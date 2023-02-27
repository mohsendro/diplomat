<?php
namespace App\Controllers;

use App\Models\Post;
use App\Models\Option;
use TypeRocket\Controllers\WPPostController;
use TypeRocket\Http\Request;

class SearchController extends WPPostController
{
    protected $modelClass = Post::class;

    /**
     * The index page for public
     *
     * @return mixed
     */
    public function page(Post $post, Option $option)
    {
        // tr_redirect()->toURL(home_url('/search/'))->now();
        return include( get_query_template( '404' ) );
    }

    /**
     * The index page for public
     *
     * @return mixed
     */
    public function archive(Post $post, Option $option, $param)
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

        $param = urldecode($param);
        $where_search = [
            [
                'column'   => 'post_status',
                'operator' => '=',
                'value'    => 'publish'
            ],
            'AND',
            [
                'column'   => 'post_title',
                'operator' => 'like',
                'value'    =>  '%'.$param.'%'
            ]
        ];
        $posts = $post->findAll()->where($where_search)->orderBy('id', 'DESC');
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
                        tr_redirect()->toURL(home_url('/search/'.$param))->now();
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
                
        return tr_view('public.search', compact('posts', 'count', 'total_page', 'current_page', 'param') );
    }
}
