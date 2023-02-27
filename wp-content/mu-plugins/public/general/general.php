<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'General' ) ) {

	class General {

		public function __construct() {

			add_action( 'wp_enqueue_scripts', array($this, 'wpplus_enqueuing_general_styles') );
			add_action( 'wp_enqueue_scripts', array($this, 'wpplus_enqueuing_general_scripts') );

		}

		public function wpplus_enqueuing_general_styles() {

			wp_register_style( 'general-style', plugin_dir_url(__FILE__) . 'css/style.css', false, '1.0.0' );
			wp_enqueue_style( 'general-style' );

		}

		public function wpplus_enqueuing_general_scripts() {

			wp_register_script( 'general-script', plugin_dir_url(__FILE__) . 'js/script.js', false, '1.0.0' );
			wp_enqueue_script( 'general-script' );
			
		}

	}

}
$General = new General;












