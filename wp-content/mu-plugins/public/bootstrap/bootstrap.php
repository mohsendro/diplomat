<?php
/**
* @deprecated : Bootstrap v5.1.3 Enqueue Styles && Scripts In Header && Footer
*/

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

/* Bootstrap Enqueue Styles && Scripts */
function wpplus_enqueuing_bootstrap_scripts() {

	wp_enqueue_style( 'bootstrap-reboot.min', plugin_dir_url(__FILE__) . 'css/bootstrap-reboot.min.css', false, '5.1.3' );
	wp_enqueue_style( 'bootstrap.rtl.min', plugin_dir_url(__FILE__) . 'css/bootstrap.rtl.min.css', false, '5.1.3' );
	wp_enqueue_script( 'bootstrap.bundle.min', plugin_dir_url(__FILE__) . 'js/bootstrap.bundle.min.js', false, '5.1.3', true );
	
}
add_action('wp_enqueue_scripts', 'wpplus_enqueuing_bootstrap_scripts');