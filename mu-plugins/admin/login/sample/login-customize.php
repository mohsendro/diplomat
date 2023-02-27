<?php
/**
* Plugin Name: Login Customize
* Plugin URI: #
* Description: LoginCustomize is the best <code>wp-login</code> Login Page Customizer plugin by <a href="https://wpbrigade.com/">WPBrigade</a> which allows you to completely change the layout of login, register and forgot password forms.
* Version: 1.0.0
* Author: Mohsendro
* Author URI: #
* Text Domain: LoginCustomize
* Domain Path: /languages
*
* @package LoginCustomize
* @category Core
* @author mohsendro
*/

class Styles {
    
    public $file;
    public $content = '
        body.login {}
        body.login div#login {}
        body.login div#login h1 {}
        body.login div#login h1 a {}
        body.login div#login p.message {}
        body.login div#login p.login.message {}
        body.login div#login div#login_error {}
        body.login div#login form#loginform {}
        body.login div#login form#loginform p {}
        body.login div#login form#loginform p label {}
        body.login div#login form#loginform input {}
        body.login div#login form#loginform input#user_login {}
        body.login div#login form#loginform input#user_pass {}
        body.login div#login form#loginform p.forgetmenot {}
        body.login div#login form#loginform p.forgetmenot input#rememberme {}
        body.login div#login form#loginform p.submit {}
        body.login div#login form#loginform p.submit input#wp-submit {}
        body.login div#login p#nav {}
        body.login div#login p#nav a {}
        body.login div#login p#backtoblog {}
        body.login div#login p#backtoblog a {}
    ';

    public function __construct( ){
        wp_enqueue_style( 'danafy-login',  plugins_url() . '/login-customize/style-login.css' );
        wp_enqueue_script( 'danafy-login', plugins_url() . '/login-customize/style-login.js' );
        // add_action('login_head', array($this, 'GenerateCss') );
        // add_action('login_head', array($this, 'GenerateJs') );
    }

    public function GenerateCss(){
        $this->file = fopen(dirname(__FILE__)."/style-login.css","w");
        fwrite($this->file, $this->content);
        fclose($this->file);
    }

    public function GenerateJs(){
        $this->file = fopen(dirname(__FILE__)."/style-login.js","w");
        fwrite($this->file, $this->content);
        fclose($this->file);
    }

}


class Logo {

    public $logo = true; // for LogoActive Method
    public $url = "http://localhost/ghazal/wp-content/uploads/2021/03/logo.png"; // for LogoImage Method

    public function __construct() {      
        if($this->logo == true){
            $this->LogoActive();
        }
        else{
            return false;
        }
    }

    public function LogoActive(){
        if( $this->logo == true ){
            add_filter( 'login_title', array($this, 'PageTitle') );
            add_filter( 'login_headerurl', array($this, 'LogoUrl') );
            add_filter( 'login_headertitle', array($this, 'LogoTitle') );
            add_action( 'login_enqueue_scripts', array($this, 'LogoImage') );
        }
        else{
            echo "noooooooooooooooooooooo";
        }
    }

    public function PageTitle($origtitle){
        return "Loooooooogin";
    }

    public function LogoUrl(){
        return home_url();
    }

    public function LogoTitle(){
        return 'Powered by Danafy Theme';
    }

    public function LogoImage(){ 
        ?> <style type="text/css">
            #login h1 a { background-image: url( <?php echo $this->url; ?>); }
        </style> <?php 
    }

}


class LoginMassages {

    public $active_message = true;
    public $message;

    public function __construct() {      
        if($this->active_message == true){
            $this->ActiveMassages();
        }
        else{
            return false;
        }
    }

    public function ActiveMassages(){
        if( isset( $_REQUEST['action'] ) ){
            add_filter( 'login_message', array($this, 'LoginMassages') );
        }
        elseif( isset( $_REQUEST['loggedout'] ) ){
            add_filter( 'wp_login_errors', array($this, 'LoggedoutMassages') );
        }
        // elseif( isset( $_REQUEST['checkemail'] ) ){
        //     // code
        // }
        else{
            $action = ' ';
            add_filter( 'login_message', array($this, 'LoginMassages') );
        }
    }

    public function LoginMassages($message){
        unset($message);
        switch ( $action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : ' ' ):
            case $action == 'register':
                $message = '<p class="login message">متن عضویت</p>';
                break;
            case $action == 'lostpassword':
                $message = '<p class="login message">متن فراموشی رمز عبور</p>';
                break;
            case $action == 'resetpass':
                $message = '<p class="login message">متن بازنشانی رمز عبور</p>';
                break;                   
            case $action == 'checkemail':
                $message = '<p class="login message">متن چک کردن ایمیل تغییر رمز</p>';
                break;                                    
            default:
                $message = '<p class="login message">متن ورود</p>';
                break;
        endswitch;
        return $message; 
    }

