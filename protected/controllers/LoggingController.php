<?php
@ob_start();
@session_start();
class LoggingController extends Controller
{
	public $layout="//layouts/logging"; 
	
	public function actionLogin(){
		$msg=null;
		if(!empty($_POST)){
			
			if(!empty($_POST["point"])){
				$point=$_POST["point"];
				
				$ckepoint=new CHttpCookie('cookie_point', $point);
				$ckepoint->expire = time()+3600*24*7; 
				Yii::app()->request->cookies['cookie_point'] = $ckepoint;
				
				
				$this->redirect(array("site/index"));
				exit();
			}else{
				$msg="!!!...ยังไม่ได้ระบุ ส่วนงาน...!!!";
			}
		}
		$this->render("login",array(
			'msg'=>$msg
		));
	}
	
	public function actionSlmodule($module=null){
		
		
		if(!empty($module)){
			$point=$module;
	
			$ckepoint=new CHttpCookie('cookie_point', $point);
			$ckepoint->expire = time()+3600*24*7;
			Yii::app()->request->cookies['cookie_point'] = $ckepoint;
	
			$this->redirect(array("site/index"));
		}else{
			$ckepoint=new CHttpCookie('cookie_point', "Stock");
			$ckepoint->expire = time()+3600*24*7;
			Yii::app()->request->cookies['cookie_point'] = $ckepoint;
			
			$this->redirect(array("site/index"));
		}
		
		
	}
	
	public function actionLogout(){
		Yii::app()->request->cookies->clear();
		
		$this->redirect(array("login"));
	}
	
}
?>