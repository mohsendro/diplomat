<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>
<h1>Comment</h1>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4" style="background: #d3f3ff;">
            <?php include plugin_dir_path(__FILE__) . '../tabs.php'; ?>
		</div>
		<div class="col-md-8" style="background: #a3d1f1;">
            
            <h5>نظرات من<span>: <?php echo $count; ?> نتیجه</span></h5> 
            <?php
				if( !$posts ) echo "محتوایی وجود ندارد"; 
				foreach ($posts as $post) {
					echo $post->comment_ID . ' | ' ;
					echo "<a href='" . get_permalink($post->comment_post_ID) . "' target='_blank'>" . $post->comment_content . "</a>" . ' | ' ;
					echo get_post_type($post->comment_post_ID);
					echo "<br>";
				}
			?>

			<?php
				require TYPEROCKET_DIR_PATH . '/functions/snippets/pagination.php';
				// pagination_post($count, $total_page, 2, $current_page);
				insertSearchPagination(home_url('account/comment/'), $current_page, $total_page, true);
			?>

		</div>
	</div>
</div>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>