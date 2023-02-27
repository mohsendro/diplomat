<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

function wp_rewrite_customize() {

    $GLOBALS['wp_rewrite']->search_base = 'search';
    
}
add_action( 'init', 'wp_rewrite_customize' );


function wpb_change_search_url() {

    if ( is_search() && ! empty( $_GET['s'] ) ) {

        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
        
    }   

}
add_action( 'template_redirect', 'wpb_change_search_url' );