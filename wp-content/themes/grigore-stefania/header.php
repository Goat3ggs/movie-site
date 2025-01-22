<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="spinner" class="spinner"></div>

    <?php get_template_part('/template-parts/navigation/navigation', 'top') ?>

    <!-- <div class="navbar">
            <?php wp_nav_menu('primary') ?>
        </div> -->

    <div class="container d-flex flex-column ">