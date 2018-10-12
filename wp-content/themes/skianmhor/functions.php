<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

function skianmhor_sidebars() {
    register_sidebar(array(
        'name' => 'Contact Lamia',
        'id' => 'avada-custom-sidebar-contact-lamia',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="heading"><h4 class="widget-title">',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'name' => 'Contact Offa',
        'id' => 'avada-custom-sidebar-contact-offa',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="heading"><h4 class="widget-title">',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'name' => 'Contact Mhorish',
        'id' => 'avada-custom-sidebar-contact-mhorish',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="heading"><h4 class="widget-title">',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'name' => 'Contact Even Mhor',
        'id' => 'avada-custom-sidebar-contact-even-mhor',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="heading"><h4 class="widget-title">',
        'after_title' => '</h4></div>',
    ));
}
add_action('widgets_init', 'skianmhor_sidebars');

function skianmhor_scripts() {
    wp_enqueue_script('skianmhor', get_stylesheet_directory_uri() . '/assets/js/skianmhor.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'skianmhor_scripts');