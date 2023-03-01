<?php
namespace App\Controllers;

use App\Models\User;
use TypeRocket\Controllers\Controller;
use TypeRocket\Http\Request;

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
    public function dashboard()
    {

        $user_id  = get_current_user_id();
        $wishlist = get_user_meta( $user_id, 'favoriteAdvertising', true );
        return tr_view('account.content.dashboard', compact('wishlist') );

    }

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function wishlist()
    {

        $user_id  = get_current_user_id();
        $wishlist = get_user_meta( $user_id, 'favoriteAdvertising', true );
        return tr_view('account.content.wishlist', compact('wishlist') );

    }

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function edit(Request $request, User $user)
    {

        $user_info = wp_get_current_user();
        $user_meta = get_user_meta( $user_info->data->ID );
        $request_edit = $request;

        if( $request_edit->checkNonce() ) {

            $user = $user->findById($request_edit->getDataPost('user_id'));
            $user->display_name = $request_edit->getDataPost('display_name');
            $user->user_email = $request_edit->getDataPost('email');
            $user->update();

            $meta_keys = [
                'first_name' => $request_edit->getDataPost('first_name'),
                'last_name'  => $request_edit->getDataPost('last_name'),
            ];

            foreach( $meta_keys as $key => $value ) {  

                $user_meta = tr_query()->table('dip_usermeta')->where('user_id', '=', $request_edit->getDataPost('user_id'))->findAll();
                $user_meta->where('meta_key', '=', $key )->update(['meta_value' => $value]);

            }       
            
            $message = ['اطلاعات کاربری شما بروزرسانی شد', 200];
            // $redirect = tr_redirect()->withMessage('اطلاعات کاربری شما بروزرسانی شد', 200);
            // $redirect->toUrl( home_url('/account/edit/') )->now();
            
        } else {

            $message = ['مشکلی رخ داد، لطفاً مجدداً امتحان نمایید', 400];
            // $redirect = tr_redirect()->withMessage('مشکلی رخ داد، لطفاً مجدداً امتحان نمایید', 400);
            // $redirect->toUrl( home_url('/account/edit/') )->now();           

        }

        return tr_view('account.content.edit', compact('user_info', 'user_meta', 'message'));

    }
    
}