<?php

class Login2018Controller extends Controller
{
	public $layout="//layouts/newlogin2018"; 
	
	public function actionStarted(){

		$msg=null;
		if(!empty($_POST)){
			$user_id=addslashes($_POST["user_id"]);
			$user_password=addslashes($_POST["user_password"]);
			$encode=md5($user_password);
			$str="SELECT * FROM sysuser WHERE `name`='$user_id' AND `password`='$encode'";
			$model=Yii::app()->db3->createCommand($str)->queryRow();
			if(!empty($model)){
				if(!empty($_POST["chkaccess"])){
					$remember=$_POST["chkaccess"];
				}else{
					$remember=7;
				}

				$cookie_commart_id = new CHttpCookie('cookie_commart_id', $model['id']);
				$cookie_commart_id->expire = time() + (60*60*$remember); 
				Yii::app()->request->cookies['cookie_commart_id'] = $cookie_commart_id;

				$cookie_commart_system = new CHttpCookie('cookie_commart_system', $model['system']);
				$cookie_commart_system->expire = time() + (60*60*$remember); 
				Yii::app()->request->cookies['cookie_commart_system'] = $cookie_commart_system;

				$cookie_commart_user = new CHttpCookie('cookie_commart_user', $model['name']);
				$cookie_commart_user->expire = time() + (60*60*$remember); 
				Yii::app()->request->cookies['cookie_commart_user'] = $cookie_commart_user;

				$this->redirect(array("/menu/index")); exit();
			}else{
				$msg="User ID หรือ Password ไม่ถูกต้อง";
			}
		}

		$this->render("login2018",array(
			'msg'=>$msg
		));
	}


	public function actionLogout2018(){
		Yii::app()->request->cookies->clear();


		$this->redirect(array("Started"));
	}


}
?>