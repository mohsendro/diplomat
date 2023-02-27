<?php
namespace App\Controllers;

use TypeRocket\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function login()
    {

        if( isset( $_GET['action'] ) ) {

            $query_string = $_GET['action'];
            switch ( $query_string ) {
    
                case 'register':
                    return tr_view('account.register');
                    break;
    
                case 'lostpassword':
                    return tr_view('account.lostpassword');
                    break;
    
                default:
                    $redirect = tr_redirect();
                    $redirect->toUrl( home_url('/login/') )->now();
                    break;
    
            }
    
        } else {
    
            return tr_view('account.login');
    
        }

    }

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function account($endpoint = null)
    {

        if( isset( $endpoint ) ) {

            switch ( $endpoint ) {
    
                case 'vip':
                    $endpoint = 'vip';
                    break;
    
                case 'wishlist':
                    $endpoint = 'wishlist';
                    break;
    
                case 'comment':
                    $endpoint = 'comment';
                    break;

                case 'ticket':
                    $endpoint = 'ticket';
                    break;

                case 'expert':
                    $endpoint = 'expert';
                    break;

                case 'request':
                    $endpoint = 'request';
                    break;

                case 'edit':
                    $endpoint = 'edit';
                    break;

                default:
                    $redirect = tr_redirect();
                    $redirect->toUrl( home_url('/account/') )->now();
                    break;
    
            }
    
        } else {

            $endpoint = 'dashboard';
            
        }

        return tr_view('account.account', compact('endpoint') );

    }
}