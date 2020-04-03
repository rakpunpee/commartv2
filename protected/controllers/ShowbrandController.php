<?php

class ShowbrandController extends CController
{
    public function actionIndex()
    {
        $this->render('index');
    }
   //  public function actionGetdatabrand()
   //  {
   //  $str="SELECT brand FROM product WHERE categoryid IN(2,65) GROUP BY brand";	

   //  	$result = Yii::app()->db->createCommand($str)->queryAll();
   //  	$data=array();
    	
   //  	foreach ($result as $key) {
   //  		$data[]=array(
			// 	'brand'=>$key['brand']    			
   //  		);
   //  	}
		 // echo json_encode($data);

   //  }
   //  public function actionGetdatalist()
   //  {
   //  		$brand=$_GET['brand'];
   //  		$str="SELECT productid,productname,categoryid FROM product WHERE brand ='$brand' AND categoryid IN(2,65)";







	  //   	$result = Yii::app()->db->createCommand($str)->queryAll();
	  //   	$data=array();	
	  //   	foreach ($result as $key) {
	  //   		$data[]=array(
			// 		'productid'=>$key['productid'],
			// 		'productname'=>$key['productname'],
			// 		'categoryid'=>$key['categoryid'],    			
	  //   		);
	  //   	}
			//  echo json_encode($data);	
   //  }

   public function actionShowstock()
   	{
   		$conn2=new mssql();
		$conn2->mssqlconnect('172.18.0.53','foxuser','foxpro');
		$conn2->mssqldb('RunStock');
		$str="SELECT * FROM Product WHERE CategoryID IN (3,65,49)";
		$result=$conn2->fetchAll($str);
		$data=array();	
		// foreach($result as $r){
		// 	$data[]=array(
		// 			'productname'=>iconv("windows-874", "utf-8",$r['Name']),
		// 			'categoryid'=>iconv("windows-874", "utf-8",$r['CategoryID']),
		// 			'brand'=>iconv("windows-874", "utf-8",$r['Brand'])    			
	 //    		);
		// }
		echo '<pre>';
		print_r($result);
		echo '</pre>';
   	}	
}