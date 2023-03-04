<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>
<h1>Expert</h1>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4" style="background: #d3f3ff;">
            <?php include plugin_dir_path(__FILE__) . '../tabs.php'; ?>
		</div>
		<div class="col-md-8" style="background: #a3d1f1;">

            <a href="<?php echo get_home_url() . '/account/expert?action=add'?>"><button class="btn" style="border: 1px solid #3858e9; color: #3858e9;">درخواست جدید</button></a><hr>
			<h5>درخواست های من<span>: <?php echo $count; ?> نتیجه</span></h5> 
            <?php
				if( !$posts ) echo "محتوایی وجود ندارد"; 
				foreach ($posts as $post) {
					echo $post->ID . ' | ' ;
					echo $post->post_title . ' | ' ;
					if( $post->post_status ) {
                        echo "<span style='color: #238d00;'>بررسی شده</span>";
                    } else {
                        echo "<span style='color: #e10000;'>بررسی نشده</span>";
                    }
					echo "<br>";
				}
			?>

			<?php
				require TYPEROCKET_DIR_PATH . '/functions/snippets/pagination.php';
				// pagination_post($count, $total_page, 2, $current_page);
				insertSearchPagination(home_url('account/expert/'), $current_page, $total_page, true);
			?>

		</div>
	</div>
</div>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>