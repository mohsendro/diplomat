<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Table: expert - جدول درخواست کارشناسی

// Plugin menu callback function
function forms_expert_list_table_init() {

    // Creating an instance
    // $formsExpertTable = new Forms_Expert_List_Table();

    echo "<div class='wrap'>";
      echo "<h1 class='wp-heading-inline'>درخواست‌ها</h1>";
      echo "<hr class='wp-header-end'>";
          // Prepare table
          $formsExpertTable->prepare_items();
          echo "<form method='get'>";
                echo "<input type='hidden' name='page' value='forms-expert' />";
                $formsExpertTable->search_box('جستجو', 'search_id');
                //Display table
                // if( isset( $_GET['forms_expert_id'] ) ) {
                      $formsExpertTable->display();
                // } else {
                    //   echo 'پیغام دلخواه...';
                // }
          echo "</form>";
    echo "</div>";

}
forms_expert_list_table_init();


// Loading table class
if( !class_exists('WP_List_Table') ) {

    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

}

