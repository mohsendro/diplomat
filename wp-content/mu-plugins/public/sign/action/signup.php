<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Signup' ) ) {

    class Signup {

        public $step_level = '';  
        public $user_login = '';  
        public $user_code  = '';    
        public $first_name = '';    
        public $last_name  = '';    
        public $password   = '';  

        public function __construct() {

            check_ajax_referer( 'signup_form_nonce', 'submitted_nonce' );  // This function will die if submitted_nonce is not correct.

            $this->step_level   = sanitize_text_field( $_POST['stepLevel'] );  
            $this->user_login   = sanitize_text_field( $_POST['userLogin'] );  
            $this->user_code    = sanitize_text_field( $_POST['userCode'] );    
            $this->first_name   = sanitize_text_field( $_POST['firstName'] );  
            $this->last_name    = sanitize_text_field( $_POST['lastName'] );  
            $this->password     = sanitize_text_field( $_POST['password'] );  

            $signup_list_errors = [
                'refresh'            => 'خطایی رخ داد است، لطفاً مجددا تلاش نمایید',
                'type_username'      => 'فرمت فیلد درست نمی باشد لطفاً شماره همراه یا نشانی ایمیل خود را بطور کامل وارد نمایید', // stepOne
                'empty_username'     => 'فیلد شماره همراه یا نشانی ایمیل الزامی است' ,
                'invalid_email'      => 'این نشانی ایمیل در سایت ثبت شده است، لطفاً از ایمیل دیگری استفاده نمایید',
                'invalid_numeric'    => 'این شماره همراه در سایت ثبت شده است، لطفاً از شماره دیگری استفاده نمایید',
                'unique_email'        => 'ایمیل شما یکتا می باشد، همچنین کد تایید برای شما ایمیل شد',
                'unique_numeric'      => 'شماره همراه شما یکتا می باشد، همچنین کد تایید برای شما پیامک شد',
                // 'success'            => 'اطلاعات درست می باشد. با موفقیت عضو شدید',
                'type_code'          => 'فیلد درست نمی باشد لطفاً فقط کاراکترهای عددی وارد نمایید', // steoTwo
                'empty_code'         => 'کد تایید الزامی است',
                'invalid_code'       => 'کد تایید نادرست می باشد',
                'unique_code'        => 'کد تایید درست می باشد، لطفاً اطلاعات کاربری خود را وارد نمایید',
                'empty_all'          => 'تمامی فیلدها الزامی است' , // stepThree
                'empty_first_name'   => 'فیلد نام الزامی است' ,
                'empty_last_name'    => 'فیلد نام خانوادگی الزامی است' ,
                'empty_password'     => 'فیلد رمز عبور الزامی است' ,
                'invalid_password'   => 'فیلد رمز عبور حداقل باید 6 کاراکتر باشد است' ,
                'success_insert'     => 'ثبت نام با موفقیت انجام شد، لطفاً وارد سایت شوید',
                'error_insert'       => 'مشکلی در ثبت نام وجود دارد لطفاً مجددا تلاش نمایید',
            ]; 

            // $this->is_validate_callback( $this->step_level, $this->user_login, $this->user_code, $this->user_code_status, $this->first_name, $this->last_name, $this->password , $signup_list_errors );
            $this->is_validate_callback2( $this->step_level, $this->user_login, $this->user_code, $this->user_code_status, $this->first_name, $this->last_name, $this->password , $signup_list_errors );

        }

        public function is_validate_callback2( $step_level, $user_login, $user_code, $first_name, $last_name, $password , $signup_list_errors ) {
            if( $step_level == 'stepOne' ) { 

                session_start();
                $_SESSION["chosen_date"] = true;

            } elseif ( $step_level == 'stepTwo' ) {

                if( $_SESSION["chosen_date"] == true ) {

                    $response = array(
                        'message'   => 'بله' . $_SESSION["chosen_date"],
                        'code'      => 'code' ,
                        'type'      => 'error' ,
                    );
                    wp_send_json_success( $response );

                } else {

                    $response = array(
                        'message'   => 'خیر' . $_SESSION["chosen_date"],
                        'code'      => 'code' ,
                        'type'      => 'error' ,
                    );
                    wp_send_json_success( $response );

                }

            } elseif( $step_level == 'stepThree' ) {



            } else {

                

            }
        }

        public function is_validate_callback( $step_level, $user_login, $user_code, $first_name, $last_name, $password , $signup_list_errors ) {

            if( $step_level == 'stepOne' ) {

                $this->signup_ajax_handle_step_one_callback( $user_login, $signup_list_errors );
        
            } elseif( $step_level == 'stepTwo' ) {
        
                if( empty( $user_login ) || $user_login == null || $user_login == " " ) {

                    $response = array(
                        'message'   => 'ابتدا فیلد شماره همراه یا نشانی ایمیل را وارد نمایید',
                        'code'      => 'code' ,
                        'type'      => 'error' ,
                    );
                    wp_send_json_success( $response );

                } else {
                                      
                    if( is_email( $user_login ) ) {
        
                        global $wpdb;
                        $db_users = $wpdb->prefix . "users";
                        $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_email` FROM $db_users WHERE `user_email` = %s", $user_login ) );
            
                        if( $return != NULL || ! empty( $return ) ) {
            
                            $response = array(
                                'message'   => 'آفرین ایمیل رو زدی',
                                'code'      => 'code' ,
                                'type'      => 'error' ,
                            );
                            wp_send_json_success( $response );
                            // $this->signup_ajax_handle_step_two_callback( $user_login, $user_code, $signup_list_errors );
                    
                        } else {

                            $response = array(
                                'message'   => 'اول ایمیل رو ثبت کن',
                                'code'      => 'code' ,
                                'type'      => 'error' ,
                            );
                            wp_send_json_success( $response );

                        }
            
                    }

                    if( is_numeric( $user_login ) ) {
                
                        global $wpdb;
                        $db_users = $wpdb->prefix . "usermeta";
                        $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_id` FROM $db_users WHERE `meta_value` = %s", $user_login ) );
            
                        if( $return != NULL || ! empty( $return ) ) {
            
                            $response = array(
                                'message'   => 'آفرین شماره همراه رو زدی',
                                'code'      => 'code' ,
                                'type'      => 'error' ,
                            );
                            wp_send_json_success( $response );
                            // $this->signup_ajax_handle_step_two_callback( $user_login, $user_code, $signup_list_errors );
                    
                        } else {

                            $response = array(
                                'message'   => 'اول شماره همراه رو ثبت کن',
                                'code'      => 'code' ,
                                'type'      => 'error' ,
                            );
                            wp_send_json_success( $response );

                        }
        
                    }

                }



            } elseif( $step_level == 'stepThree' ) {

                if( empty( $user_login ) ) {

                    $response = array(
                        'message'   => 'نخیر طبق مراحل نمی باشد',
                        'code'      => 'code' ,
                        'type'      => 'error' ,
                    );
                    wp_send_json_success( $response );

                } elseif( empty( $user_code ) ) {

                    $response = array(
                        'message'   => 'نخیر کد اعتبار باید وارد شود',
                        'code'      => 'code' ,
                        'type'      => 'error' ,
                    );
                    wp_send_json_success( $response );

                } else {

                    $this->signup_ajax_handle_step_three_callback( $user_login, $first_name, $last_name, $password, $signup_list_errors );

                }
        
            }

            wp_die();

        }

        public function signup_ajax_handle_step_one_callback( $user_login, $signup_list_errors ) {

            if( empty( $user_login ) || $user_login == null || $user_login == " " ) {
        
                $code = 'empty_username';
                $error = $signup_list_errors['empty_username'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } else {
        
                if( is_email( $user_login ) ) {
        
                    global $wpdb;
                    $db_users = $wpdb->prefix . "users";
                    $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_email` FROM $db_users WHERE `user_email` = %s", $user_login ) );
        
                    if( $return != NULL || ! empty( $return ) ) {
        
                        $code = 'invalid_email';
                        $error = $signup_list_errors['invalid_email'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
                
                    } else {
        
                        global $wpdb;
                        $db_users = $wpdb->prefix . "usermeta";
                        $user_login_code = wp_rand( 1000, 9999 );
                        $wpdb->insert( $db_users,
                                        array(
                                            'user_id'    => 0,
                                            'meta_key'   => 'user_code_' . $user_login,
                                            'meta_value' => $user_login_code,
                                        ),
                                        // array(
                                        //     'meta_key' => 'user_code_' . $user_login,
                                        // ),
                                        array(
                                            '%d', 
                                            '%s', 
                                            '%d', 
                                        ),
                                        // array(
                                        //     '%s',
                                        // )
                                    );
                        
                        // session_start();
                        // $_SESSION["chosen_date"] = true;

                        $this->signup_ajax_validate_email_callback( $user_login, $user_login_code );
        
                        $code = 'unique_email';
                        $error = $signup_list_errors['unique_email'];
                        $type = 'success';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_success( $response );
        
                    } 
        
                } elseif( is_numeric( $user_login ) ) {
                
                    global $wpdb;
                    $db_users = $wpdb->prefix . "usermeta";
                    $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_id` FROM $db_users WHERE `meta_value` = %s", $user_login ) );
        
                    if( $return != NULL || ! empty( $return ) ) {
        
                        $code = 'invalid_numeric';
                        $error = $signup_list_errors['invalid_numeric'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
                
                    } else {
        
                        global $wpdb;
                        $db_users = $wpdb->prefix . "usermeta";
                        $user_login_code = wp_rand( 1000, 9999 );
                        $wpdb->insert( $db_users,
                                        array(
                                            'user_id'    => 0,
                                            'meta_key'   => 'user_code_' . $user_login,
                                            'meta_value' => $user_login_code,
                                        ),
                                        // array(
                                        //     'meta_key' => 'user_code_' . $user_login,
                                        // ),
                                        array(
                                            '%d', 
                                            '%s', 
                                            '%d', 
                                        ),
                                        // array(
                                        //     '%s',
                                        // )
                                    );
        
                        $this->signup_ajax_validate_numeric_callback( $user_login, $user_login_code );
        
                        $code = 'unique_numeric';
                        $error = $signup_list_errors['unique_numeric'];
                        $type = 'success';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_success( $response );
                    }
        
                } else {
        
                    $code = 'type_username';
                    $error = $signup_list_errors['type_username'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );
                
                }
        
                $code = 'refresh';
                $error = $signup_list_errors['refresh'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
                    
            }  
        
        }
        
        public function signup_ajax_handle_step_two_callback( $user_login, $user_code, $signup_list_errors ) {

            if( empty( $user_code ) || $user_code == null || $user_code == " " ) {
        
                $code = 'empty_code';
                $error = $signup_list_errors['empty_code'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } else {
        
                if( is_numeric( $user_code ) ) {
                
                    global $wpdb;
                    $db_users = $wpdb->prefix . "usermeta";
                    $user_login_code = 'user_code_' . $user_login;
                    $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `meta_value` FROM $db_users WHERE `meta_key` = %s ORDER BY `umeta_id` DESC LIMIT 1", $user_login_code ) );
        
                    if( $return == NULL || empty( $return ) ) {
        
                        $code = 'invalid_code';
                        $error = $signup_list_errors['invalid_code'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
                
                    } else {
        
                        if( $return == $user_code ) {
        
                            $code = 'unique_code';
                            $error = $signup_list_errors['unique_code'];
                            $type = 'success';
                            $response = array(
                                'message'   => $error ,
                                'code'      => $code ,
                                'type'      => $type ,
                            );
                            wp_send_json_success( $response );
        
                        } else {
        
                            $code = 'invalid_code';
                            $error = $signup_list_errors['invalid_code'];
                            $type = 'error';
                            $response = array(
                                'message'   => $error ,
                                'code'      => $code ,
                                'type'      => $type ,
                            );
                            wp_send_json_error( $response );
        
                        }
                        
                    }
        
                } else {
        
                    $code = 'type_code';
                    $error = $signup_list_errors['type_code'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );
                
                }
        
                $code = 'refresh';
                $error = $signup_list_errors['refresh'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
                    
            } 
        
        }
        
        public function signup_ajax_handle_step_three_callback( $user_login, $first_name, $last_name, $password, $signup_list_errors ) {
        
            if( ((empty( $first_name ) || $first_name == null || $first_name == " ") &&
                (empty( $last_name )   || $last_name == null  || $last_name == " ") &&
                (empty( $password )    || $password == null   || $password == " ")) ||
                ((empty( $first_name ) || $first_name == null || $first_name == " ") &&
                (empty( $last_name )   || $last_name == null  || $last_name == " ")) ||
                ((empty( $first_name ) || $first_name == null || $first_name == " ") &&
                (empty( $password )    || $password == null   || $password == " ")) ||
                ((empty( $last_name )  || $last_name == null  || $last_name == " ") &&
                (empty( $password )    || $password == null   || $password == " ")) ) {
        
                    $code = 'empty_all';
                    $error = $signup_list_errors['empty_all'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );
        
            } elseif( empty( $first_name ) || $first_name == null || $first_name == " " ) {
        
                $code = 'empty_first_name';
                $error = $signup_list_errors['empty_first_name'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
        
            } elseif( empty( $last_name ) || $last_name == null || $last_name == " " ) {
        
                $code = 'empty_last_name';
                $error = $signup_list_errors['empty_last_name'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
        
            } elseif( empty( $password ) || $password == null || $password == " " ) {
        
                $code = 'empty_password';
                $error = $signup_list_errors['empty_password'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } elseif( strlen( $password ) < 6 ) {
        
                $code = 'invalid_password';
                $error = $signup_list_errors['invalid_password'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } else {
        
                global $wpdb;
                $db_users = $wpdb->prefix . "users";
                $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `ID` FROM $db_users ORDER BY `ID` DESC LIMIT 1" ) );
                $return = $return + 1;
                // $return = $wpdb->get_var( $wpdb->prepare( "SELECT auto_increment + 1 FROM $db_users ORDER BY `ID` DESC LIMIT 1" ) );
                $user_id = 'user_' . $return; 
        
                if( is_email( $user_login ) ) {
        
                    $userdata = [
                        'user_login'  => $user_id,
                        'user_pass'   => $password,
                        'first_name'  => $first_name,
                        'last_name'   => $last_name,
                        'user_email'  => $user_login,
                    ];
                    $new_user = wp_insert_user( $userdata );
            
                    if( ! is_wp_error( $new_user )   ) {
            
                        wp_signon([
                            'user_login'    => $user_id,
                            'user_password' => $password,
                            'remember'      => true
                        ]);
        
                        $code = 'success_insert';
                        $error = $signup_list_errors['success_insert'];
                        $type = 'success';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_success( $response );
            
                    } else {
            
                        $code = 'error_insert';
                        $error = $signup_list_errors['error_insert'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
            
                    }
        
                } elseif( is_numeric( $user_login ) ) {
        
                    $userdata = [
                        'user_login'  => $user_id,
                        'user_pass'   => $password,
                        'first_name'  => $first_name,
                        'last_name'   => $last_name,
                    ];
                    $new_user = wp_insert_user( $userdata );
        
                    update_user_meta( $return, 'user_phone', $user_login );
           
                    if( ! is_wp_error( $new_user ) ) {
        
                        wp_signon([
                            'user_login'    => $user_id,
                            'user_password' => $password,
                            'remember'      => true
                        ]);
        
                        $code = 'success_insert';
                        $error = $signup_list_errors['success_insert'];
                        $type = 'success';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_success( $response );
            
                    } else {
            
                        $code = 'error_insert';
                        $error = $signup_list_errors['error_insert'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
            
                    }
        
                } else {
        
                    $code = 'type_username';
                    $error = $signup_list_errors['type_username'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );
        
                }
        
                $code = 'refresh';
                $error = $signup_list_errors['refresh'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            }
        
        }
        
        public function signup_ajax_validate_email_callback( $user_login, $user_login_code ) {
        
            $to = array($user_login);
            $subject = 'کد تأیید ثبت نام در سایت';
            $headers[] = 'از طرف: هسته پلاس';
            $message = 'کد تأیید یا (OTP) مورد نظر را جهت ثبت نام وارد نمایید:' . "<br>" . $user_login_code ;
        
            $mailResult = false;
            $mailResult = wp_mail( $to, $subject, $message, $headers );
            return $mailResult;
        
        }
        
        public function signup_ajax_validate_numeric_callback( $user_login, $user_login_code ) {
        
            return false;

        }

    }

}




// Signup Ajax
// function signup_ajax_handle_function() {

//     check_ajax_referer( 'signup_form_nonce', 'submitted_nonce' );  // This function will die if submitted_nonce is not correct.

// 	$step_level   = sanitize_text_field($_POST['stepLevel']);  
// 	$user_login   = sanitize_text_field($_POST['userLogin']);  
// 	$user_code    = sanitize_text_field($_POST['userCode']);    
// 	$first_name   = sanitize_text_field($_POST['firstName']);  
//     $last_name    = sanitize_text_field($_POST['lastName']);  
//     $password     = sanitize_text_field($_POST['password']);   

//     $signup_list_errors = [
//         'refresh'            => 'خطایی رخ داد است، لطفاً مجددا تلاش نمایید',
//         'type_username'      => 'فرمت فیلد درست نمی باشد لطفاً شماره همراه یا نشانی ایمیل خود را بطور کامل وارد نمایید', // stepOne
//         'empty_username'     => 'فیلد شماره همراه یا نشانی ایمیل الزامی است' ,
//         'invalid_email'      => 'این نشانی ایمیل در سایت ثبت شده است، لطفاً از ایمیل دیگری استفاده نمایید',
//         'invalid_numeric'    => 'این شماره همراه در سایت ثبت شده است، لطفاً از شماره دیگری استفاده نمایید',
//         'unique_email'        => 'ایمیل شما یکتا می باشد، همچنین کد تایید برای شما ایمیل شد',
//         'unique_numeric'      => 'شماره همراه شما یکتا می باشد، همچنین کد تایید برای شما پیامک شد',
//         // 'success'            => 'اطلاعات درست می باشد. با موفقیت عضو شدید',
//         'type_code'          => 'فیلد درست نمی باشد لطفاً فقط کاراکترهای عددی وارد نمایید', // steoTwo
//         'empty_code'         => 'کد تایید الزامی است',
//         'invalid_code'       => 'کد تایید نادرست می باشد',
//         'unique_code'        => 'کد تایید درست می باشد، لطفاً اطلاعات کاربری خود را وارد نمایید',
//         'empty_all'          => 'تمامی فیلدها الزامی است' , // stepThree
//         'empty_first_name'   => 'فیلد نام الزامی است' ,
//         'empty_last_name'    => 'فیلد نام خانوادگی الزامی است' ,
//         'empty_password'     => 'فیلد رمز عبور الزامی است' ,
//         'invalid_password'   => 'فیلد رمز عبور حداقل باید 6 کاراکتر باشد است' ,
//         'success_insert'     => 'ثبت نام با موفقیت انجام شد، لطفاً وارد سایت شوید',
//         'error_insert'       => 'مشکلی در ثبت نام وجود دارد لطفاً مجددا تلاش نمایید',
//     ];   

//     if( $step_level == 'stepOne' ) {

//         signup_ajax_handle_step_one_callback( $user_login, $signup_list_errors );

//     } elseif( $step_level == 'stepTwo' ) {

//         signup_ajax_handle_step_two_callback( $user_login, $user_code, $signup_list_errors );

//     } elseif( $step_level == 'stepThree' ) {

//         signup_ajax_handle_step_three_callback( $user_login, $first_name, $last_name, $password, $signup_list_errors );

//     }

//     wp_die();

// }
// add_action( 'wp_ajax_signup_ajax_handle', 'signup_ajax_handle_function' );  // For logged in users. -->
// add_action( 'wp_ajax_nopriv_signup_ajax_handle', 'signup_ajax_handle_function' );


// function signup_ajax_handle_step_one_callback( $user_login, $signup_list_errors ) {

//     if( empty( $user_login ) || $user_login == null || $user_login == " " ) {

//         $code = 'empty_username';
//         $error = $signup_list_errors['empty_username'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
// 		wp_send_json_error( $response );

//     } else {

//         if( is_email( $user_login ) ) {

//             global $wpdb;
//             $db_users = $wpdb->prefix . "users";
//             $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_email` FROM $db_users WHERE `user_email` = %s", $user_login ) );

//             if( $return != NULL || ! empty( $return ) ) {

//                 $code = 'invalid_email';
//                 $error = $signup_list_errors['invalid_email'];
//                 $type = 'error';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_error( $response );
        
//             } else {

//                 global $wpdb;
//                 $db_users = $wpdb->prefix . "usermeta";
//                 $user_login_code = wp_rand( 1000, 9999 );
//                 $wpdb->insert( $db_users,
//                                 array(
//                                     'user_id'    => 0,
//                                     'meta_key'   => 'user_code_' . $user_login,
//                                     'meta_value' => $user_login_code,
//                                 ),
//                                 // array(
//                                 //     'meta_key' => 'user_code_' . $user_login,
//                                 // ),
//                                 array(
//                                     '%d', 
//                                     '%s', 
//                                     '%d', 
//                                 ),
//                                 // array(
//                                 //     '%s',
//                                 // )
//                             );
                
//                 signup_ajax_validate_email_callback( $user_login, $user_login_code );

//                 $code = 'unique_email';
//                 $error = $signup_list_errors['unique_email'];
//                 $type = 'success';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_success( $response );

//             } 

//         } elseif( is_numeric( $user_login ) ) {
        
//             global $wpdb;
//             $db_users = $wpdb->prefix . "usermeta";
//             $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_id` FROM $db_users WHERE `meta_value` = %s", $user_login ) );

//             if( $return != NULL || ! empty( $return ) ) {

//                 $code = 'invalid_numeric';
//                 $error = $signup_list_errors['invalid_numeric'];
//                 $type = 'error';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_error( $response );
        
//             } else {

//                 global $wpdb;
//                 $db_users = $wpdb->prefix . "usermeta";
//                 $user_login_code = wp_rand( 1000, 9999 );
//                 $wpdb->insert( $db_users,
//                                 array(
//                                     'user_id'    => 0,
//                                     'meta_key'   => 'user_code_' . $user_login,
//                                     'meta_value' => $user_login_code,
//                                 ),
//                                 // array(
//                                 //     'meta_key' => 'user_code_' . $user_login,
//                                 // ),
//                                 array(
//                                     '%d', 
//                                     '%s', 
//                                     '%d', 
//                                 ),
//                                 // array(
//                                 //     '%s',
//                                 // )
//                             );

//                 signup_ajax_validate_numeric_callback( $user_login, $user_login_code );

//                 $code = 'unique_numeric';
//                 $error = $signup_list_errors['unique_numeric'];
//                 $type = 'success';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_success( $response );
//             }

//         } else {

//             $code = 'type_username';
//             $error = $signup_list_errors['type_username'];
//             $type = 'error';
//             $response = array(
//                 'message'   => $error ,
//                 'code'      => $code ,
//                 'type'      => $type ,
//             );
//             wp_send_json_error( $response );
        
//         }

//         $code = 'refresh';
//         $error = $signup_list_errors['refresh'];
//         $type = 'error';
//         $response = array(
// 			'message'   => $error ,
// 			'code'      => $code ,
// 			'type'      => $type ,
//         );
//         wp_send_json_error( $response );
            
//     }  

// }

// function signup_ajax_handle_step_two_callback( $user_login, $user_code, $signup_list_errors ) {

//     if( empty( $user_code ) || $user_code == null || $user_code == " " ) {

//         $code = 'empty_code';
//         $error = $signup_list_errors['empty_code'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
// 		wp_send_json_error( $response );

//     } else {

//         if( is_numeric( $user_code ) ) {
        
//             global $wpdb;
//             $db_users = $wpdb->prefix . "usermeta";
//             $user_login_code = 'user_code_' . $user_login;
//             $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `meta_value` FROM $db_users WHERE `meta_key` = %s ORDER BY `umeta_id` DESC LIMIT 1", $user_login_code ) );

//             if( $return == NULL || empty( $return ) ) {

//                 $code = 'invalid_code';
//                 $error = $signup_list_errors['invalid_code'];
//                 $type = 'error';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_error( $response );
        
//             } else {

//                 if( $return == $user_code ) {

//                     $code = 'unique_code';
//                     $error = $signup_list_errors['unique_code'];
//                     $type = 'success';
//                     $response = array(
//                         'message'   => $error ,
//                         'code'      => $code ,
//                         'type'      => $type ,
//                     );
//                     wp_send_json_success( $response );

//                 } else {

//                     $code = 'invalid_code';
//                     $error = $signup_list_errors['invalid_code'];
//                     $type = 'error';
//                     $response = array(
//                         'message'   => $error ,
//                         'code'      => $code ,
//                         'type'      => $type ,
//                     );
//                     wp_send_json_error( $response );

//                 }
                
//             }

//         } else {

//             $code = 'type_code';
//             $error = $signup_list_errors['type_code'];
//             $type = 'error';
//             $response = array(
//                 'message'   => $error ,
//                 'code'      => $code ,
//                 'type'      => $type ,
//             );
//             wp_send_json_error( $response );
        
//         }

//         $code = 'refresh';
//         $error = $signup_list_errors['refresh'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );
            
//     } 

// }

// function signup_ajax_handle_step_three_callback( $user_login, $first_name, $last_name, $password, $signup_list_errors ) {

//     if( ((empty( $first_name ) || $first_name == null || $first_name == " ") &&
//         (empty( $last_name )   || $last_name == null  || $last_name == " ") &&
//         (empty( $password )    || $password == null   || $password == " ")) ||
//         ((empty( $first_name ) || $first_name == null || $first_name == " ") &&
//         (empty( $last_name )   || $last_name == null  || $last_name == " ")) ||
//         ((empty( $first_name ) || $first_name == null || $first_name == " ") &&
//         (empty( $password )    || $password == null   || $password == " ")) ||
//         ((empty( $last_name )  || $last_name == null  || $last_name == " ") &&
//         (empty( $password )    || $password == null   || $password == " ")) ) {

//             $code = 'empty_all';
//             $error = $signup_list_errors['empty_all'];
//             $type = 'error';
//             $response = array(
//                 'message'   => $error ,
//                 'code'      => $code ,
//                 'type'      => $type ,
//             );
//             wp_send_json_error( $response );

//     } elseif( empty( $first_name ) || $first_name == null || $first_name == " " ) {

//         $code = 'empty_first_name';
//         $error = $signup_list_errors['empty_first_name'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );


//     } elseif( empty( $last_name ) || $last_name == null || $last_name == " " ) {

//         $code = 'empty_last_name';
//         $error = $signup_list_errors['empty_last_name'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );


//     } elseif( empty( $password ) || $password == null || $password == " " ) {

//         $code = 'empty_password';
//         $error = $signup_list_errors['empty_password'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );

//     } elseif( strlen( $password ) < 6 ) {

//         $code = 'invalid_password';
//         $error = $signup_list_errors['invalid_password'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );

//     } else {

//         global $wpdb;
//         $db_users = $wpdb->prefix . "users";
//         $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `ID` FROM $db_users ORDER BY `ID` DESC LIMIT 1" ) );
//         $return = $return + 1;
//         // $return = $wpdb->get_var( $wpdb->prepare( "SELECT auto_increment + 1 FROM $db_users ORDER BY `ID` DESC LIMIT 1" ) );
//         $user_id = 'user_' . $return; 

//         if( is_email( $user_login ) ) {

//             $userdata = [
//                 'user_login'  => $user_id,
//                 'user_pass'   => $password,
//                 'first_name'  => $first_name,
//                 'last_name'   => $last_name,
//                 'user_email'  => $user_login,
//             ];
//             $new_user = wp_insert_user( $userdata );
    
//             if( ! is_wp_error( $new_user )   ) {
    
//                 wp_signon([
//                     'user_login'    => $user_id,
//                     'user_password' => $password,
//                     'remember'      => true
//                 ]);

//                 $code = 'success_insert';
//                 $error = $signup_list_errors['success_insert'];
//                 $type = 'success';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_success( $response );
    
//             } else {
    
//                 $code = 'error_insert';
//                 $error = $signup_list_errors['error_insert'];
//                 $type = 'error';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_error( $response );
    
//             }

//         } elseif( is_numeric( $user_login ) ) {

//             $userdata = [
//                 'user_login'  => $user_id,
//                 'user_pass'   => $password,
//                 'first_name'  => $first_name,
//                 'last_name'   => $last_name,
//             ];
//             $new_user = wp_insert_user( $userdata );

//             update_user_meta( $return, 'user_phone', $user_login );
   
//             if( ! is_wp_error( $new_user ) ) {

//                 wp_signon([
//                     'user_login'    => $user_id,
//                     'user_password' => $password,
//                     'remember'      => true
//                 ]);

//                 $code = 'success_insert';
//                 $error = $signup_list_errors['success_insert'];
//                 $type = 'success';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_success( $response );
    
//             } else {
    
//                 $code = 'error_insert';
//                 $error = $signup_list_errors['error_insert'];
//                 $type = 'error';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_error( $response );
    
//             }

//         } else {

//             $code = 'type_username';
//             $error = $signup_list_errors['type_username'];
//             $type = 'error';
//             $response = array(
//                 'message'   => $error ,
//                 'code'      => $code ,
//                 'type'      => $type ,
//             );
//             wp_send_json_error( $response );

//         }

//         $code = 'refresh';
//         $error = $signup_list_errors['refresh'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );

//     }

// }

// function signup_ajax_validate_email_callback( $user_login, $user_login_code ) {

//     $to = array($user_login);
// 	$subject = 'کد تأیید ثبت نام در سایت';
// 	$headers[] = 'از طرف: هسته پلاس';
// 	$message = 'کد تأیید یا (OTP) مورد نظر را جهت ثبت نام وارد نمایید:' . "<br>" . $user_login_code ;

//   	$mailResult = false;
// 	$mailResult = wp_mail( $to, $subject, $message, $headers );
// 	return $mailResult;

// }

// function signup_ajax_validate_numeric_callback( $user_login, $user_login_code ) {

// }