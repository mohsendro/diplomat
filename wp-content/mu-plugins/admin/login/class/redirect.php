<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'LoginRedirect' ) ) {

	class LoginRedirect extends Login {

		public $request_url;
        private $die_massage = "متاسفانه اجازه دسترسی ندارید!";
        private $die_title   = "عدم دسترسی";
        public $login_url = ' ';
        public $logout_url = ' ';

		public function __construct() {

            add_action( 'init', array($this, 'managment_redirect_urls') );
            $this->managment_loginout_urls();
            add_filter( 'login_redirect', array( $this, 'login_redirect_function' ) );
            add_filter( 'logout_redirect', array( $this, 'logout_redirect_function' ) );
            // add_action( 'init', array( $this, 'account_redirect_if_user_not_logged_in' ) );
            // add_action( 'init', array( $this, 'account_redirect_if_user_logged_in' ) );

        }
    
        public function managment_redirect_urls() {

            if ( is_multisite() ) return;
            if ( ! is_user_logged_in() && strpos( $_SERVER['REQUEST_URI'], 'wp-admin' ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) 
                    wp_die( $this->die_massage, $this->die_title );
            if ( strpos( $_SERVER['REQUEST_URI'], 'wp-login') ||
                 strpos( $_SERVER['REQUEST_URI'], 'wp-register') ||
                 strpos( $_SERVER['REQUEST_URI'], 'wp-signin') ||
                 strpos( $_SERVER['REQUEST_URI'], 'wp-signup') ||
                 // strpos( $_SERVER['REQUEST_URI'], 'login') ||
                 strpos( $_SERVER['REQUEST_URI'], 'wp-activate') ) {
              wp_die( $this->die_massage, $this->die_title );
            }
        
        }

        /****** WP Login Url For All Sections Site login redirect if user not logged in ******/
        public function managment_loginout_urls() {

            // wp_login  wp_logout  wp_login_form  wp_login_url  wp_register  wp_logout_url  wp_loginout
            // admin_url  get_admin_url
            // home_url  get_home_url  get_home_path  site_url  get_site_url
            // content_url  includes_url  wp_upload_dir

            $url_vorod = $_SERVER['REQUEST_URI'];
            if( ! strpos( $url_vorod, 'vorod' ) ) {

                add_filter( 'login_url', array($this, 'wpplus_login_url_rediret'), 10, 3 );
                add_filter( 'register_url', array($this, 'wpplus_register_url_rediret') );
                add_filter( 'lostpassword_url', array($this, 'wpplus_lost_password_url_rediret'), 10, 2 );
                add_filter( 'logout_url', array($this, 'wpplus_logout_url_rediret'), 10, 2 );
                // add_filter( 'admin_url', 'wpplus_admin_url_rediret', 10 );

            }

        }

        public function wpplus_login_url_rediret( $login_url, $redirect, $force_reauth ) {

            // return home_url( '/my-login-page/?redirect_to=' . $redirect );
            return home_url('account');

        }
        
        public function wpplus_register_url_rediret( $url ) {

            return home_url('account');

        }
        
        public function wpplus_lost_password_url_rediret( $lostpassword_url, $redirect ) {

            return home_url('account');

        }
        
        public function wpplus_logout_url_rediret( $logout_url, $redirect ) {

            $user = wp_get_current_user();
            $roles = ( array ) $user->roles;

            if( is_admin() ) {

                return $logout_url;

            }
            if ( in_array( "administrator", $roles ) ) {

                return $logout_url;
            
            }
            return home_url();

        }
        
        public function wpplus_admin_url_rediret() {

            return home_url();

        }

        /****** WP After Login && Logout Redirect ******/
        public function login_redirect_function( $user ) {

            //is there a user to check?
            // if ( isset( $user->roles ) && is_array( $user->roles ) ) {
                //check for admins
                if ( @in_array( 'administrator', $user->roles ) ) {

                    // redirect them to the default place
                    return $redirect_to;
                } else {
                    return home_url();
                }
            // } else {
            //     return $redirect_to;
            // }

        }

        public function logout_redirect_function( $requested_redirect_to ) {

            $requested_redirect_to = home_url();
            return $requested_redirect_to;

        }

        /****** User logeged Controll Redirect ******/
        public function account_redirect_if_user_not_logged_in() {

            if( ! is_user_logged_in() && strpos( $_SERVER['REQUEST_URI'], 'account') ) {

                wp_redirect( home_url() . "/signon" ); 
                exit;

            }
           
        }

        public function account_redirect_if_user_logged_in() {

            $user = wp_get_current_user();
            $roles = ( array ) $user->roles;
            
            if ( is_user_logged_in() && ! in_array( "administrator", $roles ) ) {

              if( strpos( $_SERVER['REQUEST_URI'], 'signon') ) {

                wp_redirect( home_url() . "/account" ); 
                exit;

              }

            }
          
        }

	}

}