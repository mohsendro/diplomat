<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>

<!DOCTYPE html>
<html lang="<?php echo get_bloginfo('language'); ?>" 
      dir="<?php if( is_rtl() ) { echo 'rtl'; } else { echo 'ltr'; } ?>"
>
<head>
    <meta charset="<?php echo get_bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            if( get_bloginfo('description') ) {
                echo get_bloginfo('name') . ' | ' . get_bloginfo('description');
            } else {
                echo get_bloginfo('name');
            }
        ?>
    </title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >