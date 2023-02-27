<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Styles' ) ) {

	class Styles {

		public function __construct() {

			add_action( 'admin_enqueue_scripts', array($this, 'wpplus_enqueuing_admin_styles') );
			add_action( 'admin_enqueue_scripts', array($this, 'wpplus_enqueuing_admin_scripts') );

		}

		public function wpplus_enqueuing_admin_styles() {

			wp_register_style( 'admin-style', plugin_dir_url(__FILE__) . 'css/admin.css', false, '1.0.0' );
			wp_enqueue_style( 'admin-style' );

		}

		public function wpplus_enqueuing_admin_scripts() {

			wp_register_script( 'admin-script', plugin_dir_url(__FILE__) . 'js/admin.js', false, '1.0.0' );
			wp_enqueue_script( 'admin-script' );
			
		}

	}

}
$styles = new Styles;