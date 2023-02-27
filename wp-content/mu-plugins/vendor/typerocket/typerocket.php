<?php
/**
* @deprecated : Typerocket Custom Code
*/

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

// Register New Directory Active Theme
if ( ! defined( 'TYPEROCKET_DIR_PATH' ) ) define( 'TYPEROCKET_DIR_PATH' , plugin_dir_path( __FILE__ ) ) ;
if ( ! defined( 'TYPEROCKET_DIR_URL' ) ) define( 'TYPEROCKET_DIR_URL' , plugin_dir_url( __FILE__ ) ) ;


// Register New Directory Active Theme
// register_theme_directory( dirname( __FILE__ ) . '/resources/themes/' );

function wpplus_template_directory_uri($template_dir_uri) {

    return str_replace('/wp-content/themes/diplomat', '/wp-content/mu-plugins/vendor/typerocket/resources/themes/', $template_dir_uri);

}
function wpplus_template_directory($template_dir) {

    return str_replace('/wp-content/themes/diplomat', '/wp-content/mu-plugins/vendor/typerocket/resources/themes/', $template_dir);

}
function wpplus_stylesheet_directory_uri($stylesheet_dir_uri) {

    return str_replace('/wp-content/themes/diplomat', '/wp-content/mu-plugins/vendor/typerocket/resources/themes/', $stylesheet_dir_uri);

}
function wpplus_stylesheet_directory($stylesheet_dir) {

    return str_replace('/wp-content/themes/diplomat', '/wp-content/mu-plugins/vendor/typerocket/resources/themes/', $stylesheet_dir);

}

add_filter('template_directory_uri', 'wpplus_template_directory_uri');
add_filter('template_directory', 'wpplus_template_directory');
add_filter('stylesheet_directory_uri', 'wpplus_stylesheet_directory_uri');
add_filter('stylesheet_directory', 'wpplus_stylesheet_directory');
// var_dump( get_template_directory() );

function wpplus_custom_route() {

	$url = $_SERVER['REQUEST_URI']; 
	if(
		! strpos( $url, 'account') ||
		! strpos( $url, 'signon') ||
		! strpos( $url, 'test')
	) {
		
		// add_action('template_redirect', 'wpplus_hierarchy_template');
		// add_filter( 'index_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'frontpage_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'home_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'page_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'paged_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'archive_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'taxonomy_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'category_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'tag_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'date_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'author_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'search_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'singular_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'single_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'embed_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'attachment_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( 'privacypolicy_template', 'wpplus_hierarchy_template', 10, 3 );
		// add_filter( '404_template', 'wpplus_hierarchy_template', 10, 3 );
	}

}
// wpplus_custom_route();

function wpplus_hierarchy_template() {

    $templates = (new Brain\Hierarchy\Hierarchy())->templates();
    
    foreach($templates as $template) {

    //   $path = get_theme_file_path("/{$template}.php");
      $path = plugin_dir_path( __FILE__) . "resources/themes/{$template}.php";
      if ( file_exists( $path ) ) {
		
        require $path;
        exit();

      }

    }
    
}
// add_action('template_redirect', 'wpplus_hierarchy_template');


// Register Theme Features
function wpplus_theme_features()  {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat' ) );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// Add theme support for custom CSS in the TinyMCE visual editor
	add_editor_style();

	// Add theme support for Translation
	load_theme_textdomain( 'wpplus', get_template_directory() . '/language' );

}
add_action('after_setup_theme', 'wpplus_theme_features') ;


// Snippets
require_once plugin_dir_path(__FILE__) . 'functions/snippets/wp-rewrite-rules.php';
require_once plugin_dir_path(__FILE__) . 'functions/snippets/optimize.php';
require_once plugin_dir_path(__FILE__) . 'functions/snippets/enqueue.php';

// Post Types
require_once plugin_dir_path(__FILE__) . 'functions/posttype/page.php';
require_once plugin_dir_path(__FILE__) . 'functions/posttype/post.php';
require_once plugin_dir_path(__FILE__) . 'functions/posttype/advertising.php';
require_once plugin_dir_path(__FILE__) . 'functions/posttype/project.php';
require_once plugin_dir_path(__FILE__) . 'functions/posttype/consultant.php';

// Taxonomies
require_once plugin_dir_path(__FILE__) . 'functions/taxonomy/category.php';
require_once plugin_dir_path(__FILE__) . 'functions/taxonomy/tag.php';
require_once plugin_dir_path(__FILE__) . 'functions/taxonomy/advertising_cat.php';

// Meta Boxes
require_once plugin_dir_path(__FILE__) . 'functions/metabox/user.php';
require_once plugin_dir_path(__FILE__) . 'functions/metabox/page.php';
require_once plugin_dir_path(__FILE__) . 'functions/metabox/post.php';
require_once plugin_dir_path(__FILE__) . 'functions/metabox/advertising.php';
require_once plugin_dir_path(__FILE__) . 'functions/metabox/project.php';
require_once plugin_dir_path(__FILE__) . 'functions/metabox/consultant.php';

// Resource
// require_once plugin_dir_path(__FILE__) . 'functions/metabox/user.php';

// Menu
require_once plugin_dir_path(__FILE__) . 'functions/menu/forms.php';
require_once plugin_dir_path(__FILE__) . 'functions/menu/expert.php';
require_once plugin_dir_path(__FILE__) . 'functions/menu/request.php';
require_once plugin_dir_path(__FILE__) . 'functions/menu/counseling.php';

// Table
// require_once plugin_dir_path(__FILE__) . 'functions/table/forms.php';
// require_once plugin_dir_path(__FILE__) . 'functions/table/expert.php';
// require_once plugin_dir_path(__FILE__) . 'functions/table/request.php';
// require_once plugin_dir_path(__FILE__) . 'functions/table/counseling.php';