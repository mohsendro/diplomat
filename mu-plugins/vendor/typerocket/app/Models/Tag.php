<?php
namespace App\Models;

use TypeRocket\Models\WPTerm;

class Tag extends WPTerm
{
    public const TAXONOMY = 'post_tag';

    // public function posts()
    // {
    //     return $this->belongsToPost(Post::class);
    // }

    public function posts()
    {
        // $model = '\App\Models\Post';
        return $this->belongsToPost(Post::class, function($posts) {
            $where = [
                [
                    'column'   => 'post_status',
                    'operator' => '=',
                    'value'    => 'publish'
                ]
            ];
            $posts->where($where)->orderBy('id', 'DESC');
        });
    }
}