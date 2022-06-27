# xmlrpc-logger

A simple WordPress plugin to log raw data sent as part of a POST request to a WordPress site's `xmlrpc.php` file.

## Why?
The XML-RPC interface of WordPress is a great way to your site to be remotely managed. However, more often than not, you will not be utilizing this end point. Yet this end point leaves your site vulnerable to password brute force attacks, where an attacker tries a username and password combination.

This plugin can help identify what exactly is happening when external parties are interacting with your `xmlrpc.php` file as it captures the RAW input data sent to the end point. This can confirm whether a password attack or another attack method is being utilized against your site.

## Usage
The plugin is in the early stages of development and therefore it has limited functionality. At this time the primary options are to enable or disable. When enabled, it will log unfiltered XML data sent to the WordPres site it is running on via the XMLRPC file.

## Data recorded
The plugin currently records the following information:
* Date and time stamp from when the request is being logged
* IP Address of the user interacting with the end point
* The raw data that was sent to the end point
* The user's User Agent information

## Installation
* Simply copy the files from the `src` directory to `wp-content-plugins/xmlrpc-logger`. 
* Navigate to the WordPress Admin Dashboard > Plugins and activate the **XMLRPC-Logger** plugin
