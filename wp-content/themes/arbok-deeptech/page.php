<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
<section class="page-hero"><div class="shell narrow"><?php arbok_breadcrumbs(); ?><p class="eyebrow">STRATEGIC RESEARCH INSTITUTE ARBOK</p><h1><?php the_title(); ?></h1><?php if (has_excerpt()) : ?><p class="lede"><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?></div></section>
<section class="section"><article class="shell narrow prose"><?php the_content(); ?></article></section>
<?php endwhile; ?>
<?php get_footer(); ?>
