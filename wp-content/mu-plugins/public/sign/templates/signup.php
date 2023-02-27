<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly. ?>

<div id="notification" style="margin:20px auto; padding:10px; border-right:3px solid red; border-radius:5px; background-color:#f7cdcd; display:none;"></div>

<form action="" method="POST" name="signup_form" id="signup-form">

  <div id="step-one" style="display: block;">
    <label for="user-login">شماره همراه یا نشانی ایمیل</label><br>
    <input type="text" name="user_login" id="user-login" class="user-login" value="" size="20" autocapitalize="off" ><br>
    
    <button type="button" name="signup_submit_one" id="signup-submit-one" class="signup-submit" onclick="signupSubmit('stepOne')" >ارسال کد</button>
    <!-- <button type="button" id="signup-back-one" class="signup-back">برگشت</button> -->
  </div>

  <div id="step-two" style="display: block;">
    <label for="user-code">کد تایید</label><br>
    <input type="number" name="user_code" id="user-code" class="user-login" min="0" max="9999" value="" size="20" autocapitalize="off" ><br>

    <button type="button" name="signup_submit_two" id="signup-submit-two" class="signup-submit" onclick="signupSubmit('stepTwo')" >تایید کد</button>
    <!-- <button type="button" id="signup-back-two" class="signup-back">برگشت</button> -->
  </div>

  <div id="step-three" style="display: block;">
    <label for="first-name">نام</label><br>
    <input type="text" name="first_name" id="first-name" class="first-name" value="" size="20" autocapitalize="off" ><br>

    <label for="last-name">نام خانوادگی</label><br>
    <input type="text" name="last_name" id="last-name" class="last-name" value="" size="20" autocapitalize="off" ><br>

    <label for="password">رمز عبور</label><br>
    <input type="password" name="password" id="password" class="password"  value="" size="20" autocapitalize="off" ><br>

    <button type="button" name="signup_submit_three" id="signup-submit-three" class="signup-submit" onclick="signupSubmit('stepThree')" >عضویت</button>
    <!-- <button type="button" id="signup-back-three" class="signup-back">برگشت</button> -->
  </div>
  
</form>

<a href="#" id="signup-btn" style="width: auto; margin: 20px auto 30px; text-align: center; color: #fff; background: #4e4edb; padding: 10px; border-radius: 5px; display: none;">حساب کاربری</a>