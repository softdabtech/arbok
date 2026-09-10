<?php
get_header();
$total_sectors = arbok_sector_count();
?>
<section class="page-hero page-hero--compact sector-archive-hero"><div class="shell"><?php arbok_breadcrumbs(); ?><div class="archive-hero-row"><div><p class="eyebrow"><?php echo esc_html((string) $total_sectors); ?> technology sectors</p><h1>Sector portfolio</h1><p class="lede">ARBOK technologies are organized by operational markets across water, energy, environmental remediation and industrial resilience.</p></div><div class="archive-hero-mark"><strong><?php echo esc_html((string) $total_sectors); ?></strong><small>sectors</small></div></div></div></section>
<section class="section sectors-archive-section"><div class="shell"><div class="sector-grid-v2 sector-grid-v2--archive"><?php while (have_posts()) : the_post(); arbok_sector_card(get_the_ID(), $wp_query->current_post + 1); endwhile; ?></div></div></section>
<?php get_footer(); ?>
