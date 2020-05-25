<?php

//////////////////////////////////////////////
// ADD A WIDGET AREA AFTER THE CONTENT AREA //
//////////////////////////////////////////////

//* Register the widget area
add_action( 'init', 'elodin_resources_register_widget_area_below' );
function elodin_resources_register_widget_area_below() {
    genesis_register_sidebar( array(
        'id'		    => 'after-single-resources',
        'name'		    => __( 'Resources single footer', 'elodin-resources' ),
        'description'	=> __( 'An area intended to house anything you\'d like to show on all resources (perhaps a listing of all of the resources for easy navigation).', 'elodin-resources' ),
        'before_title'  => '<h2>',
        'after_title'  => '</h2>',
    ) );
}

//* Display the widget area
add_action( 'genesis_before_footer', 'elodin_resources_add_widget_area_after' );
function elodin_resources_add_widget_area_after() {

    //* bail if we're not on a service
    if ( !is_singular( 'resources' ) )
        return;

	genesis_widget_area( 'after-single-resources', array(
        'before' => '<div class="resources-widget-wrap-after"><div class="wrap">',
        'after' => '</div></div>',
	) );
}

/////////////////////////////////////////
// ADD CSS WHEN ON A SINGULAR RESOURCE //
/////////////////////////////////////////

add_action( 'wp_enqueue_scripts', 'add_resource_styles_on_single' );
function add_resource_styles_on_single() {
    
    if ( !is_singular( 'resources' ) )
        return;

    wp_enqueue_style( 'elodin-resources' );
}