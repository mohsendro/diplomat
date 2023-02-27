<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>

<h1>صفحه سینگل مقاله <span>: <?php echo $post->post_title; ?></span></h1> 
<hr>

<?php
    echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'alignleft' ) );
    echo "<br>";
    echo $post->post_content; 
?>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>
