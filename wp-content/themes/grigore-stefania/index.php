<?php get_header() ?>

<div class="body-container">
    <?php
    if (have_posts()) { ?>
        <div class="row ">
            <?php while (have_posts()) {
                the_post();
            ?>
                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <div class="col-12 col-lg-6 col-xl-6 mt-3 me-1 ">
                        <?php
                        get_template_part('/template-parts/post/content', 'excerp'); ?>
                    </div>
                </article>
            <?php } // end while
            ?>
        </div>
        <div class="pagination mt-5"><?php the_posts_pagination(); ?></div>
    <?php } // end if
    ?>
</div>
<?php get_sidebar() ?>

<?php get_footer() ?>