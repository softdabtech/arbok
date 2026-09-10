<?php
get_header();
$sector = sanitize_text_field($_GET['tech_sector'] ?? ($_GET['sector_filter'] ?? ''));
$stage = sanitize_text_field($_GET['stage'] ?? '');
$search = sanitize_text_field($_GET['technology_search'] ?? '');
$paged = max(1, (int) get_query_var('paged'), (int) ($_GET['technology_page'] ?? 1));
$total_technologies = (int) (wp_count_posts('technology')->publish ?? 0);
?>
<section class="page-hero page-hero--compact portfolio-hero"><div class="shell"><?php arbok_breadcrumbs(); ?><div class="archive-hero-row"><div><p class="eyebrow"><?php echo esc_html((string) $total_technologies); ?> technology platforms</p><h1>ARBOK technology portfolio</h1><p class="lede">Water, energy, environmental remediation, climate control and industrial processing systems.</p></div><div class="archive-hero-mark"><strong><?php echo esc_html((string) $total_technologies); ?></strong><small>technologies</small></div></div></div></section>
<section class="section portfolio-section"><div class="shell">
<form class="filter-bar filter-bar--technology" method="get" data-portfolio-filter>
    <label class="search-field"><span>Search technologies</span><input type="search" name="technology_search" value="<?php echo esc_attr($search); ?>" placeholder="Search by name or application…"></label>
    <label><span>Sector</span><select name="tech_sector"><option value="">All sectors</option><?php foreach (get_terms(['taxonomy' => 'technology_sector', 'hide_empty' => true]) as $term) : ?><option value="<?php echo esc_attr($term->slug); ?>" <?php selected($sector, $term->slug); ?>><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></label>
    <?php $stage_terms = get_terms(['taxonomy' => 'readiness_stage', 'hide_empty' => true]); if ($stage_terms) : ?><label><span>Validated development stage</span><select name="stage"><option value="">All validated stages</option><?php foreach ($stage_terms as $term) : ?><option value="<?php echo esc_attr($term->slug); ?>" <?php selected($stage, $term->slug); ?>><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></label><?php else : ?><div class="filter-validation"><span>Readiness data</span><strong>Pending ARBOK validation</strong></div><?php endif; ?>
    <div class="filter-actions"><button class="button button-dark" type="submit">Apply filters</button>
    <a class="filter-reset" href="<?php echo esc_url(get_post_type_archive_link('technology')); ?>">Reset</a></div>
</form>
<?php
$tax_query = [];
if ($sector) $tax_query[] = ['taxonomy' => 'technology_sector', 'field' => 'slug', 'terms' => $sector];
if ($stage) $tax_query[] = ['taxonomy' => 'readiness_stage', 'field' => 'slug', 'terms' => $stage];
$portfolio = new WP_Query([
    'post_type' => 'technology',
    'posts_per_page' => 24,
    'paged' => $paged,
    's' => $search,
    'tax_query' => $tax_query,
    'orderby' => 'title',
    'order' => 'ASC',
]);
?>
<div class="results-summary"><strong><?php echo esc_html((string) $portfolio->found_posts); ?></strong> technologies found</div>
<?php if ($portfolio->have_posts()) : ?><div class="grid portfolio-grid"><?php while ($portfolio->have_posts()) : $portfolio->the_post(); arbok_technology_card(); endwhile; wp_reset_postdata(); ?></div>
<?php
$pagination = paginate_links([
    'base' => add_query_arg('technology_page', '%#%'),
    'format' => '',
    'current' => $paged,
    'total' => (int) $portfolio->max_num_pages,
    'type' => 'list',
    'prev_text' => '← Previous',
    'next_text' => 'Next →',
]);
if ($pagination) : ?><nav class="pagination-wrap" aria-label="Technology pagination"><?php echo wp_kses_post(str_replace('page-numbers', 'pagination page-numbers', $pagination)); ?></nav><?php endif; ?>
<?php else : ?><div class="empty-state"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png'); ?>" alt=""><h2>No technologies match these filters.</h2><p>Reset the filters or contact ARBOK to discuss an application outside the current portfolio.</p><a class="button button-dark" href="<?php echo esc_url(get_post_type_archive_link('technology')); ?>">View all technologies</a></div><?php endif; ?>
</div></section>
<?php get_footer(); ?>
