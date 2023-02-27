<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Menu: the expert - درخواست کارشناسی

function register_forms_expert_menu_page() {

	$expert = add_submenu_page( 'forms_log', 'درخواست کارشناسی', 'درخواست کارشناسی', 'manage_options', 'forms_expert', 'register_forms_expert_menu_page_callback', 'dashicons-format-chat' ); 
    add_action("load-$expert", 'forms_expert_table_add_options');  

}
add_action( 'admin_menu', 'register_forms_expert_menu_page' );


// screen option
function forms_expert_table_add_options() {

    $args_page = array(
        'label' => 'تعداد موردها در هر برگه:',
        'default' => 20,
        'option' => 'forms_expert_per_page'
    );

    add_screen_option('per_page', $args_page);

}

// get saved screen meta value
function forms_expert_table_set_option($status, $option, $value) {

    return $value;

}
add_filter('set-screen-option', 'forms_expert_table_set_option', 10, 3);


function register_forms_expert_menu_page_callback() {

    require_once plugin_dir_path(__FILE__) . "../table/expert.php";

}


// $settings = ['capability' => 'administrator'];
// $handler = function() {  

//     return 'hi2';  

// };

// $expert = tr_page('forms', 'expert', 'درخواست کارشناسی', $settings, $handler);
// $expert->setHandler(\App\Controllers\PostController::class);
// $expert->mapAction('GET', 'expert');
// $expert->mapAction('POST', 'create_expert');
// $expert->setView($handler);
// $expert->adminBar('forms_expert');
// $expert->setSlug('forms_expert');

// $expert->setParent($forms);
// $expert->setTitle('درخواست کارشناسی');
// $expert->setSubMenuTitle('درخواست کارشناسی'); // If is sub page