<?php
/*
	Plugin Name: Elodin Resources
	Plugin URI: https://elod.in
    Description: Just another gated content resource library plugin
	Version: 0.2
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/


/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Plugin directory
define( 'ELODIN_RESOURCES', dirname( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_RESOURCES_VERSION', '0.2' );


// Basic setup
require_once( 'lib/post_type.php' );
require_once( 'lib/tax.php' ); 

// Locking/unlocking logic
require_once( 'lib/locking-and-unlocking.php' );

// Layout
require_once( 'layout/resources.php');

// Updater
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/elodin-resources',
	__FILE__,
	'elodin-resources'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');