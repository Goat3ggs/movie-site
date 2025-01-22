<?php get_header() ?>

<?php get_sidebar() ?>


<h1><?php printf('Search results for: %s', '<span>' . get_search_query() . '</span>'); ?></h1>
<?php
if (have_posts()) { ?>
    <div class="row">
        <?php while (have_posts()) { ?>
            <div class="col-12 col-lg-12 col-xl-6 mt-3 me-1 post-box">
                <?php the_post(); ?>
                <?php
                get_template_part('/template-parts/post/content', 'excerp'); ?>
            </div>
        <?php } // end while
        ?>
    </div>
    <div class="pagination">
        <?php the_posts_pagination(); ?>
    </div>
<?php } else { ?>
    <p>No results found for: <strong>
            <?php echo get_search_query(); ?>
        </strong></p>
<?php } // end if
?>

<?php get_footer() ?>