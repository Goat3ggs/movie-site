<div class="card">
    <?php if (has_post_thumbnail()) : ?>
        <img class="crd-image-top" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
    <?php else : ?>
        <!-- Imagine placeholder dacă nu există imagine -->
        <img src="<?php echo get_template_directory_uri(); ?>/assets/placeholder.png" alt="Placeholder">
    <?php endif; ?>
    <div class="card-body">
        <h5 class="card-title"><?php the_title() . " "; ?> <span>( <?php the_terms($post->ID, "my_years") ?> )</span></h5>
        <p class="card-text">
            <?php
            the_excerpt();
            ?>
        </p>
        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read more</a>
    </div>
</div>