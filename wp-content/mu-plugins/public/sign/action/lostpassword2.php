<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Lostpassword' ) ) {

    class Lostpassword {

        public $step_level   = '';  
        public $user_login   = '';  
        public $user_code    = '';    
        public $password     = '';
        public $lostpassword_list_errors = array();
        public $user_code_status = false;

        public function __construct() {

            check_ajax_referer( 'lostpassword_form_nonce', 'submitted_nonce' );  // This function will die if submitted_nonce is not correct.
            
            $this->step_level   = sanitize_text_field($_POST['stepLevel']);  
            $this->user_login   = sanitize_text_field($_POST['userLogin']);  
            $this->user_code    = sanitize_text_field($_POST['userCode']);    
            $this->password     = sanitize_text_field($_POST['password']);

            $this->lostpassword_list_errors = [
                'refresh'            => 'خطایی رخ داد است، لطفاً مجددا تلاش نمایید',
                'type_username'      => 'فرمت فیلد درست نمی باشد لطفاً شماره همراه یا نشانی ایمیل خود را بطور کامل وارد نمایید', // stepOne
                'empty_username'     => 'فیلد شماره همراه یا نشانی ایمیل الزامی است' ,
                'invalid_email'      => 'این نشانی ایمیل در سایت ثبت نشده است، لطفاً از ایمیل دیگری استفاده نمایید',
                'invalid_numeric'    => 'این شماره همراه در سایت ثبت نشده است، لطفاً از شماره دیگری استفاده نمایید',
                'unique_email'       => 'ایمیل شما شناسایی شد، همچنین کد تایید برای شما ایمیل شد',
                'unique_numeric'     => 'شماره همراه شما شناسایی شد، همچنین کد تایید برای شما پیامک شد',
                'type_code'          => 'فیلد درست نمی باشد لطفاً فقط کاراکترهای عددی وارد نمایید', // steoTwo
                'empty_code'         => 'کد تایید الزامی است',
                'invalid_code'       => 'کد تایید نادرست می باشد',
                'unique_code'        => 'کد تایید درست می باشد، لطفاً رمز عبور جدید خود را وارد نمایید',
                'empty_password'     => 'فیلد رمز عبور الزامی است' , // stepThree
                'invalid_password'   => 'فیلد رمز عبور حداقل باید 6 کاراکتر باشد است' ,
                'success_change'     => 'تغییر رمز عبور با موفقیت انجام شد، لطفاً وارد سایت شوید',
                'error_change'       => 'مشکلی در تغییر رمز عبور وجود دارد لطفاً مجددا تلاش نمایید',
            ];   
        
            if( $this->step_level == 'stepOne' ) {
        
                $this->lostpassword_ajax_handle_step_one_callback( $this->user_login, $this->lostpassword_list_errors );
        
            } elseif( $this->step_level == 'stepTwo' ) {
        
                $this->lostpassword_ajax_handle_step_two_callback( $this->user_login, $this->user_code, $this->lostpassword_list_errors );
        
            } elseif( $this->step_level == 'stepThree' ) {
        
                $this->lostpassword_ajax_handle_step_three_callback( $this->user_login, $this->password, $this->lostpassword_list_errors );
        
            }

            // wp_die();

        }

        public function lostpassword_ajax_handle_step_one_callback( $user_login, $lostpassword_list_errors ) {

            if( empty( $user_login ) || $user_login == null || $user_login == " " ) {
        
                $code = 'empty_username';
                $error = $lostpassword_list_errors['empty_username'];
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
        
                        global $wpdb;
                        $db_users = $wpdb->prefix . "usermeta";
                        $user_login_code = wp_rand( 1000, 9999 );
                        $wpdb->insert( $db_users,
                                        array(
                                            'user_id'    => 0,
                                            'meta_key'   => 'user_reset_' . $this->user_login,
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
                        
                        $this->lostpassword_ajax_validate_email_callback( $user_login, $user_login_code );
                        
                        $code = 'unique_email';
                        $error = $lostpassword_list_errors['unique_email'];
                        $type = 'success';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_success( $response );
                
                    } else {
        
                        $code = 'invalid_email';
                        $error = $lostpassword_list_errors['invalid_email'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
        
                    } 
        
                } elseif( is_numeric( $user_login ) ) {
                
                    global $wpdb;
                    $db_users = $wpdb->prefix . "usermeta";
                    $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_id` FROM $db_users WHERE `meta_value` = %s", $user_login ) );
        
                    if( $return != NULL || ! empty( $return ) ) {
        
                        global $wpdb;
                        $db_users = $wpdb->prefix . "usermeta";
                        $user_login_code = wp_rand( 1000, 9999 );
                        $wpdb->insert( $db_users,
                                        array(
                                            'user_id'    => 0,
                                            'meta_key'   => 'user_reset_' . $user_login,
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
        
                        lostpassword_ajax_validate_numeric_callback( $user_login, $user_login_code );
        
                        $code = 'unique_numeric';
                        $error = $lostpassword_list_errors['unique_numeric'];
                        $type = 'success';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_success( $response );
                
                    } else {
        
                        $code = 'invalid_numeric';
                        $error = $lostpassword_list_errors['invalid_numeric'];
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
                    $error = $lostpassword_list_errors['type_username'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );
                
                }
        
                $code = 'refresh';
                $error = $lostpassword_list_errors['refresh'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
                    
            }  
        
        }
        
        public function lostpassword_ajax_handle_step_two_callback( $user_login, $user_code, $lostpassword_list_errors ) {
        
            if( empty( $user_code ) || $user_code == null || $user_code == " " ) {
        
                $code = 'empty_code';
                $error = $lostpassword_list_errors['empty_code'];
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
                    $user_login_code = 'user_reset_' . $user_login;
                    $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `meta_value` FROM $db_users WHERE `meta_key` = %s ORDER BY `umeta_id` DESC LIMIT 1", $user_login_code ) );
        
                    if( $return == NULL || empty( $return ) ) {
        
                        $code = 'invalid_code';
                        $error = $lostpassword_list_errors['invalid_code'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
                
                    } else {
        
                        if( $return == $user_code ) {
                            
                            $this->user_code_status = true;
                            $code = 'unique_code';
                            $error = $lostpassword_list_errors['unique_code'];
                            $type = 'success';
                            $response = array(
                                'message'   => $error ,
                                'code'      => $code ,
                                'type'      => $type ,
                            );
                            wp_send_json_success( $response );
        
                        } else {
        
                            $code = 'invalid_code';
                            $error = $lostpassword_list_errors['invalid_code'];
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
                    $error = $lostpassword_list_errors['type_code'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );
                
                }
        
                $code = 'refresh';
                $error = $lostpassword_list_errors['refresh'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
                    
            } 
        
        }
        
        public function lostpassword_ajax_handle_step_three_callback( $user_login, $password, $lostpassword_list_errors ) {
        
            if( empty( $password ) || $password == null || $password == " " ) {
        
                $code = 'empty_password';
                $error = $lostpassword_list_errors['empty_password'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } elseif( strlen( $password ) < 6 ) {
        
                $code = 'invalid_password';
                $error = $lostpassword_list_errors['invalid_password'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            } else {
                
                if( is_email( $user_login ) && ( $this->user_code_status === true ) ) {
                    
                    global $wpdb;
                    $db_users = $wpdb->prefix . "users";
                    $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `ID` FROM $db_users WHERE `user_email` = %s", $user_login ) );
                    $new_password = wp_set_password( $password, $return );
        
                    if( ! is_wp_error( $new_password ) ) {
        
                        $code = 'success_change';
                        $error = $lostpassword_list_errors['success_change'];
                        $type = 'success';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_success( $response );
            
                    } else {
            
                        $code = 'error_change';
                        $error = $lostpassword_list_errors['error_change'];
                        $type = 'error';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_error( $response );
            
                    }
        
                } elseif( is_numeric( $user_login ) ) {
                    
                    global $wpdb;
                    $db_users = $wpdb->prefix . "usermeta";
                    $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_id` FROM $db_users WHERE `meta_value` = %s", $user_login ) );
                    $new_password = wp_set_password( $password, $return );
        
                    if( ! is_wp_error( $new_password ) ) {
        
                        $code = 'success_change';
                        $error = $lostpassword_list_errors['success_change'];
                        $type = 'success';
                        $response = array(
                            'message'   => $error ,
                            'code'      => $code ,
                            'type'      => $type ,
                        );
                        wp_send_json_success( $response );
            
                    } else {
            
                        $code = 'error_change';
                        $error = $lostpassword_list_errors['error_change'];
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
                    $error = $lostpassword_list_errors['type_username'];
                    $type = 'error';
                    $response = array(
                        'message'   => $error ,
                        'code'      => $code ,
                        'type'      => $type ,
                    );
                    wp_send_json_error( $response );
        
                }
        
                $code = 'refresh';
                $error = $lostpassword_list_errors['refresh'];
                $type = 'error';
                $response = array(
                    'message'   => $error ,
                    'code'      => $code ,
                    'type'      => $type ,
                );
                wp_send_json_error( $response );
        
            }
        
        }
        
        public function lostpassword_ajax_validate_email_callback( $user_login, $user_login_code ) {
        
            $to = array($user_login);
            $subject = 'کد تأیید تغییر رمز عبور در سایت';
            $headers[] = 'از طرف: هسته پلاس';
            $message = 'کد تأیید یا (OTP) مورد نظر را جهت تغییر رمز عبور در سایت را وارد نمایید:' . "<br>" . $user_login_code ;
        
              $mailResult = false;
            $mailResult = wp_mail( $to, $subject, $message, $headers );
            return $mailResult;
        
        }
        
        public function lostpassword_ajax_validate_numeric_callback( $user_login, $user_login_code ) {
            
            // return true;

        }

    }

}

// $lostpassword = new Lostpassword;
// function test() {
//     $lostpassword = new Lostpassword;
// }
// add_action( 'wp_ajax_nopriv_lostpassword_ajax_handle', 'test' );



// // Lostpassword Ajax
// function lostpassword_ajax_handle_function() {

//     check_ajax_referer( 'lostpassword_form_nonce', 'submitted_nonce' );  // This function will die if submitted_nonce is not correct.

// 	$step_level   = sanitize_text_field($_POST['stepLevel']);  
// 	$user_login   = sanitize_text_field($_POST['userLogin']);  
// 	$user_code    = sanitize_text_field($_POST['userCode']);    
//     $password     = sanitize_text_field($_POST['password']);  

//     $lostpassword_list_errors = [
//         'refresh'            => 'خطایی رخ داد است، لطفاً مجددا تلاش نمایید',
//         'type_username'      => 'فرمت فیلد درست نمی باشد لطفاً شماره همراه یا نشانی ایمیل خود را بطور کامل وارد نمایید', // stepOne
//         'empty_username'     => 'فیلد شماره همراه یا نشانی ایمیل الزامی است' ,
//         'invalid_email'      => 'این نشانی ایمیل در سایت ثبت نشده است، لطفاً از ایمیل دیگری استفاده نمایید',
//         'invalid_numeric'    => 'این شماره همراه در سایت ثبت نشده است، لطفاً از شماره دیگری استفاده نمایید',
//         'unique_email'       => 'ایمیل شما شناسایی شد، همچنین کد تایید برای شما ایمیل شد',
//         'unique_numeric'     => 'شماره همراه شما شناسایی شد، همچنین کد تایید برای شما پیامک شد',
//         'type_code'          => 'فیلد درست نمی باشد لطفاً فقط کاراکترهای عددی وارد نمایید', // steoTwo
//         'empty_code'         => 'کد تایید الزامی است',
//         'invalid_code'       => 'کد تایید نادرست می باشد',
//         'unique_code'        => 'کد تایید درست می باشد، لطفاً رمز عبور جدید خود را وارد نمایید',
//         'empty_password'     => 'فیلد رمز عبور الزامی است' , // stepThree
//         'invalid_password'   => 'فیلد رمز عبور حداقل باید 6 کاراکتر باشد است' ,
//         'success_change'     => 'تغییر رمز عبور با موفقیت انجام شد، لطفاً وارد سایت شوید',
//         'error_change'       => 'مشکلی در تغییر رمز عبور وجود دارد لطفاً مجددا تلاش نمایید',
//     ];   

//     if( $step_level == 'stepOne' ) {

//         lostpassword_ajax_handle_step_one_callback( $user_login, $lostpassword_list_errors );

//     } elseif( $step_level == 'stepTwo' ) {

//         lostpassword_ajax_handle_step_two_callback( $user_login, $user_code, $lostpassword_list_errors );

//     } elseif( $step_level == 'stepThree' ) {

//         lostpassword_ajax_handle_step_three_callback( $user_login, $password, $lostpassword_list_errors );

//     }

//     wp_die();

// }
// // add_action( 'wp_ajax_lostpassword_ajax_handle', 'lostpassword_ajax_handle_function' );  // For logged in users. -->
// // add_action( 'wp_ajax_nopriv_lostpassword_ajax_handle', 'lostpassword_ajax_handle_function' );


// function lostpassword_ajax_handle_step_one_callback( $user_login, $lostpassword_list_errors ) {

//     if( empty( $user_login ) || $user_login == null || $user_login == " " ) {

//         $code = 'empty_username';
//         $error = $lostpassword_list_errors['empty_username'];
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

//                 global $wpdb;
//                 $db_users = $wpdb->prefix . "usermeta";
//                 $user_login_code = wp_rand( 1000, 9999 );
//                 $wpdb->insert( $db_users,
//                                 array(
//                                     'user_id'    => 0,
//                                     'meta_key'   => 'user_reset_' . $user_login,
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
                
//                 lostpassword_ajax_validate_email_callback( $user_login, $user_login_code );

//                 $code = 'unique_email';
//                 $error = $lostpassword_list_errors['unique_email'];
//                 $type = 'success';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_success( $response );
        
//             } else {

//                 $code = 'invalid_email';
//                 $error = $lostpassword_list_errors['invalid_email'];
//                 $type = 'error';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_error( $response );

//             } 

//         } elseif( is_numeric( $user_login ) ) {
        
//             global $wpdb;
//             $db_users = $wpdb->prefix . "usermeta";
//             $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_id` FROM $db_users WHERE `meta_value` = %s", $user_login ) );

//             if( $return != NULL || ! empty( $return ) ) {

//                 global $wpdb;
//                 $db_users = $wpdb->prefix . "usermeta";
//                 $user_login_code = wp_rand( 1000, 9999 );
//                 $wpdb->insert( $db_users,
//                                 array(
//                                     'user_id'    => 0,
//                                     'meta_key'   => 'user_reset_' . $user_login,
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

//                 lostpassword_ajax_validate_numeric_callback( $user_login, $user_login_code );

//                 $code = 'unique_numeric';
//                 $error = $lostpassword_list_errors['unique_numeric'];
//                 $type = 'success';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_success( $response );
        
//             } else {

//                 $code = 'invalid_numeric';
//                 $error = $lostpassword_list_errors['invalid_numeric'];
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
//             $error = $lostpassword_list_errors['type_username'];
//             $type = 'error';
//             $response = array(
//                 'message'   => $error ,
//                 'code'      => $code ,
//                 'type'      => $type ,
//             );
//             wp_send_json_error( $response );
        
//         }

//         $code = 'refresh';
//         $error = $lostpassword_list_errors['refresh'];
//         $type = 'error';
//         $response = array(
// 			'message'   => $error ,
// 			'code'      => $code ,
// 			'type'      => $type ,
//         );
//         wp_send_json_error( $response );
            
//     }  

// }

// function lostpassword_ajax_handle_step_two_callback( $user_login, $user_code, $lostpassword_list_errors ) {

//     if( empty( $user_code ) || $user_code == null || $user_code == " " ) {

//         $code = 'empty_code';
//         $error = $lostpassword_list_errors['empty_code'];
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
//             $user_login_code = 'user_reset_' . $user_login;
//             $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `meta_value` FROM $db_users WHERE `meta_key` = %s ORDER BY `umeta_id` DESC LIMIT 1", $user_login_code ) );

//             if( $return == NULL || empty( $return ) ) {

//                 $code = 'invalid_code';
//                 $error = $lostpassword_list_errors['invalid_code'];
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
//                     $error = $lostpassword_list_errors['unique_code'];
//                     $type = 'success';
//                     $response = array(
//                         'message'   => $error ,
//                         'code'      => $code ,
//                         'type'      => $type ,
//                     );
//                     wp_send_json_success( $response );

//                 } else {

//                     $code = 'invalid_code';
//                     $error = $lostpassword_list_errors['invalid_code'];
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
//             $error = $lostpassword_list_errors['type_code'];
//             $type = 'error';
//             $response = array(
//                 'message'   => $error ,
//                 'code'      => $code ,
//                 'type'      => $type ,
//             );
//             wp_send_json_error( $response );
        
//         }

//         $code = 'refresh';
//         $error = $lostpassword_list_errors['refresh'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );
            
//     } 

// }

// function lostpassword_ajax_handle_step_three_callback( $user_login, $password, $lostpassword_list_errors ) {

//     if( empty( $password ) || $password == null || $password == " " ) {

//         $code = 'empty_password';
//         $error = $lostpassword_list_errors['empty_password'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );

//     } elseif( strlen( $password ) < 6 ) {

//         $code = 'invalid_password';
//         $error = $lostpassword_list_errors['invalid_password'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );

//     } else {
        
//         if( is_email( $user_login ) ) {
            
//             global $wpdb;
//             $db_users = $wpdb->prefix . "users";
//             $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `ID` FROM $db_users WHERE `user_email` = %s", $user_login ) );
//             $new_password = wp_set_password( $password, $return );

//             if( ! is_wp_error( $new_password ) ) {

//                 $code = 'success_change';
//                 $error = $lostpassword_list_errors['success_change'];
//                 $type = 'success';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_success( $response );
    
//             } else {
    
//                 $code = 'error_change';
//                 $error = $lostpassword_list_errors['error_change'];
//                 $type = 'error';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_error( $response );
    
//             }

//         } elseif( is_numeric( $user_login ) ) {
            
//             global $wpdb;
//             $db_users = $wpdb->prefix . "usermeta";
//             $return = $wpdb->get_var( $wpdb->prepare( "SELECT DISTINCT `user_id` FROM $db_users WHERE `meta_value` = %s", $user_login ) );
//             $new_password = wp_set_password( $password, $return );

//             if( ! is_wp_error( $new_password ) ) {

//                 $code = 'success_change';
//                 $error = $lostpassword_list_errors['success_change'];
//                 $type = 'success';
//                 $response = array(
//                     'message'   => $error ,
//                     'code'      => $code ,
//                     'type'      => $type ,
//                 );
//                 wp_send_json_success( $response );
    
//             } else {
    
//                 $code = 'error_change';
//                 $error = $lostpassword_list_errors['error_change'];
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
//             $error = $lostpassword_list_errors['type_username'];
//             $type = 'error';
//             $response = array(
//                 'message'   => $error ,
//                 'code'      => $code ,
//                 'type'      => $type ,
//             );
//             wp_send_json_error( $response );

//         }

//         $code = 'refresh';
//         $error = $lostpassword_list_errors['refresh'];
//         $type = 'error';
//         $response = array(
//             'message'   => $error ,
//             'code'      => $code ,
//             'type'      => $type ,
//         );
//         wp_send_json_error( $response );

//     }

// }

// function lostpassword_ajax_validate_email_callback( $user_login, $user_login_code ) {

//     $to = array($user_login);
// 	$subject = 'کد تأیید تغییر رمز عبور در سایت';
// 	$headers[] = 'از طرف: هسته پلاس';
// 	$message = 'کد تأیید یا (OTP) مورد نظر را جهت تغییر رمز عبور در سایت را وارد نمایید:' . "<br>" . $user_login_code ;

//   	$mailResult = false;
// 	$mailResult = wp_mail( $to, $subject, $message, $headers );
// 	return $mailResult;

// }

// function lostpassword_ajax_validate_numeric_callback( $user_login, $user_login_code ) {

// }