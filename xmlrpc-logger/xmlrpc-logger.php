<?php
/*
    Plugin Name: XMLRPC Logger
    Plugin URI: https://example.com/xmlprc-logger
    Description: Log incoming XMLRPC requests.
    Version: 0.0.2
    Author: Andras Marton
    Author URI: https://andrasmarton.com
    License: GPL 1.2
*/

// Exit if this file is called directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// if admin area
if ( is_admin() ) {

    // include dependencies
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
}


// Register plugin settings
function xmlrpc_logger_register_settings() {

    /*

    register_settings(
        string $option_group,
        string $option_name,
        callable $sanitize_callback
    );

     */

    register_setting(
        'xmlrpc_logger_options',
        'xmlrpc_logger_options',
        'xmlrpc_logger_callback_validate_options'
    );
    /*

    add_settings_section(
            string   $id,
            string   $title,
            callable $callback,
            string   $page
    );

    */

    add_settings_section(
            'xmlrpc_logger_main_settings',
            'Main Settings Page',
            'xmlrpc_logger_callback_section_main',
            'xmlrpc_logger'
    );
    /*

    add_settings_field(
    string   $id,
            string   $title,
            callable $callback,
            string   $page,
            string   $section = 'default',
            array    $args = []
    );

    */
    add_settings_field(
        'show_ip_address',
        'Show IP Address',
        'xmlrpc_logger_callback_field_checkbox',
        'xmlrpc_logger',
        'xmlrpc_logger_callback_section_main',
        [ 'id' => 'show_ip_address', 'label' => 'Show requestor IP address.' ]
    );

    add_settings_field(
        'sanitize_xmlrpc_data',
        'Sanitize XMLRPC Data',
        'xmlrpc_logger_callback_field_checkbox',
        'xmlrpc_logger',
        'xmlrpc_logger_callback_section_main',
        [ 'id' => 'sanitize_xmlrpc_data', 'label' => 'Sanitize incoming XMLRPC data.' ]
    );

    add_settings_field(
        'validate_xml_data',
        'Validate XML Data',
        'xmlrpc_logger_callback_field_checkbox',
        'xmlrpc_logger',
        'xmlrpc_logger_callback_section_main',
        [ 'id' => 'validate_xml_data', 'label' => 'Do not log entry unless it contains valid XML data.' ]
    );
}

add_action( 'admin_init', 'xmlrpc_logger_register_settings' );


// validate plugin settings
function xmlrpc_logger_validate_options($input) {
    // todo: add validation functionality...
    //
    return $input;
}

// callback: login section
function xmlrpc_logger_callback_section_main() {

        echo '<p>These settings enable you to customize the XMLRPC-Logger plugin settings.</p>';

}

// Gather IP address from requester
function amxml_get_user_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Grab the xmlrpc.php request body
function amxml_log_xmlrpc_request() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if ( defined( 'XMLRPC_REQUEST' ) ) {
            // Retrieve the IP address returned from the function
            $ip = xl_get_user_ip();

            // Gather the raw data from the request
            $logentry = "[" . date('D M H:i:s Y') . "] [XMLRPC Request Data] ";
            $logentry .= "[" . $ip . "] ";
            $logentry .= preg_replace('/[\r\n]+/', "", file_get_contents("php://input"));

            // File location
            $logfile = ABSPATH.'/wp-content/xmlrpc-request.log';

            // Save to file
            @file_put_contents($logfile, $logentry.PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }
}
//add_action('init', 'amxml_log_xmlrpc_request');
?>
