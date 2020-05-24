<?php

function is_gated() {
    
    global $post;
    
    //* if the current post is not gated, then it's not locked
    $gated = get_post_meta( $id, 'gated', true );
    if ( $gated == true )
        return true;

    return null;

}

function is_unlocked() {
	
	//* if the current user is an admin, it's unlocked
	if ( current_user_can('administrator') )
		return true;

	//* if there's a cookie, it's unlocked
	if ( $_COOKIE["novicontentgate"] )
		return true;

	//* if there's a URL parameter, it's unlocked
	if ( htmlspecialchars($_GET["unlock"]) )
		return true;

	//* if we haven't met one of those conditions, it's still locked
	return null;

}