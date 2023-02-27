<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Menu: the counseling - درخواست مشاوره

function register_forms_counseling_menu_page() {

	$counseling = add_submenu_page( 'forms_log', 'درخواست مشاوره', 'درخواست مشاوره', 'manage_options', 'forms_counseling', 'register_forms_counseling_menu_page_callback', 'dashicons-format-chat' ); 
    add_action("load-$counseling", 'forms_counseling_table_add_options');   

}
add_action( 'admin_menu', 'register_forms_counseling_menu_page' );


// screen option
function forms_counseling_table_add_options() {

    $args_page = array(
        'label' => 'تعداد موردها در هر برگه:',
        'default' => 20,
        'option' => 'forms_counseling_per_page'
    );

    add_screen_option('per_page', $args_page);

}

// get saved screen meta value
function forms_counseling_table_set_option($status, $option, $value) {

    return $value;

}
add_filter('set-screen-option', 'forms_counseling_table_set_option', 10, 3);


function register_forms_counseling_menu_page_callback() {

    require_once plugin_dir_path(__FILE__) . "../table/counseling.php";

}


// $settings = ['capability' => 'administrator'];
// $handler = function() {  

//     return 'hi4';  

// };

// $counseling = tr_page('forms', 'counseling', 'درخواست مشاوره', $settings, $handler);
// $counseling->setHandler(\App\Controllers\PostController::class);
// $counseling->mapAction('GET', 'counseling');
// $counseling->mapAction('POST', 'create_counseling');
// $counseling->setView($handler);
// $counseling->adminBar('forms_counseling');
// $counseling->setSlug('forms_counseling');

// $counseling->setParent($forms);
// $counseling->setTitle('درخواست مشاوره');
// $counseling->setSubMenuTitle('درخواست مشاوره'); // If is sub page