<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Gutenberg' ) ) {

	class Gutenberg {

		public function __construct() {

            // add_action('admin_init', array($this, 'wpplus_disable_gutenberg_settings') );
            $this->wpplus_disable_gutenberg_settings();

		}

        public function wpplus_disable_gutenberg_settings() {

            include plugin_dir_path(__FILE__) . 'settings.php';
            $gutenberg_settins = new GutenbergSettings;  

            $type_editor = get_option('type_editor'); //var_dump( $type_editor);
            if( $type_editor == 'classic' ) {

                add_action('admin_init', array($this, 'wpplus_version_compare'));
                $this->wpplus_disable_gutenberg_for_widgets();

            }

        }

        public function wpplus_version_compare() {

            if ( version_compare($GLOBALS['wp_version'], '5.0-beta', '>') ) {
                // WP > 5 beta
                add_filter( 'use_block_editor_for_post_type', array($this, 'wpplus_disable_gutenberg_for_post_type'), 10, 2 );
            } else {
                // WP < 5 beta
                add_filter( 'gutenberg_can_edit_post_type', array($this,'wpplus_disable_gutenberg_for_post_type'), 10, 2 );
            }

        }

		public function wpplus_disable_gutenberg_for_post_type( $is_enabled, $post_type ) {

            return false;

        }

        public function wpplus_disable_gutenberg_for_widgets() {

            // Disables the block editor from managing widgets in the Gutenberg plugin.
            add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );

            // Disables the block editor from managing widgets.
            add_filter( 'use_widgets_block_editor', '__return_false' );

        }

	}

}
$gutenberg = new Gutenberg;