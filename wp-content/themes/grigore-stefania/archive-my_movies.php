<?php get_header(); ?>

<div class="row body-container">
    <h1 class="mt-4 mb-2">Movies</h1>
    <?php
    // Începe bucla WordPress
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <?php
                // Include fișierul content-excerpt.php din template-parts/my_movies
                get_template_part('template-parts/my_movies/content', 'excerpt');
                ?>
            </div>
        <?php endwhile; ?>

        <div class="pagination mt-5"><?php the_posts_pagination(); ?></div>

    <?php else :
        echo '<p>No movies found.</p>';
    endif;
    ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>