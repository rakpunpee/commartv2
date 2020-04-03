<?php
class UpdCommand extends CConsoleCommand
{
	public function actionRealstock(){
		$conn2=new mssql();
		$conn2->mssqlconnect('172.18.0.53','foxuser','foxpro');
		$conn2->mssqldb('RunStock');
		$str="SELECT * FROM Product WHERE CategoryID IN (2,3,33,65,87,15,110)";
		$result=$conn2->fetchAll($str);

		/*if(Yii::app()->db->createCommand("TRUNCATE TABLE product")->execute()){
			echo "TRUNCATE TABLE product<br>";
		}*/
		foreach($result as $r){
			$int="INSERT IGNORE INTO product SET productid='".$r["Product"]."',
					productname='".iconv("windows-874","utf8",addslashes($r["Name"]))."',
							categoryid='".$r["CategoryID"]."',
									brand='".$r["Brand"]."'
											";
			if(Yii::app()->db->createCommand($int)->execute()){
				echo $int."<br>";
			}
		}

		echo "<hr>";
		$conn=new mssql();
		$conn->mssqlconnect('172.18.0.51','foxuser','foxpro');
		$conn->mssqldb('Doctor');

		//$str="exec CallStockSell 51,'2014-03-".date("d")." 00:00:00:000','2014-06-".date("d")." 23:59:59:999' "; //branch51
		$str="exec CallStockSell 51,'".date("Y-m-d")." 00:00:00:000','".date("Y-m-d")." 23:59:59:999' ";
		echo $str;
		$result=$conn->fetchAll($str);
		foreach($result as $r){

			$product=trim($r["Product"]);
			$stock=$r["Stock"];
			$sell=$r["Sell"];
			$updqty=$stock+$sell;

			echo $product." ".$stock." ".$sell." ".$updqty. "<br>";


			$chk="SELECT COUNT(*) AS countproduct FROM stock WHERE productid='$product'";
			$rchk=Yii::app()->db->createCommand($chk)->queryRow();
			
			$data2=Yii::app()->db->createCommand("SELECT COUNT(*) AS rows,productname,brand FROM product WHERE trim(productid)='$product'")->queryRow();
			$data3=Yii::app()->db2->createCommand("SELECT modelid FROM modelproduct WHERE productid='$product'")->queryRow();
			
			if($rchk["countproduct"]>0){
				#echo "0<br>";
				$qty="SELECT IFNULL(SUM(qty),0) AS qtybyday
				FROM orderdoc
				WHERE DATE(orderdate)=CURDATE() AND productid='$product' AND `status`=0 ";
				$data=Yii::app()->db->createCommand($qty)->queryRow();

				$updremain=$updqty-$data["qtybyday"];
				
				if($stock<$updremain){
					$updqty=$stock;
					$updremain=$stock;
					echo $updqty;
				}
				$upd="UPDATE stock SET
				modelid='".$data3["modelid"]."',
				brand='".$data2["brand"]."',
				stockqty='$updqty',
				stockremain='$updremain'
				WHERE productid='$product' ";

				if(Yii::app()->db->createCommand($upd)->execute()){
					echo $upd."<br>";
				}else{
					Yii::app()->db->createCommand("INSERT INTO logupdatestock SET logtext='Update Error : ".addslashes($upd)."'")->execute();
				}
			}else{
				#echo "1<br>";
				
				if($data2["rows"]>0){
					$int="INSERT IGNORE INTO stock SET 
					modelid='".$data3["modelid"]."',
					productid='$product',
					producname='".trim($data2["productname"])."',
					brand='".trim($data2["brand"])."',
					stockqty='$updqty',
					stockremain='$updqty' ";

					if(Yii::app()->db->createCommand($int)->execute()){
						echo $int."<br>";
					}else{
						Yii::app()->db->createCommand("INSERT INTO logupdatestock SET logtext='INSERT Error : ".addslashes($int)."'")->execute();
					}
				}else{
					Yii::app()->db->createCommand("INSERT INTO logupdatestock SET logtext='product $product not found table product '")->execute();
				}
			}
		}
	}




	public function actionUpdateproduct()
	{
		$conn2=new mssql();
		$conn2->mssqlconnect('172.18.0.53','foxuser','foxpro');
		$conn2->mssqldb('RunStock');
		$str="SELECT * FROM Product WHERE CategoryID IN (2)";
		$result=$conn2->fetchAll($str);

		/*if(Yii::app()->db->createCommand("TRUNCATE TABLE product")->execute()){
			echo "TRUNCATE TABLE product<br>";
		}*/
		foreach($result as $r){
			$int="INSERT IGNORE INTO producttest SET productid='".$r["Product"]."',
					productname='".iconv("windows-874","utf8",addslashes($r["Name"]))."',
							categoryid='".$r["CategoryID"]."',
									brand='".$r["Brand"]."'
											";
			if(Yii::app()->db->createCommand($int)->execute()){
				echo $int."<br>";
			}
		}
	}
}
?>