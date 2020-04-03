<?php
class RegisController extends Controller
{
	public function actionIndex(){
		if(empty(Yii::app()->request->cookies['cookie_point']->value)){
			$this->redirect(array("Logging/Login")); exit();
		}
		
		$artim=Yii::app()->db->createCommand("SELECT NOW() AS curdays")->queryRow();
		$this->render("index",array(
			'artim'=>$artim["curdays"]
		));
	}

	public function actionAddproductregis(){
		
		if(!empty($_GET['pagenum'])){
			$pagenum = $_GET['pagenum'];
		}else{
			$pagenum = 0;
		}
		
		if(!empty($_GET['pagesize'])){
			$pagesize = $_GET['pagesize'];
		}else{
			$pagesize = 0;
		}
		$start = $pagenum * $pagesize;
		
		$str="SELECT SQL_CALC_FOUND_ROWS * FROM stock ";
		
		if (isset($_GET['filterscount']))
		{
			$filterscount = $_GET['filterscount'];

			if ($filterscount > 0)
			{
				$where = " WHERE (";
				$tmpdatafield = "";
				$tmpfilteroperator = "";
				for ($i=0; $i < $filterscount; $i++)
				{
					// get the filter's value.
					$filtervalue = $_GET["filtervalue" . $i];
					// get the filter's condition.
					$filtercondition = $_GET["filtercondition" . $i];
					// get the filter's column.
					$filterdatafield = $_GET["filterdatafield" . $i];
					// get the filter's operator.
					$filteroperator = $_GET["filteroperator" . $i];

					if ($tmpdatafield == "")
					{
						$tmpdatafield = $filterdatafield;
					}
					else if ($tmpdatafield <> $filterdatafield)
					{
						$where .= ")AND(";
					}
					else if ($tmpdatafield == $filterdatafield)
					{
						if ($tmpfilteroperator == 0)
						{
							$where .= " AND ";
						}
						else $where .= " OR ";
					}

					// build the "WHERE" clause depending on the filter's condition, value and datafield.
					switch($filtercondition)
					{
						case "CONTAINS":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
						break;
						case "DOES_NOT_CONTAIN":
						$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
						break;
						case "EQUAL":
						$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
						break;
						case "NOT_EQUAL":
						$where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
						break;
						case "GREATER_THAN":
						$where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
						break;
						case "LESS_THAN":
						$where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
						break;
						case "GREATER_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
						break;
						case "LESS_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
						break;
						case "STARTS_WITH":
						$where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
						break;
						case "ENDS_WITH":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
						break;
					}

					if ($i == $filterscount - 1)
					{
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
		
		if (isset($_GET['sortdatafield']))
		{
			$sortfield = $_GET['sortdatafield'];
			$sortorder = $_GET['sortorder'];

			if ($sortfield != NULL)
			{
				if ($_GET['filterscount'] == 0)
				{
					if ($sortorder == "desc")
					{
						$str = $str . " ORDER BY " . $sortfield . " DESC ";
					}
					else if ($sortorder == "asc")
					{
						$str = $str .  " ORDER BY " . $sortfield . " ASC ";
					}
				}
				else
				{
					if ($sortorder == "desc")
					{
						$filterquery .= " ORDER BY" . " " . $sortfield . " DESC ";
					}
					else if ($sortorder == "asc")
					{
						$filterquery .= " ORDER BY" . " " . $sortfield . " ASC ";
					}
					$str = $filterquery;
				}

			}
		}
		
		$str=$str." LIMIT $start, $pagesize ";
		$result=Yii::app()->db->createCommand($str)->queryAll();
		$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
		$rows = Yii::app()->db->createCommand($sql)->queryRow();
		$total_rows = $rows['found_rows'];
		
		$productregis=array();
		foreach($result as $r){
			$productregis[]=array(
				'brand'=>$r["brand"],
				'modelid'=>trim($r["modelid"]),
				'productid'=>trim($r["productid"]),
				'producname'=>trim($r["producname"]),
				'stockqty'=>$r["stockremain"],
				'booking'=>0
			);
		}
		$data[] = array(
			'TotalRows' => $total_rows,
			'Rows' => $productregis
		);
		echo json_encode($data);
	}
	
	public function actionSaveproductregis(){
		
		if(!empty($_GET['regis'])=='true'){
			
			$alocateid='';
			$customer='';
			$register='';
			$addr1='';
			$addr2='';
			$city='';
			$zipid='';
			$tel='';
			$regcash=0;
			$regcredit=0;
			$regloan=0;
			$regloan1=0;
			$boots='';
			
			
			$alocateid=$_GET['alocateid'];
			$customer=$_GET['customer'];
			$register=$_GET['register'];
			//$addr1=$_GET['addr1'];
			if(!empty($_GET['addr1'])){
				$addr1=$_GET['addr1'];
			}
			if(!empty($_GET['addr2'])){
				$addr2=$_GET['addr2'];
			}
			if(!empty($_GET['city'])){
				$city=$_GET['city'];
			}
			if(!empty($_GET['zipid'])){
				$zipid=$_GET['zipid'];
			}
			$tel=$_GET['tel'];
			if(!empty($_GET['regcash'])){
				$regcash=$_GET['regcash'];
			}
			if(!empty($_GET['regcredit'])){
				$regcredit=$_GET['regcredit'];
			}
			if(!empty($_GET['regloan'])){
				$regloan=$_GET['regloan'];
			}
			if(!empty($_GET['regloan1'])){
				$regloan1=$_GET['regloan1'];
			}
			$modelid=$_GET['modelid'];
			$productid=$_GET['productid'];
			$producname=$_GET['producname'];
			$booking=$_GET['booking'];
			$boots=$_GET["boots"];
			
			$int="INSERT INTO orderdoc SET
			orderdate=NOW(), 
			alocateid='$alocateid',
			customer='$customer',
			register='$register',
			addr1='$addr1',
			addr2='$addr2',
			city='$city',
			zipid='$zipid',
			tel='$tel',
			regcash='$regcash',
			regcredit='$regcredit',
			regloan='$regloan',
			regloan1='$regloan1',
			boots='$boots',
			productid='$productid',
			productname='$producname',
			modelid='$modelid',
			qty='$booking'
			";
			
			$result=Yii::app()->db->createCommand($int)->execute();
			
			$upd="UPDATE stock SET stockremain=stockqty-(SELECT SUM(qty) FROM orderdoc 
			WHERE DATE(orderdate)=CURDATE() AND productid='$productid' AND `status`=0) 
			WHERE productid='$productid'";
			echo Yii::app()->db->createCommand($upd)->execute();

		}		
	}
	
	public function actionGetalocate(){
		$alocateid=$_POST["alocateid"];
		$str="SELECT alocateid FROM orderdoc WHERE alocateid = '$alocateid' AND DATE(orderdate)=CURDATE() AND `status`=0 ";
		$data=Yii::app()->db->createCommand($str)->queryRow();
		if(!empty($data)){
			echo "!!! หมายเลขใบจองนี้มีในระบบแล้ว";
		}else{
			echo '';
		}
		
		
	}
	
	
	public function actionListregis(){
		$this->render("lists");
	}
	
	public function actionListregisdata(){
		$str="SELECT
		orderdate,
		alocateid,
		modelid,
		productid,
		productname,
		customer,
		tel,
		boots,
		register
		FROM
		orderdoc ";
		
		$condition=" WHERE ";
		if(!empty($_POST["search"])=="true"){
			if($_POST["chkdate"]==1){
				$str.=" $condition (DATE(orderdate) BETWEEN '".MyClass::insertDate($_POST["orddate1"])."' AND '".MyClass::insertDate($_POST["orddate2"])."') ";
				$condition=" AND ";
			}
			if(!empty($_POST["alocateid"])){
				$str.=" $condition alocateid LIKE '%".$_POST["alocateid"]."%' ";
				$condition=" AND ";
			}
			if(!empty($_POST["modelid"])){
				$str.=" $condition modelid LIKE '%".$_POST["modelid"]."%' ";
				$condition=" AND ";
			}
			if(!empty($_POST["productid"])){
				$str.=" $condition productid LIKE '%".$_POST["productid"]."%' ";
				$condition=" AND ";
			}
			if(!empty($_POST["productname"])){
				$str.=" $condition productname LIKE '%".$_POST["productname"]."%' ";
				$condition=" AND ";
			}
			if(!empty($_POST["customer"])){
				$str.=" $condition customer LIKE '%".$_POST["customer"]."%' ";
				$condition=" AND ";
			}
			if(!empty($_POST["tel"])){
				$str.=" $condition tel LIKE '%".$_POST["tel"]."%' ";
				$condition=" AND ";
			}
		}
		//WHERE
		//DATE(orderdoc.orderdate) = CURDATE()";
		//echo $str;
		$result=Yii::app()->db->createCommand($str)->queryAll();
		
		$this->renderPartial("listsdata",array(
			'str'=>$str,
			'result'=>$result
		));

	}
	
	public function actionEditor($orddate,$alocateid){
		$str="SELECT * FROM orderdoc WHERE orderdate='$orddate' AND alocateid='$alocateid' LIMIT 1";
		$data=Yii::app()->db->createCommand($str)->queryRow();
		$this->render("editor",array(
			'data'=>$data,
			'orddate'=>$orddate,
			'alocateid'=>$alocateid
		));
	}
	
	public function actionEditorproduct(){
		$str="SELECT
		a.brand,
		b.modelid,
		b.productid,
		b.productname,
		b.qty
		FROM
		product AS a
		INNER JOIN orderdoc AS b ON b.productid = a.productid 
		WHERE b.orderdate='".$_GET['orddate']."' AND b.alocateid='".$_GET['alocateid']."'";
		$result=Yii::app()->db->createCommand($str)->queryAll();
		$data=array();
		foreach($result as $r){
			$data[]=array(
				'brand'=>$r['brand'],
				'modelid'=>$r['modelid'],
				'productid'=>$r['productid'],
				'producname'=>$r['productname'],
				'booking'=>$r['qty']
			);
		}
		echo json_encode($data);
		Yii::app()->end();
	}
	
	public function actionEditbillproductregis(){

		if(!empty($_GET['regis'])=='true'){

			$alocateid='';
			$orderdate='';
			$customer='';
			$register='';
			$addr1='';
			$addr2='';
			$city='';
			$zipid='';
			$tel='';
			$regcash=0;
			$regcredit=0;
			$regloan=0;
			$regloan1=0;
			$boots='';

			$alocateid=$_GET['alocateid'];
			$orderdate=$_GET['orderdate'];
			
			$customer=$_GET['customer'];
			$register=$_GET['register'];
			//$addr1=$_GET['addr1'];
			if(!empty($_GET['addr1'])){
				$addr1=$_GET['addr1'];
			}
			if(!empty($_GET['addr2'])){
				$addr2=$_GET['addr2'];
			}
			if(!empty($_GET['city'])){
				$city=$_GET['city'];
			}
			if(!empty($_GET['zipid'])){
				$zipid=$_GET['zipid'];
			}
			$tel=$_GET['tel'];
			if(!empty($_GET['regcash'])){
				$regcash=$_GET['regcash'];
			}
			if(!empty($_GET['regcredit'])){
				$regcredit=$_GET['regcredit'];
			}
			if(!empty($_GET['regloan'])){
				$regloan=$_GET['regloan'];
			}
			if(!empty($_GET['regloan1'])){
				$regloan1=$_GET['regloan1'];
			}
			//$modelid=$_GET['modelid'];
			$productid=$_GET['productid'];
			$newproductid=$_GET['newproductid'];
			//$producname=$_GET['newproducname'];
			/*$str2="select productname from product where productid='$newproductid'";
			$data2=Yii::app()->db->createCommand($str2)->queryRow();*/
			
			$str="SELECT * FROM stock WHERE productid='$newproductid' LIMIT 1";
			$data=Yii::app()->db->createCommand($str)->queryRow();
			$modelid=$data["modelid"];
			$producname=$data["producname"];
			
			$booking=$_GET['booking'];
			$boots=$_GET["boots"];
			
			
			
			$upd="UPDATE orderdoc SET
			customer='$customer',
			register='$register',
			addr1='$addr1',
			addr2='$addr2',
			city='$city',
			zipid='$zipid',
			tel='$tel',
			regcash='$regcash',
			regcredit='$regcredit',
			regloan='$regloan',
			regloan1='$regloan1',
			boots='$boots',
			productid='$newproductid',
			productname='$producname',
			modelid='$modelid',
			qty='$booking'
			WHERE orderdate='$orderdate' AND alocateid='$alocateid' AND productid='$productid' ";

			$exe1=Yii::app()->db->createCommand($upd)->execute();

			$upd2="UPDATE stock SET stockremain=stockqty-IFNULL((SELECT SUM(qty) FROM orderdoc
			WHERE DATE(orderdate)=CURDATE() AND productid='$productid' AND `status`=0),0)
			WHERE productid='$productid'";
			$exe2=Yii::app()->db->createCommand($upd2)->execute();
			
			$upd3="UPDATE stock SET stockremain=stockqty-IFNULL((SELECT SUM(qty) FROM orderdoc
			WHERE DATE(orderdate)=CURDATE() AND productid='$newproductid' AND `status`=0),0)
			WHERE productid='$newproductid'";
			echo Yii::app()->db->createCommand($upd3)->execute();

		}
	}
	
	public function actionSearchproduct(){
		$product = $_POST["product"];
		$booking = $_POST["booking"];
		$str="SELECT * FROM stock WHERE productid='$product' AND stockremain>=$booking";
		$data=Yii::app()->db->createCommand($str)->queryRow();
		if(!empty($data)){
			echo $data["producname"];
		}else{
			echo 0;
		}
		
	}


