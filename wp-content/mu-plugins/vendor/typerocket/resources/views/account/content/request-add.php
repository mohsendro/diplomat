<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>
<h1>Add Request</h1>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4" style="background: #d3f3ff;">
            <?php include plugin_dir_path(__FILE__) . '../tabs.php'; ?>
		</div>
		<div class="col-md-8" style="background: #a3d1f1;">
			
			<a href="<?php echo get_home_url() . '/account/request/'?>"><button class="btn" style="border: 1px solid #3858e9; color: #3858e9;">بازگشت به درخواست‌ها</button></a><hr>
			<h5>اگر به دنبال ملک خاصی هستید، از طریق فرم زیر با ما در ارتباط باشید</h5> 

			<?php
                if( $response ) {

                    switch ( $response ) {
                        case $response['type'] == 100:
                            echo "<div style='background: #fbfad8; padding: 10px; border-right: 2px solid #f3b300;'>" . $response['message'] . "</div>";
                            break;
            
                        case $response['type'] == 200:
                            echo "<div style='background: #d8fbd8; padding: 10px; border-right: 2px solid #4dc54d;'>" . $response['message'] . "</div>";
                            break;
            
                        case $response['type'] == 300:
                            echo "<div style='background: #d8fbd8; padding: 10px; border-right: 2px solid #4dc54d;'>" . $response['message'] . "</div>";
                            break;
            
                        case $response['type'] == 400:
                            echo "<div style='background: #fbd8d8; padding: 10px; border-right: 2px solid #f3000b;'>" . $response['message'] . "</div>";
                            break;
            
                        case $response['type'] == 500:
                            echo "<div style='background: #fbd8d8; padding: 10px; border-right: 2px solid #f3000b;'>" . $response['message'] . "</div>";
                            break;    
            
                        default:
                            # code...
                            break;
                    }
            
                }
                $user_meta = get_user_meta( $user_info->data->ID );
            ?>
			
            <?php $EditForm = tr_form('post'); ?>   
                <?php $EditFormButton = 'درخواست ملک جدید'; ?> 
                <?php echo $EditForm->open(); ?>
                    <?php echo tr_field_nonce(); ?>

                    <label for="request-title">عنوان درخواست</label><br>
                    <input type="text" id="request-title" name="request_title"><br>

					<label for="request-description">توضیحات درخواست</label><br>
					<textarea name="request_description" id="request-description" cols="30" rows="10"></textarea><br>
					<em style="display: block;margin-top: 10px;font-size: 12px;font-style: normal;color: red;">لطفاً اطلاعات کاملی از ملک مد نظر خئد را وارد نمایید</em>

                    <!-- <input type="submit" value="درخواست ملک جدید"> -->
            <?php echo $EditForm->close($EditFormButton); ?>

		</div>
	</div>
</div>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>