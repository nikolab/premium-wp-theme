<?php

/*

@package premiumtheme

	========================
		ADMIN ENQUE FUNCTIONS
	========================
*/

function premium_load_admin_scripts( $hook ){

    if( 'toplevel_page_nik_premium' != $hook ){ return; }

    wp_register_style( 'premium_admin', get_template_directory_uri() . '/css/premium-admin.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'premium_admin' );

    wp_enqueue_media();

    wp_register_script( 'premium_admin-script', get_template_directory_uri() . '/js/premium-admin.js', array('jquery'), '1.0.0', 'true' );
    wp_enqueue_script( 'premium_admin-script' );

}
add_action( 'admin_enqueue_scripts', 'premium_load_admin_scripts' );