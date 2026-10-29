<?php
/*
Template Name: ARBOK Media
*/

get_header();

while (have_posts()) :
    the_post();
    $content = apply_filters('the_content', get_the_content());
    $has_images = (bool) preg_match('/<img\b|wp-block-gallery/i', $content);
    ?>
    <section class="page-hero page-hero--compact media-hero">
        <div class="shell">
            <?php arbok_breadcrumbs(); ?>
            <p class="eyebrow">ARBOK media</p>
            <h1>Media library</h1>
            <p class="lede">Photography from ARBOK projects, research, events and institutional activities.</p>
        </div>
    </section>

    <section class="section media-library">
        <div class="shell">
            <div class="media-library__heading">
                <div>
                    <p class="eyebrow dark">Photography archive</p>
                    <h2>ARBOK in focus</h2>
                </div>
                <p>Selected photography documenting the institute, its people, technologies and international work.</p>
            </div>

            <div class="media-page__content<?php echo $has_images ? ' has-images' : ' is-empty'; ?>">
                <?php echo wp_kses_post($content); ?>

                <?php if (!$has_images) : ?>
                    <div class="media-empty-state">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arbok-logo-black.webp'); ?>" alt="" width="96" height="96">
                        <h2>ARBOK photography will be published here.</h2>
                        <p>The media library is ready for project, event, team and institutional images.</p>
                        <?php if (current_user_can('edit_post', get_the_ID())) : ?>
                            <a class="button button-dark" href="<?php echo esc_url(get_edit_post_link(get_the_ID())); ?>">Add photos in WordPress</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
endwhile;

get_footer();
