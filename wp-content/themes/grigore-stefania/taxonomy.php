<?php get_header(); ?>

<div class="body-container">

    <header class="taxonomy-header mb-4">
        <h1 class="taxonomy-title">
            <?php
            // Verificăm ce taxonomie este afișată și afișăm textul corespunzător
            if (is_tax('my_years')) {
                // Dacă suntem pe pagina unui an, afișăm "Movies from year: ..."
                echo 'Movies from year: ';
            } elseif (is_tax('my_genres')) {
                // Dacă suntem pe pagina unui gen, afișăm "Genre: ..."
                echo 'Genre: ';
            }

            // Afișăm numele taxonomiei (anul sau genul)
            single_term_title();
            ?>
        </h1>

    </header>
    <?php if (have_posts()) { ?>
        <div class="row">
            <?php while (have_posts()) {
                the_post(); // Asigură-te că apelăm această funcție înainte de a folosi alte date ale postării
            ?>
                <article <?php post_class('col-12 col-md-6 col-lg-4 mb-4'); ?> id="post-<?php the_ID(); ?>">
                    <?php
                    // Include template-ul pentru afișarea filmului
                    get_template_part('template-parts/my_movies/content', 'excerpt');
                    ?>
                </article>
            <?php } // end while 
            ?>
        </div>

        <div class="pagination mt-5"><?php the_posts_pagination(); ?></div>
    <?php } else { ?>
        <p><?php esc_html_e('No posts found in this taxonomy.', 'text_domain'); ?></p>
    <?php } // end if 
    ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>