<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Post Type: advertising - آگهی

// general
$advertising = tr_post_type('advertising', 'advertisings');
$advertising->setIcon('dashicons-admin-multisite');
$advertising->setPosition(5);
$advertising->setModelClass(\App\Models\Advertising::class);
$advertising->setHandler(\App\Controllers\AdvertisingController::class);

// labels
$upperPlural = 'آگهی‌ها';
$upperSingular = 'آگهی';
$lowerSingular = 'آگهی';
$pluralLower = 'آگهی‌ها';
$labels = [
    'add_new'               => _x('افزودن آگهی', 'post_type:advertising', 'wpplus'),
    'all_items'             => sprintf( _x('همهٔ %s', 'post_type:advertising', 'wpplus'), $upperPlural),
    'archives'              => sprintf( _x('%s آگهی‌ها', 'post_type:advertising', 'wpplus'), $upperSingular),
    'add_new_item'          => sprintf( _x('%s تازه', 'post_type:advertising', 'wpplus'), $upperSingular),
    'attributes'            => sprintf( _x('ویژگی %s', 'post_type:advertising', 'wpplus'), $upperSingular),
    'edit_item'             => sprintf( _x('ویرایش %s', 'post_type:advertising', 'wpplus'), $upperSingular),
    'filter_items_list'     => sprintf( _x('فیلتر %s list %s', 'post_type:advertising', 'wpplus'), $pluralLower, $upperSingular),
    'insert_into_item'      => sprintf( _x('درج در %s', 'post_type:advertising', 'wpplus'), $lowerSingular),
    'item_published'        => sprintf( _x('%s انتشار.', 'post_type:advertising', 'wpplus'), $upperSingular),
    'item_published_privately' => sprintf( _x('%s انتشار خصوصی.', 'wpplus'), $upperSingular),
    'item_updated'          => sprintf( _x('%s بروزرسانی.', 'post_type:advertising', 'wpplus'), $upperSingular),
    'item_reverted_to_draft'=> sprintf( _x('%s انتقال به پیشنویس.', 'post_type:advertising', 'wpplus'), $upperSingular),
    'item_scheduled'        => sprintf( _x('%s برنامه ریزی.', 'post_type:advertising', 'wpplus'), $upperSingular),
    'items_list'            => sprintf( _x('%s لیست', 'post_type:advertising', 'wpplus'), $upperPlural),
    'menu_name'             => sprintf( _x('%s',  'post_type:advertising:admin menu', 'wpplus'), $upperPlural),
    'name'                  => sprintf( _x('%s', 'post_type:advertising:post type general name', 'wpplus'), $upperPlural),
    'name_admin_bar'        => sprintf( _x('%s', 'post_type:advertising:add new from admin bar', 'wpplus'), $upperSingular),
    'items_list_navigation' => sprintf( _x('%s list navigation', 'post_type:advertising', 'wpplus'), $upperPlural),
    'new_item'              => sprintf( _x('جدید %s', 'post_type:advertising', 'wpplus'), $upperSingular),
    'not_found'             => sprintf( _x('هیچ آگهی یافت نشد', 'post_type:advertising', 'wpplus'), $pluralLower),
    'not_found_in_trash'    => sprintf( _x('یافت نشد %s در سطل زباله', 'post_type:advertising', 'wpplus'), $pluralLower),
    'parent_item_colon'     => sprintf( _x("مادر %s:", 'post_type:advertising', 'wpplus'), $upperPlural),
    'search_items'          => sprintf( _x('جستجو %s', 'post_type:advertising', 'wpplus'), $upperPlural),
    'singular_name'         => sprintf( _x('%s',  'post_type:advertising:post type singular name', 'wpplus'), $upperSingular),
    'uploaded_to_this_item' => sprintf( _x('بارگذاری در %s', 'post_type:advertising', 'wpplus'), $lowerSingular),
    'view_item'             => sprintf( _x('نمایش %s', 'post_type:advertising', 'wpplus'), $upperSingular),
    'view_items'            => sprintf( _x('نمایش %s', 'post_type:advertising', 'wpplus'), $upperPlural),
];
$advertising->setLabels($labels);

// slug
$withFront = false;
$advertising->setSlug('advertising', $withFront);
$advertising->setHierarchical(true);
$advertising->setRest('advertising');
// $advertising->setRootOnly('/{post-type}/{post-name}');

// single
$advertising->forceDisableGutenberg();
$advertising->setSupports(['title', 'thumbnail', 'editor', 'excerpt', 'author', 'comments', 'page-attributes', 'post-formats']);
// $advertising->featureless();

// archive
// $advertising->addColumn('Photo', true, 'Photo3', function($value) {
//     return 'asdsad';
// });


// meta data
// $advertising->setModelClass(\App\Models\Advertising::class)
//             ->saveTitleAs(function (\App\Models\Advertising $advertising, \TypeRocket\Http\Request $request) {
//                 return $advertising->data->$request->getDataPost('post_title');
//             });