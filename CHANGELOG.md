# Changelog
## [ 0.0.3 ] - 06-26-2022
### Updated
- Updated both `README.md` and `readme.txt`
### Added
- `src` directory and moved the source files necessary for the plugin under there
- This is retrospective but addex `amxml-log-init.php` which completes the actually logging to the database
- Store the data within the database in a table specific to the plugin

### Removed
- Removed the use of a static file in favor of using the database to store the information gathered

## [ 0.0.2 ] - 11-16-2021
### Updated
- Updated header information in the main file.
- Updated `README.md`
## [ 0.0.2 ] - 10-10-2021
### Added
- Function to sanitize username and password. This is still a work in progress where multiple username and passwords are provided within a single request
### Updated
- Changed how the log queries are put together to factor in the sanitized information
### Removed
- For the time being removed the WordPress admin page hooks

## [ 0.0.1 ] - 09-14-2021 
###  Added
- Initial commit
