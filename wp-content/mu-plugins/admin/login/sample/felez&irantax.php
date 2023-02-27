<?php

/************************ User logeged Controll Redirect ************************/
function felez_redirect_if_user_not_logged_in() {

  if( !is_user_logged_in() && strpos( $_SERVER['REQUEST_URI'], 'account') ) {
      wp_redirect( home_url() . "/signon" ); 
      exit;
  }
 
}
add_action( 'init', 'felez_redirect_if_user_not_logged_in' );


function felez_redirect_if_user_logged_in() {
  
  $user = wp_get_current_user();
  $roles = ( array ) $user->roles;
  
  if ( is_user_logged_in() && ! in_array( "administrator", $roles ) ) {
    if( strpos( $_SERVER['REQUEST_URI'], 'signon') ) {
      wp_redirect( home_url() . "/account" ); 
      exit;
    }
  }

}
add_action( 'init', 'felez_redirect_if_user_logged_in' );





