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

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function update()
    {

        // $tr_request = tr_request();
        // $to_job->user_id = $tr_request->getDataPost('tojob_add_user_id');
        // $to_job->job_id  = $tr_request->getDataPost('tojob_add_job_id');
        // $to_job->content = $tr_request->getDataPost('tojob_add_content');
        // if( $tr_request->getDataPost('tojob_add_status') ) {
        //     $to_job->status = "active";
        // } else {
        //     $to_job->status = "deactive";
        // }
        // $to_job->save(); 
        // tr_response()->flashNext('درخواست جدید ثبت شد'); 
        // return tr_redirect()->toPage('tojob', 'index');

    }
}