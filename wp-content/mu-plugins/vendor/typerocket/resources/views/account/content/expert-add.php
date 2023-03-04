<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>
<h1>Add Expert</h1>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4" style="background: #d3f3ff;">
            <?php include plugin_dir_path(__FILE__) . '../tabs.php'; ?>
		</div>
		<div class="col-md-8" style="background: #a3d1f1;">
			
			<a href="<?php echo get_home_url() . '/account/expert/'?>"><button class="btn" style="border: 1px solid #3858e9; color: #3858e9;">بازگشت به درخواست‌ها</button></a>

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
                <?php $EditFormButton = 'ویرایش اطلاعات'; ?> 
                <?php echo $EditForm->open(); ?>
                    <?php echo tr_field_nonce(); ?>
                    <input type="hidden" name="user_id" value="<?php echo $user_info->data->ID; ?>">

                    <label for="user-login">نام کاربری</label><br>
                    <input type="text" id="user-login" name="user_login" value="<?php echo $user_info->data->user_login; ?>" readonly><br>
                    <em style="display: block;margin-top: 10px;font-size: 12px;font-style: normal;color: red;">نام کاربری هنگام ثبت نام ایجاد می شود (شناسه&zwnj; نمی&zwnj;تواند عوض شود)</em>

                    <label for="display-name">نام نمایشی</label><br>
                    <input type="text" id="display-name" name="display_name" value="<?php echo $user_info->data->display_name; ?>"><br>
                    <em style="display: block;margin-top: 10px;font-size: 12px;font-style: normal;color: red;">اسم شما به این صورت در حساب کاربری و نظرات دیده خواهد شد. (بصورت پیشفرض نام و نام خانوادگی نمایش داده خواهد شد)</em>
                    
                    <label for="first-name">نام</label><br>
                    <input type="text" id="first-name" name="first_name" value="<?php echo $user_meta['first_name'][0]; ?>"><br>

                    <label for="last-name">نام خانوادگی</label><br>
                    <input type="text" id="last-name" name="last_name" value="<?php echo $user_meta['last_name'][0]; ?>"><br>

                    <label for="email">آدرس ایمیل </label><br>
                    <input type="email" id="email" name="email" value="<?php echo $user_info->data->user_email; ?>"><br>

                    <!-- <input type="submit" value="ویرایش اطلاعات"> -->
            <?php echo $EditForm->close($EditFormButton); ?>

		</div>
	</div>
</div>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>