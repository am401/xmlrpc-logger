<?php // XMLRPC-Logger admin menu

// No direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// add sub-level administrative menu
function xmlrpc_logger_add_sublevel_menu() {

        /*

        add_submenu_page(
                string   $parent_slug,
                string   $page_title,
                string   $menu_title,
                string   $capability,
                string   $menu_slug,
                callable $function = ''
        );

        */

        add_submenu_page(
                'options-general.php',
                'XMLRPC-Logger Settings',
                'XMLRPC-Logger',
                'manage_options',
                'xmlrpc_logger',
                'xmlrpc_logger_display_settings_page'
        );

}
add_action( 'admin_menu', 'xmlrpc_logger_add_sublevel_menu' );
