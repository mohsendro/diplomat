<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.;

/** Cretae Virtual Page By Url Parameters */
// function wpplus_add_virtual_page( $template ) {
//     if ( isset( $_GET['invoice_id'] ) ) {
//         $invoice_id = $_GET['invoice_id'];
//         include plugin_dir_path( __FILE__ ) . 'templates/invoice.php';
//         die;
//     }
// }
// add_action( 'init', 'wpplus_add_virtual_page');


/** Main Account Page Slug */
function wpplus_generate_rewrite_rule_main_account( $wp_rewrite ) {
    $wp_rewrite->rules = array_merge(
        ['account/?$' => 'index.php?main_account=1'],
        $wp_rewrite->rules
    );
}
add_filter( 'generate_rewrite_rules', 'wpplus_generate_rewrite_rule_main_account');

function wpplus_query_vars_main_account( $query_vars ) {
    $query_vars[] = 'main_account';
    return $query_vars;
}
add_filter( 'query_vars', 'wpplus_query_vars_main_account');

function wpplus_templates_main_account() {
    $custom = intval( get_query_var( 'main_account' ) );
    if ( $custom ) {
        include plugin_dir_path( __FILE__ ) . 'templates/template-account.php';
        die;
    }
}
add_action( 'template_redirect', 'wpplus_templates_main_account');


/** Endpoints Account Page Slug */
function wpplus_rewrite_rule_account() {
    add_rewrite_rule( 'account/([a-z0-9-]+)[/]?$', 'index.php?account=$matches[1]', 'top' );
    // add_rewrite_endpoint( 'account', EP_ROOT );
    // flush_rewrite_rules();   
}
add_action( 'init', 'wpplus_rewrite_rule_account');

function wpplus_query_vars_account( $query_vars ){
    $query_vars[] = 'account';
    return $query_vars;
}
add_filter( 'query_vars', 'wpplus_query_vars_account' );

function wpplus_templates_account( $template ){ 
    if ( get_query_var( 'account' ) == false || get_query_var( 'account' ) == '' ) {
        return $template;
    }
    include plugin_dir_path( __FILE__ ) . 'templates/template-account.php';
    die;
}
add_action( 'template_include', 'wpplus_templates_account' );