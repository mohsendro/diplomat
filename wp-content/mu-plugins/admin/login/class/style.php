<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'LoginStyle' ) ) {

	class LoginStyle extends Login {

		public $logo = true; // for LogoActive Method
    	public $url = ''; // for LogoImage Method

		public function __construct() {

            add_action( 'login_enqueue_scripts', array($this, 'wpplus_enqueuing_login_styles') );
            add_action( 'login_enqueue_scripts', array($this, 'wpplus_enqueuing_login_scripts') );
			if( $this->logo == true ) {
				$this->LogoActive();
			}
			else {
				return false;
			}

        }
    
        public function wpplus_enqueuing_login_styles() {

			wp_register_style( 'login-style', plugin_dir_url(__FILE__) . "../css/login.css", false, '1.0.0' );
			wp_enqueue_style( 'login-style' );

		}

		public function wpplus_enqueuing_login_scripts() {

			wp_register_script( 'login-script', plugin_dir_url(__FILE__) . "../js/login.js", false, '1.0.0' );
			wp_enqueue_script( 'login-script' );
			
		}

		public function LogoActive() {

			if( $this->logo == true ) {

				add_filter( 'login_title', array($this, 'PageTitle') );
				add_filter( 'login_headerurl', array($this, 'LogoUrl') );
				add_filter( 'login_headertitle', array($this, 'LogoTitle') );
				add_action( 'login_enqueue_scripts', array($this, 'LogoImage') );

			}

		}
	
		public function PageTitle($origtitle) {

			return "بخش ورود مدیر سایت";

		}
	
		public function LogoUrl() {

			return home_url();

		}
	
		public function LogoTitle() {

			return 'توسعه توسط: محسن دروگر';

		}
	
		public function LogoImage() { 

			$this->url = plugin_dir_url(__FILE__) . '../img/logo.png'; // for LogoImage Method
			?> <style type="text/css">
				#login h1 a { background-image: url( <?php echo $this->url; ?>); }
			</style> <?php 

		}

	}

}