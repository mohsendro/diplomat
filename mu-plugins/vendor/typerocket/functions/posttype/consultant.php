<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Post Type: consultant - مشاوره

// general
$consultant = tr_post_type('consultant', 'consultants');
$consultant->setIcon('dashicons-archive');
$consultant->setPosition(5);
$consultant->setModelClass(\App\Models\Consultant::class);
$consultant->setHandler(\App\Controllers\ConsultantController::class);

// labels
$upperPlural = 'مشاوره‌ها';
$upperSingular = 'مشاوره';
$lowerSingular = 'مشاوره';
$pluralLower = 'مشاوره‌ها';
$labels = [
    'add_new'               => _x('افزودن مشاوره', 'post_type:consultant', 'wpplus'),
    'all_items'             => sprintf( _x('همهٔ %s', 'post_type:consultant', 'wpplus'), $upperPlural),
    'archives'              => sprintf( _x('%s مشاوره‌ها', 'post_type:consultant', 'wpplus'), $upperSingular),
    'add_new_item'          => sprintf( _x('%s تازه', 'post_type:consultant', 'wpplus'), $upperSingular),
    'attributes'            => sprintf( _x('ویژگی %s', 'post_type:consultant', 'wpplus'), $upperSingular),
    'edit_item'             => sprintf( _x('ویرایش %s', 'post_type:consultant', 'wpplus'), $upperSingular),
    'filter_items_list'     => sprintf( _x('فیلتر %s list %s', 'post_type:consultant', 'wpplus'), $pluralLower, $upperSingular),
    'insert_into_item'      => sprintf( _x('درج در %s', 'post_type:consultant', 'wpplus'), $lowerSingular),
    'item_published'        => sprintf( _x('%s انتشار.', 'post_type:consultant', 'wpplus'), $upperSingular),
    'item_published_privately' => sprintf( _x('%s انتشار خصوصی.', 'wpplus'), $upperSingular),
    'item_updated'          => sprintf( _x('%s بروزرسانی.', 'post_type:consultant', 'wpplus'), $upperSingular),
    'item_reverted_to_draft'=> sprintf( _x('%s انتقال به پیشنویس.', 'post_type:consultant', 'wpplus'), $upperSingular),
    'item_scheduled'        => sprintf( _x('%s برنامه ریزی.', 'post_type:consultant', 'wpplus'), $upperSingular),
    'items_list'            => sprintf( _x('%s لیست', 'post_type:consultant', 'wpplus'), $upperPlural),
    'menu_name'             => sprintf( _x('%s',  'post_type:consultant:admin menu', 'wpplus'), $upperPlural),
    'name'                  => sprintf( _x('%s', 'post_type:consultant:post type general name', 'wpplus'), $upperPlural),
    'name_admin_bar'        => sprintf( _x('%s', 'post_type:consultant:add new from admin bar', 'wpplus'), $upperSingular),
    'items_list_navigation' => sprintf( _x('%s list navigation', 'post_type:consultant', 'wpplus'), $upperPlural),
    'new_item'              => sprintf( _x('جدید %s', 'post_type:consultant', 'wpplus'), $upperSingular),
    'not_found'             => sprintf( _x('هیچ مشاوره یافت نشد', 'post_type:consultant', 'wpplus'), $pluralLower),
    'not_found_in_trash'    => sprintf( _x('یافت نشد %s در سطل زباله', 'post_type:consultant', 'wpplus'), $pluralLower),
    'parent_item_colon'     => sprintf( _x("مادر %s:", 'post_type:consultant', 'wpplus'), $upperPlural),
    'search_items'          => sprintf( _x('جستجو %s', 'post_type:consultant', 'wpplus'), $upperPlural),
    'singular_name'         => sprintf( _x('%s',  'post_type:consultant:post type singular name', 'wpplus'), $upperSingular),
    'uploaded_to_this_item' => sprintf( _x('بارگذاری در %s', 'post_type:consultant', 'wpplus'), $lowerSingular),
    'view_item'             => sprintf( _x('نمایش %s', 'post_type:consultant', 'wpplus'), $upperSingular),
    'view_items'            => sprintf( _x('نمایش %s', 'post_type:consultant', 'wpplus'), $upperPlural),
];
$consultant->setLabels($labels);

// slug
$withFront = false;
$consultant->setSlug('consultant', $withFront);
$consultant->setHierarchical(true);
$consultant->setRest('consultant');
// $consultant->setRootOnly('/{post-type}/{post-name}');

// single
$consultant->forceDisableGutenberg();
$consultant->setSupports(['title', 'thumbnail', 'editor', 'excerpt', 'author', 'comments', 'page-attributes', 'post-formats']);
// $consultant->featureless();

// archive
// $consultant->addColumn('Photo', true, 'Photo3', function($value) {
//     return 'asdsad';
// });


// meta data
// $consultant->setModelClass(\App\Models\Consultant::class)
//             ->saveTitleAs(function (\App\Models\Consultant $consultant, \TypeRocket\Http\Request $request) {
//                 return $consultant->data->$request->getDataPost('post_title');
//             });