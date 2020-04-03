<?php
class UpdproductCommand extends CConsoleCommand
{
	public function actionUpdateproduct(){
		$conn2=new mssql();
		$conn2->mssqlconnect('172.18.0.53','foxuser','foxpro');
		$conn2->mssqldb('RunStock');
		$str="SELECT * FROM Product WHERE CategoryID IN (2,3,33,65,87,15)";
		$result=$conn2->fetchAll($str);
		
		foreach($result as $r){
			$upd="UPDATE product SET 
				productname='".addslashes($r["Name"])."',
				categoryid='".$r["CategoryID"]."',
				brand='".$r["Brand"]."'
				WHERE productid='".$r["Product"]."'
				";
			
			if(Yii::app()->db->createCommand($upd)->execute()){
				echo $upd."<br>";
			}
		}
		
	}
}