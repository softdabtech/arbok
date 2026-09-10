<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
<section class="page-hero"><div class="shell narrow"><p class="eyebrow"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></p><h1><?php the_title(); ?></h1><p class="lede"><?php echo esc_html(arbok_excerpt(36)); ?></p></div></section>
<section class="section"><article class="shell narrow prose"><?php the_content(); ?></article></section>
<?php endwhile; ?>
<?php get_footer(); ?>
