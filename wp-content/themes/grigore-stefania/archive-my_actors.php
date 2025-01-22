<?php get_header(); ?>

<div class="row">
    <h1 class="mt-4 mb-2">Actors</h1>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4 ">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <h2 class="entry-title custom-box"><?php the_title(); ?></h2>
                    </a>
                    <div class="entry-summary"><?php the_excerpt(); ?></div>
                </article>
            </div>
        <?php endwhile; ?>

        <div class="pagination mt-5"><?php the_posts_pagination(); ?></div>

    <?php else : ?>
        <p>No actors found.</p>
    <?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>