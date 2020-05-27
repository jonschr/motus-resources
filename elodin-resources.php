<?php
/*
	Plugin Name: Elodin Resources
	Plugin URI: https://elod.in
    Description: Just another gated content resource library plugin
	Version: 0.2.1
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

// Layout adjustments on single (adding widget area, etc.)
require_once( 'lib/single-resources-modifications.php' );

// Adding the filter/toggle
require_once( 'lib/resources-toggle.php' );

// Locking/unlocking logic
require_once( 'lib/locking-and-unlocking.php' );

// Layout
require_once( 'layout/resources.php');
require_once( 'layout/resources-list.php');

// Updater
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/elodin-resources',
	__FILE__,
	'elodin-resources'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');


add_action( 'wp_enqueue_scripts', 'elodin_resources_enqueue' );
function elodin_resources_enqueue() {
	
	// Plugin styles
    wp_enqueue_style( 'elodin-resources', plugin_dir_url( __FILE__ ) . 'css/elodin-resources.css', array(), ELODIN_RESOURCES_VERSION, 'screen' );
    
    // Script
    // wp_register_script( 'slick-init', plugin_dir_url( __FILE__ ) . 'js/slick-init.js', array( 'slick-main' ), REDBLUE_SECTIONS_VERSION, true );
	
	
}