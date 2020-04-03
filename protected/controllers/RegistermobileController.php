<?php


class RegistermobileController extends CController
{
    public function actionIndex()
    {
    	$this->render('index');
    }
    public function actionRecive_order()
    {
        $orderCode = $_POST['orderCode'];
		$productCode = urldecode($_POST['productCode']);
		$productQty = $_POST['productQty'];
		$productStatus = $_POST['productStatus'];
		$customerName = $_POST['customerName'];
		$customerPhone = $_POST['customerPhone'];
		$customerEmail = $_POST['customerEmail'];

		if(!empty($_POST['orderCode']) || !empty($_POST['productCode'])){

			// $checktest=Yii::app()->db->createCommand("SELECT * FROM commart.orderdoc_web WHERE orderCode='$orderCode' AND productCode='$productCode'")->queryRow()

			

				$in = "INSERT INTO commart.orderdoc_web SET 
			    	 	orderCode='$orderCode', 
						dateorder=NOW(),
						productCode='$productCode',
						productQty='$productQty',
						productStatus='$productStatus',
						customerName='$customerName',
						customerPhone='$customerPhone',
						customerEmail='$customerEmail',
						upd=NOW()";
				if(Yii::app()->db->createCommand($in)->execute()){
					echo "TRUE";
					exit;
				}else{
					echo "FALSE";
					exit;
				}
		}else{
			echo "orderCode AND productCode is Empty!!";
			exit;
		}	

    }


    public function actionCheckstatus()
    {
    	$orderCode = $_POST['orderCode'];
		$productCode = urldecode($_POST['productCode']);
		$state = 'TRUE';

		$str = "SELECT * FROM commart.orderdoc_web WHERE orderCode='$orderCode' AND productCode='$productCode'";
		$data=Yii::app()->db->createCommand($str)->queryRow();
		if(!empty($data)){
			$productStatus = $data['productStatus'];
		}else{
			$state = 'FALSE';
			$productStatus = '';
		}
		$callback[]=array(
					'state' =>$state,
            		'orderCode'=>$orderCode,
            		'productCode'=>$productCode,
            		'productStatus'=>$productStatus
            		);
        echo json_encode($callback);
    }

    public function actionUpdatestatus()
    {	
    	$orderCode = $_POST['orderCode'];
		$productCode = urldecode($_POST['productCode']);
		$productStatus = $_POST['productStatus'];

		$up = "UPDATE commart.orderdoc_web SET productStatus='$productStatus' WHERE orderCode='$orderCode' AND productCode='$productCode'";
        if(Yii::app()->db->createCommand($up)->execute()){
        	echo "TRUE";
        }else{
        	echo "FALSE";
        }
    }

    public function actionShoworder()
    {
    	if (empty ( Yii::app ()->request->cookies ['cookie_point']->value )) {
			$this->redirect ( array (
					"Logging/Login" 
			) );
			exit ();
		}

    	$this->renderPartial('orderstock');
    }

     public function actionShowjudorder()
    {
    	if (empty ( Yii::app ()->request->cookies ['cookie_point']->value )) {
			$this->redirect ( array (
					"Logging/Login" 
			) );
			exit ();
		}

    	$this->renderPartial('ordershow');
    }








    public function actionAddstatus()
    {
    	$orderCode = $_POST['orderCode'];
		$productCode = urldecode($_POST['productCode']);
		$productStatus = $_POST['productStatus'];
		$order_cancel = $_POST['order_cancel'];
		$up = "UPDATE commart.orderdoc_web SET productStatus='$productStatus',order_cancel='$order_cancel' WHERE orderCode='$orderCode' AND productCode='$productCode'";
        if(Yii::app()->db->createCommand($up)->execute()){
        	echo "TRUE";
        }else{
        	echo "FALSE";
        }

    }



    

}