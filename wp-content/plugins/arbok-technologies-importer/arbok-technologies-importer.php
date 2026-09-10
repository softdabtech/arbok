<?php
/**
 * Plugin Name: ARBOK Technologies Importer
 * Description: Imports the ARBOK public technology stack into the Technology custom post type with SEO metadata, sectors and readiness filters.
 * Version: 1.0.0
 * Author: ARBOK
 */

if (!defined('ABSPATH')) {
    exit;
}

final class Arbok_Technologies_Importer {
    private const NONCE = 'arbok_technologies_import';
    private const OPTION_LAST_REPORT = 'arbok_technologies_import_last_report';

    public static function boot(): void {
        add_action('admin_menu', [__CLASS__, 'admin_menu']);
        add_action('admin_post_arbok_import_technologies', [__CLASS__, 'handle_import']);
    }

    public static function admin_menu(): void {
        add_management_page(
            'ARBOK Technologies Import',
            'ARBOK Technologies Import',
            'manage_options',
            'arbok-technologies-import',
            [__CLASS__, 'render_admin_page']
        );
    }

    public static function render_admin_page(): void {
        if (!current_user_can('manage_options')) {
            return;
        }
        $records = self::records();
        $report = get_option(self::OPTION_LAST_REPORT, []);
        ?>
        <div class="wrap">
            <h1>ARBOK Technologies Import</h1>
            <p>This importer creates or updates ARBOK technology pages from the prepared public technology package. Existing matching technologies are updated, not duplicated.</p>
            <div style="background:#fff;border:1px solid #ccd0d4;padding:16px 20px;max-width:920px;margin:18px 0;">
                <p><strong>Technologies in package:</strong> <?php echo esc_html((string) count($records)); ?></p>
                <p><strong>Target post type:</strong> technology</p>
                <p><strong>Filters:</strong> technology sectors and readiness stages are assigned automatically.</p>
                <p><strong>SEO:</strong> each page receives an SEO title/meta description source field for the ARBOK theme and SEO plugins.</p>
            </div>
            <?php if (!post_type_exists('technology')) : ?>
                <div class="notice notice-error"><p>The <code>technology</code> post type is not available. Activate the ARBOK Core plugin first.</p></div>
            <?php else : ?>
                <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <?php wp_nonce_field(self::NONCE); ?>
                    <input type="hidden" name="action" value="arbok_import_technologies">
                    <?php submit_button('Import / Update ARBOK Technologies'); ?>
                </form>
            <?php endif; ?>
            <?php if (is_array($report) && $report) : ?>
                <h2>Last import report</h2>
                <table class="widefat striped" style="max-width:920px;">
                    <tbody>
                        <tr><th>Created</th><td><?php echo esc_html((string) ($report['created'] ?? 0)); ?></td></tr>
                        <tr><th>Updated</th><td><?php echo esc_html((string) ($report['updated'] ?? 0)); ?></td></tr>
                        <tr><th>Skipped / failed</th><td><?php echo esc_html((string) ($report['failed'] ?? 0)); ?></td></tr>
                        <tr><th>Imported at</th><td><?php echo esc_html((string) ($report['imported_at'] ?? '')); ?></td></tr>
                    </tbody>
                </table>
                <?php if (!empty($report['messages'])) : ?>
                    <h3>Messages</h3>
                    <pre style="white-space:pre-wrap;background:#fff;border:1px solid #ccd0d4;padding:12px;max-width:920px;max-height:360px;overflow:auto;"><?php echo esc_html(implode("\n", array_slice((array) $report['messages'], -120))); ?></pre>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    public static function handle_import(): void {
        if (!current_user_can('manage_options')) {
            wp_die('Permission denied.');
        }
        check_admin_referer(self::NONCE);
        $report = self::import_records();
        update_option(self::OPTION_LAST_REPORT, $report, false);
        wp_safe_redirect(add_query_arg(['page' => 'arbok-technologies-import', 'arbok_imported' => '1'], admin_url('tools.php')));
        exit;
    }

    public static function import_records(): array {
        $created = 0;
        $updated = 0;
        $failed = 0;
        $messages = [];

        self::ensure_base_terms();

        foreach (self::records() as $record) {
            try {
                $existing_id = self::find_existing_post($record);
                $postarr = [
                    'post_type' => 'technology',
                    'post_status' => 'publish',
                    'post_title' => $record['title'],
                    'post_name' => $record['slug'],
                    'post_excerpt' => $record['short_description'],
                    'post_content' => $record['content_html'],
                ];

                if ($existing_id) {
                    $postarr['ID'] = $existing_id;
                    $post_id = wp_update_post(wp_slash($postarr), true);
                    $updated++;
                } else {
                    $post_id = wp_insert_post(wp_slash($postarr), true);
                    $created++;
                }

                if (is_wp_error($post_id)) {
                    $failed++;
                    $messages[] = $record['title'] . ': ' . $post_id->get_error_message();
                    continue;
                }

                foreach ($record['meta'] as $key => $value) {
                    update_post_meta($post_id, $key, wp_kses_post($value));
                }
                update_post_meta($post_id, 'technology_name', sanitize_text_field($record['title']));
                update_post_meta($post_id, 'short_description', sanitize_textarea_field($record['short_description']));
                update_post_meta($post_id, 'full_description', wp_kses_post($record['content_html']));
                update_post_meta($post_id, '_arbok_meta_title', sanitize_text_field($record['seo_title']));
                update_post_meta($post_id, '_arbok_meta_description', sanitize_text_field($record['seo_description']));
                update_post_meta($post_id, '_arbok_source_file', sanitize_text_field($record['source_file']));
                update_post_meta($post_id, '_arbok_import_batch', 'technologies-public-365');

                wp_set_object_terms($post_id, [$record['sector_slug']], 'technology_sector', false);
                wp_set_object_terms($post_id, [$record['readiness_slug']], 'readiness_stage', false);
            } catch (Throwable $e) {
                $failed++;
                $messages[] = $record['title'] . ': ' . $e->getMessage();
            }
        }

        flush_rewrite_rules(false);

        return [
            'created' => $created,
            'updated' => $updated,
            'failed' => $failed,
            'imported_at' => current_time('mysql'),
            'messages' => $messages,
        ];
    }

    private static function records(): array {
        $file = __DIR__ . '/includes/technology-data.php';
        if (!file_exists($file)) {
            return [];
        }
        $records = require $file;
        return is_array($records) ? $records : [];
    }

    private static function find_existing_post(array $record): int {
        $aliases = array_unique(array_filter(array_merge([$record['slug'], $record['code_slug'] ?? ''], $record['aliases'] ?? [])));
        foreach ($aliases as $slug) {
            $post = get_page_by_path($slug, OBJECT, 'technology');
            if ($post instanceof WP_Post) {
                return (int) $post->ID;
            }
        }

        global $wpdb;
        $title = (string) $record['title'];
        $id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'technology' AND post_status NOT IN ('trash','auto-draft') AND LOWER(post_title) = LOWER(%s) LIMIT 1",
            $title
        ));

