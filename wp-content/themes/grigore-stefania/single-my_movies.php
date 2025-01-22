<?php
get_header();
?>
<div id="primary" class="content-area ">
    <main id="main" class="site-main">
        <?php
        // Start Loop
        while (have_posts()) :
            the_post();
        ?>

            <div class="row align-items-start mt-4 full-height">
                <!-- Image Section -->
                <div class="col-lg-4 col-md-6">
                    <?php if (has_post_thumbnail()) : ?>
                        <img class="mb-4" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php else : ?>
                        <!-- Imagine placeholder dacă nu există imagine -->
                        <img class="mb-4" src="<?php echo get_template_directory_uri(); ?>/assets/placeholder.png" alt="Placeholder">
                    <?php endif; ?>
                </div>

                <!-- Content Stection -->
                <div class="col-md-6 col-lg-8 ps-5">
                    <h1 class="mb-3">
                        <?php the_title() . " "; ?><span> <?php the_terms($post->ID, "my_years") ?></span>
                    </h1>

                    <div class="mb-3">
                        <?php the_content(); ?>
                    </div>

                    <div class="runtime d-flex align-items-center mb-2">
                        <?php
                        $runtime = get_post_meta(get_the_ID(), 'my_runtime', true);

                        if ($runtime) {
                            echo '<p class="me-2 mb-0" id="runtime-text">Runtime: ' . esc_html($runtime) . ' minutes</p>';
                            echo '<button id="toggle-runtime" class="btn btn-secondary btn-sm">Convert</button>';
                        } else {
                            echo '<p>Runtime not available.</p>';
                        }
                        ?>
                    </div>


                    <div class="distribution">
                        <!-- DIRECTORS -->
                        <?php $connected = new WP_Query([
                            'relationship' => [
                                'id'   => 'movies_to_directors',
                                'from' => get_the_ID(),
                            ],
                            'nopaging'     => true,
                        ]);
                        if ($connected->have_posts()) {
                            echo "<div class='directors mb-2'>";

                            echo __('Directed by', 'text_domain') . ": ";

                            $i = 0;
                            while ($connected->have_posts()) {
                                $connected->the_post();

                                if ($i !== 0) {
                                    echo ", ";
                                }
                                echo "<a href='" . get_the_permalink() . "'>" . get_the_title() . "</a>";

                                $i++;
                            }
                            wp_reset_postdata();
                            unset($i);

                            echo "</div>"; // div class="actors"
                        }
                        unset($connected); ?>

                        <!-- ACTORS -->

                        <?php $connected = new WP_Query([
                            'relationship' => [
                                'id'   => 'movies_to_actors',
                                'from' => get_the_ID(),
                            ],
                            'nopaging'     => true,
                        ]);
                        if ($connected->have_posts()) {
                            echo "<div class='actors mb-2'>";

                            echo __('Actors', 'text_domain') . ": ";

                            $i = 0;
                            while ($connected->have_posts()) {
                                $connected->the_post();

                                if ($i !== 0) {
                                    echo ", ";
                                }
                                echo "<a href='" . get_the_permalink() . "'>" . get_the_title() . "</a>";

                                $i++;
                            }
                            wp_reset_postdata();
                            unset($i);

                            echo "</div>"; // div class="actors"
                        }
                        unset($connected); ?>


                        <!-- GENRES -->
                        <p><?php the_terms($post->ID, "my_genres", "Genres: ", ", ", " "); ?></p>
                    </div>
                </div>
            </div>

        <?php endwhile; // End loop
        ?>
    </main>
</div>

<?php
get_footer();
