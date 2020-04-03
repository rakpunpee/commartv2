<?php
class EditbillController extends Controller
{
	public function actionCancelbill(){
		$this->render("cancelbill");
	}
	
	public function actionCancelbilldata(){
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
		
		$str="SELECT SQL_CALC_FOUND_ROWS 
		orderid,alocateid,paydoc,productid,productname,qty,customer,tel,
		CASE
			WHEN pay=0 THEN 'รอจ่ายเงิน'
			WHEN pay=1 THEN 'จ่ายเงินแล้ว'
		END AS paytxt 
		FROM orderdoc 
		WHERE DATE(orderdate)=CURDATE() AND `status`=0 ";
		
		if (isset($_GET['filterscount']))
		{
			$filterscount = $_GET['filterscount'];

			if ($filterscount > 0)
			{
				$where = " AND (";
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
		
		if(!empty($_GET["delete"])=="true"){
			$alocateid=$_GET["alocateid"];
			$upd="UPDATE orderdoc SET `status`=1 WHERE alocateid='$alocateid' AND DATE(orderdate)=CURDATE() ";
			echo Yii::app()->db->createCommand($upd)->execute();
			
		}else{
			$str=$str." LIMIT $start, $pagesize ";
			$result=Yii::app()->db->createCommand($str)->queryAll();
			$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
			$rows = Yii::app()->db->createCommand($sql)->queryRow();
			$total_rows = $rows['found_rows'];
			
			$orderdoc=array();
			foreach($result as $r){
				$orderdoc[]=array(
						'orderid'=>$r["orderid"],
						'alocateid'=>$r["alocateid"],
						'paydoc'=>trim($r["paydoc"]),
						'productid'=>trim($r["productid"]),
						'productname'=>trim($r["productname"]),
						'qty'=>$r["qty"],
						'customer'=>trim($r["customer"]),
						'tel'=>trim($r["tel"]),
						'paytxt'=>trim($r["paytxt"])
				);
			}
			$data[] = array(
					'TotalRows' => $total_rows,
					'Rows' => $orderdoc
			);
			
			echo json_encode($data);
		}
		
	}
	
	public function actionChange() {
		if (empty(Yii::app()->request->cookies['cookie_point']->value)) {
			$this->redirect(array("Logging/Login"));
			exit();
		}
	
		$this->render("//changeproduct/index");
	}
	
	public function actionChangeproduct() {
		$search = $_POST['txt_search'];
		$str = "SELECT * FROM orderdoc WHERE paydoc='$search' ";
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
	
	public function actionSelectproduct() {
		$productid = $_POST['productid'];
		//echo $productid;
		$str = "SELECT * FROM stock WHERE productid='$productid' AND stockremain != 0";
		$productlist = Yii::app()->db->createCommand($str)->queryRow();
		echo $productlist["modelid"]."||".$productlist["producname"];
		// echo $str;
	}
	
	public function actionSavechange(){
		if($_GET["change"]=="true"){
			$orderid=$_GET["orderid"];
			$productid=$_GET["productid"];
			$productname=$_GET["productname"];
			$modelid=$_GET["modelid"];
			$qty=$_GET["qty"];
			
			$int="INSERT INTO orderdoc (
			productid,productname,modelid,alocateid,qty,orderdate,customer,addr1,addr2,city,zipid,tel,regcash,
			regcredit,regloan,regloan1,boots,register,qty,status,payq,pay,paydoc,paydate,paytype,payremark,
			cash,creditcard,loan,loadtype,tranfer,bank,stock,percharge,chargebath,total)
			SELECT 
			'".$productid."','".$productname."','".$modelid."',alocateid,'".$qty."',orderdate,customer,addr1,addr2,city,zipid,tel,regcash,
			regcredit,regloan,regloan1,boots,register,qty,status,payq,pay,paydoc,paydate,paytype,payremark,
			cash,creditcard,loan,loadtype,tranfer,bank,stock,percharge,chargebath,total
			FROM orderdoc WHERE orderid=$orderid ";
			Yii::app()->db->createCommand($int)->execute();
			
			$upd="UPDATE orderdoc SET `status`=1 WHERE orderid=$orderid ";
			Yii::app()->db->createCommand($upd)->execute();
			
		}
	}
} 
?>