<?php
namespace App\Controllers;

use App\Models\Project;
use App\Models\Option;
use TypeRocket\Controllers\WPPostController;
use TypeRocket\Http\Request;

class ProjectController extends WPPostController
{
    protected $modelClass = Project::class;

    /**
     * The index page for public
     *
     * @return mixed
     */
    public function home(Project $post, Option $option)
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

        $posts = $post->findAll()->where('post_status', '=', 'publish')->orderBy('id', 'DESC');
        $posts_data = $posts; 
        $posts = $posts->get();

        if( $posts != null || $posts > 0 ) {

            $count = $posts->count();
            $total_page = ceil($count / $option);
            $current_page = 1;
            $posts = $posts_data->take($option, 0)->get();

        } else {

            $posts = [];
            $count = 0;
            $total_page = 0;
            $current_page = 0;
            
        } 

        return tr_view('public.project', compact('posts', 'count', 'total_page', 'current_page') );
    }

    /**
     * The index page for public
     *
     * @return mixed
     */
    public function page(Project $post, Option $option)
    {
        // tr_redirect()->toURL(home_url('/blog/'))->now();
        return include( get_query_template( '404' ) );
    }

    /**
     * The archive page for public
     *
     * @return mixed
     */
    public function archive(Project $post, Option $option, $number)
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

        $posts = $post->findAll()->where('post_status', '=', 'publish')->orderBy('id', 'DESC');
        $posts_data = $posts; 
        $posts = $posts->get();

        if( $posts != null || $posts > 0 ) {

            $count = $posts->count();
            $total_page = ceil($count / $option);
            $current_page = intval($number);

            if( (intval($number) <= $total_page) && (intval($number) >= 1) ) {
                $posts = $posts_data->take($option, ($number-1)*$option)->get();
                if( $number == 1 ) {
                    // $posts = $posts->take($option, 1);
                    tr_redirect()->toURL(home_url('/project/'))->now();
                }
            } else {
                // $posts = $posts->take($option, $number);
                // tr_redirect()->toURL(home_url('/project/'))->now();
                return include( get_query_template( '404' ) );
            }

        } else {

            $posts = [];
            $count = 0;
            $total_page = 0;
            $current_page = 0;
            
        } 

        return tr_view('public.project', compact('posts', 'count', 'total_page', 'current_page') );
    }

    /**
     * The single page for admin
     *
     * @return mixed
     */
    public function single(Project $post, $slug)
    {
        $where = [
            [
                'column'   => 'post_status',
                'operator' => '=',
                'value'    => 'publish'
            ],
            'AND',
            [
                'column'   => 'post_name',
                'operator' => '=',
                'value'    => $slug
            ]
        ];
        $post = $post->first()->where($where)->get();

        if( $post ){
            return tr_view('public.single-project', compact('post', 'slug') );
        } else {
            return include( get_query_template( '404' ) );
        }
    }
}