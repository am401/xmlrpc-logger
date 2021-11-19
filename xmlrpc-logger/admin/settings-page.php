<?php // XMLRPC-Logger - settings page

// No direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// display the plugin settings page
function xmlrpc_logger_display_settings_page() {
if ( ! current_user_can( 'manage_options' ) ) return;

?>

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="POST">
        
        <?php
    
        // output security fields
        settings_fields( 'xmlrpc_logger_options' );

        // output settings sections
        do_settings_sections( 'xmlrpc_logger' );

        // submit button
        submit_button();

        ?>

    </form>
</div>

<?php
}
