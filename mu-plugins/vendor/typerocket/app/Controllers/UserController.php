<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Option;
use TypeRocket\Controllers\WPUserController;
use TypeRocket\Http\Request;

class UserController extends WPUserController
{
    protected $modelClass = User::class;

    /**
     * The index page for public
     *
     * @return mixed
     */
    public function home(User $user, Option $option)
    {
        $where = [
            [
                'column'   => 'option_name',
                'operator' => '=',
                'value'    => 'posts_per_page'
            ]
        ];
        $option = $option->find()->where($where)->select('option_value')->get()->toArray();
        $option = $option[0]['option_value'];

        $users = $user->findAll()->orderBy('id', 'DESC');
        $count = $users->count();
        $total_page = ceil($count / $option);
        $current_page = 1;
        $users = $users->take($option, 0)->get();

        // $users = $user->findAll()->where('post_status', '=', 'publish')->orderBy('id', 'DESC');
        // $users_data = $users; 
        // $users = $users->get();

        // if( $users != null || $users > 0 ) {

        //     $count = $users->count();
        //     $total_page = ceil($count / $option);
        //     $current_page = 1;
        //     $users = $users_data->take($option, 0)->get();

        // } else {

        //     $users = [];
        //     $count = 0;
        //     $total_page = 0;
        //     $current_page = 0;
            
        // } 

        return tr_view('public.author', compact('users', 'count', 'total_page', 'current_page') );
    }

    /**
     * The index page for public
     *
     * @return mixed
     */
    public function page(User $user, Option $option)
    {
        // tr_redirect()->toURL(home_url('/blog/'))->now();
        return include( get_query_template( '404' ) );
    }

    /**
     * The archive page for public
     *
     * @return mixed
     */
    public function archive(User $user, Option $option, $number)
    {
        $where = [
            [
                'column'   => 'option_name',
                'operator' => '=',
                'value'    => 'posts_per_page'
            ]
        ];
        $option = $option->find()->where($where)->select('option_value')->get()->toArray();
        $option = $option[0]['option_value'];

        $users = $user->findAll()->orderBy('id', 'DESC');
        // $users = $user->findAll()->where('dip_user_level', '!=', '10')->orderBy('id', 'DESC');
        $count = $users->count();
        $total_page = ceil($count / $option);
        $current_page = intval($number);

        if( (intval($number) <= $total_page) && (intval($number) >= 1) ) {
            $users = $users->take($option, ($number-1)*$option)->get();
            if( $number == 1 ) {
                // $users = $users->take($option, 1);
                tr_redirect()->toURL(home_url('/author/'))->now();
            }
        } else {
            // $users = $users->take($option, $number);
            // tr_redirect()->toURL(home_url('/author/'))->now();
            return include( get_query_template( '404' ) );
        }

        // $users = $user->findAll()->where('post_status', '=', 'publish')->orderBy('id', 'DESC');
        // $users_data = $users; 
        // $users = $users->get();

        // if( $users != null || $users > 0 ) {

        //     $count = $users->count();
        //     $total_page = ceil($count / $option);
        //     $current_page = intval($number);

        //     if( (intval($number) <= $total_page) && (intval($number) >= 1) ) {
        //         $users = $users_data->take($option, ($number-1)*$option)->get();
        //         if( $number == 1 ) {
        //             // $users = $users->take($option, 1);
        //             tr_redirect()->toURL(home_url('/blog/'))->now();
        //         }
        //     } else {
        //         // $users = $users->take($option, $number);
        //         // tr_redirect()->toURL(home_url('/blog/'))->now();
        //         return include( get_query_template( '404' ) );
        //     }

        // } else {

        //     $users = [];
        //     $count = 0;
        //     $total_page = 0;
        //     $current_page = 0;
            
        // } 

        return tr_view('public.author', compact('users', 'count', 'total_page', 'current_page') );
    }

    /**
     * The single page for admin
     *
     * @return mixed
     */
    public function single(User $user, $slug)
    {
        $where = [
            [
                'column'   => 'user_login',
                'operator' => '=',
                'value'    => $slug
            ]
        ];
        $user = $user->first()->where($where)->get();

        if( $user ){
            return tr_view('public.single-author', compact('user', 'slug') );
        } else {
            return include( get_query_template( '404' ) );
        }
    }
}