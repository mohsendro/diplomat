<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>

<h1>صفحه نتایج جستجو <span>: <?php echo $count; ?> نتیجه</span></h1> 
<hr>

<h3>نوشته‌ها:</h3><br>
<?php
    if( !$posts ) echo "محتوایی وجود ندارد"; 
    foreach ($posts as $post) {
        echo $post->ID . ' | ' ;
        echo "<a href='" . get_permalink($post->ID) . "'>" . $post->post_title . "</a>";
        echo "<br>";
    }
    echo "<hr>";
?>

<?php
    require TYPEROCKET_DIR_PATH . '/functions/snippets/pagination.php';
    // pagination_post($count, $total_page, 2, $current_page);
    insertSearchPagination(home_url('search/'.$param), $current_page, $total_page, true);
?>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>
