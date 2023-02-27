<?php
namespace App\Models;

use TypeRocket\Models\WPTerm;

class AdcertisingCat extends WPTerm
{
    public const TAXONOMY = 'advertising_cat';

    // public function adcertisings()
    // {
    //     return $this->belongsToPost(Advertising::class);
    // }

    public function posts()
    {
        // $model = '\App\Models\Adcertising';
        return $this->belongsToPost(Advertising::class, function($posts) {
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