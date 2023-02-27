<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

?>
<h1>Tabs</h1>

<ul>
    <li><a href="<?php echo home_url('/account/')?>">پیشخوان</a></li>
    <li><a href="<?php echo home_url('/account/vip/')?>">آگهی‌های VIP</a></li>
    <li><a href="<?php echo home_url('/account/wishlist/')?>">علاقمندی‌ها</a></li>
    <li><a href="<?php echo home_url('/account/comment/')?>">نظرات من</a></li>
    <li><a href="<?php echo home_url('/account/ticket/')?>">ثبت تیکت</a></li>
    <li><a href="<?php echo home_url('/account/expert/')?>">درخواست کارشناسی</a></li>
    <li><a href="<?php echo home_url('/account/request/')?>">درخواست ملک</a></li>
    <li><a href="<?php echo home_url('/account/edit/')?>">اطلاعات من</a></li>
    <li><a href="<?php echo home_url('/account/')?>">خروج</a></li>
</ul>


<?php get_header(); ?>

<?php the_content(); ?>

<?php get_footer(); ?>