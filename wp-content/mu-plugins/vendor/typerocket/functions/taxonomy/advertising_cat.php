<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Taxonomy: advertising_cat - دسته آگهی

// general
$advertising_cat = tr_taxonomy('advertising_cat', 'advertising_cats');
$advertising_cat->addPostType('advertising');
// $advertising = tr_post_type('advertising');
// $advertising_cat->apply($advertising);
$advertising->setModelClass(\App\Models\AdcertisingCat::class);
$advertising->setHandler(\App\Controllers\AdcertisingCatController::class);

// labels
$upperPlural = 'دسته‌ها';
$upperSingular = 'دسته';
$lowerSingular = 'دسته';
$lowerPlural = 'دسته‌ها';
$labels = [
    'add_new_item'               => sprintf( _x( 'افزودن %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperSingular),
    'add_or_remove_items'        => sprintf( _x( 'افزودن یا حذف %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $lowerPlural),
    'all_items'                  => sprintf( _x( 'همهٔ %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperPlural),
    'back_to_items'              => sprintf( _x( '← برگشت به %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $lowerPlural),
    'choose_from_most_used'      => sprintf( _x( 'انتخاب از بیشترین موارد %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $lowerPlural),
    'edit_item'                  => sprintf( _x( 'ویرایش %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperSingular),
    'name'                       => sprintf( _x( '%s', 'taxonomy:advertising_cat:taxonomy general name', 'your-custom-domain' ), $upperPlural),
    'menu_name'                  => sprintf( _x( '%s', 'taxonomy:advertising_cat:admin menu', 'your-custom-domain' ), $upperPlural),
    'new_item_name'              => sprintf( _x( 'نام %s جدید', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperSingular),
    'no_terms'                   => sprintf( _x( 'بدون %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $lowerPlural),
    'not_found'                  => sprintf( _x( 'هیچ %s یافت نشد.', 'taxonomy:advertising_cat', 'your-custom-domain' ), $lowerPlural),
    'parent_item'                => sprintf( _x( '%s مادر', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperSingular),
    'parent_item_colon'          => sprintf( _x( 'مادر %s:', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperSingular),
    'popular_items'              => sprintf( _x( 'محبوب %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperPlural),
    'search_items'               => sprintf( _x( 'جستجو %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperPlural),
    'separate_items_with_commas' => sprintf( _x( 'جداسازی %s با کاما', 'taxonomy:advertising_cat', 'your-custom-domain' ), $lowerPlural),
    'singular_name'              => sprintf( _x( '%s', 'taxonomy:advertising_cat:taxonomy singular name', 'your-custom-domain' ), $upperSingular),
    'update_item'                => sprintf( _x( 'بروزرسانی %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperSingular),
    'view_item'                  => sprintf( _x( 'نمایش %s', 'taxonomy:advertising_cat', 'your-custom-domain' ), $upperSingular),
];
$advertising_cat->setLabels($labels);

// slug
$withFront = false;
$advertising_cat->setSlug('advertising_cat', $withFront);
$advertising_cat->setHierarchical();
$advertising_cat->setRest('advertising_cat');

// single


// archive
$advertising_cat->showQuickEdit(true);
$advertising_cat->showPostTypeAdminColumn(true);


// meta data
