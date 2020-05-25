<?php

// [resourcetoggle foo="foo-value"]
function resourcetoggle_func( $atts ) {

    ob_start();

    ?>
    <script>
    jQuery(document).ready(function( $ ) {
        var alllink = $( 'a#alllink' );
        var links = $( 'ul.resourceselection a.resourcelink');

        alllink.addClass( 'active' );
        
        //* get the url parameters on load
        $.urlParam = function (name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)')
            .exec(window.location.href);
            
            if (results == null) {
                return null;
            }
            return results[1] || 0;
        }

        parameterpassed = $.urlParam('show');
        console.log(parameterpassed );

        //* switch parameters based on the link
        if ( parameterpassed != null ) {       
            alllink.removeClass( 'active' );
            links.removeClass( 'active' );
            $( ".resourceselection a[data-filter=" + parameterpassed + "]"  ).addClass('active');
            $( '.loop-container .entry.type-resources' ).addClass( 'hideresource' );
            $( '.loop-container .entry.type-resources.resourcecategories-' + parameterpassed ).removeClass( 'hideresource');
        }
        
        //* link is clicked
        links.click( function(e) {
            e.preventDefault();

            alllink.removeClass( 'active' );
            links.removeClass( 'active' );
            $( this ).addClass('active');

            var filter = $( this ).data( "filter" );

            if ('URLSearchParams' in window) {
                var searchParams = new URLSearchParams(window.location.search);
                searchParams.set("show", filter );
                // window.location.search = searchParams.toString();
                window.history.pushState("", "", "?show=" + filter );

            }

            $( '.loop-container .entry.type-resources' ).addClass( 'hideresource' );
            $( '.loop-container .entry.type-resources.resourcecategories-' + filter ).removeClass( 'hideresource');
        });

        //* all link is clicked 
        alllink.click( function(e) {
            e.preventDefault();

            links.removeClass( 'active' );
            $( this ).addClass('active');

            $( '.entry.type-resources' ).removeClass( 'hideresource' );
        });

        function UpdateQueryString(key, value, url) {
            if (!url) url = window.location.href;
            var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
                hash;

            if (re.test(url)) {
                if (typeof value !== 'undefined' && value !== null) {
                    return url.replace(re, '$1' + key + "=" + value + '$2$3');
                } 
                else {
                    hash = url.split('#');
                    url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
                    if (typeof hash[1] !== 'undefined' && hash[1] !== null) {
                        url += '#' + hash[1];
                    }
                    return url;
                }
            }
            else {
                if (typeof value !== 'undefined' && value !== null) {
                    var separator = url.indexOf('?') !== -1 ? '&' : '?';
                    hash = url.split('#');
                    url = hash[0] + separator + key + '=' + value;
                    if (typeof hash[1] !== 'undefined' && hash[1] !== null) {
                        url += '#' + hash[1];
                    }
                    return url;
                }
                else {
                    return url;
                }
            }
        }
        
    });
    </script>
    <?php

    $terms = get_terms( 'resourcecategories', array(
        'hide_empty' => true,
    ) );

    echo '<ul class="resourceselection">';

        echo '<li><a id="alllink" href="#" class="" data-filter="all">All</a></li>';

        foreach( $terms as $term ) {
            // echo '<pre>';
            // print_r( $term );
            // echo '</pre>';

            echo '<li>';
                printf( '<a href="#" class="resourcelink" data-filter="%s">%s</a>', $term->slug, $term->name );
            echo '</li>';
        }

    echo '</ul>';

    return ob_get_clean();
   
}
add_shortcode( 'resourcetoggle', 'resourcetoggle_func' );