<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>

<h1>صفحه کاربران <span>: <?php echo $count; ?> نتیجه</span></h1> 
<hr>

<h3>کاربران:</h3><br>
<?php
    if( !$users ) echo "کاربری وجود ندارد"; 
    foreach ($users as $user) {

        // foreach( $user->meta->dip_capabilities as $role => $cap ) {
        //     $role = $role;
        // }

        // if( $role != 'administrator' ) {
            echo $user->ID . ' | ' ;
            echo "<a href='" . home_url('author/'.$user->user_login) . "'>" . $user->display_name . "</a>"; //var_dump($user->meta);
            echo "<br>";
        // }

    }
    echo "<hr>";
?>

<?php
    require TYPEROCKET_DIR_PATH . '/functions/snippets/pagination.php';
    // pagination_post($count, $total_page, 2, $current_page);
    insertPagination(home_url('author/page'), $current_page, $total_page, true);
?>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>
