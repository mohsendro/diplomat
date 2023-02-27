<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Post Type: project - پروژه

// general
$project = tr_post_type('project', 'projects');
$project->setIcon('dashicons-archive');
$project->setPosition(5);
$project->setModelClass(\App\Models\Project::class);
$project->setHandler(\App\Controllers\ProjectController::class);

// labels
$upperPlural = 'پروژه‌ها';
$upperSingular = 'پروژه';
$lowerSingular = 'پروژه';
$pluralLower = 'پروژه‌ها';
$labels = [
    'add_new'               => _x('افزودن پروژه', 'post_type:project', 'wpplus'),
    'all_items'             => sprintf( _x('همهٔ %s', 'post_type:project', 'wpplus'), $upperPlural),
    'archives'              => sprintf( _x('%s پروژه‌ها', 'post_type:project', 'wpplus'), $upperSingular),
    'add_new_item'          => sprintf( _x('%s تازه', 'post_type:project', 'wpplus'), $upperSingular),
    'attributes'            => sprintf( _x('ویژگی %s', 'post_type:project', 'wpplus'), $upperSingular),
    'edit_item'             => sprintf( _x('ویرایش %s', 'post_type:project', 'wpplus'), $upperSingular),
    'filter_items_list'     => sprintf( _x('فیلتر %s list %s', 'post_type:project', 'wpplus'), $pluralLower, $upperSingular),
    'insert_into_item'      => sprintf( _x('درج در %s', 'post_type:project', 'wpplus'), $lowerSingular),
    'item_published'        => sprintf( _x('%s انتشار.', 'post_type:project', 'wpplus'), $upperSingular),
    'item_published_privately' => sprintf( _x('%s انتشار خصوصی.', 'wpplus'), $upperSingular),
    'item_updated'          => sprintf( _x('%s بروزرسانی.', 'post_type:project', 'wpplus'), $upperSingular),
    'item_reverted_to_draft'=> sprintf( _x('%s انتقال به پیشنویس.', 'post_type:project', 'wpplus'), $upperSingular),
    'item_scheduled'        => sprintf( _x('%s برنامه ریزی.', 'post_type:project', 'wpplus'), $upperSingular),
    'items_list'            => sprintf( _x('%s لیست', 'post_type:project', 'wpplus'), $upperPlural),
    'menu_name'             => sprintf( _x('%s',  'post_type:project:admin menu', 'wpplus'), $upperPlural),
    'name'                  => sprintf( _x('%s', 'post_type:project:post type general name', 'wpplus'), $upperPlural),
    'name_admin_bar'        => sprintf( _x('%s', 'post_type:project:add new from admin bar', 'wpplus'), $upperSingular),
    'items_list_navigation' => sprintf( _x('%s list navigation', 'post_type:project', 'wpplus'), $upperPlural),
    'new_item'              => sprintf( _x('جدید %s', 'post_type:project', 'wpplus'), $upperSingular),
    'not_found'             => sprintf( _x('هیچ پروژه یافت نشد', 'post_type:project', 'wpplus'), $pluralLower),
    'not_found_in_trash'    => sprintf( _x('یافت نشد %s در سطل زباله', 'post_type:project', 'wpplus'), $pluralLower),
    'parent_item_colon'     => sprintf( _x("مادر %s:", 'post_type:project', 'wpplus'), $upperPlural),
    'search_items'          => sprintf( _x('جستجو %s', 'post_type:project', 'wpplus'), $upperPlural),
    'singular_name'         => sprintf( _x('%s',  'post_type:project:post type singular name', 'wpplus'), $upperSingular),
    'uploaded_to_this_item' => sprintf( _x('بارگذاری در %s', 'post_type:project', 'wpplus'), $lowerSingular),
    'view_item'             => sprintf( _x('نمایش %s', 'post_type:project', 'wpplus'), $upperSingular),
    'view_items'            => sprintf( _x('نمایش %s', 'post_type:project', 'wpplus'), $upperPlural),
];
$project->setLabels($labels);

// slug
$withFront = false;
$project->setSlug('project', $withFront);
$project->setHierarchical(true);
$project->setRest('project');
// $project->setRootOnly('/{post-type}/{post-name}');

// single
$project->forceDisableGutenberg();
$project->setSupports(['title', 'thumbnail', 'editor', 'excerpt', 'author', 'comments', 'page-attributes', 'post-formats']);
// $project->featureless();

// archive
// $project->addColumn('Photo', true, 'Photo3', function($value) {
//     return 'asdsad';
// });


// meta data
// $project->setModelClass(\App\Models\Project::class)
//             ->saveTitleAs(function (\App\Models\Project $project, \TypeRocket\Http\Request $request) {
//                 return $project->data->$request->getDataPost('post_title');
//             });