<h1>Premium Contact Form</h1>
<?php settings_errors(); ?>

<?php

//$picture = esc_attr( get_option( 'profile_picture' ) );

?>


<form method="post" action="options.php" class="premium-general-form">
    <?php settings_fields('premium-contact-options' ); ?>
    <?php do_settings_sections('nik_premium_theme_contact' ); ?>
    <?php submit_button(); ?>
</form>
