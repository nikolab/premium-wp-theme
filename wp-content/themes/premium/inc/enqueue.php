<?php

/*

@package premiumtheme

	========================
		ADMIN ENQUE FUNCTIONS
	========================
*/

function premium_load_admin_scripts( $hook ){

    if( 'toplevel_page_nik_premium' == $hook ){

        wp_register_style( 'premium_admin', get_template_directory_uri() . '/css/premium-admin.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'premium_admin' );

        wp_enqueue_media();

        wp_register_script( 'premium_admin-script', get_template_directory_uri() . '/js/premium-admin.js', array('jquery'), '1.0.0', 'true' );
        wp_enqueue_script( 'premium_admin-script' );

    } else if( 'premium_page_nik_premium_css' == $hook ) {

        wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/premium.ace.css', array(), '1.0.0', 'all');
        wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.2.1', true );
        wp_enqueue_script( 'premium-custom-css-script', get_template_directory_uri() . '/js/premium.custom_css.js', array('jquery'), '1.0.0', true );

    } else {
        return;
    }

}
add_action( 'admin_enqueue_scripts', 'premium_load_admin_scripts' );

function premium_load_scripts(){

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '', 'all' );
    wp_enqueue_style( 'premium', get_template_directory_uri() . '/css/premium.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );


    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery.js', false, '', true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );

}
add_action( 'wp_enqueue_scripts', 'premium_load_scripts' );