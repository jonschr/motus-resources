<?php

add_action( 'init', 'elodin_resources_register_taxonomies' );
function elodin_resources_register_taxonomies() {
	register_taxonomy(
		'resourcecategories',
		'resources',
		array(
			'label' => __( 'Resource Categories' ),
			'rewrite' => array( 'slug' => 'resourcecategories' ),
			'hierarchical' => true,
		)
	);
}