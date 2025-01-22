<?php
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        // Start Loop
        while (have_posts()) :
            the_post();
        ?>
            <div class="mt-4">
                <h1><?php the_title() ?></h1>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <strong><?php esc_html_e('Description:', 'text_domain'); ?></strong>
                    <?php the_content(); ?>
                </div>
            </div>

            <?php $connected = new WP_Query([
                'relationship' => [
                    'id'   => 'movies_to_directors',
                    'to' => get_the_ID(),
                ],
                'nopaging'     => true,
            ]);
            if ($connected->have_posts()) {   ?>
                <div class="movies mt-5">
                    <div class="h5">
                        <?php _e('Movies directed by ', 'text_domain'); ?> <?php the_title(); ?>
                    </div>
                    <div class="row">
                        <?php while ($connected->have_posts()) {
                            $connected->the_post();

                            echo "<div class='col-12 mb-3 col-sm-6 col-md-4'>";
                            get_template_part('template-parts/my_movies/content', 'excerpt');
                            echo "</div>";
                        }
                        wp_reset_postdata();  ?>
                    </div>
                </div>
            <?php } ?>
        <?php endwhile; // End loop
        ?>


    </main>
</div>

<?php
get_footer();
