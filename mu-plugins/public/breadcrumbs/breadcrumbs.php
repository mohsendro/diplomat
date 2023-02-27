<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

function get_breadcrumb() {

	// echo '<a href="'.home_url().'" rel="nofollow">صفحه اصلی</a>';

    $current = $post->ID;
    $parent = $post->post_parent;
    $grandparent_get = get_post($parent);
    $grandparent = $grandparent_get->post_parent;

    if ( ! is_front_page() ) {
        echo '<a href="'.home_url().'" rel="nofollow">صفحه اصلی</a>';
    }

    if( is_home() ) {
        echo "  /  ";
        echo "آرشیو نوشته ها و اخبار";
    }

    if ( is_page() && ! is_front_page() ) {
        echo "  /  ";
        //if ($root_parent = get_the_title($grandparent) !== $root_parent = get_the_title($current)) {echo get_the_title($grandparent); } else {echo get_the_title($parent); }
        echo the_title();
    }
    elseif ( is_search() ) {
        echo "  /  ";
        echo "نتیجه جستجو برای: ";
        echo the_search_query();
    }

    if ( is_category() || is_single() ) {
		echo "  /  ";
		the_category (' • ');
			if (is_single()) {
				echo "  /  ";
				the_title();
			}
    } 

}


// Create Shortcode wpplus_breadcrumb
// Shortcode: [wpplus_breadcrumb]
function wpplus_breadcrumb_shortcode() {
	get_breadcrumb();
}
add_shortcode( 'wpplus_breadcrumb', 'wpplus_breadcrumb_shortcode' );