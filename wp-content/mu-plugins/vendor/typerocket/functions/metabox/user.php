<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Meta Box: user - متادیتای کاربر

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

    //
    // Set a unique slug-like ID
    $prefix = 'userInfo';
  
    //
    // Create profile options
    CSF::createProfileOptions( $prefix, array(
      'data_type' => 'unserialize', // The type of the database save options. `serialize` or `unserialize`
    ) );
  
    //
    // Create a section
    CSF::createSection( $prefix, array(
      'fields' => array(
  
        array(
          'id'         => 'vip',
          'type'       => 'switcher',
          'title'      => 'کاربر VIP',
          'text_on'    => 'بله',
          'text_off'   => 'خیر',
          'text_width' => 100
        ),

        array(
          'id'          => 'favoriteAdvertising',
          'type'        => 'select',
          'title'       => 'آگهی‌های مورد علاقه',
          'chosen'      => true,
          'multiple'    => true,
          'sortable'    => true,
          'ajax'        => true,
          'options'     => 'posts',
          'query_args'  => array(
            'post_type' => 'advertising'
          ),
          'placeholder' => 'انتخاب موارد...',
        ),

      )
    ) );
  
}