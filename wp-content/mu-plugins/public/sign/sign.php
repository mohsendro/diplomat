<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Sign' ) ) {

    class Sign {

        public $request = '';

        public function __construct() {

            $this->request = $_SERVER['REQUEST_URI'];

            add_action( 'wp_enqueue_scripts', array( $this, 'wpplus_enqueuing_signon_scripts' ) );

            // add_action( 'wp_ajax_signin_ajax_handle', array( $this, 'wpplus_signin_action' ) );  // For logged in users.
            add_action( 'wp_ajax_nopriv_signin_ajax_handle', array( $this, 'wpplus_signin_action' ) );

            // add_action( 'wp_ajax_signup_ajax_handle', array( $this, 'wpplus_signup_action' ) );  // For logged in users.
            add_action( 'wp_ajax_nopriv_signup_ajax_handle', array( $this, 'wpplus_signup_action' ) );

            // add_action( 'wp_ajax_lostpassword_ajax_handle', array( $this, 'wpplus_lostpassword_action' ) );  // For logged in users.
            add_action( 'wp_ajax_nopriv_lostpassword_ajax_handle', array( $this, 'wpplus_lostpassword_action' ) );

            add_filter( 'user_contactmethods', array( $this, 'custom_user_contact_methods' ) );
            add_filter( 'manage_users_columns', array( $this, 'new_modify_user_table' ) );
            add_filter( 'manage_users_custom_column', array( $this, 'new_modify_user_table_row' ), 10, 3 );
            add_filter( 'generate_rewrite_rules', array( $this, 'wpplus_generate_rewrite_rule_signon' ) );
            add_filter( 'query_vars', array( $this, 'wpplus_query_vars_signon' ) );
            add_action( 'template_redirect', array( $this, 'wpplus_templates_signon' ) );

        }

        public function wpplus_enqueuing_signon_scripts() {

            wp_register_style( 'signon-style', plugin_dir_url(__FILE__) . 'assets/css/signon.css', false, '1.0.0' );
            wp_register_script( 'signon-script', plugin_dir_url(__FILE__) . 'assets/js/signon.js', false, '1.0.0' );
            wp_register_script( 'signin-script', plugin_dir_url(__FILE__) . 'ajax/signin.js', false, '1.0.0' );
            wp_register_script( 'signup-script', plugin_dir_url(__FILE__) . 'ajax/signup.js', false, '1.0.0' );
            wp_register_script( 'lostpassword-script', plugin_dir_url(__FILE__) . 'ajax/lostpassword.js', false, '1.0.0' );

            if ( strpos( $this->request, 'signon') ) {

                wp_enqueue_style( 'signon-style' );
                wp_enqueue_script( 'jquery' );
                wp_enqueue_script( 'signon-script' );

                if( isset( $_GET['action'] ) ) {

                    $query_string = $_GET['action'];

                    switch ( $query_string ) {
            
                        case 'signup':
                            wp_enqueue_script( 'signup-script' );
                            wp_localize_script( 'signup-script', 'signup_ajax_localize_obj', array(
                                'ajax_url' => admin_url( 'admin-ajax.php' ),
                                'the_nonce' => wp_create_nonce('signup_form_nonce') 
                            ));
                            break;

                        case 'lostpassword':
                            wp_enqueue_script( 'lostpassword-script' );
                            wp_localize_script( 'lostpassword-script', 'lostpassword_ajax_localize_obj', array(
                                'ajax_url' => admin_url( 'admin-ajax.php' ),
                                'the_nonce' => wp_create_nonce('lostpassword_form_nonce') 
                            ));
                            break;

                        default:
                            wp_enqueue_script( 'signin-script' );
                            wp_localize_script( 'signin-script', 'signin_ajax_localize_obj', array(
                                'ajax_url' => admin_url( 'admin-ajax.php' ),
                                'the_nonce' => wp_create_nonce('signin_form_nonce') 
                            ));
                            break;
            
                    }
            
                } else {
            
                    wp_enqueue_script( 'signin-script' );
                    wp_localize_script( 'signin-script', 'signin_ajax_localize_obj', array(
                        'ajax_url' => admin_url( 'admin-ajax.php' ),
                        'the_nonce' => wp_create_nonce('signin_form_nonce') 
                    ));
                                                    
                }

            }

        }
        
        public function wpplus_signin_action() {

            include plugin_dir_path(__FILE__) . 'action/signin.php';
            $signin = new Signin;

        }

        public function wpplus_signup_action() {

            include plugin_dir_path(__FILE__) . 'action/signup.php';
            $signup = new Signup;

        }

        public function wpplus_lostpassword_action() {

            include plugin_dir_path(__FILE__) . 'action/lostpassword.php';
            $lostpassword = new Lostpassword;

        }

        /****** Register User Contact Methods ******/
        public function custom_user_contact_methods( $user_contact_method ) {

            $user_contact_method['user_phone'] = 'شماره همراه (لازم)';
            
            return $user_contact_method;
        
        }

        public function new_modify_user_table( $column ) {

            // $column['user_phone'] = 'شماره';
            $column = array(
                "cb"         => "",
                "username"   => "نام کاربری",
                "name"       => "نام",
                "email"      => "ایمیل",
                "user_phone" => 'شماره',
                "role"       => "نقش",
                "posts"      => "نوشته‌ها",
            );
            return $column;
        
        }

        public function new_modify_user_table_row( $val, $column_name, $user_id ) {

            switch ($column_name) {

                case 'user_phone' :
                    return get_user_meta( $user_id, 'user_phone', true);
                default:
                
            }
            return $val;

        }

        /****** Signon register Slug and dont endpoint ******/
        public function wpplus_generate_rewrite_rule_signon( $wp_rewrite ) {

            $wp_rewrite->rules = array_merge(
                ['signon/?$' => 'index.php?signon=1'],
                $wp_rewrite->rules
            );

        }

        public function wpplus_query_vars_signon( $query_vars ) {

            $query_vars[] = 'signon';
            return $query_vars;

        }

        public function wpplus_templates_signon() {

            $custom = intval( get_query_var( 'signon' ) );
            if( $custom ) {

                include plugin_dir_path( __FILE__ ) . 'templates/signon.php';
                die;

            }

        }

    }

}
$sign = new Sign;