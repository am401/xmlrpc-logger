<?php
/*
    Plugin Name: XMLRPC Logger
    Plugin URI: https://github.com/am401/xmlrpc-logger
    Description: Log incoming XMLRPC requests.
    Version: 0.0.3
    Author: Andras Marton
    Author URI: https://andrasmarton.com
    License: GPL 1.2
*/

// Exit if this file is called directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define("XMLRPC_ATTEMPT_LOG", true);

$amxml_settings = array(
    "plugin_name" => "XMLRPC Logger",
    "plugin_url" => "xmlrpc-logger",
    "plugin_version" => "0.1",
    "plugin_db_version" => "1.0",
    "plugin_table_name" => "{$wpdb->prefix}xmlrpc_logs",
);

require_once("amxml-log-init.php");

register_activation_hook(__FILE__, "amxml_install");
register_deactivation_hook(__FILE__, 'amxml_uninstall');

function amxml_install()
{
        global $wpdb, $amxml_settings;

        $table_name = $wpdb->prefix."xmlrpc_logs";

        $sql = <<<SQL
CREATE TABLE $table_name (
  `id`        mediumint(9)    NOT NULL AUTO_INCREMENT,
  `time`      datetime        DEFAULT '0000-00-00 00:00:00' NOT NULL,
  `ip`        varchar(255)    NOT NULL,
  `data`      longtext        NOT NULL,
  `agent`     varchar(255)    NOT NULL,
  `host`      varchar(255)    DEFAULT NULL,
  UNIQUE KEY  `id`            (`id`),
  KEY         `time`          (`time`),
  KEY         `ip`            (`ip`(255)),
  KEY         `agent`         (`agent`(255))
);
SQL;

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option("amxml_db_version", $amxml_settings['plugin_db_version']);
}

function amxml_uninstall()
{
        global $wpdb, $amxml_settings;

        $table_name = $wpdb->prefix."xmlrpc_logs";

        $wpdb->get_results("DROP TABLE $table_name;");

        add_option("amxml_db_version", $amxml_settings['plugin_db_version']);
}
?>
