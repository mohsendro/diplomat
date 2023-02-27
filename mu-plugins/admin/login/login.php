<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'Login' ) ) {

	class Login {
       
        public $root_path = '';

		public function __construct() {

            $this->root_path = plugin_dir_path(__FILE__);
            $this->wpplus_includes();

		}

		public function wpplus_includes() {

            include_once plugin_dir_path( __FILE__ ) . "class/style.php";
            include_once plugin_dir_path( __FILE__ ) . "class/rename.php";
            include_once plugin_dir_path( __FILE__ ) . "class/redirect.php";
            include_once plugin_dir_path( __FILE__ ) . "class/security.php";
            $login_style    = new LoginStyle;
            $login_rename   = new LoginRename;
            $login_redirect = new LoginRedirect;
            $login_security = new LoginSecurity;

		}

	}

}
$login = new Login;