<?php

/*

@package premium theme

	========================
		Custom Post Type
	========================
*/

$contact = get_option('activate_contact');
if( @$contact == 1 ) {
    add_action( 'init', 'premium_contact_custom_post_type' );
    add_filter( 'manage_premium-contact_posts_columns', 'premium_set_contact_columns' );
    add_action( 'manage_premium-contact_posts_custom_column', 'premium_custom_contact_columns', 10, 2 );

    add_action( 'add_meta_boxes', 'premium_contact_add_meta_box' );

    add_action( 'save_post', 'premium_save_contact_email_data' );


}

/**
 *  Register Custom Post Type
 */
function premium_contact_custom_post_type() {

    $labels = array(
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message'
    );

    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_ui_menu'      => true,
        'capability_type'   => 'post',
        'hiearchical'       => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email-alt',
        'supports'          => array('title', 'editor', 'author')
    );

    register_post_type( 'premium-contact', $args );
}

function premium_set_contact_columns( $columns ) {
    $newColumns = array();
    $newColumns['title'] = 'Fullname';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';

    return $newColumns;
}

function premium_custom_contact_columns( $column, $post_id ){
    switch( $column ){

        case 'message' :
            echo get_the_excerpt();
            break;

        case 'email' :
            $email = get_post_meta( $post_id, '_contact_email_value_key', true );
        echo '<a href="mailto:'.$email.'">'. $email .'</a>';
            break;
    }
}

/*
 *  Contact meta boxes
 */

function premium_contact_add_meta_box () {
    add_meta_box( 'contact_email', 'User email', 'premium_contact_email_callback', 'premium-contact', 'side' );
}

function premium_contact_email_callback ( $post ) {
    wp_nonce_field( 'premium_save_contact_email_data', 'premium_contact_email_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_contact_email_value_key', true );

    echo '<label for="premium_contact_email_field" >User Email Address</label>';
    echo '<input type="email" name="premium_contact_email_field" id="premium_contact_email_field" value="'. esc_attr( $value ) .'" size="25" >';
}

function premium_save_contact_email_data ($post_id) {
    if ( ! isset( $_POST['premium_contact_email_meta_box_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['premium_contact_email_meta_box_nonce'], 'premium_save_contact_email_data') ) {
        return;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( ! isset( $_POST['premium_contact_email_field']) ) {
        return;
    }

    $my_data = sanitize_text_field( $_POST['premium_contact_email_field'] );

    update_post_meta( $post_id, '_contact_email_value_key', $my_data );
}