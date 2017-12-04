<?php

/*

@package premium theme

	========================
		ADMIN PAGE
	========================
*/

function premium_add_admin_page() {

    // Generate Premium admin page
	add_menu_page( 'Premium Theme Options', 'Premium', 'manage_options', 'nik_premium', 'premium_theme_create_page', get_template_directory_uri() . '/img/logo-nikolasweb.png', 110 );

    // Generate Premium admin subpage

    add_submenu_page('nik_premium', 'Premium Sidebar Options', 'Sidebar', 'manage_options', 'nik_premium', 'premium_theme_create_page');

    add_submenu_page('nik_premium', 'Premium Theme Options', 'Theme Options', 'manage_options', 'nik_premium_theme', 'premium_theme_support_page');

    add_submenu_page('nik_premium', 'Premium Contact Form', 'Contact Form', 'manage_options', 'nik_premium_theme_contact', 'premium_contact_form_page');

    add_submenu_page('nik_premium', 'Premium CSS Options', 'Custom CSS', 'manage_options', 'nik_premium_css', 'premium_theme_settings_page');


    // Activate custom settings

    add_action( 'admin_init', 'premium_custom_settings' );

}
add_action( 'admin_menu', 'premium_add_admin_page' );

function premium_custom_settings () {

    //Sidebar Options
    register_setting( 'premium-settings-group', 'profile_picture' );
    register_setting( 'premium-settings-group', 'first_name' );
    register_setting( 'premium-settings-group', 'last_name' );
    register_setting( 'premium-settings-group', 'user_description' );
    register_setting( 'premium-settings-group', 'twitter_handler', 'premium_sanatize_twitter_handler' );
    register_setting( 'premium-settings-group', 'facebook_handler' );
    register_setting( 'premium-settings-group', 'gplus_handler' );

    // Add settings section
    add_settings_section( 'premium-sidebar-options', 'Sidebar Options', 'premium_sidebar_options', 'nik_premium' );

    // Add settings field
    add_settings_field(  'sidebar-profile-picture', 'Profile picture', 'premium_sidebar_picture', 'nik_premium', 'premium-sidebar-options' );
    add_settings_field(  'sidebar-name', 'Full Name', 'premium_sidebar_name', 'nik_premium', 'premium-sidebar-options' );
    add_settings_field(  'sidebar-description', 'Description', 'premium_sidebar_description', 'nik_premium', 'premium-sidebar-options' );
    add_settings_field(  'sidebar-twitter', 'Twitter handler', 'premium_sidebar_twitter', 'nik_premium', 'premium-sidebar-options' );
    add_settings_field(  'sidebar-facebook', 'Facebook handler', 'premium_sidebar_facebook', 'nik_premium', 'premium-sidebar-options' );
    add_settings_field(  'sidebar-gplus', 'Gplus handler', 'premium_sidebar_gplus', 'nik_premium', 'premium-sidebar-options' );

    //Theme Support
    register_setting( 'premium-theme-support', 'post_formats');
    register_setting( 'premium-theme-support', 'custom_header');
    register_setting( 'premium-theme-support', 'custom_background');

    add_settings_section( 'premium-theme-options', 'Theme Options', 'premium_theme_options', 'nik_premium_theme' );

    add_settings_field( 'post-formats', 'Post Formats', 'premium_post_formats', 'nik_premium_theme', 'premium-theme-options' );
    add_settings_field( 'custom-header', 'Custom Header', 'premium_custom_header', 'nik_premium_theme', 'premium-theme-options' );
    add_settings_field( 'custom-background', 'Custom Background', 'premium_custom_background', 'nik_premium_theme', 'premium-theme-options' );

    //contact form option
    register_setting( 'premium-contact-options', 'activate_contact' );

    add_settings_section( 'premium-contact-section', 'Contact form', 'premium_contact_section', 'nik_premium_theme_contact' );

    add_settings_field( 'activate-form', 'Activate Contact Form', 'premium_activate_section', 'nik_premium_theme_contact', 'premium-contact-section' );
}



//Post format callback functions

function premium_contact_section () {
    echo 'Activate and Deactivate built-in Contact Form';
}


function premium_theme_options() {
    echo 'Activate/deactivate theme options';
}


function premium_activate_section() {
    $contact = get_option('activate_contact');

    $checked = ( @$contact == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" name="activate_contact" id="activate_contact" value="1" '.$checked.' ></label><br>';

}

function premium_post_formats () {
    $options = get_option('post_formats');
    $formats = array ('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    $output = '';
    foreach ($formats as $format) {
        $checked = ( @$options[$format] == 1 ? 'checked' : '');
        $output .= '<label><input type="checkbox" name="post_formats['.$format.']" id="'.$format.'" value="1" '.$checked.' >' . $format . '</label><br>';
    }
        echo $output;
}

function premium_custom_header() {
    $header = get_option('custom_header');

        $checked = ( @$header == 1 ? 'checked' : '');
        echo '<label><input type="checkbox" name="custom_header" id="custom_header" value="1" '.$checked.' >Activate the Custom Header</label><br>';

}

function premium_custom_background() {
    $background = get_option('custom_background');

    $checked = ( @$background == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" name="custom_background" id="custom_background" value="1" '.$checked.' >Activate the Custom Background</label><br>';

}


// Sidebar options functions
function premium_sidebar_options() {
    echo 'Costumize your Sidebar information';
}

function premium_sidebar_picture () {
    $picture = esc_attr( get_option( 'profile_picture' ) );
    if( empty($picture) ){
        echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
    } else {
        echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
    }

}

function premium_sidebar_name() {
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    echo '<input type="text" name="first_name" value="'.$firstName.'"  placeholder="First Name" /> <input type="text" name="last_name" value="'.$lastName.'"  placeholder="Last Name" />';
}

function premium_sidebar_description () {
    $description = esc_attr( get_option('user_description') );
    echo  '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p>Write something smart.</p>';
}


function premium_sidebar_twitter() {
    $twitter = esc_attr( get_option( 'twitter_handler' ) );
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter handler" /><p class="description">Input your Twitter username without the @ character.</p>';
}

function premium_sidebar_facebook () {
    $facebook = esc_attr( get_option( 'facebook_handler' ) );
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook handler" />';
}

function premium_sidebar_gplus () {
    $gplus = esc_attr( get_option( 'gplus_handler' ) );
    echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Gplus handler" />';
}

// Sanitazation settings
function premium_sanitaze_twitter_handler( $input ) {
    $output = sanitize_text_field(  $input );
    $output = str_replace( '@', '', $output );
    return $output;
}

//Template submenu functions
function premium_theme_create_page() {
	//generation of our admin page
    require_once ( get_template_directory() . '/inc/templates/premium-admin.php' );
}

function premium_theme_support_page() {
    require_once ( get_template_directory() . '/inc/templates/premium-theme-support.php' );
}

function premium_contact_form_page() {
    require_once ( get_template_directory() . '/inc/templates/premium-contact-form-page.php' );
}

function premium_theme_settings_page() {
    //generation of our admin page
    echo '<h1>Custom CSS</h1>';
}