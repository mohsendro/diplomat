<?php
/*
    Plugin Name: هسته پلاس
    Description: مجوعه ای از افزونه های کوچک برای توسعه هسته اصلی وردپرس که شامل موارد زیر می باشند:
    Version: 1.0.1
    Author: محسن دروگر
    Author URI:  mohsendroo@yahoo.com
*/

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if( ! class_exists( 'WPPlus' ) ) {

    class WPPlus {

        /**
        * @param : Plugins List
        */
        public $wpplus_plugins_vendor_list = [
            [ 
                'name'        => 'PHPackagist',
                'description' => 'فریمورک نصب و استفاده از پکیج‌های PHP از مخزن Composer در وردپرس',
                'direction'   => 'vendor/phpackagist/phpackagist.php',
                'status'      => true
            ],
            [ 
                'name'        => 'WPackagist',
                'description' => 'فریمورک نصب و استفاده از افزونه‌‌ها و قالب‌های مخزن وردپرس بصورت پکیج‌های Composer در وردپرس',
                'direction'   => 'vendor/wpackagist/wpackagist.php',
                'status'      => true
            ],
            [ 
                'name'        => 'Codestar',
                'description' => 'فریمورک پنل تنظیمات وردپرس',
                'direction'   => 'vendor/codestar-framework/codestar-framework.php',
                'status'      => true
            ],
            [ 
                'name'        => 'Typerocket',
                'description' => 'فریمورک ساختار MVC وردپرس',
                'direction'   => 'vendor/typerocket/typerocket.php',
                'status'      => true
            ],
            [ 
                'name'        => 'Acorn',
                'description' => 'فریمورک بارگذاری امکانات و پکیج‌های Laravel با رعایت قوانین و سلسه مراتب درون وردپرس',
                'direction'   => 'vendor/acorn/acorn.php',
                'status'      => false
            ],
           
        ];  

        public $wpplus_plugins_admin_list = [
            [ 
                'name'        => 'Styles',
                'description' => 'افزونه استایل و اسکریپت دهی به بخش مدیریت وردپرس',
                'direction'   => 'admin/styles/styles.php',
                'status'      => true
            ],
            [ 
                'name'        => 'Gutenberg',
                'description' => 'افزونه مدیریت صفحه ساز گوتنبرگ وردپرس',
                'direction'   => 'admin/gutenberg/gutenberg.php',
                'status'      => true
            ],
            [ 
                'name'        => 'Menus',
                'description' => 'افزونه مدیریت منوهای بخش مدیریت وردپرس',
                'direction'   => 'admin/menus/menus.php',
                'status'      => true
            ],
            [ 
                'name'        => 'Login',
                'description' => 'افزونه تغییر مسیر ورود به بخش مدیریت وردپرس',
                'direction'   => 'admin/login/login.php',
                'status'      => true
            ],  
            [ 
                'name'        => 'Parsidate',
                'description' => 'افزونه شمسی سازی تاریخ وردپرس'.' | parsidate("Y/m/d", $custom_date)',
                'direction'   => 'admin/parsidate/parsidate.php',
                'status'      => true
            ],
        ]; 
        
        public $wpplus_plugins_public_list = [    
            [ 
                'name'        => 'Bootstrap',
                'description' => 'کتابخانه طراحی صفحات واکنشگرا',
                'direction'   => 'public/bootstrap/bootstrap.php',
                'status'      => true
            ],
            [ 
                'name'        => 'General',
                'description' => 'ایجاد فایل های استایل و اسکریپت برای کل سایت',
                'direction'   => 'public/general/general.php',
                'status'      => true
            ],    
            [ 
                'name'        => 'Sign',
                'description' => 'فرم ورود، عضویت و فراموشی رمز عبور اختصاصی',
                'direction'   => 'public/sign/sign.php',
                'status'      => false
            ],
            [ 
                'name'        => 'Account',
                'description' => 'حساب کاربری اختصاصی',
                'direction'   => 'public/account/account.php',
                'status'      => false
            ], 
            [ 
                'name'        => 'Localization',
                'description' => 'شمسی سازی دیتاپیکر المنتور',
                'direction'   => 'public/localization/localization.php',
                'status'      => false
            ],  
            [ 
                'name'        => 'Views',
                'description' => 'نمایش تعداد بازدید پست‌ها',
                'direction'   => 'public/views/views.php',
                'status'      => false
            ], 
            [ 
                'name'        => 'Breadcrumbs',
                'description' => 'نمایش مسیر جاری سلسله ساختار'.' | [wpplus_breadcrumb]',
                'direction'   => 'public/breadcrumbs/breadcrumbs.php',
                'status'      => false
            ], 
        ]; 


        public function __construct() {

            /**
            * @param : Define Directory
            */
            $wpplus_basename = trailingslashit( basename(__FILE__) );
            if ( ! defined( 'WPPLUS_DIR_PATH' ) ) define( 'WPPLUS_DIR_PATH' , trailingslashit( WPMU_PLUGIN_DIR ) ) ;
            if ( ! defined( 'WPPLUS_DIR_URL' ) ) define( 'WPPLUS_DIR_URL' , trailingslashit( WPMU_PLUGIN_URL ) ) ;

            add_filter( 'plugin_row_meta', array($this, 'wpplus_plugins_row_meta'), 10, 2 );
            $this->wpplus_plugins_includes();

        }

        public function wpplus_plugins_row_meta( $plugin_meta, $plugin_file ) {

            if ( strpos( $plugin_file, 'wpplus-plugins.php' ) !== false ) {
                $new_meta = [
                    "plugins_list" => $this->wpplus_plugins_vendor_list_callback() . 
                                      $this->wpplus_plugins_admin_list_callback() . 
                                      $this->wpplus_plugins_public_list_callback(),
                ];
                $plugin_meta = array_merge( $plugin_meta, $new_meta );
            }
            return $plugin_meta;
        }

        public function wpplus_plugins_vendor_list_callback() {

            $tag = "<div><b> بخش پکیج های وردپرس </b></div>";
            $tag .= "<ol>";
            foreach ($this->wpplus_plugins_vendor_list as $list_details) {
                $tag .= "<li>";
                foreach ($list_details as $key => $value) {
                    if ( $key == 'name') {
                        $tag .= $value . ': ';
                    }
                    if ( $key == 'description') {
                        $tag .= $value;
                    }
                    if ( $key == 'status') {
                        if( $value === true ) {
                            $tag .= "<span style='color: #00e300;'> (فعال) </span>";
                        } else {
                            $tag .= "<span style='color: #e30000;'> (غیرفعال) </span>";
                        } 
                    }
                }
                $tag .= "</li>";
            }
            $tag .= "</ol>";
        
            return $tag;

        }

        public function wpplus_plugins_admin_list_callback() {

            $tag = "<div><b> بخش مدیریت وردپرس </b></div>";
            $tag .= "<ol>";
            foreach ($this->wpplus_plugins_admin_list as $list_details) {
                $tag .= "<li>";
                foreach ($list_details as $key => $value) {
                    if ( $key == 'name') {
                        $tag .= $value . ': ';
                    }
                    if ( $key == 'description') {
                        $tag .= $value;
                    }
                    if ( $key == 'status') {
                        if( $value === true ) {
                            $tag .= "<span style='color: #00e300;'> (فعال) </span>";
                        } else {
                            $tag .= "<span style='color: #e30000;'> (غیرفعال) </span>";
                        } 
                    }
                }
                $tag .= "</li>";
            }
            $tag .= "</ol>";
        
            return $tag;

        }

        public function wpplus_plugins_public_list_callback() {

            $tag = "<div><b> بخش عمومی وردپرس </b></div>";
            $tag .= "<ol>";
            foreach ($this->wpplus_plugins_public_list as $list_details) {
                $tag .= "<li>";
                foreach ($list_details as $key => $value) {
                    if ( $key == 'name') {
                        $tag .= $value . ': ';
                    }
                    if ( $key == 'description') {
                        $tag .= $value;
                    }
                    if ( $key == 'status') {
                        if( $value === true ) {
                            $tag .= "<span style='color: #00e300;'> (فعال) </span>";
                        } else {
                            $tag .= "<span style='color: #e30000;'> (غیرفعال) </span>";
                        } 
                    }
                }
                $tag .= "</li>";
            }
            $tag .= "</ol>";
        
            return $tag;

        }

        public function wpplus_plugins_includes() {

            $wpplus_all_plugins_list = array_merge( $this->wpplus_plugins_vendor_list, 
                                                    $this->wpplus_plugins_admin_list, 
                                                    $this->wpplus_plugins_public_list 
                                                  );

            foreach ( $wpplus_all_plugins_list as $inclue_list ) {
                if( $inclue_list['status'] === true ) {
                    if( $inclue_list['name'] === 'Typerocket' ) {
                        define('TYPEROCKET_MU_INSTALL', '/vendor/typerocket/wordpress/');
                        require ('vendor/typerocket/init.php');
                    } 
                    include WPPLUS_DIR_PATH . $inclue_list['direction'];
                }
            } 

        }

    }

}
$wpplus = new WPPlus;