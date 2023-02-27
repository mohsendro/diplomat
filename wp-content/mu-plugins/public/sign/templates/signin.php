<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly. ?>

<div id="notification" style="margin:20px auto; padding:10px; border-right:3px solid red; border-radius:5px; background-color:#f7cdcd; display:none;"></div>

<form action="" method="POST" name="signin_form" id="signin-form">

  <label for="user-login">شماره همراه یا نشانی ایمیل</label><br>
  <input type="text" name="user_login" id="user-login" class="user-login" value="" size="20" autocapitalize="off" ><br>

  <label for="user-pass">رمز عبور</label><br>
  <input type="password" name="user_pass" id="user-pass" class="user-pass" value="" size="20">

  <p class="forgetmenot">
    <label for="user-rememberme">مرا به خاطر بسپار</label>
    <input type="checkbox" name="user_rememberme" id="user-rememberme" class="user-rememberme" value="">
  </p>

  <button type="button" name="signin_submit" id="signin-submit" class="signin-submit" onclick="signinSubmit()" >ورود</button>

</form>

<a href="#" id="signin-btn" style="width: auto; margin: 20px auto 30px; text-align: center; color: #fff; background: #4e4edb; padding: 10px; border-radius: 5px; display: none;">حساب کاربری</a>