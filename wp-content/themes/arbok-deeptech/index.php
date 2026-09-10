<?php get_header(); ?>
<section class="page-hero page-hero--compact"><div class="shell narrow"><?php arbok_breadcrumbs(); ?><p class="eyebrow">News and updates</p><h1>Verified ARBOK updates</h1><p class="lede">Technology, partnerships and portfolio developments published after corporate review.</p></div></section>
<section class="section"><div class="shell grid cards">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="card"><p class="card-meta"><?php echo esc_html(get_the_date()); ?></p><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><p><?php echo esc_html(arbok_excerpt()); ?></p><a class="text-link" href="<?php the_permalink(); ?>">Read update →</a></article>
<?php endwhile; else : ?><div class="empty-state"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png'); ?>" alt=""><h2>No verified updates published yet.</h2><p>Legacy template articles were removed from the public archive. New corporate updates will appear here after ARBOK review.</p><a class="button button-dark" href="<?php echo esc_url(home_url('/contact/?subject=media')); ?>">Media inquiry</a></div><?php endif; ?>
</div></section>
<?php get_footer(); ?>
