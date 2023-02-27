<?php
/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

// Run Custom Controller Method
// $controller = new \App\Controllers\PostController;
// $controller = $controller::test(); // test == method  /* Build the model inside the method and don't give it as argument input to the method  */

// tr_route()->get()->match('path')->do('method@Controller');
// tr_route()->post()->match('path')->do('method@Controller');
// tr_route()->put()->match('path')->do('method@Controller');
// tr_route()->delete()->match('path')->do('method@Controller');
// tr_route()->any()->match('path')->do('method@Controller');

// Index or Front-page
tr_route()->get()->match('/')->do('index@FronPageController');

// Blog or Post
tr_route()->get()->match('/blog')->do('home@PostController');
// tr_route()->get()->match('/blog/page')->do('page@PostController');
tr_route()->get()->match('/blog/page/([^\/]+)', ['number'])->do('archive@PostController');
// tr_route()->get()->match('/category')->do('page@CategoryController');
tr_route()->get()->match('/category/([^\/]+)', ['cat_name'])->do('category@CategoryController');
tr_route()->get()->match('/category/([^\/]+)/page/([^\/]+)', ['cat_name', 'number'])->do('archive@CategoryController');
// tr_route()->get()->match('/tag')->do('page@TagController');
tr_route()->get()->match('/tag/([^\/]+)', ['tag_name'])->do('tag@TagController');
tr_route()->get()->match('/tag/([^\/]+)/page/([^\/]+)', ['tag_name', 'number'])->do('archive@TagController');
tr_route()->get()->match('/blog/([^\/]+)', ['slug'])->do('single@PostController'); // single

// Advertising
tr_route()->get()->match('/advertising')->do('home@AdvertisingController');
// tr_route()->get()->match('/advertising/page')->do('page@AdvertisingController');
tr_route()->get()->match('/advertising/page/([^\/]+)', ['number'])->do('archive@AdvertisingController');
// tr_route()->get()->match('/advertising-cat')->do('page@AdcertisingCatController');
tr_route()->get()->match('/advertising-cat/([^\/]+)', ['cat_name'])->do('category@AdcertisingCatController');
tr_route()->get()->match('/advertising-cat/([^\/]+)/page/([^\/]+)', ['cat_name', 'number'])->do('archive@AdcertisingCatController');
tr_route()->get()->match('/advertising/([^\/]+)', ['slug'])->do('single@AdvertisingController'); // single

// Project
tr_route()->get()->match('/project')->do('home@ProjectController');
// tr_route()->get()->match('/project/page')->do('page@ProjectController');
tr_route()->get()->match('/project/page/([^\/]+)', ['number'])->do('archive@ProjectController');
// tr_route()->get()->match('/project-cat')->do('page@ProjectCatController');
// tr_route()->get()->match('/project-cat/([^\/]+)', ['cat_name'])->do('category@ProjectCatController');
// tr_route()->get()->match('/project-cat/([^\/]+)/page/([^\/]+)', ['cat_name', 'number'])->do('archive@ProjectCatController');
tr_route()->get()->match('/project/([^\/]+)', ['slug'])->do('single@ProjectController'); // single

// Consultant
tr_route()->get()->match('/consultant')->do('home@ConsultantController');
// tr_route()->get()->match('/consultant/page')->do('page@ConsultantController');
tr_route()->get()->match('/consultant/page/([^\/]+)', ['number'])->do('archive@ConsultantController');
// tr_route()->get()->match('/consultant-cat')->do('page@ConsultantCatController');
// tr_route()->get()->match('/consultant-cat/([^\/]+)', ['cat_name'])->do('category@ConsultantCatController');
// tr_route()->get()->match('/consultant-cat/([^\/]+)/page/([^\/]+)', ['cat_name', 'number'])->do('archive@ConsultantCatController');
tr_route()->get()->match('/consultant/([^\/]+)', ['slug'])->do('single@ConsultantController'); // single

// Author
tr_route()->get()->match('/author')->do('home@UserController');
tr_route()->get()->match('/author/page/([^\/]+)', ['number'])->do('archive@UserController');
tr_route()->get()->match('/author/([^\/]+)', ['slug'])->do('single@UserController'); // single

// Metadata Archive
// tr_route()->get()->match('/project')->do('home@ProjectController');

// Search
tr_route()->get()->match('/search/([^\/]+)', ['param'])->do('archive@SearchController');

// Account
tr_route()->get()->match('/login')->do('login@AccountController')->middleware('LoggedInUser');
tr_route()->get()->match('/account')->do('account@AccountController')->middleware('LoggedInUser');
tr_route()->get()->match('/account/([^\/]+)', ['endpoint'])->do('account@AccountController')->middleware('LoggedInUser');