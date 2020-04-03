<?php

class DatastoreController extends Controller {

    public function actionAddproductregis() {
        #$brand=$_POST["brand"];
        $str = "SELECT SQL_CALC_FOUND_ROWS * FROM stock ";
        $result = Yii::app()->db->createCommand($str)->queryAll();
        $productregis = array();
        foreach ($result as $r) {
            $productregis[] = array(
                'productid' => $r["productid"],
                'productname' => $r["productname"],
                'stockqty' => $r["stockqty"],
                'booking' => ''
            );
        }
        echo json_encode($productregis);
    }

    public function actionChangeProduct() {
        $search = $_POST['txt_search'];
        $str = "SELECT SQL_CALC_FOUND_ROWS * FROM orderdoc WHERE paydoc='$search'";
        $result = Yii::app()->db->createCommand($str)->queryAll();
        $sql = "SELECT FOUND_ROWS() AS `found_rows`;";
        $rows = Yii::app()->db->createCommand($sql)->queryRow();
        $total_rows = $rows['found_rows'];
        $changeproduct = array();

        foreach ($result as $r) {

            $changeproduct[] = array(
                'productid' => trim($r["productid"]),
                'productname' => trim($r["productname"]),
                'qty' => $r["qty"]
            );
        }

        echo json_encode($changeproduct);
    }

    public function actionSelectproduct() {
        $productid = $_POST['productid'];
        //echo $productid;
        $str = "SELECT * FROM stock WHERE productid='$productid' AND stockremain != 0";
        $productlist = Yii::app()->db->createCommand($str)->queryRow();
        echo $productlist["producname"];
        // echo $str;
    }

    public function actionProductList() {
        $productid = $_POST['productid'];
        $str = "SELECT productid,productname FROM product WHERE productid LIKE '%$productid%' LIMIT 1 ";
        $data = Yii::app()->db->createCommand($str)->queryRow();
        echo $data['productname'];
    }
    
    public function actionChangeproduct() {
    	$search = $_POST['txt_search'];
    	$str = "SELECT * FROM orderdoc WHERE paydoc='$search'";
    	$result = Yii::app()->db->createCommand($str)->queryAll();
    	
    	$changeproduct=array();
    
    	foreach ($result as $r) {
    		 
    		$changeproduct[]=array(
    				'orderid'=>$r["orderid"],
    				'modelid'=>trim($r["modelid"]),
    				'productid'=>trim($r["productid"]),
    				'productname'=>trim($r["productname"]),
    				'qty'=>$r["qty"]
    		);
    	}
    	 
    	echo json_encode($changeproduct);
    }

}

?>