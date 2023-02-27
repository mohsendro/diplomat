<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>
<h1>Edit</h1>

<?php echo do_shortcode('[dm-edit-phone]'); ?>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>