    public function LoggedoutMassages($errors){
        $errors->errors['loggedout'][0] = 'متن با موفقیت از سایت خارج شدید';       
        return $errors;
    }  

}


class ErroeMassages {

    public $active_error = true;
    public $error;

    public function __construct() {      
        if($this->active_error == true){
            $this->ActiveError();
        }
        else{
            return false;
        }
    }

    public function ActiveError(){
        add_filter('login_errors', array($this, 'LoginErrors'));
    }
    
    public function LoginErrors($error){
        global $errors;
        $err_codes = $errors->get_error_codes();
        $err_codes = $err_codes[0];
        var_dump($err_codes);
        switch ( $err_codes ):
            case $err_codes == 'invalid_username':
                $error = 'نام کاربری معتبر نیست';
                break;
            case $err_codes == 'invalid_email':
                $error = 'ایمیل معتبر نیست';
                break;
            case $err_codes == 'invalidkey':
                $error = 'لینک تنظیم مجدد رمز عبور نامعتبر است لطفا مجددا تلاش نمایید';
                break;    
            case $err_codes == 'incorrect_password':
                $error = 'رمز عبور معتبر نیست';
                break;                   
            case $err_codes == 'empty_username':
                $error = 'نام کاربری نباید خالی باشد';
                break;                                    
            case $err_codes == 'empty_email':
                $error = 'ایمیل نباید خالی باشد';
                break;                                    
            case $err_codes == 'empty_password':
                $error = 'رمز عبور نباید خالی باشد';
                break;                                    
            case $err_codes == 'username_exists':
                $error = 'نام کاربری از قبل وجود دارد نام دیگری انتخاب کنید';
                break;                                    
            case $err_codes == 'email_exists':
                $error = 'ایمیل از قبل وجود دارد ایمیل دیگری انتخاب کنید';
                break;                                    
            case $err_codes == 'retrieve_password_email_failure':
                $error = 'مشکلی در ارسال ایمیل وجود دارد با پشتیبان خود تماس بگیرید';
                break;                                    
            case $err_codes == 'invalidcombo':
                $error = 'نام کاربری یا ایمیل جهت بازیابی رمز عبور الزامی می باشد';
                break;                                    
            case $err_codes == 'invalidkey':
                $error = 'لینک تنظیم مجدد رمز عبور نامعتبر است لطفا مجددا تلاش نمایید';
                break;                                    
            case $err_codes == 'test_cookie':
                $error = 'کوکی ها به درستی ست نشده اند';
                break;                                    
            default:
                $error = 'در صورت بروز مشکل با بخش پشتیبانی تماس بگیرید';
                break;
        endswitch;
        return $error;
    }

}

class MainForm {

}

class OtherFields {

}

class FooetrForm {

}

class RenameUrl {

    private $rewrite_url  = "vorodd";
    private $redirect_url = "404.php";
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

        require_once( ABSPATH . WPINC . '/template-loader.php' );

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

        if ( ! is_multisite()
            && ( strpos( $_SERVER['REQUEST_URI'], 'wp-signup' )  !== false
                || strpos( $_SERVER['REQUEST_URI'], 'wp-activate' ) )  !== false ) {

            wp_die( __( 'This feature is not enabled.', 'wps-hide-login' ) );

        }

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

class RenameUrl2 {

    public $activate     = true;
    public $protocol     = null;
    public $currentPage  = null;
    public $adminPage    = null;
    public $str_replace  = null;
    public $rewrite_url  = "vorod";
    public $redirect_url = "404.php";

    public function __construct() {
        if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ){ $this->protocol = "https://"; }else{ $this->protocol = "http://"; }
        $this->currentPage = $this->protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
        $this->str_replace = str_replace(home_url(), "",  $this->currentPage);
        $this->adminPage   = home_url('/') . $this->rewrite_url;  
        add_action( 'init', array($this, 'rewrite_rules_function') );
        add_filter( 'login_redirect', array($this, 'login_redirect_function'), 10, 3 );
        add_filter( 'registration_redirect', array($this, 'registration_redirect_function'), 10, 3 );
        add_filter( 'lostpassword_redirect', array($this, 'lostpassword_redirect_function'), 10, 3 );
        add_filter( 'init', array($this, 'checkemail_redirect_function') );
    }

    public function rewrite_rules_function(){
        if($this->activate == true){
            // array( 'wp-login.php', 'wp-register.php', 'wp-signup.php' )
            // $wpadmin_slug = trim( sanitize_key( $_POST[HC_WPADMIN_OPTION] ) );
            add_rewrite_rule( "{$this->rewrite_url}/?$", 'wp-login.php', 'top' );
        }else{
            flush_rewrite_rules();
        }
    }

