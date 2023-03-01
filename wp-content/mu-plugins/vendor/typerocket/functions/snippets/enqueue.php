<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

function wpplus_enqueue_scripts() {

	wp_register_style( 'account-style', TYPEROCKET_DIR_URL . 'resources/assets/css/theme.css', false, '1.0.0' );
	wp_register_script( 'account-script', TYPEROCKET_DIR_URL . 'resources/assets/js/theme.js', false, '1.0.0' );
	wp_register_script( 'ajax-acount-script', TYPEROCKET_DIR_URL . 'resources/assets/js/ajax-acount.js', false, '1.0.0' );
	// wp_enqueue_style( 'account-style' );
	// wp_enqueue_script( 'account-script' );
    // wp_enqueue_script( 'ajax-acount-script' );


    // Ajax Handler
    // wp_localize_script(
    //     'ajax-acount-script', 'account_ajax_localize_obj', array(
    //         'ajax_url' => admin_url( 'admin-ajax.php' ),
    //         'the_nonce' => wp_create_nonce('account_form_nonce') 
    //     )
    // );

}
add_action( 'wp_enqueue_scripts', 'wpplus_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'wpplus_enqueue_scripts' );
add_action( 'enqueue_embed_scripts', 'wpplus_enqueue_scripts' );