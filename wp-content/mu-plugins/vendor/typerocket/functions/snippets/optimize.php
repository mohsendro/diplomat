<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Snipets' ) ) {

	class Snipets {

		public function __construct() {

			if( is_admin() ) {

				add_action( 'admin_init' , array( $this, 'wpplus_admin_snippets' ) );

			} elseif( ! is_admin() ) {

				$this->wpplus_public_snippets();

			} else {

				return false;

			}

			add_action( 'init' , array( $this, 'wpplus_all_snippets' ) );

		}

		public function wpplus_admin_snippets() {

            // My Code

		}

		public function wpplus_public_snippets() {

			$this->disable_emojis();
			add_action( 'wp_enqueue_scripts', array( $this, 'smartwp_remove_wp_block_library_css' ) , 100 );
			add_action( 'wp_enqueue_scripts', array( $this, 'wps_deregister_styles' ), 100 );
			add_filter( 'wp_enqueue_scripts', array( $this, 'disable_classic_theme_styles' ), 100 );

		}

		public function wpplus_all_snippets() {

			add_action( 'wp_before_admin_bar_render', array( $this, 'remove_wp_logo' ) ); 

		}

		/**
		 * Start Snippets Methods Admin
		*/

		/**
		 * Start Snippets Methods Public
		*/

		public function disable_emojis() {

			add_action( 'init', array( $this, 'disable_emojis_callback' ) );

		}

		public function disable_emojis_callback() {

			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );	
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
			// Remove from TinyMCE
			add_filter( 'tiny_mce_plugins', array( $this, 'disable_emojis_tinymce' ) );

		}

		public function disable_emojis_tinymce( $plugins ) {

			if ( is_array( $plugins ) ) {
				return array_diff( $plugins, array( 'wpemoji' ) );
			} else {
				return array();
			}

		}

		public function smartwp_remove_wp_block_library_css() {

			wp_dequeue_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library-theme' );
			wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS

		} 

		public function wps_deregister_styles() {

			wp_dequeue_style( 'global-styles' );

		}

		public function disable_classic_theme_styles() {

			wp_deregister_style('classic-theme-styles');
			wp_dequeue_style('classic-theme-styles');

		}

		/**
		 * Start Snippets Methods All
		*/

		public function remove_wp_logo() {  

			global $wp_admin_bar;  
			$wp_admin_bar->remove_menu('wp-logo');  

		}  

	}

}
$Snipets = new Snipets;