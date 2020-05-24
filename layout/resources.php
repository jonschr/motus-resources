<?php

//* Output resources before
add_action( 'before_loop_layout_resources', 'elodin_resources_before' );
function elodin_resources_before( $args ) {
	wp_enqueue_style( 'elodin-resources' );
}

//* Output each resources
add_action( 'add_loop_layout_resources', 'rb_resources_each' );
function rb_resources_each() {

    //* vars
	$id = get_the_ID();
    $title = get_the_title();
    $excerpt = apply_filters( 'the_content', get_the_excerpt() );
    
    //* markup
    printf( '<a class="overlay" href="%s"></a>', get_the_permalink() );
    
    if ( has_post_thumbnail() ) 
        printf( '<div class="featured-wrap"><div class="featured-image" style="background-image:url( %s )"></div></div>', get_the_post_thumbnail_url( $id, 'large' ) );
    

    echo '<div class="inner">';

        //* Output the content
        echo '<div class="inner-content">';

            if ( $title )
                printf( '<h3>%s</h3>', $title );

            if ( $excerpt )
                printf( '<div class="excerpt">%s</div>', $excerpt );

        echo '</div>';

        //* Output the lock/unlock icon only if this is a gated post
        if ( is_gated() ) {

            //* show different icons for locked and unlocked posts
            if ( is_unlocked() ) {
                echo '<div class="lock"><span class="dashicons dashicons-unlock"></span></div>';
            } else {
                echo '<div class="lock"><span class="dashicons dashicons-lock"></span></div>';
            }

        }


    echo '</div>';

    edit_post_link();
    
}