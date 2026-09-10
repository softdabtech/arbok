<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header">
    <div class="shell header-inner">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="ARBOK home">
            <?php arbok_logo('header'); ?>
        </a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav"><span>Menu</span><i></i></button>
        <nav id="primary-nav" class="primary-nav" aria-label="Primary navigation">
            <?php arbok_header_menu(); ?>
            <a class="button button-small" href="<?php echo esc_url(home_url('/contact/#inquiry')); ?>">Contact us</a>
        </nav>
    </div>
</header>
<main id="main">
