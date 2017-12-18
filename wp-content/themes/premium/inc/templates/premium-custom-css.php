<h1>Premium Custom CSS</h1>
<?php settings_errors(); ?>

<?php

//$picture = esc_attr( get_option( 'profile_picture' ) );

?>


<form id="save-custom-css-form" method="post" action="options.php" class="premium-general-form">
    <?php settings_fields('premium-custom-css-options' ); ?>
    <?php do_settings_sections('nik_premium_css' ); ?>
    <?php submit_button(); ?>
</form>
