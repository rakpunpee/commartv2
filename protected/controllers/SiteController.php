<?php
class SiteController extends Controller {
	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array (
				// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array (
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF 
			),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array (
				'class' => 'CViewAction' 
			) 
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->redirect(array("main/index"));
		exit();
		// $this->render("index");
	}
	
	public function actionIndexdata() {
		
		$str = "SELECT
		a.modelid,
		a.productid,
		a.producname,
		a.brand,
		a.stockqty,
		(a.stockremain-IFNULL((SELECT SUM(productQty)  FROM commart.orderdoc_web WHERE productCode=a.productid AND productStatus IN(1,2) ),0)) AS stockremain,
		a.upd
		FROM
		stock AS a ";
		
		if (isset ( $_GET ['filterscount'] )) {
			$filterscount = $_GET ['filterscount'];
			
			if ($filterscount > 0) {
				$where = " WHERE (";
				$tmpdatafield = "";
				$tmpfilteroperator = "";
				for($i = 0; $i < $filterscount; $i ++) {
					// get the filter's value.
					$filtervalue = $_GET ["filtervalue" . $i];
					// get the filter's condition.
					$filtercondition = $_GET ["filtercondition" . $i];
					// get the filter's column.
					$filterdatafield = $_GET ["filterdatafield" . $i];
					// get the filter's operator.
					$filteroperator = $_GET ["filteroperator" . $i];
					
					if ($tmpdatafield == "") {
						$tmpdatafield = $filterdatafield;
					} else if ($tmpdatafield != $filterdatafield) {
						$where .= ")AND(";
					} else if ($tmpdatafield == $filterdatafield) {
						if ($tmpfilteroperator == 0) {
							$where .= " AND ";
						} else
						$where .= " OR ";
					}
					
					// build the "WHERE" clause depending on the filter's condition, value and datafield.
					switch ($filtercondition) {
						case "CONTAINS" :
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "%'";
						break;
						case "DOES_NOT_CONTAIN" :
						$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue . "%'";
						break;
						case "EQUAL" :
						$where .= " " . $filterdatafield . " = '" . $filtervalue . "'";
						break;
						case "NOT_EQUAL" :
						$where .= " " . $filterdatafield . " <> '" . $filtervalue . "'";
						break;
						case "GREATER_THAN" :
						$where .= " " . $filterdatafield . " > '" . $filtervalue . "'";
						break;
						case "LESS_THAN" :
						$where .= " " . $filterdatafield . " < '" . $filtervalue . "'";
						break;
						case "GREATER_THAN_OR_EQUAL" :
						$where .= " " . $filterdatafield . " >= '" . $filtervalue . "'";
						break;
						case "LESS_THAN_OR_EQUAL" :
						$where .= " " . $filterdatafield . " <= '" . $filtervalue . "'";
						break;
						case "STARTS_WITH" :
						$where .= " " . $filterdatafield . " LIKE '" . $filtervalue . "%'";
						break;
						case "ENDS_WITH" :
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "'";
						break;
					}
					
					if ($i == $filterscount - 1) {
						$where .= ")";
					}
					
					$tmpfilteroperator = $filteroperator;
					$tmpdatafield = $filterdatafield;
				}
				// build the query.
				$filterquery = $str . $where;
				$str = $str . $where;
			}
		}
		
		if (isset ( $_GET ['sortdatafield'] )) {
			$sortfield = $_GET ['sortdatafield'];
			$sortorder = $_GET ['sortorder'];
			
			if ($sortfield != NULL) {
				if ($_GET ['filterscount'] == 0) {
					if ($sortorder == "desc") {
						$str = $str . " ORDER BY " . $sortfield . " DESC ";
					} else if ($sortorder == "asc") {
						$str = $str . " ORDER BY " . $sortfield . " ASC ";
					}
				} else {
					if ($sortorder == "desc") {
						$filterquery .= " ORDER BY" . " " . $sortfield . " DESC ";
					} else if ($sortorder == "asc") {
						$filterquery .= " ORDER BY" . " " . $sortfield . " ASC ";
					}
					$str = $filterquery;
				}
			}
		}
		
		//$str = $str . " LIMIT $start, $pagesize ";
		$result = Yii::app ()->db->createCommand ( $str )->queryAll ();
		
		$data = array ();
		foreach ( $result as $r ) {
			$data [] = array (
				'brand' => $r ["brand"],
				'modelid' => trim ( $r ["modelid"] ),
				'productid' => trim ( $r ["productid"] ),
				'producname' => trim ( $r ["producname"] ),
				'stockqty' => $r ["stockremain"]
			);
		}
		
		echo json_encode ( $data );
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */


	public function actionExportexcel()
	{
		$str = "SELECT * FROM stock ";
		$result = Yii::app ()->db->createCommand ( $str )->queryAll ();
		// echo json_encode ( $data );
		$this->renderPartial('exp_stock', array('result'=>$result));

	}

	public function actionError() {
		if ($error = Yii::app ()->errorHandler->error) {
			if (Yii::app ()->request->isAjaxRequest)
				echo $error ['message'];
			else
				$this->render ( 'error', $error );
		}
	}
	
	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm ();
		if (isset ( $_POST ['ContactForm'] )) {
			$model->attributes = $_POST ['ContactForm'];
			if ($model->validate ()) {
				$name = '=?UTF-8?B?' . base64_encode ( $model->name ) . '?=';
				$subject = '=?UTF-8?B?' . base64_encode ( $model->subject ) . '?=';
				$headers = "From: $name <{$model->email}>\r\n" . "Reply-To: {$model->email}\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/plain; charset=UTF-8";
				
				mail ( Yii::app ()->params ['adminEmail'], $subject, $model->body, $headers );
				Yii::app ()->user->setFlash ( 'contact', 'Thank you for contacting us. We will respond to you as soon as possible.' );
				$this->refresh ();
			}
		}
		$this->render ( 'contact', array (
			'model' => $model 
		) );
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model = new LoginForm ();
		
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'login-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		// collect user input data
		if (isset ( $_POST ['LoginForm'] )) {
			$model->attributes = $_POST ['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->login ())
				$this->redirect ( Yii::app ()->user->returnUrl );
		}
		// display the login form
		$this->render ( 'login', array (
			'model' => $model 
		) );
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app ()->user->logout ();
		$this->redirect ( Yii::app ()->homeUrl );
	}
}