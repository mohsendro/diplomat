<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Signin' ) ) {

    class Signin {

        public $user_login    = '';  
        public $user_pass     = '';  
        public $user_remember = '';    

        public function __construct() {

            check_ajax_referer( 'signin_form_nonce', 'submitted_nonce' );  // This function will die if submitted_nonce is not correct.
            
            $this->user_login    = sanitize_text_field( $_POST['userLogin'] ); 
            $this->user_pass     = sanitize_text_field( $_POST['userPass'] );  
            $this->user_remember = sanitize_text_field( $_POST['userRememberme'] );    

            $signin_list_errors = [
                'refresh'            => 'خطایی رخ داد است، لطفاً مجددا تلاش نمایید',
                'type_username'      => 'فرمت فیلد درست نمی باشد لطفاً شماره همراه یا نشانی ایمیل خود را بطور کامل وارد نمایید',
                'empty_all'          => 'تمامی فیلدها الزامی است' ,
                'empty_username'     => 'فیلد شماره همراه یا نشانی ایمیل الزامی است' ,
                'empty_password'     => 'فیلد رمز عبور الزامی است' ,
                'invalid_email'      => 'نشانی ایمیل در سایت ثبت نشده است',
                'invalid_numeric'    => 'شماره همراه در سایت ثبت نشده است',
                'incorrect_password' => 'رمز عبور وارد شده درست نیست',
                'success'            => 'اطلاعات درست می باشد. با موفقیت وارد شدید',
            ];  

            $this->is_validate_callback( $this->user_login, $this->user_pass, $this->user_remember, $signin_list_errors );

        }

        public function is_validate_callback( $user_login, $user_pass, $user_remember, $signin_list_errors ) {
                    
            if( empty( $user_login ) && empty( $user_pass ) ) {

                $code = 'empty_all';
                $error = $signin_list_errors['empty_all'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
                
            } elseif( empty( $user_login ) || $user_login == null || $user_login == " " ) {
        
                $code = 'empty_username';
                $error = $signin_list_errors['empty_username'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } elseif( empty( $user_pass ) || $user_pass == null || $user_pass == " " ) {
                
                $code = 'empty_password';
                $error = $signin_list_errors['empty_password'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } else {
        
                if( is_email( $user_login ) ) {
        
                    $this->is_email_callback( $this->user_login, $this->user_pass, $this->user_remember, $signin_list_errors );
        
                } elseif ( is_numeric( $user_login ) ) {
            
                    $this->is_numeric_callback( $this->user_login, $this->user_pass, $this->user_remember, $signin_list_errors );
            
                } else {
            
                    $code = 'type_username';
                    $error = $signin_list_errors['type_username'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );
            
                }
        
                $code = 'refresh';
                $error = $signin_list_errors['refresh'];
                $$type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            }

            wp_die();

        }

        public function is_email_callback( $user_login, $user_pass, $user_remember, $signin_list_errors ) {

            $return = wp_authenticate_email_password( null, $user_login, $user_pass );
            
            if( is_wp_error( $return ) ) {
        
                $code  = $return->get_error_code();

                if( $code == 'invalid_email' ) {

                    $code = 'invalid_email';
                    $error = $signin_list_errors['invalid_email'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );

                } elseif( $code == 'incorrect_password' ) {

                    $code = 'incorrect_password';
                    $error = $signin_list_errors['incorrect_password'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );

                } else {
                
                    $code = 'refresh';
                    $error = $signin_list_errors['refresh'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );

                }
        
            } else {
        
                wp_signon([
                    'user_login'    => $user_login,
                    'user_password' => $user_pass,
                    'remember'      => $user_remember
                ]);

                $code = 'success';
                $error = $signin_list_errors['success'];
                $$type = 'success';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_success( $response );
        
            }

        }

        public function is_numeric_callback( $user_login, $user_pass, $user_remember, $signin_list_errors ) {

            global $wpdb;
            $db_user = $wpdb->prefix . 'users';
            $db_user_meta = $wpdb->prefix . 'usermeta';
            $user_phone = $user_login;
            $return = $wpdb->get_var( $wpdb->prepare( "SELECT `user_id` FROM $db_user_meta WHERE meta_value = %s", $user_phone ) );   
     
            if( $return == NULL || empty( $return ) ) {

                $code = 'invalid_numeric';
                $error = $signin_list_errors['invalid_numeric'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } else {
        
                $return_numeric = $wpdb->get_var( $wpdb->prepare( "SELECT `user_login`, `user_pass` FROM $db_user WHERE ID = $return" ) ); 
                $return_login = wp_authenticate_username_password( null, $return_numeric, $this->user_pass );
                
                if( is_wp_error( $return_login ) ) {
        
                    $code  = $return_login->get_error_code();

                    if( $code == 'incorrect_password' ) {
    
                        $code = 'incorrect_password';
                        $error = $signin_list_errors['incorrect_password'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
    
                    } else {
                    
                        $code = 'refresh';
                        $error = $signin_list_errors['refresh'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
    
                    }
            
                } else {
            
                    wp_signon([
                        'user_login'    => $return_numeric,
                        'user_password' => $user_pass,
                        'remember'      => $user_remember
                    ]);

                    $code = 'success';
                    $error = $signin_list_errors['success'];
                    $type = 'success';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_success( $response );
            
                }
        
            }
            
        }

    }

}