    public function login_redirect_function($redirect_to, $request, $user){
        if ( is_user_logged_in() || isset( $user->roles ) && is_array( $user->roles ) ) {
            $redirect_to = admin_url('index.php');
            return $redirect_to;
        } else {
            if( strpos($this->str_replace, "/" . $this->rewrite_url ) !== false ){
                return $redirect_to;
            }
            else{
                $redirect_to = wp_redirect($this->redirect_url);
                return $redirect_to;
            }
        }
    }   
    
    public function registration_redirect_function( $registration_redirect ) {
        if ( is_user_logged_in() || isset( $user->roles ) && is_array( $user->roles ) ) {
            $redirect_to = admin_url('index.php');
            return $redirect_to;
        } else {
            if( strpos($this->str_replace, "/" . $this->rewrite_url ) !== false ){
                return $redirect_to;
            }
            else{
                $redirect_to = wp_redirect($this->redirect_url);
                return $redirect_to;
            }
        }
    }   
     
    public function lostpassword_redirect_function( $lostpassword_redirect ) {
        if ( is_user_logged_in() || isset( $user->roles ) && is_array( $user->roles ) ) {
            $redirect_to = admin_url('index.php');
            return $redirect_to;
        } else {
            if( strpos($this->str_replace, "/" . $this->rewrite_url ) !== false ){
                return $redirect_to;
            }
            else{
                $redirect_to = wp_redirect($this->redirect_url);
                return $redirect_to;
            }
        }
    }

    public function checkemail_redirect_function() {
        // if( isset($_REQUEST['checkemail']) ){
            // if ( is_user_logged_in() || isset( $user->roles ) && is_array( $user->roles ) ) {
            //     $redirect_to = admin_url('index.php');
            //     return $redirect_to;
            // } else {
            //     if( strpos($this->str_replace, "/" . $this->rewrite_url ) !== false ){
            //         return $redirect_to;
            //     }
            //     else{
            //         $redirect_to = wp_redirect($this->redirect_url);
            //         return $redirect_to;
            //     }
            // }
        // }
    }

}













// $object1 = new Styles;
// $object2 = new Logo;
$object3 = new LoginMassages;
// $object4 = new ErroeMassages;
// $object5 = new MainForm;
// $object6 = new OtherFields;
// $object7 = new FooetrForm;
$object8 = new RenameUrl;


/**
 * login
 * ["invalid_username"]
 * ["invalid_email"]
 * ["incorrect_password"] /// invalid password
 * ["empty_username"]
 * ["empty_email"]
 * ["empty_password"]
 * 
 * 
 * register
 * ["invalid_username"]
 * ["invalid_email"]
 * ["empty_username"]
 * ["empty_email"]
 * ["username_exists"]
 * ["email_exists"]
 * 
 * lostpass
 * ["retrieve_password_email_failure"] /// dont send email
 * ["invalidcombo"] /// empty username or email field in forgetpassword
 * ["invalidkey"]  /// not valid key in resetpass
 * 
 * ["test_cookie"]
 * action=confirm_admin_email&wp_lang=fa_IR // درست سنجی ایمیل مدیر
 * action=confirm_admin_email&remind_me_later=c61f2f9bc1
 **/








/*
// اضافه کردن فیلد رمز عبور به صفحه لاگین

add_action( 'register_form', 'ts_show_extra_register_fields' );
function ts_show_extra_register_fields(){
?>
<p>
<label for="password">رمز عبور
<input id="password" type="password" tabindex="30" size="25" value="" name="password" />
</label>
</p>
<p>
<!-- <label for="repeat_password">تکرار رمز عبور
<input id="repeat_password" type="password" tabindex="40" size="25" value="" name="repeat_password" />
</label> -->
</p>
<?php
}

// چک کردن خطا های احتمالی
add_action( 'register_post', 'ts_check_extra_register_fields', 10, 3 );
function ts_check_extra_register_fields($login, $email, $errors) {
// if ( $_POST['password'] !== $_POST['repeat_password'] ) {
// $errors->add( 'passwords_not_matched', "!خطا: پسوردها هماهنگ نیست" );
// }
if ( strlen( $_POST['password'] ) < 6 ) {
$errors->add( 'password_too_short', "!خطا: رمز عبور باید بیشتر از ۶ حزف باشد" );
}
}

// ثبت رمز عبور در دیتابیس

add_action( 'user_register', 'ts_register_extra_fields', 100 );
function ts_register_extra_fields( $user_id ){
$userdata = array();
$userdata['ID'] = $user_id;
if ( $_POST['password'] !== '' ) {
$userdata['user_pass'] = $_POST['password'];
}
$new_user_id = wp_update_user( $userdata );
}

// نمایش پیام کامل شدن ثبت نام

add_filter( 'gettext', 'ts_edit_password_email_text' );
function ts_edit_password_email_text ( $text ) {
if ( $text == 'پسورد برای شما ایمیل خواهد شد' ) {
$text = 'اگر فیلد پسورد را خالی گذاشته اید. پسورد برای شما جنریت خواهد شد. رمز عبور باید بیش از ۵ حرف باشد.';
}
return $text;
}


