<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>

<h1>صفحه سینگل کاربر <span>: <?php echo $user->display_name; ?></span></h1> 
<hr>

<?php
    echo $user->user_login; 
    echo "<br>";
    echo $user->display_name; 
    echo "<br>";
    echo $user->user_email; 
    echo "<br>";
    foreach( $user->meta->dip_capabilities as $key => $value ) {
        echo $key;
    }
    echo "<hr>";
    // var_dump($user->meta);
?>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>
