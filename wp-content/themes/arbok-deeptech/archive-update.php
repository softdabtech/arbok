<?php
get_header();

$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
$blog_query = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 9,
    'paged' => $paged,
    'ignore_sticky_posts' => false,
]);
$published_posts = wp_count_posts('post');
$post_count = isset($published_posts->publish) ? (int) $published_posts->publish : 0;
?>
<section class="page-hero page-hero--compact blog-archive-hero">
    <div class="shell">
        <?php arbok_breadcrumbs(); ?>
        <div class="archive-hero-row">
            <div>
                <p class="eyebrow">ARBOK blog</p>
                <h1>Research updates and technology notes</h1>
                <p class="lede">Published ARBOK articles, research notes, portfolio updates and institutional announcements.</p>
            </div>
            <div class="archive-hero-mark"><strong><?php echo esc_html((string) $post_count); ?></strong><small>posts</small></div>
        </div>
    </div>
</section>
<section class="section blog-archive-section">
    <div class="shell">
        <?php if ($blog_query->have_posts()) : ?>
            <div class="blog-grid">
                <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    <article class="blog-card">
                        <a class="blog-card__media" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['alt' => get_the_title()]); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png'); ?>" alt="" loading="lazy">
                            <?php endif; ?>
                        </a>
                        <div class="blog-card__body">
                            <p class="card-meta"><?php echo esc_html(get_the_date('M j, Y')); ?></p>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html(arbok_excerpt(28)); ?></p>
                            <a class="text-link" href="<?php the_permalink(); ?>">Read article <span>↗</span></a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <div class="pagination-wrap">
                <?php
                echo paginate_links([
                    'total' => max(1, (int) $blog_query->max_num_pages),
                    'current' => $paged,
                    'mid_size' => 1,
                    'prev_text' => 'Previous',
                    'next_text' => 'Next',
                ]);
                ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="empty-state">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arbok-logo.png'); ?>" alt="">
                <h2>No blog posts published yet.</h2>
                <p>New ARBOK articles and research notes will appear here after publication.</p>
                <a class="button button-dark" href="<?php echo esc_url(home_url('/contact/?subject=media')); ?>">Media inquiry</a>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
