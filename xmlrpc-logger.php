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

/*
function amxml_sanitize($xml_body) {
    $search = "/(.*<data><value><string>)(.*)(<\/string><\/value><value><string>)(.*)(<\/string><\/value>.*)/";
    $replace_user = "SANITIZED_USERNAME";
    $replace_pass = "SANITIZED_PASSWORD";
    $string = $xml_body;

    return preg_replace($search, '$1'.$replace_user.'$3'.$replace_pass.'$5', $string);
}
 */

// Grab the xmlrpc.php request body
function amxml_log_xmlrpc_request() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if ( defined( 'XMLRPC_REQUEST' ) ) {
            // Retrieve the IP address returned from the function
            $ip = amxml_get_user_ip();
            /*
            $input_to_sanitize = preg_replace('/[\r\n]+/', "", file_get_contents("php://input"));
            $pattern_sanitize = '/(.*<data><value><string>)(.*)(<\/string><\/value><value><string>)(.*)(<\/string><\/value>.*)/';
            $sanitized_xml = preg_replace_callback($pattern_sanitize, 'amxml_sanitize_data', $input_to_sanitize);
 */
            //$xml_raw = file_get_contents("php://input");
            $xml_string = new SimpleXMLElement(file_get_contents("php://input"));
            $xml_data = $xml_string->asXML();
            $xml_output = $xml_data->params->param->value->array->data->value->struct->member->value->array->data->value->array->data->string;

            // Gather the raw data from the request
            $logentry = "[" . date('D M H:i:s Y') . "] [XMLRPC Request Data] ";
            $logentry .= "[" . $ip . "] ";
            $logentry .= $xml_output;
            //$logentry .= $xml_raw;
            /*$logentry .= $raw_xml;*/

            // File location
            $logfile = ABSPATH.'/wp-content/xmlrpc-request.log';

            // Save to file
            @file_put_contents($logfile, $logentry.PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }
}

/*
add_action('admin_menu', 'amxml_register_sub_menu');

function amxml_register_sub_menu() {
    add_submenu_page(
        'tools.php',
        'XMLRPC-Logger',
        'XMLRPC-Logger Settings',
        'manage_options',
        'xmlrpc-logger-settings',
        'axml_display_xmlrpc_logger'
    );
}

function axml_display_xmlrpc_logger() {
    echo '<div class="wrap">';
        echo '<h2>Page Title</h2>';
    echo '</div>';
}

add_action( 'admin_menu', 'amxml_settings_page');

function amxml_settings_page() {
    add_options_page(
        'XMLRPC Logger',
        'XMLRPC Logger Settings',
        'manage_options',
        'xmlrpc-logger-settings',
        'amxml_xmlrpc_logger_options'
    );
}
 */

add_action('init', 'amxml_log_xmlrpc_request');
?>
