# README

## User Details Plugin

Wordpress plugin created for a job application task for Inpsyde.

## Requirements 

PHP 7.2+
Wordpress 5.4+

## Installation

To use the plugin, clone this repository to your plugin folder and activate the plugin.
"Composer install" is only required for testing. To start tests, run "./vendor/bin/phpunit tests".

## Usage

Navigate to "ROOT/user-details" (https://example.com/user-details)

## Notes

When any of the links are clicked, an AJAX call is made to the https://jsonplaceholder.typicode.com/ user details endpoint and a new HTML table row node object is created with the user's details inside. The row node object is then cached in a JS Map object, so the next time the same user's link is clicked, the node can be retreived from cache.