        return $id ? (int) $id : 0;
    }

    private static function ensure_base_terms(): void {
        $sectors = [
            'sector-a' => 'Water Desalination & Treatment',
            'sector-b' => 'Waste Management & Remediation',
            'sector-c' => 'Energy Production',
            'sector-d' => 'Air & Climate Control',
            'sector-e' => 'Oil Spill Cleanup',
            'sector-f' => 'Organic Fertilizers',
            'sector-g' => 'Liquid Transportation',
            'sector-h' => 'Crystallization Systems',
            'sector-i' => 'Water Production',
        ];
        foreach ($sectors as $slug => $name) {
            self::ensure_term('technology_sector', $slug, $name);
        }

        $stages = [
            'trl-1-3' => 'TRL 1–3: Concept / early research',
            'trl-4-5' => 'TRL 4–5: Validated research',
            'trl-6-7' => 'TRL 6–7: Pilot / demonstration',
            'trl-8-9' => 'TRL 8–9: Deployment-ready',
            'stage-on-request' => 'Stage on request',
        ];
        foreach ($stages as $slug => $name) {
            self::ensure_term('readiness_stage', $slug, $name);
        }
    }

    private static function ensure_term(string $taxonomy, string $slug, string $name): int {
        $term = get_term_by('slug', $slug, $taxonomy);
        if ($term && !is_wp_error($term)) {
            return (int) $term->term_id;
        }
        $result = wp_insert_term($name, $taxonomy, ['slug' => $slug]);
        if (is_wp_error($result)) {
            $fallback = get_term_by('name', $name, $taxonomy);
            return $fallback && !is_wp_error($fallback) ? (int) $fallback->term_id : 0;
        }
        return (int) $result['term_id'];
    }
}

Arbok_Technologies_Importer::boot();
