=== Plugin Name ===
Contributors: am401
Donate link: na
Tags: xmlrpc
Requires at least: 4.7
Tested up to: 5.8
Stable tag: 4.3
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple logger to capture incoming data to the xmlrpc.php file.

=== Description ===

Ever wondered what's happening with traffic to your xmlrpc.php file? The XML-RPC interface within WordPress allows access to the WP Admin area to carry out tasks such as publishing posts or uploading media. However, there are a number of potential security implications that may affect your site. The primary attack vector that can be used against the XML-RPC interface is username and password brute force attempts.

Being able to see what's happening with requests to this interface, especially when you are not actively using it yourself can bring additional security insight when you are trying to protect your site from attackers.

=== Changelog ===

= 0.0.2 =
* Removed WordPress admin page hooks.
* Changed how the log queries and formatting are put together.

= 0.0.1 =
* Initial commit.
