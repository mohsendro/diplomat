<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Meta Box: advertising - متادیتای آگهی

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

    //
    // Set a unique slug-like ID
    $prefix = 'advertisingInfo';
  
    //
    // Create profile options
    CSF::createMetabox( $prefix, array(
      'data_type' => 'unserialize', // The type of the database save options. `serialize` or `unserialize`
      'title'     => 'اطلاعات آگهی',
      'post_type' => 'advertising',
    ) );
  
    //
    // Create a section
    CSF::createSection( $prefix, array(
      'fields' => array(
  
        array(
          'id'         => 'vip',
          'type'       => 'switcher',
          'title'      => 'آگهی VIP',
          'text_on'    => 'بله',
          'text_off'   => 'خیر',
          'text_width' => 100
        ),

      )
    ) );
  
}