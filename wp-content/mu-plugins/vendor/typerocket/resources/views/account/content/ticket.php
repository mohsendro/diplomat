<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>
<h1>Ticket</h1>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4" style="background: #d3f3ff;">
            <?php include plugin_dir_path(__FILE__) . '../tabs.php'; ?>
		</div>
		<div class="col-md-8" style="background: #a3d1f1;">
            <?php do_shortcode('[nirweb_ticket]'); ?>
		</div>
	</div>
</div>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>