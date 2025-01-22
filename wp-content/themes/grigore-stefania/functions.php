<?php
if (! function_exists('theme_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     */
    function theme_setup()
    {

        /**
         * Make theme available for translation.
         * Translations can be placed in the /languages/ directory.
         */
        load_theme_textdomain('text_domain', get_template_directory() . '/languages');

        /**
         * Add default posts and comments RSS feed links to <head>.
         */
        add_theme_support('automatic-feed-links');

        /**
         * Enable support for post thumbnails and featured images.
         */
        add_theme_support('post-thumbnails');

        /**
         * Enable the use of a custom logo in your theme.
         */
        add_theme_support('custom-logo');

        $defaults = array(
            'height'               => 100,
            'width'                => 400,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => array('site-title', 'site-description'),
            'unlink-homepage-logo' => true,
        );
        add_theme_support('custom-logo', $defaults);

        /**
         * Register Custom Navigation Walker
         */
        require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

        /**
         * Add support for two custom navigation menus.
         */
        register_nav_menus(array(
            'primary'   => __('Primary Menu', 'text_domain'),
            'secondary' => __('Secondary Menu', 'text_domain')
        ));

        /**
         * Register Custom Sidebar
         */
        register_sidebar(array(
            'name'          => 'Footer Widgets',
            'id'            => 'footer-widgets',
            'before_widget' => '<div id="%1$s" class="footer-widget col  %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ));

        /**
         * Enable support for the following post formats:
         * aside, gallery, quote, image, and video
         */
        add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));

        /**
         * Add Bootsatap stylesheet file
         */
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/modules/css/bootstrap.min.css', array(), '5.3.3', 'all');

        /**
         * Add Bootstrap javascript file
         */
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/modules/js/bootstrap.min.js', array('jquery'));

        /**
         * Add Bootstrap Popper file
         */
        wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js');

        /**
         * Add main stylesheet file
         */
        wp_enqueue_style('style', get_stylesheet_uri(), array('bootstrap'));
    }
} // theme_setup
add_action('after_setup_theme', 'theme_setup');

function custom_excerpt_length($length)
{
    return 15;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function custom_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

// Our custom post type function
function create_my_custom_post_type()
{
    // MOVIES
    register_post_type(
        'my_movies',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Movies'),
                'singular_name' => __('Movie'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movie'),
            'show_in_rest' => true,
            // Features this CPT supports in Post Editor
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
        )
    );

    // ACTORS
    register_post_type(
        'my_actors',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Actors'),
                'singular_name' => __('Actor'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'actor'),
            'show_in_rest' => true,
            // Features this CPT supports in Post Editor
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields',),
        )
    );

    // DIRECTORS
    register_post_type(
        'my_directors',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Directors'),
                'singular_name' => __('Director'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'director'),
            'show_in_rest' => true,
            // Features this CPT supports in Post Editor
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields',),
        )
    );

    $genre_labels = array(
        'name' => _x('Genres', 'taxonomy general name'),
        'singular_name' => _x('Genre', 'taxonomy singular name'),
        'search_items' =>  __('Search Genres'),
        'all_items' => __('All Genres'),
        'parent_item' => __('Parent Genre'),
        'parent_item_colon' => __('Parent Genre:'),
        'edit_item' => __('Edit Genre'),
        'update_item' => __('Update Genre'),
        'add_new_item' => __('Add New Genre'),
        'new_item_name' => __('New Genre Name'),
        'menu_name' => __('Genres'),
    );

    // Now register the taxonomy
    register_taxonomy('my_genres', array('my_movies'), array(
        'labels' => $genre_labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    ));

    $year_labels = array(
        'name' => _x('Years', 'taxonomy general name'),
        'singular_name' => _x('Year', 'taxonomy singular name'),
        'search_items' =>  __('Search Years'),
        'all_items' => __('All Years'),
        'parent_item' => __('Parent Year'),
        'parent_item_colon' => __('Parent Year:'),
        'edit_item' => __('Edit Year'),
        'update_item' => __('Update Year'),
        'add_new_item' => __('Add New Year'),
        'new_item_name' => __('New Year Name'),
        'menu_name' => __('Years'),
    );
    register_taxonomy('my_years', array('my_movies'), array(
        'labels' => $year_labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'year'),
    ));
}
// Hooking up our fct to theme setup
add_action('init', 'create_my_custom_post_type');

add_action('mb_relationships_init', function () {
    MB_Relationships_API::register([
        'id'   => 'movies_to_actors',
        'from' => [
            'post_type' => 'my_movies',
            'meta_box'    => [
                'title' => 'Actors',
            ],
        ],
        'to'   => [
            'post_type'   => 'my_actors',
            'meta_box'    => [
                'title' => 'Movies',
            ],
        ],
    ]);

    MB_Relationships_API::register([
        'id'   => 'movies_to_directors',
        'from' => [
            'post_type' => 'my_movies',
            'meta_box'    => [
                'title' => 'Directors',
            ],
        ],
        'to'   => [
            'post_type'   => 'my_directors',
            'meta_box'    => [
                'title' => 'Movies',
            ],
        ],
    ]);
});

function runtime_prettier($movie_length = 0)
{
    // Verifică dacă durata este invalidă (nu este un număr sau 0)
    if ($movie_length == 0 || !is_numeric($movie_length)) {
        return "No runtime data";
    }
    // Dacă durata este de 1 minut
    else if ($movie_length == 1) {
        return $movie_length . " minute";
    }
    // Dacă durata este mai mică de 60 de minute, dar mai mare decât 1 minut
    else if ($movie_length > 1 && $movie_length < 60) {
        return $movie_length . " minutes"; // Corectarea textului de plural
    }
    // Dacă durata este de 60 de minute sau mai mare (în ore și minute)
    else {
        $hours = floor($movie_length / 60); // Calculăm orele
        $minutes = $movie_length % 60; // Calculăm minutele rămase

        // Formatează textul, adăugând pluralizarea corectă
        return $hours . (($hours == 1) ? ' hour ' : ' hours ') . $minutes . (($minutes == 1) ? ' minute' : ' minutes');
    }
}

function display_directors($post_id)
{
    // Obține ID-urile regizorilor asociați filmului
    $directors = get_post_meta($post_id, 'movies_to_directors', true);

    // Verifică dacă există regizori asociați
    if ($directors) {
        // Parcurge fiecare ID de director
        $director_names = [];
        foreach ($directors as $director_id) {
            // Obține detaliile regizorului
            $director = get_post($director_id);
            if ($director && $director->post_type == 'my_directors') {
                $director_names[] = $director->post_title; // Adaugă numele regizorului
            }
        }
        // Afișează numele regizorilor separați prin virgulă
        echo implode(', ', $director_names);
    } else {
        echo "No director assigned";  // Mesaj pentru cazul în care nu sunt regizori
    }
}

add_action('wpcf7_mail_sent', function ($contact_form) {
    setcookie('form_submitted', 'true', time() + 86400, "/");
});

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && (is_post_type_archive(['my_actors', 'my_directors']))) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
});

function my_theme_enqueue_scripts()
{
    // Înregistrează și include fișierul main.js
    wp_enqueue_script(
        'main-js', // Numele scriptului (un identificator unic)
        get_template_directory_uri() . '/assets/js/main.js', // Calea către fișierul JS
        array(), // Dependențele (dacă există; lăsăm un array gol pentru acum)
        null, // Versiunea scriptului (poți adăuga o versiune sau un timestamp pentru cache busting)
        true // True înseamnă că scriptul va fi inclus înainte de tagul de închidere </body>
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');
