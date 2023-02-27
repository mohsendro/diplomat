<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>

<h1>صفحه اصلی</h1>
<hr>

<h3>نوشته‌ها:</h3><br>
<?php

    if( $posts ) 
    foreach ($posts as $post) {
        echo $post->ID . ' | ' . $post->post_title;
        echo "<br>";
    }

?>
<hr>

<h3>آگهی‌ها:</h3><br>
<?php

    if( $advertisings ) 
    foreach ($advertisings as $advertising) {
        echo $advertising->ID . ' | ' . $advertising->post_title;
        echo "<br>";
    }

?>
<hr>

<h3>پروژه‌ها:</h3><br>
<?php

    if( $projects ) 
    foreach ($projects as $project) {
        echo $project->ID . ' | ' . $project->post_title;
        echo "<br>";
    }

?>
<hr>

<h3>مشاوره‌ها:</h3><br>
<?php

    if( $consultants ) 
    foreach ($consultants as $consultant) {
        echo $consultant->ID . ' | ' . $consultant->post_title;
        echo "<br>";
    }

?>
<hr>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>
