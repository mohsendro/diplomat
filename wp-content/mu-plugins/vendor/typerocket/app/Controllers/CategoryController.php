<?php
namespace App\Controllers;

use App\Models\Category;
use App\Models\Option;
use TypeRocket\Controllers\WPTermController;
use TypeRocket\Http\Request;

class CategoryController extends WPTermController
{
    protected $modelClass = Category::class;

    /**
     * The category taxonomy for public
     *
     * @return mixed
     */
    public function category(Category $category, Option $option, $cat_name, $number = 1)
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

        $category = $category->first()->where('slug', '=', $cat_name)->get();

        if( $category != null || $category > 0 )  {

            $posts = $category->posts();
            $posts_data = $posts;
            $posts = $posts->get();

            if( $posts != null || $posts > 0 ) {

                $count = $posts->count();        
                $total_page = ceil($count / $option);
                $current_page = intval($number);
                // $posts = $posts_data->take($option, 0)->get();

                if( (intval($number) <= $total_page) && (intval($number) >= 1) ) {
                    $posts = $posts_data->take($option, ($number-1)*$option)->get();
                    // if( $number == 1 ) {
                        // tr_redirect()->toURL(home_url('/category/' . $uncategorized->slug))->now();
                    // }
                } else {
                    // $posts = $posts->take($option, $number);
                    // tr_redirect()->toURL(home_url('/blog/'))->now();
                    return include( get_query_template( '404' ) );
                }

            } else {

                $posts = [];
                $count = 0;
                $total_page = 0;
                $current_page = 0;

            }                   

        } else {

            return include( get_query_template( '404' ) );

        }
        
        return tr_view('public.category', compact('category', 'posts', 'count', 'total_page', 'current_page') );
    }

    /**
     * The archive taxonomy for public
     *
     * @return mixed
     */
    public function archive(Category $category, Option $option, $cat_name, $number)
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

        $category = $category->first()->where('slug', '=', $cat_name)->get();

        if( $category != null || $category > 0 )  {

            $posts = $category->posts();
            $posts_data = $posts;
            $posts = $posts->get();

            if( $posts != null || $posts > 0 ) {

                $count = $posts->count();        
                $total_page = ceil($count / $option);
                $current_page = intval($number);
                // $posts = $posts_data->take($option, 0)->get();

                if( (intval($number) <= $total_page) && (intval($number) >= 1) ) {
                    $posts = $posts_data->take($option, ($number-1)*$option)->get();
                    if( $number == 1 ) {
                        tr_redirect()->toURL(home_url('/category/' . $category->slug))->now();
                    }
                } else {
                    // $posts = $posts->take($option, $number);
                    // tr_redirect()->toURL(home_url('/blog/'))->now();
                    return include( get_query_template( '404' ) );
                }
                
            } else {

                $posts = [];
                $count = 0;
                $total_page = 0;
                $current_page = 0;

            }

        } else {

            return include( get_query_template( '404' ) );

        }       

        return tr_view('public.category', compact('category', 'posts', 'count', 'total_page', 'current_page') );
    }
}