<?php
/*
    Plugin Name: XMLRPC Logger
    Plugin URI: https://example.com/xmlprc-logger
    Description: Log incoming XMLRPC request
    Version: 0.1a
    Author: Andras Marton
    Author URI: https://andrasmarton.com
    License: GPL 1.2
*/

function xl_get_user_ip() {
    // Gather IP address from requester
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function xl_log_xmlrpc_request() {
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

add_action('init', 'xl_log_xmlrpc_request');
?>
