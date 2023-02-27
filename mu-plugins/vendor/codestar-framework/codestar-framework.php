<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * @package   Codestar Framework - WordPress Options Framework
 * @author    Codestar <info@codestarthemes.com>
 * @link      http://codestarframework.com
 * @copyright 2015-2022 Codestar
 *
 *
 * Plugin Name: Codestar Framework
 * Plugin URI: http://codestarframework.com/
 * Author: Codestar
 * Author URI: http://codestarthemes.com/
 * Version: 2.2.6
 * Description: A Simple and Lightweight WordPress Option Framework for Themes and Plugins
 * Text Domain: csf
 * Domain Path: /languages
 *
 */

require_once plugin_dir_path( __FILE__ ) .'classes/setup.class.php';

/* CSF Framework Enqueue Styles && Scripts */
function wpplus_enqueuing_csf_scripts() {
	wp_dequeue_style( 'csf-css' );
	wp_dequeue_style( 'csf-rtl-css' );
	wp_dequeue_script( 'csf-plugins-js' );
	wp_dequeue_script( 'csf-js' );
	wp_enqueue_style( 'csf-css', plugin_dir_url(__FILE__) . 'assets/css/style.min.css', false, '1.0.0' );
    wp_enqueue_style( 'csf-rtl-css', plugin_dir_url(__FILE__) . 'assets/css/style-rtl.min.css', false, '1.0.0' );
	wp_enqueue_script( 'csf-plugins-js', plugin_dir_url(__FILE__) . 'assets/js/plugins.min.js', false, '1.0.0' );
	wp_enqueue_script( 'csf-js', plugin_dir_url(__FILE__) . 'assets/js/main.min.js', false, '1.0.0' );
}
add_action('csf_enqueue', 'wpplus_enqueuing_csf_scripts');
// add_filter( 'csf_welcome_page', '__return_false' );