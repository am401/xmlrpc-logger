# xmlrpc-logger

A simple WordPress plugin to log raw data sent as part of a POST request to a WordPress site's `xmlrpc.php` file.

# Usage
The plugin is in the early stages of development and therefore it has limited functionality. At this time the primary options are to enable or disable. When enabled, it will log unfiltered XML data sent to the WordPres site it is running on via the XMLRPC file.

The plugin will write data to the `/wp-content/xmlrpc-request.log` file and will log the raw data, a timestamp and the IP of the requester.

# TODO

- [ ] Create a settings page within the WordPress Admin Dashboard
- [ ] Set the default behavior to filter out invalid XML
- [ ] Create a setting to sanitize the XML data to remove username/passwords
- [ ] By default do not log IP address of client
- [ ] Create necessary settings for the above three options within the WordPress Admin Dashboard
