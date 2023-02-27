<?php
namespace App\Models;

use TypeRocket\Models\WPPost;

class Advertising extends WPPost
{
    public const POST_TYPE = 'advertising';

    public function adcertising_cat()
    {
        return $this->belongsToTaxonomy(AdcertisingCat::class, AdcertisingCat::TAXONOMY);
    }
}