<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly. ?>

<div id="notification" style="margin:20px auto; padding:10px; border-right:3px solid red; border-radius:5px; background-color:#f7cdcd; display:none;"></div>

<form action="" method="POST" name="lostpassword_form" id="lostpassword-form">

  <div id="step-one" style="display: block;">
    <label for="user-login">شماره همراه یا نشانی ایمیل</label><br>
    <input type="text" name="user_login" id="user-login" class="user-login" value="" size="20" autocapitalize="off" ><br>
    
    <button type="button" name="lostpassword_submit_one" id="lostpassword-submit-one" class="lostpassword-submit" onclick="lostpasswordSubmit('stepOne')" >ارسال کد</button>
    <!-- <button type="button" id="lostpassword-back-one" class="lostpassword-back">برگشت</button> -->
  </div>

  <div id="step-two" style="display: none;">
    <label for="user-code">کد تایید</label><br>
    <input type="number" name="user_code" id="user-code" class="user-login" min="0" max="9999" value="" size="20" autocapitalize="off" ><br>

    <button type="button" name="lostpassword_submit_two" id="lostpassword-submit-two" class="lostpassword-submit" onclick="lostpasswordSubmit('stepTwo')" >تایید کد</button>
    <!-- <button type="button" id="lostpassword-back-two" class="lostpassword-back">برگشت</button> -->
  </div>

  <div id="step-three" style="display: none;">
    <!-- <label for="first-name">نام</label><br>
    <input type="text" name="first_name" id="first-name" class="first-name" value="" size="20" autocapitalize="off" ><br>

    <label for="last-name">نام خانوادگی</label><br>
    <input type="text" name="last_name" id="last-name" class="last-name" value="" size="20" autocapitalize="off" ><br> -->

    <label for="password">رمز عبور جدید</label><br>
    <input type="password" name="password" id="password" class="password"  value="" size="20" autocapitalize="off" ><br>

    <button type="button" name="lostpassword_submit_three" id="lostpassword-submit-three" class="lostpassword-submit" onclick="lostpasswordSubmit('stepThree')" >تغییر</button>
    <!-- <button type="button" id="lostpassword-back-three" class="lostpassword-back">برگشت</button> -->

  </div>
  
</form>

<a href="#" id="lostpassword-btn" style="width: auto; margin: 20px auto 30px; text-align: center; color: #fff; background: #4e4edb; padding: 10px; border-radius: 5px; display: none;">صفحه ورود</a>