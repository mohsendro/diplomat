<?php
namespace App\Controllers;

use App\Models\Option;
use App\Models\User;
use App\Models\Advertising;
use App\Models\Comment;
use App\Models\FormExpert;
use App\Models\FormRequest;
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
    public function vip(Advertising $post, Option $option)
    {

        $user_id  = get_current_user_id();
        $user_vip = get_user_meta( $user_id, 'vip', true );

        if( ! $user_vip ) {

            return tr_view('account.content.vip', compact('user_vip') );

        }

        $where = [
            [
                'column'   => 'option_name',
                'operator' => '=',
                'value'    => 'posts_per_page'
            ]
        ];
        $option = $option->find()->where($where)->select('option_value')->get()->toArray();
        $option = $option[0]['option_value'];

        $posts = $post->findAll()->with('meta')->whereMeta('vip', '=', 1)->where('post_status', '=', 'publish')->orderBy('id', 'DESC');
        $posts_data = $posts; 
        $posts = $posts->get();
        
        if( $posts != null || $posts > 0 ) {

            $count = $posts->count();
            $total_page = ceil($count / $option);

            if( intval($_GET['page']) ) {
                $current_page = $_GET['page'];
            } else {
                $current_page = 1;
            } 
            
            if( intval($_GET['page']) ) {
                if( (intval($_GET['page']) <= $total_page) && (intval($_GET['page']) >= 1) ) {
                    $posts = $posts_data->take($option, (intval($_GET['page'])-1)*$option)->get();
                    if( $_GET['page'] == 1 ) {
                        // $posts = $posts->take($option, 1);
                        tr_redirect()->toURL(home_url('/account/vip/'))->now();
                    }
                } else {
                    // $posts = $posts->take($option, $_GET['page']);
                    // tr_redirect()->toURL(home_url('/blog/'))->now();
                    return include( get_query_template( '404' ) );
                } 
            } else {
                $posts = $posts_data->take($option, 0)->get();
            }

        } else {

            $posts = [];
            $count = 0;
            $total_page = 0;
            $current_page = 0;
            
        }   

        return tr_view('account.content.vip', compact('posts', 'count', 'total_page', 'current_page') );

    }

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function wishlist(Advertising $post, Option $option)
    {

        $user_id  = get_current_user_id();
        $wishlist = get_user_meta( $user_id, 'favoriteAdvertising', true );

        $where = [
            [
                'column'   => 'option_name',
                'operator' => '=',
                'value'    => 'posts_per_page'
            ]
        ];
        $option = $option->find()->where($where)->select('option_value')->get()->toArray();
        $option = $option[0]['option_value'];

        $posts = $post->find($wishlist)->where('post_status', '=', 'publish')->orderBy('id', 'DESC');
        $posts_data = $posts; 
        $posts = $posts->get();
        
        if( $posts != null || $posts > 0 ) {

            $count = $posts->count();
            $total_page = ceil($count / $option);

            if( intval($_GET['page']) ) {
                $current_page = $_GET['page'];
            } else {
                $current_page = 1;
            } 
            
            if( intval($_GET['page']) ) {
                if( (intval($_GET['page']) <= $total_page) && (intval($_GET['page']) >= 1) ) {
                    $posts = $posts_data->take($option, (intval($_GET['page'])-1)*$option)->get();
                    if( $_GET['page'] == 1 ) {
                        // $posts = $posts->take($option, 1);
                        tr_redirect()->toURL(home_url('/account/wishlist/'))->now();
                    }
                } else {
                    // $posts = $posts->take($option, $_GET['page']);
                    // tr_redirect()->toURL(home_url('/blog/'))->now();
                    return include( get_query_template( '404' ) );
                } 
            } else {
                $posts = $posts_data->take($option, 0)->get();
            }

        } else {

            $posts = [];
            $count = 0;
            $total_page = 0;
            $current_page = 0;
            
        }   

        return tr_view('account.content.wishlist', compact('posts', 'count', 'total_page', 'current_page') );

    }

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function comment(Comment $post, Option $option) {

        $user_id  = get_current_user_id();

        $where = [
            [
                'column'   => 'option_name',
                'operator' => '=',
                'value'    => 'posts_per_page'
            ]
        ];
        $option = $option->find()->where($where)->select('option_value')->get()->toArray();
        $option = $option[0]['option_value'];

        $where_comment = [
            [
                'column'   => 'comment_approved',
                'operator' => '=',
                'value'    => 1
            ],
            'AND',
            [
                'column'   => 'user_id',
                'operator' => '=',
                'value'    => $user_id
            ]
        ];
        $posts = $post->findAll()->where($where_comment)->orderBy('comment_ID', 'DESC');
        $posts_data = $posts; 
        $posts = $posts->get();
        
        if( $posts != null || $posts > 0 ) {

            $count = $posts->count();
            $total_page = ceil($count / $option);

            if( intval($_GET['page']) ) {
                $current_page = $_GET['page'];
            } else {
                $current_page = 1;
            } 
            
            if( intval($_GET['page']) ) {
                if( (intval($_GET['page']) <= $total_page) && (intval($_GET['page']) >= 1) ) {
                    $posts = $posts_data->take($option, (intval($_GET['page'])-1)*$option)->get();
                    if( $_GET['page'] == 1 ) {
                        // $posts = $posts->take($option, 1);
                        tr_redirect()->toURL(home_url('/account/comment/'))->now();
                    }
                } else {
                    // $posts = $posts->take($option, $_GET['page']);
                    // tr_redirect()->toURL(home_url('/blog/'))->now();
                    return include( get_query_template( '404' ) );
                } 
            } else {
                $posts = $posts_data->take($option, 0)->get();
            }

        } else {

            $posts = [];
            $count = 0;
            $total_page = 0;
            $current_page = 0;
            
        }   

        return tr_view('account.content.comment', compact('posts', 'count', 'total_page', 'current_page') );

    }

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function ticket() {

        return tr_view('account.content.ticket');

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
            
            $response = [
                'message' => '?????????????? ???????????? ?????? ?????????????????? ????',
                'type'    => 200
            ];
            // $redirect = tr_redirect()->withMessage('?????????????? ???????????? ?????? ?????????????????? ????', 200);
            $redirect = tr_redirect();
            $redirect->toUrl( home_url('/account/edit/') )->now();
            
        } else {

            $response = [
                // 'message' => '?????????? ???? ???????? ?????????? ???????????? ???????????? ????????????',
                // 'type'    => 400
            ];
            // $redirect = tr_redirect()->withMessage('?????????? ???? ???????? ?????????? ???????????? ???????????? ????????????', 400);
            // $redirect->toUrl( home_url('/account/edit/') )->now();           

        }

        return tr_view('account.content.edit', compact('user_info', 'response') );

    }   

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function expert(FormExpert $form_expert, Option $option, Request $request)
    {

        $user_id  = get_current_user_id();
        
        if( $_GET['action'] && $_GET['action'] == 'add' ) {

            if( $request->checkNonce() ) {

                $form_expert->post_author   = $user_id;
                $form_expert->post_date     = date("Y-m-d h:i:s");
                $form_expert->post_date_gmt = date("Y-m-d h:i:s");
                $form_expert->post_title    = $request->getDataPost('expert_title');
                $form_expert->post_content  = $request->getDataPost('expert_description');
                $form_expert->post_status   = 0;
                $form_expert->save();    
                
                $response = [
                    'message' => '?????????????? ?????? ???? ???????????? ?????? ????',
                    'type'    => 200
                ];
                // $redirect = tr_redirect()->withMessage('?????????????? ?????? ???? ???????????? ?????? ????', 200);
                // $redirect = tr_redirect();
                // $redirect->toUrl( home_url('/account/expert/?action=add') )->now();
                
            } else {

                $response = [
                    // 'message' => '?????????? ???? ???????? ?????????? ???????????? ???????????? ????????????',
                    // 'type'    => 400
                ];
                // $redirect = tr_redirect()->withMessage('?????????? ???? ???????? ?????????? ???????????? ???????????? ????????????', 400);
                // $redirect->toUrl( home_url('/account/expert/?action=add') )->now();           

            }

            return tr_view('account.content.expert-add', compact('user_id', 'response') );

        }


        $where = [
            [
                'column'   => 'option_name',
                'operator' => '=',
                'value'    => 'posts_per_page'
            ]
        ];
        $option = $option->find()->where($where)->select('option_value')->get()->toArray();
        $option = $option[0]['option_value'];

        $posts = $form_expert->findAll()->where('post_author', '=', $user_id)->orderBy('ID', 'DESC');
        $posts_data = $posts; 
        $posts = $posts->get();
        
        if( $posts != null || $posts > 0 ) {

            $count = $posts->count();
            $total_page = ceil($count / $option);

            if( intval($_GET['page']) ) {
                $current_page = $_GET['page'];
            } else {
                $current_page = 1;
            } 
            
            if( intval($_GET['page']) ) {
                if( (intval($_GET['page']) <= $total_page) && (intval($_GET['page']) >= 1) ) {
                    $posts = $posts_data->take($option, (intval($_GET['page'])-1)*$option)->get();
                    if( $_GET['page'] == 1 ) {
                        // $posts = $posts->take($option, 1);
                        tr_redirect()->toURL(home_url('/account/expert/'))->now();
                    }
                } else {
                    // $posts = $posts->take($option, $_GET['page']);
                    // tr_redirect()->toURL(home_url('/blog/'))->now();
                    return include( get_query_template( '404' ) );
                } 
            } else {
                $posts = $posts_data->take($option, 0)->get();
            }

        } else {

            $posts = [];
            $count = 0;
            $total_page = 0;
            $current_page = 0;
            
        }   

        return tr_view('account.content.expert', compact('posts', 'count', 'total_page', 'current_page') );

    } 

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function request(FormRequest $form_request, Option $option, Request $request)
    {

        $user_id  = get_current_user_id();
        
        if( $_GET['action'] && $_GET['action'] == 'add' ) {

            if( $request->checkNonce() ) {

                $form_request->post_author   = $user_id;
                $form_request->post_date     = date("Y-m-d h:i:s");
                $form_request->post_date_gmt = date("Y-m-d h:i:s");
                $form_request->post_title    = $request->getDataPost('request_title');
                $form_request->post_content  = $request->getDataPost('request_description');
                $form_request->post_status   = 0;
                $form_request->save();    
                
                $response = [
                    'message' => '?????????????? ?????? ???? ???????????? ?????? ????',
                    'type'    => 200
                ];
                // $redirect = tr_redirect()->withMessage('?????????????? ?????? ???? ???????????? ?????? ????', 200);
                // $redirect = tr_redirect();
                // $redirect->toUrl( home_url('/account/request/?action=add') )->now();
                
            } else {

                $response = [
                    // 'message' => '?????????? ???? ???????? ?????????? ???????????? ???????????? ????????????',
                    // 'type'    => 400
                ];
                // $redirect = tr_redirect()->withMessage('?????????? ???? ???????? ?????????? ???????????? ???????????? ????????????', 400);
                // $redirect->toUrl( home_url('/account/request/?action=add') )->now();           

            }

            return tr_view('account.content.request-add', compact('user_id', 'response') );

        }


        $where = [
            [
                'column'   => 'option_name',
                'operator' => '=',
                'value'    => 'posts_per_page'
            ]
        ];
        $option = $option->find()->where($where)->select('option_value')->get()->toArray();
        $option = $option[0]['option_value'];

        $posts = $form_request->findAll()->where('post_author', '=', $user_id)->orderBy('ID', 'DESC');
        $posts_data = $posts; 
        $posts = $posts->get();
        
        if( $posts != null || $posts > 0 ) {

            $count = $posts->count();
            $total_page = ceil($count / $option);

            if( intval($_GET['page']) ) {
                $current_page = $_GET['page'];
            } else {
                $current_page = 1;
            } 
            
            if( intval($_GET['page']) ) {
                if( (intval($_GET['page']) <= $total_page) && (intval($_GET['page']) >= 1) ) {
                    $posts = $posts_data->take($option, (intval($_GET['page'])-1)*$option)->get();
                    if( $_GET['page'] == 1 ) {
                        // $posts = $posts->take($option, 1);
                        tr_redirect()->toURL(home_url('/account/request/'))->now();
                    }
                } else {
                    // $posts = $posts->take($option, $_GET['page']);
                    // tr_redirect()->toURL(home_url('/blog/'))->now();
                    return include( get_query_template( '404' ) );
                } 
            } else {
                $posts = $posts_data->take($option, 0)->get();
            }

        } else {

            $posts = [];
            $count = 0;
            $total_page = 0;
            $current_page = 0;
            
        }   

        return tr_view('account.content.request', compact('posts', 'count', 'total_page', 'current_page') );

    } 
}