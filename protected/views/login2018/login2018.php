<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<form method="post" action="" >
<img src="../../../commartv02/images/logologo.png" />
<div class='box'>
<p style="color: white" class='field'><?php if($msg!=""){
  echo $msg;
} ?></p>
  <div class='box-form'>
    <div class='box-login-tab'></div>
    <div class='box-login-title'>
      <div class='i i-login'></div><h2>LOGIN</h2>
    </div>
    <div class='box-login'>
      <div class='fieldset-body' id='login_form'>
        <button type="button" onclick="openLoginInfo();" class='b b-form i i-more' title=''></button>
        	<p class='field'>
          <label for='user_id'>USER ID</label>
          <input type='text' id='user_id' name='user_id' title='Username' autocomplete="off" require/>
          <span id='valida' class='i i-warning'></span>
        </p>
      	  <p class='field'>
          <label for='user_password'>PASSWORD</label>
          <input type='password' id='user_password' name='user_password' title='Password' autocomplete="off"/>
          <span id='valida' class='i i-close'></span>
        </p>

          <label class='checkbox'>
            <input type='checkbox' name="chkaccess" value='3' title='Keep me Signed in' /> Keep me Signed in
          </label>

        	<input type='submit' id='do_login' value='GET STARTED' title='Get Started' />
      </div>
    </div>
  </div>
  </form>
  <div class='box-info'>
					    <p><button type="button" onclick="closeLoginInfo();" class='b b-info i i-left' title='Back to Sign In'></button><h3>Need Help?</h3>
    </p>
					    <div class='line-wh'></div>
    					<button type="button" onclick="" class='b-support' title='Forgot Password?'> Forgot Password?</button>
    <button type="button" onclick="" class='b-support' title='Contact Support'> Contact Support</button>
    					<div class='line-wh'></div>
    <!-- <button onclick="" class='b-cta' title='Sign up now!'> CREATE ACCOUNT</button> -->
  				</div>
</div>


 <div class='icon-credits'>Copyright © 2017-2018 Management Information System (MIS) By JIB. All rights reserved.</div>
  