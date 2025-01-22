<?php get_header(); ?>
<!-- Început de Loop. -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php if (in_category('3')) : ?>
            <div class="post-cat-three">
            <?php else : ?>
                <div class="post">
                <?php endif; ?>

                <h2 class="single-post-title">
                    <?php the_title(); ?>
                </h2>

                <!-- Afișăm conținutul (textul) postării într-un div. -->

                <div class="entry">
                    <?php the_content(); ?>
                </div>

                <!-- Oprim Loop-ul (dar mai avem și un "else:" mai jos). -->

            <?php endwhile;
    else : ?>


            <!-- Primul "if" a verificat dacă există postări pentru a fi afișate. -->
            <!-- Acest "else" indică ce să se afișeze dacă nu a fost găsită nici-o postare. -->
            <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>


            <!-- Aici CHIAR oprim Loop-ul. -->
        <?php endif; ?>
                </div>
                <?php get_footer(); ?>