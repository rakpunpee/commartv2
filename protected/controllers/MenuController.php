<?php

class MenuController extends Controller
{
	public function actionIndex(){
		// if (empty(Yii::app()->request->cookies['cookie_commart_system']->value)) {
		// 	$this->redirect(array("login2018/Started"));
		// }
		//$access = Yii::app()->request->cookies['cookie_commart_system']->value;
		// if (empty(Yii::app()->request->cookies['cookie_commart_id']->value)) {
		// 	$this->redirect(array("login2018/Started"));
		// }if (empty(Yii::app()->request->cookies['cookie_commart_system']->value)) {
		// 	$this->redirect(array("login2018/Started"));
		// }
		// if (empty(Yii::app()->request->cookies['cookie_commart_id']->value)) {
  //           $this->render("//dialog/unaccess");exit();
  //       }if (empty(Yii::app()->request->cookies['cookie_commart_system']->value)) {
  //          $this->render("//dialog/unaccess");exit();
  //       }
		
		// $access = Yii::app()->request->cookies['cookie_commart_system']->value;
		// $CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 1, $access);
		// $CAccess2 = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 2, $access);
		// $CAccess3 = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 3, $access);
		$this->render("index");

	}
	public function actionMisconfig(){
		$access = Yii::app()->request->cookies['cookie_commart_system']->value;
		if($access==0){
			$this->render("//dialog/unaccess");exit();
		}

		$this->render("configmis");

	}
	public function actionConfigoption(){

		$mysql = "UPDATE commart.stock as a LEFT JOIN jib.listprice as b ON a.productid = b.product SET a.price = b.price1 WHERE a.price = 0";
		echo Yii::app()->db->createCommand($mysql)->execute();

	}
	public function actionConfigoption2(){

		$mysql = "UPDATE commart.stock as a LEFT JOIN jib.impproduct as i ON a.productid = i.product LEFT JOIN jib.class as c ON c.classid = i.CATEGORYID
		SET a.category = i.CATEGORYID,a.categoryname = c.classname";
		echo Yii::app()->db->createCommand($mysql)->execute();

	}
	public function actionConfigoption3(){

		$mysql = "UPDATE commart.stock as a	LEFT JOIN jib.stocknow_by_product as b
		ON a.productid = b.productid SET a.stockqty = b.sto,a.stockremain = b.sto WHERE b.branch = 51 ";
		echo Yii::app()->db->createCommand($mysql)->execute();

	}
	public function actionConfigoption4(){

		$mysql = "INSERT INTO commart.stock (productid,producname,modelid,brand)
		SELECT
		m.productid as productid,
		m.productname as producname,
		m.modelid as modelid,
		m.brand as brand
		FROM `commart-sticker`.modelproduct as m WHERE NOT EXISTS (SELECT * FROM commart.stock as s WHERE s.productid = m.productid) ";
		echo Yii::app()->db->createCommand($mysql)->execute();

	}
	public function actionConfigoption5(){

		$mysql = "UPDATE commart.stock as a set a.stockqty = a.stockremain";
		echo Yii::app()->db->createCommand($mysql)->execute();

	}
	public function actionGen() {

		$sql = "SELECT regisshop.shop,regisshop.brand FROM regisshop";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($result as $r ) {

			$gen=6; 
			$char_pass = "1234567890";
			$password = "";
			while(strlen($password)<$gen) {
				$password .= $char_pass[rand()%strlen($char_pass)];

				$sql1 = "UPDATE commart.regisshop SET password='$password' WHERE shop='".$r["shop"]."' AND brand='".$r["brand"]."' ";

				$result1 = Yii::app()->db->createCommand($sql1)->execute();

			}

		}



	}

	public function actionGenpass(){

		$this->renderPartial("genpass");

	}

	public function actionShowpass(){

		$this->renderPartial("showpass");

	}
	public function actionGenshow() {

		$sql = "SELECT regisshop.shop,regisshop.brand FROM regisshop";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($result as $r ) {


		}

	}

 public function actionTruncate(){

        $str="UPDATE nocheck SET payq='',qtime=null ";

        $result=Yii::app()->db->createCommand($str)->execute();

         echo "<script>alert('Clear SuCCess'); window.location.href = '" . $this->createUrl('menu/index') . "'</script>";


    }

	
}


?>