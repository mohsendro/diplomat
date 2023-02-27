<?php

/**
 * do_action( "login_form_{$action}" ) 
 * بخش پویا نام قلاب، $action، به عملی اشاره دارد که بازدیدکننده را به فرم ورود آورده است.
 * http://wpschool.ir/%D8%AC%D8%A7%DB%8C%DA%AF%D8%B2%DB%8C%D9%86-%D8%B5%D9%81%D8%AD%D9%87-%D9%84%D8%A7%DA%AF%DB%8C%D9%86-%D8%AF%D8%B1-%D9%88%D8%B1%D8%AF%D9%BE%D8%B1%D8%B3/
 *
 * http://wpschool.ir/%D8%AC%D8%A7%DB%8C%DA%AF%D8%B2%DB%8C%D9%86-%D8%B5%D9%81%D8%AD%D9%87-%D8%AB%D8%A8%D8%AA-%D9%86%D8%A7%D9%85-%D8%AF%D8%B1-%D9%88%D8%B1%D8%AF%D9%BE%D8%B1%D8%B3/
 * 
 * http://wpschool.ir/%D8%AC%D8%A7%DB%8C%DA%AF%D8%B2%DB%8C%D9%86-%D8%B5%D9%81%D8%AD%D9%87-%D9%81%D8%B1%D8%A7%D9%85%D9%88%D8%B4%DB%8C-%D8%B1%D9%85%D8%B2-%D9%88%D8%B1%D8%AF%D9%BE%D8%B1%D8%B3/
 */

// function login_redirect() {
//     wp_redirect( 'test' );
// }
// if( strpos( $_SERVER['REQUEST_URI'], 'vorod' )) {
//     add_action('login_form_checkemail', 'login_redirect');
//     add_action('login_form_confirm_admin_email', 'login_redirect');
//     add_action('login_form_confirmaction', 'login_redirect');
//     add_action('login_form_entered_recovery_mode', 'login_redirect');
//     add_action('login_form_login', 'login_redirect');
//     add_action('login_form_logout', 'login_redirect');
//     add_action('login_form_lostpassword', 'login_redirect');
//     add_action('login_form_postpass', 'login_redirect');
//     add_action('login_form_register', 'login_redirect');
//     add_action('login_form_resetpass', 'login_redirect');
//     add_action('login_form_retrievepassword', 'login_redirect');
//     add_action('login_form_rp', 'login_redirect');
// }

// خط اول برای اینه که هر وقت کاربر درخواست صفحه لاگین کرد تابعی که ما معرفی کردیم اجرا بشه.

// تابع redirect_to_custom_login در صورتی که درخواست از نوع get باشه و اگر کاربر از قبل لاگین کرده باشه کاربر رو به صفحه درخواستیش هدایت میکنه (تابع دوم برای انجام این کار هستش) و در صورتی که که لاگین نکرده باشه صفحه لاگینی که ساختیم رو به کاربر نمایش میده.
// add_action( 'login_form_login', 'redirect_to_custom_login');
// function redirect_to_custom_login() {
//     if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
//         $redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : null;
     
//         if ( is_user_logged_in() ) {
//             redirect_logged_in_user( $redirect_to );
//             exit;
//         }
 
//         // The rest are redirected to the login page
//         $login_url = home_url( 'user-login' );
//         if ( ! empty( $redirect_to ) ) {
//             $login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
//         }
 
//         wp_redirect( $login_url );
//         exit;
//     }
// }

// function redirect_logged_in_user( $redirect_to = null ) {
//     $user = wp_get_current_user();
//     if ( user_can( $user, 'manage_options' ) ) {
//         if ( $redirect_to ) {
//             wp_safe_redirect( $redirect_to );
//         } else {
//             wp_redirect( admin_url() );
//         }
//     } else {
//         wp_redirect( home_url() );
//     }
// } 








// در صورتی که در هنگام لاگین خطایی رخ بده کاربر باید در صفحه لاگین باقی بمونه و خطاهای موجود برای کاربر نمایش داده بشه:


// add_filter( 'authenticate', 'maybe_redirect_at_authenticate' , 101, 3 );
// function maybe_redirect_at_authenticate( $user, $username, $password ) {
//     if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
//         if ( is_wp_error( $user ) ) {
//             $error_codes = join( ',', $user->get_error_codes() );
//             $login_url = home_url( 'user-login' );
//             $login_url = add_query_arg( 'login', $error_codes, $login_url );
 
//             wp_redirect( $login_url );
//             exit;
//         }
//     }
//     return $user;
// }