<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

function get_ip_address() {
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($iplist as $ip) {
            if (validate_ip($ip))
                return $ip;
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];
    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

function validate_ip($ip) {
    if (filter_var($ip, FILTER_VALIDATE_IP, 
                            FILTER_FLAG_IPV4 | 
                            FILTER_FLAG_IPV6 |
                            FILTER_FLAG_NO_PRIV_RANGE | 
                            FILTER_FLAG_NO_RES_RANGE) === false)
        return false;
    return true;
}

function set_post_view_custom_field() {

    $selected_type = array( 'post' );
    $both_view = true; // Both view parameters: true, false
    $unique_ip = false; // Unique IP parameters: true, false

    if ( is_singular( $selected_type ) ) {
        global $post;
        $post_id = $post->ID;
        $stored_ip_addresses = 0;
        $wpplus_post_view_count_all    = get_post_meta( $post_id, 'wpplus_post_view_count_all', true );
        $wpplus_post_view_count_unique = get_post_meta( $post_id, 'wpplus_post_view_count_unique', true );
        $stored_ip_addresses = get_post_meta(get_the_ID(),'wpplus_view_ip',true);
        $current_ip = get_ip_address();

        if( $stored_ip_addresses && $both_view == false ) {
            if ( $unique_ip == true ) {	
                if( !in_array($current_ip, $stored_ip_addresses) ) {
                    $stored_ip_addresses[] = $current_ip;
                    update_post_meta(get_the_ID(), 'wpplus_post_view_count_unique', intval($wpplus_post_view_count_unique) + 1 );
                    update_post_meta(get_the_ID(),'wpplus_view_ip',$stored_ip_addresses);
                }
            } else {
                update_post_meta(get_the_ID(), 'wpplus_post_view_count_all', intval($wpplus_post_view_count_all) + 1 );
            }
        } else {
            update_post_meta(get_the_ID(), 'wpplus_post_view_count_all', intval($wpplus_post_view_count_all) + 1 );
            if( !in_array($current_ip, $stored_ip_addresses) ) {
                $stored_ip_addresses[] = $current_ip;
                update_post_meta(get_the_ID(), 'wpplus_post_view_count_unique', intval($wpplus_post_view_count_unique) + 1 );
                update_post_meta(get_the_ID(),'wpplus_view_ip',$stored_ip_addresses);
            }
        }
    }

}
add_action( 'wp_head', 'set_post_view_custom_field' );




function add_wpplus_post_view_count_column( $columns ) {
    if( is_array( $columns ) && ! isset( $columns['wpplus_post_view_count'] ) )
        $columns[ 'wpplus_post_view_count' ] = 'بازدید';
    return $columns;
}
add_filter( 'manage_posts_columns', 'add_wpplus_post_view_count_column' );

function set_wpplus_post_view_count_column( $column_name, $post_ID ) {
    if ( $column_name == 'wpplus_post_view_count' ) {
        $count = 'کل: ' . get_post_meta( $post_ID, 'wpplus_post_view_count_all', true ) .
                  "</br>" .
                  'یکتا: ' . get_post_meta( $post_ID, 'wpplus_post_view_count_unique', true );
        echo $count ? $count : 0;
    }
}
add_action( 'manage_posts_custom_column', 'set_wpplus_post_view_count_column', 10, 2);




function get_wpplus_post_view_count_all( $post_id ){
    return get_post_meta( $post_id, 'wpplus_post_view_count_all', true );
}

function get_wpplus_post_view_count_unique( $post_id ){
    return get_post_meta( $post_id, 'wpplus_post_view_count_unique', true );
}

function wpplus_post_view_the_content($content) {
    $content .= '<p>تعداد کل بازدید ها: ' . get_wpplus_post_view_count_all( get_the_ID() ) . ' بازدید </p>';
    $content .= '<p>تعداد بازدید های یکتا: ' . get_wpplus_post_view_count_unique( get_the_ID() ) . ' بازدید </p>';
    return $content;
}
add_filter( 'the_content', 'wpplus_post_view_the_content');

function wpplus_post_view_shortcode() {
	function wpplus_post_view_callback($atts = array() , $content = '') { 
		$content .= '<p>تعداد کل بازدید ها: ' . get_wpplus_post_view_count_all( get_the_ID() ) . ' بازدید </p>';
        $content .= '<p>تعداد بازدید های یکتا: ' . get_wpplus_post_view_count_unique( get_the_ID() ) . ' بازدید </p>';
        return $content;
	}
	if(!shortcode_exists( 'wpplus_post_view' )){
		add_shortcode( 'wpplus_post_view', 'wpplus_post_view_callback' );
	}	
}
add_action( 'wp', 'wpplus_post_view_shortcode' );
