<?php

/**
 * Remove junk
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'wp_head', 'feed_links', 2);
remove_action( 'wp_head', 'feed_links_extra', 3);
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0);
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0);
 
 
/**
  * Remove comments feed
  *
  * @return void
  */
 
function gregory_post_comments_feed_link() {
    return;
}
 
add_filter('post_comments_feed_link', 'gregory_post_comments_feed_link');


function load_scripts_styles() {
    # Dequeue scripts and styles

    wp_deregister_script( 'wp-embed' );
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); 
    wp_deregister_style('classic-theme-styles');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style( 'global-styles' );
   
    # Enqueue external libraries
    wp_enqueue_script( 'splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), null,  true);
    wp_enqueue_style( 'splide-styles', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array());
    wp_enqueue_script( 'aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null,  true);
    
    # Enqueue custom styles and js
    wp_enqueue_style(
        'theme-styles', // $handle
        get_template_directory_uri() . '/dist/css/styles.css', // $src
        array(), // $deps
        filemtime( get_stylesheet_directory() . '/dist/css/styles.css' ) // $ver
    );

    wp_enqueue_script(
        'theme-scripts', // $handle
        get_template_directory_uri() . '/dist/js/scripts.min.js', // $src
        array(), // $deps
        filemtime( get_template_directory() . '/dist/js/scripts.min.js' ), // $ver
        true // $in_footer
    );
}

add_action( 'wp_enqueue_scripts', 'load_scripts_styles' );


function filter_head() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
	remove_action( 'wp_head', 'wp_generator' );
}
add_action('get_header', 'filter_head');


// Removes edit comments from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

// Removes comments from post and pages
add_action('init', 'remove_comment_support', 100);
function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

// Removes comments from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );


// Remove the output of html comments 
function callback($buffer) {
    $buffer = preg_replace('/<!--(.|s)*?-->/', '', $buffer);
    return $buffer;
}
function buffer_start() {
    ob_start("callback");
}
function buffer_end() {
    ob_end_flush();
}
add_action('get_header', 'buffer_start');
add_action('wp_footer', 'buffer_end');


// Add editor styles for previewing acf blocks
function gregory_setup() {
    // Add support for editor styles 
    add_theme_support('editor-styles');

    // Load default block styles.
    add_theme_support( 'wp-block-styles' );

    // Enqueue editor styles 
    add_editor_style( 'dist/css/styles.css');
}

add_action( 'after_setup_theme', 'gregory_setup' );


// Enqueue assets specifically for the block editor
function manage_block_editor_assets($hook) {
    $screen = get_current_screen();
    if ($screen->post_type === 'page') {
        // Enqueue Splide CSS in the editor
        wp_enqueue_style(
            'splide-editor-css',
            'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css',
            array(),
            '4.1.4'
        );

        // Enqueue Splide JS in the editor
        wp_enqueue_script(
            'splide-editor-js',
            'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
            array(),
            '4.1.4',
            true
        );

        // Enqueue your theme's editor scripts
        wp_enqueue_script(
            'theme-editor-scripts',
            get_template_directory_uri() . '/dist/js/editor-blocks.js', // Assuming this is your editor script
            array('wp-blocks', 'wp-element', 'wp-i18n', 'wp-components', 'splide-editor-js'),
            filemtime(get_template_directory() . '/dist/js/editor-blocks.js'), // Make sure this path is correct
            true
        );
    }
}
add_action('enqueue_block_editor_assets', 'manage_block_editor_assets', 10, 1);

function load_admin_styles() {
    wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'load_admin_styles' );


/**
 * Enqueue Google Font for both frontend and Block Editor.
 */
function mytheme_enqueue_jost_font() {
    // The URL for the Jost Google Font
    $font_url = 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap';

    // Enqueue for the frontend
    wp_enqueue_style(
        'mytheme-jost-font-frontend', // Unique handle for frontend
        $font_url,
        array(), // No dependencies
        null // Version (null uses WordPress's default cache busting)
    );

    // Enqueue the same font for the Block Editor
    // 'enqueue_block_assets' hook runs in both frontend and editor contexts for block-related assets.
    wp_enqueue_style(
        'mytheme-jost-font-editor', // Unique handle for editor (can be the same as frontend if desired, but good to separate)
        $font_url,
        array(), // No dependencies
        null
    );
}
add_action( 'enqueue_block_assets', 'mytheme_enqueue_jost_font' );

// Register navigation menus
function gregory_digital_register_menus() {
    register_nav_menus( array(
        'main_menu'    => __( 'Main Menu', 'gregory-digital-theme' ),
        'footer_menu'  => __( 'Footer Menu', 'gregory-digital-theme' ),
        'legal_menu'  => __( 'Legal Menu', 'gregory-digital-theme' ),
    ) );
}
add_action( 'init', 'gregory_digital_register_menus' );