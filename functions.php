<?php 

function init_template() {

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus(
        array(
            'top_menu' => 'Menu Principal'
        )
    );

}

add_action('after_setup_theme', 'init_template');

function assets() {
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', '', '4.4.1', 'all');
    wp_register_style('montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap', '', '1.0', 'all');

    wp_enqueue_style('styles', get_stylesheet_uri(), array('bootstrap', 'montserrat'), '1.0', 'all');

    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', '', '1.16.1', true);

    wp_enqueue_script('bootstraps', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery', 'popper'), '4.5.2', true);

    wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', '', '1.0', true);
}

add_action('wp_enqueue_scripts', 'assets');

function sidebar(){
    register_sidebar(
        array(
            'name' => 'Pie de pagina',
            'id' => 'footer',
            'description' => 'Zona de widgets para pie de pagina',
            'before_title' => '<p>',
            'after_title' => '</p>',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>',
        )
    );
}

add_action('widgets_init', 'sidebar');

function products_type(){

    $labels = array(
        'name' => 'Products',
        'singular' => 'Product',
        'menu_name' => 'Products',
    );
    $args = array(
        'label' => 'Products',
        'description' => 'Productos de Platzi',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'can_export' => true,
        'publicly_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => true

    );
    register_post_type('product', $args);
}

add_action('init', 'products_type');