// 	public function actionSearchprint()
// 	{

// 		// if($id==1){
// 		// 	$q="A";
// 		// }else{
// 		// 	$q="C";
// 		// }
// 		// $str="INSERT INTO runqcommart 
// 		// 	SELECT CURDATE(),'$q' AS qtype,IFNULL(MAX(runq),0)+1,NOW() FROM runqcommart WHERE typeq='$q' AND dateq=CURDATE()";
// 		// Yii::app()->db->createCommand($str)->execute();


// 		// $str="SELECT dateq,typeq,runq,CONCAT(DATE_FORMAT(upd,'%m/%d/%Y %H:%i')) AS timeq,cid FROM ddcountq WHERE typeq='$q' AND dateq=CURDATE()  ORDER BY runq DESC LIMIT 1";
// 		// $data=Yii::app()->db->createCommand($str)->queryRow();



// 		$content =     file_get_contents("http://172.18.0.135:8505/getque/cash");

// 		$result  = json_decode($content, true);

// 		$data[]=array(
// 				// 'id'=>$key  +1,
// 			'cid'=>$result["data"][0]["payq"],
// 			'timeq'=>$result["data"][0]["timeupd"],

// 		);
// // print_r($result["data"][0]["payq"]);
// 		if($result["data"][0]["typeq"]=='cash'){
// 			$typename='เงินสด/บัตรเครดิต';
// 		}else{
// 			$typename='สินเชื่อ';
// 		}

// 		$this->renderPartial('printq2',array('data'=>$data,'typename'=>$typename));




// 	}
	public function actionSearchprint($id)
	{
		
		if($id==1){
			$q="CASH";
		}else{
			$q="CREDIT";
		}


		$content = file_get_contents("http://172.18.0.135:8505/getque/".$q);

		$result  = json_decode($content, true);
		if($result["data"][0]["typeq"]=='CASH'){
			$typename='เงินสด/บัตรเครดิต';
		}else{
			$typename='สินเชื่อ';
		}
		$data=array(

			'cid'=>$result["data"][0]["payq"],
			'timeq'=>$result["data"][0]["timeupd"],
			'codechk'=>$result["data"][0]["codechk"]

		);

		// print_r($data);

		$this->renderPartial('printq2',array('data'=>$data,'typename'=>$typename));



		
	}
}
?>