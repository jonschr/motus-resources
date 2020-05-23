<?php

//* Output resources before
// add_action( 'before_loop_layout_resources', 'rb_resources_before' );
function rb_resources_before( $args ) {
	// wp_enqueue_script( 'SCRIPTHANDLE' );
}

//* Output each resources
add_action( 'add_loop_layout_resources', 'rb_resources_each' );
function rb_resources_each() {

	$id = get_the_ID();

    $title = get_the_title();
    $icon = get_post_meta( $id, 'icon', true );
    $gated = get_post_meta( $id, 'gated', true );
    // $description = get_post_meta( $id, 'content_summary', true );
    // $description = apply_filters( 'the_content', apply_filters( 'the_content', $description ) );

    if ( has_post_thumbnail() ) 
        printf( '<div class="featured-wrap"><div class="featured-image" style="background-image:url( %s )"></div></div>', get_the_post_thumbnail_url( $post_id, 'large' ) );

    printf( '<a class="overlay" href="%s"></a>', get_the_permalink() );

    echo '<div class="inner">';

        //* Output the content
        echo '<div class="inner-content">';

            if ( $title )
                printf( '<h3>%s</h3>', $title );

            // if ( $description )
            //     printf( '<div class="description">%s</div>', $description );

        echo '</div>';

        //* Output the video/pdf icon
        if ( $icon ) {

            echo '<div class="icon">';

                if ( $icon == 'pdf' )
                    echo '<span class="dashicons dashicons-media-document"></span>';

                if ( $icon == 'video' )
                    echo '<span class="dashicons dashicons-controls-play"></span>';

            echo '</div>';
        }

        //* Output the lock/unlock icon
        if ( $gated == false || is_unlocked() ) {
            echo '<div class="lock"><span class="dashicons dashicons-unlock"></span></div>';
        } else {
            echo '<div class="lock"><span class="dashicons dashicons-lock"></span></div>';
        }

    echo '</div>';
    
}