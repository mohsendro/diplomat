<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'LoginSecurity' ) ) {

	class LoginSecurity extends Login {

		public function __construct() {

            add_filter( 'show_admin_bar', array( $this, 'remove_admin_bar' ) );
            add_action('init',  array( $this, 'is_admin_access' ) );
            // add_filter( 'comment_form_fields', array( $this, 'comment_form_defaults_massage' ) );
            add_filter( 'comment_form_defaults', array( $this, 'comment_form_replay_defaults_massage' ) );
            add_filter( 'comment_reply_link', array( $this, 'comment_reply_link_massage' ), 10 ,4);
            add_action('widgets_init', array( $this, 'unregister_default_widgets' ), 11);
            add_filter('wp_nav_menu_items', array( $this, 'add_login_logout_link' ), 10, 2);

        }
    
        /****** Display admin-bar for roles ******/
        public function remove_admin_bar() {

            $users = wp_get_current_user();
            if ( in_array( 'administrator', (array) $users->roles ) && !is_admin() ) {

              return true;

            } else {

              return false;

            }

        }

        /****** Limited access to wp-admin for roles ******/
        public function is_admin_access() {

            $users = wp_get_current_user();
            if ( in_array( 'administrator', (array) $users->roles ) ) {

                return true;

            } else {

                if( is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ){

                    wp_die( "متاسفانه اجازه دسترسی ندارید!", "عدم دسترسی" );

                }

            }

        }

        /****** Comment login redirect if user not logged in ******/
        public function comment_form_defaults_massage( $fields ) {

            $fields['must_log_in'] = 'برای ثبت نظر باید وارد شوید';
            return $fields ;

        }

        public function comment_form_replay_defaults_massage( $defaults ) {

            $defaults['must_log_in'] = 'برای ثبت نظر باید وارد شوید';
            return $defaults;

        }

        public function comment_reply_link_massage( $link, $args, $comment, $post) {

            return $args["login_text"] = 'برای پاسخ به نظر باید وارد شوید';

        }

        /****** Disable Default Widgets Wordpress ******/
        public function unregister_default_widgets() {

            unregister_widget('WP_Widget_Meta');
            unregister_widget('WP_Nav_Menu_Widget');

        }

        public function add_login_logout_link($items, $args) {

            ob_start();
            wp_loginout('index.php');
            $loginoutlink = ob_get_contents();
            ob_end_clean();
            $items .= '<li>'. $loginoutlink .'</li>';
            return $items;

        }

	}

}
 