<h1>Premium Theme Support</h1>
<?php settings_errors(); ?>

<?php

//$picture = esc_attr( get_option( 'profile_picture' ) );

?>


<form method="post" action="options.php" class="premium-general-form">
    <?php settings_fields('premium-theme-support' ); ?>
    <?php do_settings_sections('nik_premium_theme' ); ?>
    <?php submit_button(); ?>
</form>
