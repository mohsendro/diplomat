<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'LoginRename' ) ) {

	class LoginRename extends Login {

        private $rewrite_url  = "vorod";
        private $redirect_url = "404.php";
        private $die_massage  = "متاسفانه اجازه دسترسی ندارید!";
        private $die_title    = "عدم دسترسی";
        private $wp_login_php;
        protected static $instance = null;

		public function __construct() {

            add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ), 2 );
            add_action( 'wp_loaded', array( $this, 'wp_loaded' ) );
            add_filter( 'site_url', array( $this, 'site_url' ), 10, 4 );

        }
    
        private function path() {

            return trailingslashit( dirname( __FILE__ ) );

        }
    
        private function use_trailing_slashes() {
    
            // return ( '/' === substr( get_option( 'permalink_structure' ), -1, 1 ) );
            return ( ' ' === substr( get_option( 'permalink_structure' ), -1, 1 ) );
    
        }
    
        private function user_trailingslashit( $string ) {
    
            return $this->use_trailing_slashes()
                ? trailingslashit( $string )
                : untrailingslashit( $string );
    
        }
    
        private function wp_template_loader() {
    
            global $pagenow;
    
            $pagenow = 'index.php';
    
            if ( ! defined( 'WP_USE_THEMES' ) ) {
    
                define( 'WP_USE_THEMES', true );
    
            }
    
            wp();
    
            if ( $_SERVER['REQUEST_URI'] === $this->user_trailingslashit( str_repeat( '-/', 10 ) ) ) {
    
                $_SERVER['REQUEST_URI'] = $this->user_trailingslashit( '/wp-login-php/' );
    
            }
    
            // require_once( ABSPATH . WPINC . '/template-loader.php' );
            wp_die( $this->die_massage, $this->die_title );
    
            die;
    
        }
    
        public function new_login_url( $scheme = null ) {
    
            if ( get_option( 'permalink_structure' ) ) {
    
                return $this->user_trailingslashit( home_url( '/', $scheme ) . $this->rewrite_url );
    
            } else {
    
                return home_url( '/', $scheme ) . '?' . $this->rewrite_url;
    
            }
    
        }
    
        public static function get_instance() {
            
            // If the single instance hasn't been set, set it now.
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
    
            return self::$instance;
        }
    
        public function plugins_loaded() {
    
            global $pagenow;
    
            // if ( ! is_multisite()
            //     && ( strpos( $_SERVER['REQUEST_URI'], 'wp-signup' )  !== false
            //         || strpos( $_SERVER['REQUEST_URI'], 'wp-activate' ) )  !== false ) {
    
            //     wp_die( __( 'This feature is not enabled.', 'wps-hide-login' ) );
    
            // }
    
            $request = parse_url( $_SERVER['REQUEST_URI'] );
    
            if ( ( strpos( $_SERVER['REQUEST_URI'], 'wp-login.php' ) !== false
                    || untrailingslashit( $request['path'] ) === site_url( 'wp-login', 'relative' ) )
                && ! is_admin() ) {
    
                $this->wp_login_php = true;
    
                $_SERVER['REQUEST_URI'] = $this->user_trailingslashit( '/' . str_repeat( '-/', 10 ) );
    
                $pagenow = 'index.php';
    
            } elseif ( untrailingslashit( $request['path'] ) === home_url( $this->rewrite_url, 'relative' )
                || ( ! get_option( 'permalink_structure' )
                    && isset( $_GET[$this->rewrite_url] )
                    && empty( $_GET[$this->rewrite_url] ) ) ) {
    
                $pagenow = 'wp-login.php';
    
            }
    
        }
    
        public function wp_loaded() {
    
            global $pagenow;
    
            if ( is_admin()
                && ! is_user_logged_in()
                && ! defined( 'DOING_AJAX' ) ) {
    
                status_header(404);
                nocache_headers();
                // include( get_404_template() );
                // wp_redirect('404.php');
                exit;
            }
    
            $request = parse_url( $_SERVER['REQUEST_URI'] );
    
            if ( $pagenow === 'wp-login.php'
                && $request['path'] !== $this->user_trailingslashit( $request['path'] )
                && get_option( 'permalink_structure' ) ) {
    
                wp_safe_redirect( $this->user_trailingslashit( $this->new_login_url() )
                    . ( ! empty( $_SERVER['QUERY_STRING'] ) ? '?' . $_SERVER['QUERY_STRING'] : '' ) );
    
                die;
    
            } elseif ( $this->wp_login_php ) {
    
                if ( ( $referer = wp_get_referer() )
                    && strpos( $referer, 'wp-activate.php' ) !== false
                    && ( $referer = parse_url( $referer ) )
                    && ! empty( $referer['query'] ) ) {
    
                    parse_str( $referer['query'], $referer );
    
                    if ( ! empty( $referer['key'] )
                        && ( $result = wpmu_activate_signup( $referer['key'] ) )
                        && is_wp_error( $result )
                        && ( $result->get_error_code() === 'already_active'
                            || $result->get_error_code() === 'blog_taken' ) ) {
    
                        wp_safe_redirect( $this->new_login_url()
                            . ( ! empty( $_SERVER['QUERY_STRING'] ) ? '?' . $_SERVER['QUERY_STRING'] : '' ) );
    
                        die;
    
                    }
    
                }
    
                $this->wp_template_loader();
    
            } elseif ( $pagenow === 'wp-login.php' ) {
    
                global $error, $interim_login, $action, $user_login;
    
                @require_once ABSPATH . 'wp-login.php';
    
                die;
    
            }
    
        }
    
        public function site_url( $url, $path, $scheme, $blog_id ) {
    
            return $this->filter_wp_login_php( $url, $scheme );
    
        }
    
        public function filter_wp_login_php( $url, $scheme = null ) {
    
            if ( strpos( $url, 'wp-login.php' ) !== false ) {
    
                if ( is_ssl() ) {
    
                    $scheme = 'https';
    
                }
    
                $args = explode( '?', $url );
    
                if ( isset( $args[1] ) ) {
    
                    parse_str( $args[1], $args );
    
                    $url = add_query_arg( $args, $this->new_login_url( $scheme ) );
    
                } else {
    
                    $url = $this->new_login_url( $scheme );
    
                }
    
            }
    
            return $url;
    
        }

	}

}