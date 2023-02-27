<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Menu: forms - درخواست‌ها

function register_forms_log_menu_page() {

	$forms = add_menu_page( 'درخواست‌ها', 'درخواست‌ها', 'manage_options', 'forms_log', 'register_forms_log_menu_page_callback', 'dashicons-format-chat' ); 
    add_action("load-$forms", 'forms_log_table_add_options');
    
}
add_action( 'admin_menu', 'register_forms_log_menu_page' );


// screen option
function forms_log_table_add_options() {

    $args_page = array(
        'label' => 'تعداد موردها در هر برگه:',
        'default' => 20,
        'option' => 'forms_log_per_page'
    );

    add_screen_option('per_page', $args_page);

}

// get saved screen meta value
function forms_log_table_set_option($status, $option, $value) {

    return $value;

}
add_filter('set-screen-option', 'forms_log_table_set_option', 10, 3);


function register_forms_log_menu_page_callback() {

    require_once plugin_dir_path(__FILE__) . "../table/forms.php";

}


// $settings = ['capability' => 'administrator'];
// $handler = function() {  

    // return 'hi';  

// };

// $forms = tr_page('forms', 'log', 'درخواست‌ها', $settings, $handler);
// $forms->setHandler(\App\Controllers\PostController::class);
// $forms->mapAction('GET', 'forms');
// $forms->mapAction('POST', 'create_forms');
// $forms->setView($handler);
// $forms->adminBar('forms_index');
// $forms->setSlug('forms_index');

// $forms->setIcon('dashicons-format-chat');
// $forms->setTitle('درخواست‌ها');
// $forms->setMenuTitle('درخواست‌ها');
// $forms->setSubMenuTitle('درخواست‌ها'); // If is sub page