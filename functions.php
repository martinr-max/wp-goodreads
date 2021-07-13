<?php
require get_theme_file_path('/inc/user-booklist-route.php');

function goodreads_files() {
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery'));

    wp_enqueue_style('goodreads_main_styles', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_localize_script('custom-script', 'goodreadsData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
      ));

}
add_action('wp_enqueue_scripts', 'goodreads_files');

//REGISTER SIDE-BAR

function my_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' )
        )
    );
    register_sidebar(
        array(
            'id'            => 'secondary',
            'name'          => __( 'Secondary Sidebar' ),
        )
    );
}

add_action( 'widgets_init', 'my_register_sidebars' );

function goodreads_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size( 'single-post-thumbnail', 590, 180 );

    register_nav_menus(array(
        'fancy-shop-main-menu' => 'Fancy shop main menu',
        'fancy-shop-footer-menu' => 'Fancy shop footer menu',
        'fancy-shop-mobile-menu' => 'Fancy shop mobile menu'
    ));
    
}
  
add_action('after_setup_theme', 'goodreads_features');


function goodreads_post_types() {
    // Event Post Type
    register_post_type('book', array(
      'show_in_rest' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'rewrite' => array('slug' => 'books'),
      'has_archive' => true,
      'public' => true,
      'labels' => array(
        'name' => 'Books',
        'add_new_item' => 'Add New Book',
        'edit_item' => 'Edit Book',
        'all_items' => 'All Books',
        'singular_name' => 'Book'
      ),
      'taxonomies' => array('genre', 'category', 'post_tag' ),
      'menu_icon' => 'dashicons-book'
    ));

      register_post_type('my_booklist', array(
        'show_in_rest' => true,
        'supports' => array('title'),
        'public' => true,
        'map_meta_cap' => true,
        'show_ui' => true,
        'labels' => array(
          'name' => 'Booklist',
          'add_new_item' => 'Add New Booklist',
          'edit_item' => 'Edit Booklist',
          'all_items' => 'All Booklists',
          'singular_name' => 'Booklist'
        ),
        'menu_icon' => 'dashicons-book'
      ));

      register_post_type('author2', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'author2'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
          'name' => 'Author',
          'add_new_item' => 'Add New Author',
          'edit_item' => 'Edit Author',
          'all_items' => 'All Authors',
          'singular_name' => 'Author'
        ),
        'menu_icon' => 'dashicons-book'
      ));
  
  
   
  
  }
  add_action('init', 'goodreads_post_types');


  function my_query_post_type($query) {
    if ( is_category() && ( ! isset( $query->query_vars['suppress_filters'] ) || false == $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array( 'post', 'book' ) );
        return $query;
    }
    if ( is_category() && ( ! isset( $query->query_vars['suppress_filters'] ) || false == $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array( 'post', 'author' ) );
        return $query;
    }
}
add_filter('pre_get_posts', 'my_query_post_type');



