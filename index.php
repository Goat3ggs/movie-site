<?php

/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
?>

<?php require_once('./includes/header.php') ?>

<h2><?php echo greeting() ?> Please click the button for more info.</h2>
<a class="btn btn-primary" href="./movies.php" role="button">Read more</a>

<?php require_once('./includes/footer.php') ?>