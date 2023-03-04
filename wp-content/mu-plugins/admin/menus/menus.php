<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Menus' ) ) {

	class Menus {

		public function __construct() {

			add_filter('custom_menu_order', array($this, 'wpplus_menu_order') );
            add_filter('menu_order', array($this, 'wpplus_menu_order') );
            // add_action( 'admin_init', array($this, 'wpplus_remove_menus') );

		}

		public function wpplus_menu_order( $menu_ord ) {

			// var_dump($menu_ord);
            if (!$menu_ord) return true;
            return array(
             'index.php',
             'separator1',
             'edit.php?post_type=page',
             'edit.php',
             'edit.php?post_type=advertising',
             'edit.php?post_type=project',
             'edit.php?post_type=consultant',
             'edit-comments.php',
             'forms_log',
             'nirweb_ticket_manage_tickets',
             'wpcf7',
             'flamingo',
             'upload.php',
             'separator2',
             'themes.php',
             'plugins.php',
             'users.php',
             'tools.php',
             'options-general.php',
             'separator-last',
             );

		}

		public function wpplus_remove_menus() {

			remove_menu_page( 'index.php' );
			
		}

	}

}
$menus = new Menus;