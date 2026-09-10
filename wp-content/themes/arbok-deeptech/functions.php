<?php
if (!defined('ABSPATH')) {
    exit;
}

function arbok_theme_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('site-icon');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');
    register_nav_menus(['primary' => 'Primary navigation', 'footer' => 'Footer navigation']);
}
add_action('after_setup_theme', 'arbok_theme_setup');

function arbok_assets(): void {
    $version = (string) filemtime(get_template_directory() . '/assets/css/main.css');
    wp_enqueue_style('arbok-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Manrope:wght@500;600;700;800&display=swap', [], null);
    wp_enqueue_style('arbok-main', get_template_directory_uri() . '/assets/css/main.css', [], $version);
    wp_enqueue_script('arbok-main', get_template_directory_uri() . '/assets/js/main.js', [], $version, true);
}
add_action('wp_enqueue_scripts', 'arbok_assets');

function arbok_document_meta(): void {
    if (function_exists('arbok_is_terms_of_use') && arbok_is_terms_of_use()) {
        $description = 'Terms of Use for the ARBOK website, including website access, informational materials, intellectual property, submissions, disclaimers and limitations of liability.';
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        echo '<link rel="canonical" href="' . esc_url(home_url('/terms-of-use/')) . '">' . "\n";
        echo '<meta property="og:title" content="Terms of Use | ARBOK">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url('/terms-of-use/')) . '">' . "\n";
        echo '<meta property="og:image" content="' . esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png') . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        return;
    }
    if (function_exists('arbok_is_density_doctrine') && arbok_is_density_doctrine()) {
        $description = 'The Density Doctrine by the ARBOK Strategic Research Institute: a strategic proposition on density, useful work, water, waste, energy and Zero Waste Discharge.';
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        echo '<link rel="canonical" href="' . esc_url(home_url('/density-doctrine/')) . '">' . "\n";
        echo '<meta property="og:title" content="The Density Doctrine | ARBOK">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url('/density-doctrine/')) . '">' . "\n";
        echo '<meta property="og:image" content="' . esc_url(get_template_directory_uri() . '/assets/images/density-doctrine-hero.jpg') . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        $schema = ['@context' => 'https://schema.org', '@graph' => [
            ['@type' => 'Organization', '@id' => home_url('/#organization'), 'name' => 'STRATEGIC RESEARCH INSTITUTE ARBOK', 'url' => home_url('/'), 'logo' => get_template_directory_uri() . '/assets/images/arbok-logo.png', 'email' => 'info@arbok.tech'],
            ['@type' => 'Article', '@id' => home_url('/density-doctrine/#article'), 'headline' => 'The Density Doctrine', 'description' => $description, 'url' => home_url('/density-doctrine/'), 'image' => get_template_directory_uri() . '/assets/images/density-doctrine-hero.jpg', 'publisher' => ['@id' => home_url('/#organization')]],
        ]];
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        return;
    }
    if (function_exists('arbok_is_europe_water_resilience') && arbok_is_europe_water_resilience()) {
        $description = 'Advanced technologies for desalination, water purification, water reuse and water resilience across Europe. Partner with ARBOK International.';
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        echo '<link rel="canonical" href="' . esc_url(home_url('/europe-water-resilience/')) . '">' . "\n";
        echo '<meta property="og:title" content="Europe Water Resilience Solutions | ARBOK International Inc.">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url('/europe-water-resilience/')) . '">' . "\n";
        echo '<meta property="og:image" content="' . esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png') . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        $schema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                ['@type'=>'Organization','@id'=>home_url('/#organization'),'name'=>'STRATEGIC RESEARCH INSTITUTE ARBOK','url'=>home_url('/'),'logo'=>get_template_directory_uri() . '/assets/images/arbok-logo.png','email'=>'info@arbok.tech'],
                ['@type'=>'WebPage','@id'=>home_url('/europe-water-resilience/#webpage'),'url'=>home_url('/europe-water-resilience/'),'name'=>'Europe Water Resilience Solutions','description'=>$description,'publisher'=>['@id'=>home_url('/#organization')]],
                ['@type'=>'FAQPage','mainEntity'=>[
                    ['@type'=>'Question','name'=>'How can Europe address water scarcity?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Europe can combine demand management, infrastructure modernization, water reuse, desalination, industrial recovery and regional resilience planning.']],
                    ['@type'=>'Question','name'=>'What technologies can improve water resilience?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Water purification, reuse, brine conversion, industrial recovery and modular water production can improve resilience.']],
                    ['@type'=>'Question','name'=>'Can desalination help European regions?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Desalination can support coastal regions, islands, emergency supply and industrial projects when designed with sustainability and recovery in mind.']],
                    ['@type'=>'Question','name'=>'How can industries reduce water consumption?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Industries can recover process water, reuse treated streams, reduce discharge and integrate circular-water systems.']],
                    ['@type'=>'Question','name'=>'What is water reuse?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Water reuse means treating wastewater or process water so it can be safely used again for municipal, agricultural or industrial purposes.']],
                    ['@type'=>'Question','name'=>'How can municipalities improve water security?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Municipalities can diversify supply, reduce losses, modernize treatment, reuse water and prepare emergency drinking-water capacity.']]
                ]]
            ]
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        return;
    }
    if (function_exists('arbok_is_water_solutions') && arbok_is_water_solutions()) {
        $pages = function_exists('arbok_water_solution_meta_pages') ? arbok_water_solution_meta_pages() : [];
        $slug = function_exists('arbok_water_solution_slug') ? arbok_water_solution_slug() : '';
        $page = $slug !== '' && isset($pages[$slug]) ? $pages[$slug] : null;
        $title = $page['title'] ?? 'Water Solutions';
        $description = $page['description'] ?? 'ARBOK water solutions for True Zero-Liquid Discharge desalination, brine conversion, wastewater reuse, industrial water treatment and validation-ready technical diligence.';
        $canonical_path = $slug !== '' ? '/water-solutions/' . $slug . '/' : '/water-solutions/';
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        echo '<link rel="canonical" href="' . esc_url(home_url($canonical_path)) . '">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($title . ' | ARBOK') . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url($canonical_path)) . '">' . "\n";
        echo '<meta property="og:image" content="' . esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png') . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        $schema = ['@context' => 'https://schema.org', '@graph' => [
            ['@type' => 'Organization', '@id' => home_url('/#organization'), 'name' => 'STRATEGIC RESEARCH INSTITUTE ARBOK', 'url' => home_url('/'), 'logo' => get_template_directory_uri() . '/assets/images/arbok-logo.png', 'email' => 'info@arbok.tech'],
            ['@type' => 'TechArticle', '@id' => home_url($canonical_path . '#article'), 'headline' => $title, 'description' => $description, 'url' => home_url($canonical_path), 'publisher' => ['@id' => home_url('/#organization')], 'about' => ['@type' => 'Thing', 'name' => 'Zero-Liquid Discharge water technology']],
        ]];
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        return;
    }
    $description = '';
    if (is_front_page()) {
        $description = 'ARBOK develops Zero Waste Discharge technologies to restore natural equilibrium across water, waste, energy, climate and materials systems.';
    } elseif (is_singular()) {
        $description = (string) get_post_meta(get_queried_object_id(), '_arbok_meta_description', true);
        if ($description === '') {
            $description = arbok_clean_summary(get_the_excerpt() ?: get_post_field('post_content', get_queried_object_id()), get_the_title(), 30);
        }
    } elseif (is_post_type_archive('technology')) {
        $description = 'Explore the ARBOK technology portfolio across water, energy, environment and industrial systems.';
    } elseif (is_post_type_archive('sector')) {
        $description = 'Explore nine ARBOK technology sectors and their related applications.';
    } elseif (is_post_type_archive('team_member')) {
        $description = 'Meet the international ARBOK leadership and technical team.';
    }
    $description = trim(wp_strip_all_tags($description));
    if ($description !== '') {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    }
    echo '<meta property="og:title" content="' . esc_attr(wp_get_document_title()) . '">' . "\n";
    echo '<meta property="og:type" content="' . (is_singular() ? 'article' : 'website') . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url((is_singular() ? get_permalink() : home_url(add_query_arg([], $GLOBALS['wp']->request ?? '')))) . '">' . "\n";
    $image = is_singular() && has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : get_template_directory_uri() . '/assets/images/arbok-logo.png';
    echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    if (wp_get_environment_type() === 'local' || in_array(wp_parse_url(home_url(), PHP_URL_HOST), ['127.0.0.1', 'localhost'], true)) {
        echo '<meta name="robots" content="noindex,nofollow">' . "\n";
    }
    $organization = [
        '@type' => 'Organization',
        '@id' => home_url('/#organization'),
        'name' => 'STRATEGIC RESEARCH INSTITUTE ARBOK',
        'url' => home_url('/'),
        'logo' => get_template_directory_uri() . '/assets/images/arbok-logo.png',
        'email' => 'info@arbok.tech',
        'telephone' => '+1-929-235-1625',
        'description' => 'Zero Waste Discharge technology portfolio for water, waste, energy, climate and material systems.',
    ];
    $graph = [$organization];
    if (is_singular('technology')) {
        $graph[] = [
            '@type' => 'TechArticle',
            'headline' => get_the_title(),
            'description' => $description,
            'url' => get_permalink(),
            'image' => $image,
            'publisher' => ['@id' => home_url('/#organization')],
            'about' => ['@type' => 'Thing', 'name' => get_the_title()],
        ];
    } elseif (is_singular('team_member')) {
        $graph[] = [
            '@type' => 'Person',
            'name' => get_the_title(),
            'jobTitle' => (string) get_post_meta(get_the_ID(), 'role', true),
            'image' => $image,
            'worksFor' => ['@id' => home_url('/#organization')],
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'arbok_document_meta', 3);

function arbok_ga4_water_pages_fallback(): void {
    if (!function_exists('arbok_is_water_solutions') || !arbok_is_water_solutions()) {
        return;
    }
    ?>
<!-- Google Analytics GA4 fallback for ARBOK virtual Water Solutions pages -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PXDVFCSFSF"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-PXDVFCSFSF');
</script>
<?php
}
add_action('wp_head', 'arbok_ga4_water_pages_fallback', 20);

function arbok_security_headers(): void {
    if (headers_sent()) {
        return;
    }
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    header('X-Frame-Options: SAMEORIGIN');
}
add_action('send_headers', 'arbok_security_headers');
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');


function arbok_is_europe_water_resilience(): bool {
    $path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    return $path === 'europe-water-resilience';
}

function arbok_water_solution_slug(): string {
    $path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($path === 'water-solutions') {
        return '';
    }
    if (strpos($path, 'water-solutions/') === 0) {
        return trim(substr($path, strlen('water-solutions/')), '/');
    }
    return '';
}

function arbok_is_water_solutions(): bool {
    $path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if ($path === 'water-solutions') {
        return true;
    }
    $slug = arbok_water_solution_slug();
    return $slug !== '' && isset(arbok_water_solution_meta_pages()[$slug]);
}

function arbok_water_solution_meta_pages(): array {
    return [
        'true-zero-liquid-discharge' => [
            'title' => 'True Zero-Liquid Discharge',
            'description' => 'ARBOK True Zero-Liquid Discharge technology converts seawater, brine and complex water streams into drinkable water and dry salt or minerals without liquid waste discharge.',
        ],
        'v12-system-operation' => [
            'title' => 'ARBOK V12 System & Operation',
            'description' => 'ARBOK V12 modular water-treatment architecture for continuous operation, vacuum evaporation, condensation, salt extraction and remote monitored water production.',
        ],
        'deployment-scenarios' => [
            'title' => 'Greenfield & Brownfield Water Deployment',
            'description' => 'ARBOK deployment scenarios for new desalination plants and brownfield brine-recovery integration with existing reverse-osmosis infrastructure.',
        ],
        'wastewater-industrial-reuse' => [
            'title' => 'Wastewater & Industrial Reuse',
            'description' => 'ARBOK water technologies for wastewater purification, industrial water reuse, oil-contaminated water, brackish water and circular water recovery projects.',
        ],
        'validation-performance' => [
            'title' => 'Validation & Performance Evidence',
            'description' => 'ARBOK water-technology validation references including SGS reports, water-quality testing, EU quality testing and investor diligence performance indicators.',
        ],
    ];
}

function arbok_is_density_doctrine(): bool {
    $path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    return $path === 'density-doctrine';
}

function arbok_is_terms_of_use(): bool {
    $path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    return $path === 'terms-of-use';
}

add_filter('pre_get_document_title', function ($title) {
    if (arbok_is_terms_of_use()) {
        return 'Terms of Use | ARBOK';
    }
    if (arbok_is_density_doctrine()) {
        return 'The Density Doctrine | ARBOK';
    }
    if (arbok_is_europe_water_resilience()) {
        return 'Europe Water Resilience Solutions | ARBOK International Inc.';
    }
    if (arbok_is_water_solutions()) {
        $pages = arbok_water_solution_meta_pages();
        $slug = arbok_water_solution_slug();
        return ($slug !== '' && isset($pages[$slug]) ? $pages[$slug]['title'] : 'Water Solutions') . ' | ARBOK';
    }
    return $title;
}, 30);

function arbok_render_terms_of_use(): void {
    if (!arbok_is_terms_of_use()) {
        return;
    }
    global $wp_query;
    if ($wp_query) {
        $wp_query->is_404 = false;
    }
    status_header(200);
    include get_template_directory() . '/page-terms-of-use.php';
    exit;
}
add_action('template_redirect', 'arbok_render_terms_of_use', 1);

function arbok_render_density_doctrine(): void {
    if (!arbok_is_density_doctrine()) {
        return;
    }
    global $wp_query;
    if ($wp_query) {
        $wp_query->is_404 = false;
    }
    status_header(200);
    include get_template_directory() . '/page-density-doctrine.php';
    exit;
}
add_action('template_redirect', 'arbok_render_density_doctrine', 1);

function arbok_render_europe_water_resilience(): void {
    if (!arbok_is_europe_water_resilience()) {
        return;
    }
    global $wp_query;
    if ($wp_query) {
        $wp_query->is_404 = false;
    }
    status_header(200);
    include get_template_directory() . '/page-europe-water-resilience.php';
    exit;
}
add_action('template_redirect', 'arbok_render_europe_water_resilience', 1);

function arbok_render_water_solutions(): void {
    if (!arbok_is_water_solutions()) {
        return;
    }
    global $wp_query;
    if ($wp_query) {
        $wp_query->is_404 = false;
    }
    status_header(200);
    include get_template_directory() . '/page-water-solutions.php';
    exit;
}
add_action('template_redirect', 'arbok_render_water_solutions', 1);

function arbok_image_attributes(array $attr, WP_Post $attachment): array {
    if (empty($attr['alt'])) {
        $attr['alt'] = sanitize_text_field($attachment->post_excerpt ?: $attachment->post_title);
    }
    if (empty($attr['loading'])) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'arbok_image_attributes', 10, 2);

function arbok_logo(string $context = 'header'): void {
    printf(
        '<span class="brand-logo brand-logo--%1$s"><img src="%2$s" alt="STRATEGIC RESEARCH INSTITUTE ARBOK"><span class="brand-wordmark"><strong>ARBOK</strong><small>Strategic Research Institute</small></span></span>',
        esc_attr($context),
        esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png')
    );
}

function arbok_media_url(string $title, string $fallback = ''): string {
    $attachment = get_page_by_title($title, OBJECT, 'attachment');
    return $attachment ? (string) wp_get_attachment_url($attachment->ID) : $fallback;
}

function arbok_breadcrumbs(): void {
    if (is_front_page()) {
        return;
    }
    echo '<nav class="breadcrumbs" aria-label="Breadcrumb"><a href="' . esc_url(home_url('/')) . '">Home</a><span>/</span>';
    $current = '';
    if (is_singular('technology')) {
        echo '<a href="' . esc_url(get_post_type_archive_link('technology')) . '">Technologies</a><span>/</span>';
        $current = get_the_title();
    } elseif (is_singular('sector')) {
        echo '<a href="' . esc_url(get_post_type_archive_link('sector')) . '">Sectors</a><span>/</span>';
        $current = get_the_title();
    } elseif (is_singular('team_member')) {
        echo '<a href="' . esc_url(get_post_type_archive_link('team_member')) . '">Team</a><span>/</span>';
        $current = get_the_title();
    } elseif (is_post_type_archive()) {
        $current = post_type_archive_title('', false);
    } elseif (is_singular()) {
        $current = get_the_title();
    }
    echo '<span aria-current="page">' . esc_html(wp_strip_all_tags($current)) . '</span></nav>';
}


function arbok_technology_image_url(string $slug): string {
    $slug = sanitize_title($slug);
    $generated_path = get_template_directory() . '/assets/images/technology-visuals/' . $slug . '.svg';
    if ($slug && file_exists($generated_path)) {
        return get_template_directory_uri() . '/assets/images/technology-visuals/' . $slug . '.svg';
    }

    $map = [
        'arbok-desalination' => ['ARBOK Desalination System', 'ARBOK-Desalination-System', 'WaterOutput'],
        'arbok-brine' => ['ARBOK Brine', 'Salt Production', 'Crystallization'],
        'arbok-purification' => ['ARBOK Purification', 'ARBOK Purification System', 'Arbok-Purification'],
        'arbok-dynamix' => ['Dynamix', 'Arbok Dynamix', 'Arbok-Dynamix'],
        'arbok-air' => ['Arbok Air', 'ARBOK Air', 'Arbok-Air'],
        'arbok-teg' => ['TEG Equipment', 'TEG_Equipment', 'Energy Efficiency'],
        'arbok-black-sand' => ['Arbok BlackSand', 'Black Sand', 'Arbok-BlackSand'],
        'arbok-peak' => ['Arbok Peak', 'PEAK Water', 'Arbok-Peak'],
        'arbok-crystallizer' => ['Crystallization', 'rbok Crystalizer', 'rbok-Crystalizer'],
        'arbok-bottling' => ['Water Bottling', 'Water-Bottling', 'Arbok bottling'],
    ];
    foreach (($map[$slug] ?? []) as $title) {
        $url = arbok_media_url($title);
        if ($url) {
            return $url;
        }
    }
    return '';
}

function arbok_technology_visual_fallback(int $post_id = 0, string $context = 'card'): void {
    $post_id = $post_id ?: get_the_ID();
    $terms = get_the_terms($post_id, 'technology_sector');
    $sector = $terms && !is_wp_error($terms) ? $terms[0]->name : 'ARBOK technology';
    $sector_slug = $terms && !is_wp_error($terms) ? sanitize_html_class($terms[0]->slug) : 'multi-sector';
    $title = get_the_title($post_id);
    $short_title = preg_replace('/^ARBOK[\s\-:]*/i', '', $title);
    $short_title = wp_trim_words($short_title ?: $title, $context === 'hero' ? 8 : 5, '');
    ?>
    <div class="technology-visual-fallback technology-visual-fallback--<?php echo esc_attr($sector_slug); ?> technology-visual-fallback--<?php echo esc_attr($context); ?>" role="img" aria-label="<?php echo esc_attr($title); ?>">
        <span class="tech-visual-orbit" aria-hidden="true"></span>
        <span class="tech-visual-grid" aria-hidden="true"></span>
        <span class="tech-visual-badge"><?php echo esc_html($sector); ?></span>
        <strong><?php echo esc_html($short_title); ?></strong>
        <small>Strategic Research Institute ARBOK</small>
    </div>
    <?php
}

function arbok_technology_card(int $post_id = 0): void {
    $post_id = $post_id ?: get_the_ID();
    $card_slug = get_post_field('post_name', $post_id);
    $terms = get_the_terms($post_id, 'technology_sector');
    $sector = $terms && !is_wp_error($terms) ? $terms[0]->name : 'Multi-sector platform';
    $sector_slug = $terms && !is_wp_error($terms) ? sanitize_html_class($terms[0]->slug) : 'multi-sector';
    $stage_terms = get_the_terms($post_id, 'readiness_stage');
    $stage_meta = (string) arbok_field('technology_readiness_level', $post_id, '');
    $stage = $stage_terms && !is_wp_error($stage_terms) ? $stage_terms[0]->name : ($stage_meta ?: 'Stage on request');
    $summary_source = (string) arbok_field('short_description', $post_id, get_post_field('post_excerpt', $post_id) ?: get_post_field('post_content', $post_id));
    ?>
    <article class="technology-card technology-card--<?php echo esc_attr($card_slug); ?> technology-card--sector-<?php echo esc_attr($sector_slug); ?>">
        <a class="technology-card__visual" href="<?php echo esc_url(get_permalink($post_id)); ?>">
            <?php if (has_post_thumbnail($post_id)) : echo get_the_post_thumbnail($post_id, 'large'); else : $fallback_image = arbok_technology_image_url($card_slug); ?>
                <?php if ($fallback_image) : ?><img src="<?php echo esc_url($fallback_image); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>" loading="lazy"><?php else : arbok_technology_visual_fallback($post_id, 'card'); endif; ?>
            <?php endif; ?>
        </a>
        <div class="technology-card__body">
            <div class="card-kicker"><span><?php echo esc_html($sector); ?></span><i aria-hidden="true">•</i><span><?php echo esc_html($stage); ?></span></div>
            <h3><a href="<?php echo esc_url(get_permalink($post_id)); ?>"><?php echo esc_html(get_the_title($post_id)); ?></a></h3>
            <p><?php echo esc_html(arbok_clean_summary($summary_source, get_the_title($post_id), 25)); ?></p>
            <div class="card-actions"><a class="text-link" href="<?php echo esc_url(get_permalink($post_id)); ?>">Explore technology <span>↗</span></a><a class="mini-cta" href="<?php echo esc_url(home_url('/contact/?subject=technology&technology=' . rawurlencode(get_the_title($post_id)))); ?>">Discuss</a></div>
        </div>
    </article>
    <?php
}

function arbok_excerpt(int $words = 28): string {
    $text = get_the_excerpt() ?: wp_strip_all_tags(get_the_content());
    return wp_trim_words($text, $words);
}

function arbok_clean_summary(string $text, string $title = '', int $words = 30): string {
    $text = html_entity_decode(wp_strip_all_tags($text), ENT_QUOTES | ENT_HTML5);
    $text = preg_replace('/\s+/', ' ', $text);
    $text = preg_split('/\bSUMMARY\s*:/i', $text)[0] ?? $text;
    if ($title !== '') {
        $text = preg_replace('/^' . preg_quote($title, '/') . '\s*/i', '', $text);
    }
    $text = preg_replace('/^ARBOK\s*-\s*[^"]*"([^"]+)"\s*/i', '', $text);
    $text = str_replace(['SUMMARY:', 'SUMMARY', 'Bio', 'WHO WE ARE'], ' ', $text);
    $text = preg_replace('/([.!?])(?=[A-Z])/', '$1 ', $text);
    $text = preg_replace('/\s+/', ' ', $text);
    return wp_trim_words(trim($text, " \t\n\r\0\x0B\"'"), $words);
}

function arbok_sector_name(string $slug): string {
    $names = [
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
    return $names[$slug] ?? get_the_title();
}

function arbok_sector_summary(string $slug): string {
    $summaries = [
        'sector-a' => 'Desalination, brine recovery, purification, and treatment of radioactive or oil-contaminated water.',
        'sector-b' => 'Thermodynamic processing for polymer, rubber, and petroleum-contaminated waste streams.',
        'sector-c' => 'Heavy-water, hydrogen, and thermodynamic energy systems.',
        'sector-d' => 'Efficient evaporative cooling and atmospheric ionization technologies.',
        'sector-e' => 'Oil-spill sorbent and recovery systems for water and difficult terrain.',
        'sector-f' => 'Lower-energy extraction and production of organic sapropel fertilizer.',
        'sector-g' => 'Low-energy liquid transport for water, oil, and petroleum products.',
        'sector-h' => 'Phase-change crystal separation for efficient solid-liquid processing.',
        'sector-i' => 'Integrated desalination and direct drinking-water bottling.',
    ];
    if (isset($summaries[$slug])) { return $summaries[$slug]; }
    return arbok_clean_summary(get_the_excerpt() ?: get_the_content(), get_the_title(), 22);
}

function arbok_sector_image(string $slug): string {
    $titles = [
        'sector-a' => 'ARBOK-Desalination System',
        'sector-b' => 'Arbok-BlackSand-00004',
        'sector-c' => 'Arbok-Dynamix-00001',
        'sector-d' => 'Arbok-Air-00002',
        'sector-e' => 'Oil Spills',
        'sector-f' => 'Sapropel',
        'sector-g' => 'Arbok-Peak-00002',
        'sector-h' => 'Crystallization',
        'sector-i' => 'Water Bottling',
    ];
    if (isset($titles[$slug])) { return arbok_media_url($titles[$slug]); }
    if (has_post_thumbnail()) { return (string) get_the_post_thumbnail_url(get_the_ID(), 'large'); }
    return arbok_media_url('Technologies', arbok_media_url('Tech Blue', ''));
}


function arbok_sector_count(): int {
    return (int) (wp_count_posts('sector')->publish ?? 0);
}

function arbok_sector_card(int $post_id = 0, int $index = 0): void {
    $post_id = $post_id ?: get_the_ID();
    $slug = get_post_field('post_name', $post_id);
    $title = arbok_sector_name($slug);
    $summary = arbok_sector_summary($slug);
    $image = has_post_thumbnail($post_id) ? (string) get_the_post_thumbnail_url($post_id, 'large') : arbok_sector_image($slug);
    $number = $index > 0 ? str_pad((string) $index, 2, '0', STR_PAD_LEFT) : '→';
    ?>
    <a class="sector-card-v2 sector-card-v2--<?php echo esc_attr($slug); ?>" href="<?php echo esc_url(get_permalink($post_id)); ?>">
        <span class="sector-card-v2__media"><?php if ($image) : ?><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy"><?php endif; ?></span>
        <span class="sector-card-v2__body"><span class="sector-card-v2__index"><?php echo esc_html($number); ?></span><strong><?php echo esc_html($title); ?></strong><small><?php echo esc_html($summary); ?></small><b>Explore sector ↗</b></span>
    </a>
    <?php
}

function arbok_localize_legacy_content(string $content): string {
    $technology_slugs = [
        'arbok-brine','arbok-desalination','arbok-purification','arbok-oasis','arbok-nuke',
        'arbok-space','arbok-sotarix','arbok-newro','arbok-oily','arbok-desulph',
        'arbok-blacksand','arbok-deuterium','arbok-dynamix','arbok-arctic','arbok-air',
        'arbok-skymanager','arbok-teg','arbok-sapropel','arbok-peak','arbok-crystallizer','arbok-bottling',
    ];
    foreach ($technology_slugs as $slug) {
        $content = str_replace(
            ['https://arbok.tech/' . $slug . '/', 'http://arbok.tech/' . $slug . '/'],
            trailingslashit(get_post_type_archive_link('technology')) . $slug . '/',
            $content
        );
    }
    $content = str_replace(['https://arbok.tech/technology/', 'http://arbok.tech/technology/'], get_post_type_archive_link('technology'), $content);
    $content = preg_replace('/<a\b([^>]*?)href=(["\'])#\2([^>]*)>(.*?)<\/a>/is', '$4', $content);
    $content = preg_replace('/<img\b[^>]*demosites\.royal-elementor-addons\.com[^>]*>/is', '', $content);
    return $content;
}
add_filter('the_content', 'arbok_localize_legacy_content', 20);

function arbok_repair_primary_menu_links(array $items, object $args): array {
    if (($args->theme_location ?? '') !== 'primary') {
        return $items;
    }
    $destinations = [
        'Technologies' => get_post_type_archive_link('technology'),
        'Water' => home_url('/water-solutions/'),
        'Water Solutions' => home_url('/water-solutions/'),
        'Directions' => home_url('/directions/'),
        'Doctrine' => home_url('/density-doctrine/'),
        'Sectors' => home_url('/directions/'),
        'About ARBOK' => home_url('/about-arbok/'),
        'Team' => get_post_type_archive_link('team_member'),
        'Blog' => get_post_type_archive_link('update'),
        'News / Updates' => get_post_type_archive_link('update'),
    ];
    foreach ($items as $item) {
        $title = wp_strip_all_tags($item->title);
        if (isset($destinations[$title])) {
            $item->url = $destinations[$title];
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'arbok_repair_primary_menu_links', 10, 2);


function arbok_hidden_team_ids(): array {
    $hidden_slugs = ['mohamed-zayed'];
    $ids = [];
    foreach ($hidden_slugs as $slug) {
        $post = get_page_by_path($slug, OBJECT, 'team_member');
        if ($post) {
            $ids[] = (int) $post->ID;
        }
    }
    return $ids;
}

function arbok_hide_legacy_team_member(): void {
    if (is_singular('team_member') && get_post_field('post_name') === 'mohamed-zayed') {
        wp_safe_redirect(get_post_type_archive_link('team_member'), 301);
        exit;
    }
}
add_action('template_redirect', 'arbok_hide_legacy_team_member');

function arbok_team_archive_order(WP_Query $query): void {
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('team_member')) {
        $query->set('posts_per_page', -1);
        $query->set('post__not_in', arbok_hidden_team_ids());
        $query->set('orderby', ['menu_order' => 'ASC', 'title' => 'ASC']);
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'arbok_team_archive_order');


function arbok_header_menu(): void {
    $items = [
        'Technologies' => get_post_type_archive_link('technology'),
        'Water' => home_url('/water-solutions/'),
        'Directions' => home_url('/directions/'),
        'Doctrine' => home_url('/density-doctrine/'),
        'About' => home_url('/about-arbok/'),
        'Team' => get_post_type_archive_link('team_member'),
        'Blog' => get_post_type_archive_link('update'),
    ];
    echo '<ul class="nav-list nav-list--header">';
    foreach ($items as $label => $url) {
        printf('<li><a href="%s">%s</a></li>', esc_url($url), esc_html($label));
    }
    echo '</ul>';
}

function arbok_menu_fallback(): void {
    $items = [
        'Technologies' => get_post_type_archive_link('technology'),
        'Water' => home_url('/water-solutions/'),
        'Directions' => home_url('/directions/'),
        'Doctrine' => home_url('/density-doctrine/'),
        'About' => home_url('/about-arbok/'),
        'Team' => get_post_type_archive_link('team_member'),
        'Blog' => get_post_type_archive_link('update'),
    ];
    echo '<ul class="nav-list">';
    foreach ($items as $label => $url) {
        printf('<li><a href="%s">%s</a></li>', esc_url($url), esc_html($label));
    }
    echo '</ul>';
}

function arbok_contact_spam_fields(): void {
    $issued_at = time();
    $token = wp_hash($issued_at . '|arbok_contact_form');
    echo '<input type="hidden" name="arbok_form_issued_at" value="' . esc_attr((string) $issued_at) . '">';
    echo '<input type="hidden" name="arbok_form_token" value="' . esc_attr($token) . '">';
}

function arbok_contact_is_spam_submission(string $message, string $name, string $email): bool {
    $issued_at = absint($_POST['arbok_form_issued_at'] ?? 0);
    $token = sanitize_text_field(wp_unslash($_POST['arbok_form_token'] ?? ''));
    $age = time() - $issued_at;

    if ($issued_at <= 0 || $token === '' || !hash_equals(wp_hash($issued_at . '|arbok_contact_form'), $token)) {
        return true;
    }

    if ($age < 4 || $age > 3 * HOUR_IN_SECONDS) {
        return true;
    }

    if (preg_match_all('~https?://|www\\.|\\[url=|</a>|<a\\s~i', $message, $matches) > 1) {
        return true;
    }

    $content = strtolower($name . ' ' . $email . ' ' . $message);
    $blocked_patterns = [
        'casino', 'crypto', 'viagra', 'cialis', 'loan', 'porn', 'escort', 'seo backlinks',
        'guest post', 'link building', 'whatsapp marketing', 'telegram channel', 'forex',
    ];
    foreach ($blocked_patterns as $pattern) {
        if (str_contains($content, $pattern)) {
            return true;
        }
    }

    if (strlen($message) < 20 || preg_match('/(.)\\1{12,}/', $message)) {
        return true;
    }

    return false;
}

function arbok_contact_form_handler(): void {
    if (!isset($_POST['arbok_contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['arbok_contact_nonce'])), 'arbok_contact')) {
        wp_die('Invalid request.');
    }
    $redirect = wp_get_referer() ?: home_url('/contact/');
    if (!empty($_POST['website'])) {
        wp_safe_redirect(add_query_arg('contact', 'received', $redirect));
        exit;
    }
    $name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $organization = sanitize_text_field(wp_unslash($_POST['organization'] ?? ''));
    $country = sanitize_text_field(wp_unslash($_POST['country'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $representing = sanitize_text_field(wp_unslash($_POST['representing'] ?? ''));
    $subject = sanitize_text_field(wp_unslash($_POST['subject'] ?? 'General inquiry'));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));
    $context = sanitize_text_field(wp_unslash($_POST['inquiry_context'] ?? 'General inquiry'));
    if ($name === '' || !is_email($email) || $message === '' || empty($_POST['consent'])) {
        wp_safe_redirect(add_query_arg('contact', 'error', $redirect));
        exit;
    }
    if (arbok_contact_is_spam_submission($message, $name, $email)) {
        wp_safe_redirect(add_query_arg('contact', 'received', $redirect));
        exit;
    }
    $rate_key = 'arbok_inquiry_' . md5((string) ($_SERVER['REMOTE_ADDR'] ?? 'local'));
    if (get_transient($rate_key)) {
        wp_safe_redirect(add_query_arg('contact', 'error', $redirect));
        exit;
    }
    set_transient($rate_key, 1, 10 * MINUTE_IN_SECONDS);
    $daily_key = 'arbok_inquiry_daily_' . md5((string) ($_SERVER['REMOTE_ADDR'] ?? 'local'));
    $daily_count = (int) get_transient($daily_key);
    if ($daily_count >= 5) {
        wp_safe_redirect(add_query_arg('contact', 'received', $redirect));
        exit;
    }
    set_transient($daily_key, $daily_count + 1, DAY_IN_SECONDS);
    $inquiry_id = wp_insert_post([
        'post_type' => 'arbok_inquiry',
        'post_status' => 'private',
        'post_title' => $subject . ' — ' . $name,
        'post_content' => $message,
    ]);
    if ($inquiry_id && !is_wp_error($inquiry_id)) {
        update_post_meta($inquiry_id, 'name', $name);
        update_post_meta($inquiry_id, 'email', $email);
        update_post_meta($inquiry_id, 'organization', $organization);
        update_post_meta($inquiry_id, 'country', $country);
        update_post_meta($inquiry_id, 'phone', $phone);
        update_post_meta($inquiry_id, 'representing', $representing);
        update_post_meta($inquiry_id, 'subject', $subject);
        update_post_meta($inquiry_id, 'context', $context);
        update_post_meta($inquiry_id, 'submitted_at', current_time('mysql'));
    }
    $mail_body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\nOrganization: {$organization}\nCountry: {$country}\nRepresents: {$representing}\nContext: {$context}\n\n{$message}";
    wp_mail(get_option('admin_email'), '[ARBOK] ' . $subject, $mail_body, ['Reply-To: ' . $name . ' <' . $email . '>']);
    wp_safe_redirect(add_query_arg('contact', 'received', $redirect));
    exit;
}
add_action('admin_post_nopriv_arbok_contact', 'arbok_contact_form_handler');
add_action('admin_post_arbok_contact', 'arbok_contact_form_handler');


function arbok_brand_output_replacements(string $html): string {
    $map = [
        'ARBOK International Inc.' => 'STRATEGIC RESEARCH INSTITUTE ARBOK',
        'Arbok International Inc.' => 'STRATEGIC RESEARCH INSTITUTE ARBOK',
        'ARBOK Technologies' => 'STRATEGIC RESEARCH INSTITUTE ARBOK',
        'Arbok Technologies' => 'STRATEGIC RESEARCH INSTITUTE ARBOK',
        'International Inc.' => 'Strategic Research Institute',
        'Sector-A - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Water Desalination & Treatment | ARBOK',
        'Sector-B - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Waste Management & Remediation | ARBOK',
        'Sector-C - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Energy Production | ARBOK',
        'Sector-D - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Air & Climate Control | ARBOK',
        'Sector-E - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Oil Spill Cleanup | ARBOK',
        'Sector-F - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Organic Fertilizers | ARBOK',
        'Sector-G - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Liquid Transportation | ARBOK',
        'Sector-H - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Crystallization Systems | ARBOK',
        'Sector-I - STRATEGIC RESEARCH INSTITUTE ARBOK' => 'Water Production | ARBOK',
    ];
    $html = str_replace(array_keys($map), array_values($map), $html);

    $descriptions = [
        'https://arbok.tech/' => 'ARBOK develops Zero Waste Discharge technologies to restore natural equilibrium across water, waste, energy, climate and materials systems.',
        'https://arbok.tech/about-arbok/' => 'Learn about ARBOK’s mission to restore natural equilibrium through Zero Waste Discharge technologies and resource recovery systems.',
        'https://arbok.tech/contact/' => 'Contact ARBOK for technology partnerships, sector discussions, pilot deployment, licensing and strategic collaboration inquiries.',
        'https://arbok.tech/directions/' => 'Explore ARBOK strategic directions across water security, energy systems, environmental remediation and industrial resilience.',
        'https://arbok.tech/directions/water-security/' => 'ARBOK water security technologies address desalination, brine utilization, purification and distributed drinking-water production.',
        'https://arbok.tech/directions/energy-systems/' => 'ARBOK energy systems cover hydrogen, heavy-water and thermodynamic technologies for resilient infrastructure applications.',
        'https://arbok.tech/directions/environmental-remediation/' => 'ARBOK environmental remediation technologies address oil, contaminated water and difficult industrial waste streams.',
        'https://arbok.tech/directions/industrial-resilience/' => 'ARBOK industrial resilience technologies support cooling, transport, crystallization and process infrastructure.',
        'https://arbok.tech/sectors/sector-a/' => 'Desalination, brine recovery, purification and advanced water treatment technologies for resilient water infrastructure.',
        'https://arbok.tech/sectors/sector-b/' => 'Waste processing and remediation technologies for polymer, rubber and petroleum-contaminated industrial streams.',
        'https://arbok.tech/sectors/sector-c/' => 'Energy production technologies across hydrogen, heavy-water and thermodynamic energy systems.',
        'https://arbok.tech/sectors/sector-d/' => 'Air, cooling and climate-control technologies for efficient environmental and industrial applications.',
        'https://arbok.tech/sectors/sector-e/' => 'Oil spill cleanup and recovery technologies for water, shoreline and difficult terrain applications.',
        'https://arbok.tech/sectors/sector-f/' => 'Organic fertilizer technologies focused on lower-energy sapropel extraction and production.',
        'https://arbok.tech/sectors/sector-g/' => 'Liquid transportation technologies for low-energy movement of water, oil and petroleum products.',
        'https://arbok.tech/sectors/sector-h/' => 'Crystallization systems for efficient solid-liquid separation and industrial process recovery.',
        'https://arbok.tech/sectors/sector-i/' => 'Water production technologies integrating desalination and direct drinking-water bottling for distributed supply.',
    ];
    foreach ($descriptions as $canonical => $description) {
        if (preg_match('#<link rel="canonical" href="' . preg_quote($canonical, '#') . '"#', $html)) {
            $escaped = esc_attr($description);
            if (preg_match('/<meta name="description" content="[^"]*"\s*\/>/i', $html)) {
                $html = preg_replace('/<meta name="description" content="[^"]*"\s*\/>/i', '<meta name="description" content="' . $escaped . '" />', $html, 1);
            } else {
                $html = preg_replace('/(<title>.*?<\/title>)/is', '$1' . "\n" . '<meta name="description" content="' . $escaped . '" />', $html, 1);
            }
            $html = preg_replace('/<meta property="og:description" content="[^"]*"\s*\/>/i', '<meta property="og:description" content="' . $escaped . '" />', $html, 1);
            $html = preg_replace('/<meta name="twitter:description" content="[^"]*"\s*\/>/i', '<meta name="twitter:description" content="' . $escaped . '" />', $html, 1);
            break;
        }
    }
    return $html;
}

function arbok_start_brand_output_buffer(): void {
    if (!is_admin() && !wp_doing_ajax() && !wp_is_json_request() && !(function_exists('arbok_is_europe_water_resilience') && arbok_is_europe_water_resilience())) {
        ob_start('arbok_brand_output_replacements');
    }
}
add_action('template_redirect', 'arbok_start_brand_output_buffer', 0);
