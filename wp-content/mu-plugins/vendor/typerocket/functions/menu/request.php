<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Menu: the request - درخواست ملک

function register_forms_request_menu_page() {

	$request = add_submenu_page( 'forms_log', 'درخواست ملک', 'درخواست ملک', 'manage_options', 'forms_request', 'register_forms_request_menu_page_callback', 'dashicons-format-chat' ); 
    add_action("load-$request", 'forms_request_table_add_options');  
    
}
add_action( 'admin_menu', 'register_forms_request_menu_page' );


// screen option
function forms_request_table_add_options() {

    $args_page = array(
        'label' => 'تعداد موردها در هر برگه:',
        'default' => 20,
        'option' => 'forms_request_per_page'
    );

    add_screen_option('per_page', $args_page);

}

// get saved screen meta value
function forms_request_table_set_option($status, $option, $value) {

    return $value;

}
add_filter('set-screen-option', 'forms_request_table_set_option', 10, 3);


function register_forms_request_menu_page_callback() {

    require_once plugin_dir_path(__FILE__) . "../table/request.php";

}


// $settings = ['capability' => 'administrator'];
// $handler = function() {  

//     return 'hi3';  

// };

// $request = tr_page('forms', 'request', 'درخواست ملک', $settings, $handler);
// $request->setHandler(\App\Controllers\PostController::class);
// $request->mapAction('GET', 'request');
// $request->mapAction('POST', 'create_request');
// $request->setView($handler);
// $request->adminBar('forms_request');
// $request->setSlug('forms_request');

// $request->setParent($forms);
// $request->setTitle('درخواست ملک');
// $request->setSubMenuTitle('درخواست ملک'); // If is sub page