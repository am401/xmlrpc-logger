<?php

//if (!XMLRPC_ATTEMPT_LOG) die();


function amxml_actually_log() {
    global $wpdb;

    if ( defined( 'XMLRPC_REQUEST' ) ) {
        //$raw_xml_data = file_get_contents("php://input");
        //$logentry = preg_replace('/[\r\n]+/', "", filter_var($raw_xml_data, FILTER_FLAG_ENCODE_LOW));
        $logentry = preg_replace('/[\r\n]+/', "", file_get_contents("php://input"));

        $table_name = $wpdb->prefix."xmlrpc_logs";

        $wpdb->insert(
            $table_name,
            array(
                "data"      => $logentry,
                "time"      => current_time('mysql'),
                "agent"     => $_SERVER['HTTP_USER_AGENT'],
                "ip"        => $_SERVER['REMOTE_ADDR'],
            )
        );
    }
}

add_action('init', 'amxml_actually_log');
