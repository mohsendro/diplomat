<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Table: request - جدول درخواست ملک

// Plugin menu callback function
function forms_request_list_table_init() {

    // Creating an instance
    // $formsRequestTable = new Forms_Request_List_Table();

    echo "<div class='wrap'>";
      echo "<h1 class='wp-heading-inline'>درخواست‌ها</h1>";
      echo "<hr class='wp-header-end'>";
          // Prepare table
          $formsRequestTable->prepare_items();
          echo "<form method='get'>";
                echo "<input type='hidden' name='page' value='forms-request' />";
                $formsRequestTable->search_box('جستجو', 'search_id');
                //Display table
                // if( isset( $_GET['forms_request_id'] ) ) {
                      $formsRequestTable->display();
                // } else {
                //       echo 'پیغام دلخواه...';
                // }
          echo "</form>";
    echo "</div>";

}
forms_request_list_table_init();


// Loading table class
if( !class_exists('WP_List_Table') ) {

    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

}

