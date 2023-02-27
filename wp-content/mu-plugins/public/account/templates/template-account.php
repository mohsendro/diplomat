<?php

echo "صفحه حساب کاربری" . "<br>";
echo $_SERVER['REQUEST_URI'];


if( is_user_logged_in() ){
    echo "<br>" . 'شما لاگین هستید';
} else {
    echo "<br>" . 'باید لاگین شوید';
}


$url_parse = $_SERVER['REQUEST_URI'];


if( strpos( $url_parse, 'account/order' ) ) {
    echo "<br>" . 'صفحه سفارشات شما';
}
if( strpos( $url_parse, 'account/edit' ) ) {
    echo "<br>" . 'صفحه ویرایشات شما';
}