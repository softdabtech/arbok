<?php get_header(); while (have_posts()) : the_post(); $terms = get_the_terms(get_the_ID(), 'technology_sector'); $sector = $terms && !is_wp_error($terms) ? $terms[0]->name : 'Multi-sector platform'; $summary = arbok_clean_summary((string) arbok_field('short_description', false, get_the_excerpt() ?: get_the_content()), get_the_title(), 38); $technology_image = has_post_thumbnail() ? '' : arbok_technology_image_url(get_post_field('post_name')); ?>
<section class="page-hero page-hero--compact technology-hero">
    <div class="shell"><?php arbok_breadcrumbs(); ?></div>
    <div class="shell technology-hero-grid">
        <div><p class="eyebrow"><?php echo esc_html($sector); ?></p><h1><?php the_title(); ?></h1><p class="lede"><?php echo esc_html($summary); ?></p><div class="button-row"><a class="button" href="#technology-brief">Technology brief</a><a class="button button-ghost" href="<?php echo esc_url(home_url('/contact/?subject=technology&technology=' . rawurlencode(get_the_title()))); ?>">Discuss partnership</a></div></div>
        <div class="technology-hero-visual"><?php if (has_post_thumbnail()) : the_post_thumbnail('large', ['alt' => get_the_title()]); elseif ($technology_image) : ?><img src="<?php echo esc_url($technology_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"><?php else : ?><img class="technology-hero-logo" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png'); ?>" alt=""><?php endif; ?><aside class="data-panel">
            <div><span>Development stage</span><strong><?php echo esc_html(arbok_field('current_stage', false, 'To be confirmed')); ?></strong></div>
            <div><span>Readiness</span><strong><?php echo esc_html(arbok_field('technology_readiness_level', false, 'To be confirmed')); ?></strong></div>
            <div><span>Partnership</span><strong><?php echo esc_html(arbok_field('investor_status', false, 'Status on request')); ?></strong></div>
        </aside></div>
    </div>
</section>
<section id="technology-brief" class="section technology-brief">
    <div class="shell detail-layout">
        <article class="prose"><p class="eyebrow dark">Technology brief</p><h2>What this platform addresses</h2><p><?php echo esc_html($summary); ?></p><div class="source-note"><?php echo esc_html(arbok_field('verification_status', false, 'Source-derived profile. Technical performance and readiness require ARBOK confirmation and independent validation.')); ?></div></article>
        <aside class="sticky-aside">
            <img class="aside-logo" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png'); ?>" alt="">
            <h2>At a glance</h2><dl><dt>Sector</dt><dd><?php echo esc_html($sector); ?></dd><dt>IP / patents</dt><dd><?php echo esc_html(arbok_field('ip_patent_status', false, 'Details available under technical diligence.')); ?></dd><dt>Commercial path</dt><dd>Licensing, pilot partnership or joint deployment</dd></dl>
            <a class="button button-dark button-block" href="<?php echo esc_url(home_url('/contact/?subject=technical-discussion&technology=' . rawurlencode(get_the_title()))); ?>">Request technical discussion</a>
        </aside>
    </div>
</section>
<?php
$sections = [
    'problem' => ['The challenge', 'The problem this technology addresses'],
    'solution' => ['ARBOK solution', 'How the ARBOK system creates value'],
    'market_opportunity' => ['Market and application', 'Commercial opportunity'],
    'use_cases' => ['Use cases', 'Where the technology can be applied'],
];
foreach ($sections as $field => [$label, $heading]) : $value = arbok_field($field); if ($value) : ?>
<section class="section detail-block"><div class="shell two-column"><div><p class="eyebrow dark"><?php echo esc_html($label); ?></p><h2><?php echo esc_html($heading); ?></h2></div><div class="prose"><?php echo wp_kses_post($value); ?></div></div></section>
<?php endif; endforeach; ?>

<?php
$images = arbok_field('images', false, []);
$diagrams = arbok_field('diagrams', false, []);
$documents = arbok_field('documents', false, []);
$videos = arbok_field('videos_animations', false, []);
if ($images || $diagrams || $documents || $videos) : ?>
<section class="section technology-assets"><div class="shell"><div class="section-heading"><div><p class="eyebrow dark">Technology materials</p><h2>Images, diagrams and supporting files</h2></div></div>
    <?php foreach ([['Images', $images], ['Diagrams', $diagrams]] as [$asset_label, $gallery]) : if ($gallery && is_array($gallery)) : ?><div class="asset-group"><h3><?php echo esc_html($asset_label); ?></h3><div class="asset-gallery"><?php foreach ($gallery as $asset) : $url = is_array($asset) ? ($asset['sizes']['large'] ?? $asset['url'] ?? '') : wp_get_attachment_image_url((int) $asset, 'large'); if ($url) : ?><img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr(is_array($asset) ? ($asset['alt'] ?? get_the_title()) : get_the_title()); ?>" loading="lazy"><?php endif; endforeach; ?></div></div><?php endif; endforeach; ?>
    <?php if ($documents && is_array($documents)) : ?><div class="asset-group"><h3>Documents</h3><div class="asset-list"><?php foreach ($documents as $doc) : $file = $doc['file'] ?? null; $url = is_array($file) ? ($file['url'] ?? '') : (string) $file; if ($url) : ?><a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"><?php echo esc_html($doc['label'] ?? 'Download document'); ?> <span>↗</span></a><?php endif; endforeach; ?></div></div><?php endif; ?>
    <?php if ($videos && is_array($videos)) : ?><div class="asset-group"><h3>Videos / animations</h3><div class="asset-list"><?php foreach ($videos as $video) : if (!empty($video['media'])) : ?><a href="<?php echo esc_url($video['media']); ?>" target="_blank" rel="noopener"><?php echo esc_html($video['label'] ?? 'Open media'); ?> <span>↗</span></a><?php endif; endforeach; ?></div></div><?php endif; ?>
</div></section>
<?php endif; ?>

<section class="section section-soft source-detail"><div class="shell narrow"><details><summary>View preserved source description</summary><div class="prose technology-content"><?php echo wp_kses_post(arbok_localize_legacy_content((string) arbok_field('full_description', false, get_the_content()))); ?></div></details></div></section>
<?php $related = new WP_Query(['post_type' => 'technology', 'posts_per_page' => 3, 'post__not_in' => [get_the_ID()], 'tax_query' => $terms && !is_wp_error($terms) ? [['taxonomy' => 'technology_sector', 'field' => 'term_id', 'terms' => wp_list_pluck($terms, 'term_id')]] : []]); if ($related->have_posts()) : ?>
<section class="section section-soft"><div class="shell"><div class="section-heading"><div><p class="eyebrow dark">Related technologies</p><h2>Explore adjacent ARBOK systems</h2></div></div><div class="grid technology-grid"><?php while ($related->have_posts()) : $related->the_post(); arbok_technology_card(); endwhile; wp_reset_postdata(); ?></div></div></section>
<?php endif; ?>
<section class="section contact-cta"><div class="shell contact-cta__inner"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png'); ?>" alt=""><div><p class="eyebrow">Partnership pathway</p><h2>Evaluate <?php the_title(); ?> for your application or pilot site.</h2><div class="button-row"><a class="button" href="<?php echo esc_url(home_url('/contact/?subject=technology&technology=' . rawurlencode(get_the_title()))); ?>">Contact partnership team</a><a class="button button-ghost" href="<?php echo esc_url(home_url('/directions/')); ?>">Strategic directions</a></div></div></div></section>
<?php endwhile; get_footer(); ?>
