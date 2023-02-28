<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>
<h1>Edit</h1>

<?php echo do_shortcode('[dm-edit-phone]'); ?>

<form action="" method="post" id="account-edit">

    <?php 
        $user_info = wp_get_current_user();
        $user_meta = get_user_meta( $user_info->data->ID );
    ?>

    <label for="user-login">نام کاربری</label><br>
    <input type="text" id="user-login" name="user-login" value="<?php echo $user_info->data->user_login; ?>" readonly><br>
    <em style="display: block;margin-top: 10px;font-size: 12px;font-style: normal;color: red;">نام کاربری هنگام ثبت نام ایجاد می شود (شناسه&zwnj; نمی&zwnj;تواند عوض شود)</em>

    <label for="display-name">نام نمایشی</label><br>
    <input type="text" id="display-name" name="display-name" value="<?php echo $user_info->data->display_name; ?>" readonly><br>
    <em style="display: block;margin-top: 10px;font-size: 12px;font-style: normal;color: red;">اسم شما به این صورت در حساب کاربری و نظرات دیده خواهد شد. (بصورت پیشفرض نام و نام خانوادگی نمایش داده خواهد شد)</em>
    
    <label for="first-name">نام</label><br>
    <input type="text" id="first-name" name="first-name" value="<?php echo $user_meta['first_name'][0]; ?>"><br>

    <label for="last-name">نام خانوادگی</label><br>
    <input type="text" id="last-name" name="last-name" value="<?php echo $user_meta['last_name'][0]; ?>"><br>

    <label for="email">آدرس ایمیل </label><br>
    <input type="email" id="email" name="email" value="<?php echo $user_info->data->user_email; ?>"><br>

    <input type="submit" value="ویرایش اطلاعات">
</form>

<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>