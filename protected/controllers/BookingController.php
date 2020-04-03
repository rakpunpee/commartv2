<?php

class BookingController extends Controller {

    public function actionIndex() {
        if (empty(Yii::app()->request->cookies['cookie_point']->value)) {
            $this->redirect(array("Logging/Login"));
            exit();
        }
        $this->render("index");
    }

    public function actionAddproductbooking() {

        if (!empty($_GET['pagenum'])) {
            $pagenum = $_GET['pagenum'];
        } else {
            $pagenum = 0;
        }

        if (!empty($_GET['pagesize'])) {
            $pagesize = $_GET['pagesize'];
        } else {
            $pagesize = 0;
        }
        $start = $pagenum * $pagesize;

        $str = "SELECT SQL_CALC_FOUND_ROWS * FROM pledge ";

        if (isset($_GET['filterscount'])) {
            $filterscount = $_GET['filterscount'];

            if ($filterscount > 0) {
                $where = " WHERE (";
                $tmpdatafield = "";
                $tmpfilteroperator = "";
                for ($i = 0; $i < $filterscount; $i++) {
                    // get the filter's value.
                    $filtervalue = $_GET["filtervalue" . $i];
                    // get the filter's condition.
                    $filtercondition = $_GET["filtercondition" . $i];
                    // get the filter's column.
                    $filterdatafield = $_GET["filterdatafield" . $i];
                    // get the filter's operator.
                    $filteroperator = $_GET["filteroperator" . $i];

                    if ($tmpdatafield == "") {
                        $tmpdatafield = $filterdatafield;
                    } else if ($tmpdatafield <> $filterdatafield) {
                        $where .= ")AND(";
                    } else if ($tmpdatafield == $filterdatafield) {
                        if ($tmpfilteroperator == 0) {
                            $where .= " AND ";
                        }
                        else
                            $where .= " OR ";
                    }

                    // build the "WHERE" clause depending on the filter's condition, value and datafield.
                    switch ($filtercondition) {
                        case "CONTAINS":
                            $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "%'";
                            break;
                        case "DOES_NOT_CONTAIN":
                            $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue . "%'";
                            break;
                        case "EQUAL":
                            $where .= " " . $filterdatafield . " = '" . $filtervalue . "'";
                            break;
                        case "NOT_EQUAL":
                            $where .= " " . $filterdatafield . " <> '" . $filtervalue . "'";
                            break;
                        case "GREATER_THAN":
                            $where .= " " . $filterdatafield . " > '" . $filtervalue . "'";
                            break;
                        case "LESS_THAN":
                            $where .= " " . $filterdatafield . " < '" . $filtervalue . "'";
                            break;
                        case "GREATER_THAN_OR_EQUAL":
                            $where .= " " . $filterdatafield . " >= '" . $filtervalue . "'";
                            break;
                        case "LESS_THAN_OR_EQUAL":
                            $where .= " " . $filterdatafield . " <= '" . $filtervalue . "'";
                            break;
                        case "STARTS_WITH":
                            $where .= " " . $filterdatafield . " LIKE '" . $filtervalue . "%'";
                            break;
                        case "ENDS_WITH":
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

        if (isset($_GET['sortdatafield'])) {
            $sortfield = $_GET['sortdatafield'];
            $sortorder = $_GET['sortorder'];

            if ($sortfield != NULL) {
                if ($_GET['filterscount'] == 0) {
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

        $str = $str . " LIMIT $start, $pagesize ";
        $result = Yii::app()->db->createCommand($str)->queryAll();
        $sql = "SELECT FOUND_ROWS() AS `found_rows`;";
        $rows = Yii::app()->db->createCommand($sql)->queryRow();
        $total_rows = $rows['found_rows'];

        $productbooking = array();
        foreach ($result as $r) {
            $productbooking[] = array(
                'brand' => $r["brand"],
                'product' => $r["productid"],
                'name' => $r["producname"],
                'unitamt' => $r["unitamt"],
                'alocate' => $r["alocate"],
                'totalamt' => $r["totalamt"],
            );
        }
        $data[] = array(
            'TotalRows' => $total_rows,
            'Rows' => $productbooking
        );
        echo json_encode($productbooking);
    }

    public function actionSaveproductbooking() {

        if (!empty($_GET['booking']) == 'true') {
            $orderdoc = ($_GET["orderdoc"] != '') ? $_GET["orderdoc"] : '';
            $orderdate = ($_GET["orderdate"] != '') ? MyClass::insertDate($_GET["orderdate"]) : '0000-00-00';
            $customer = ($_GET["customer"] != '') ? $_GET["customer"] : '';
            $addr1 = ($_GET["addr1"] != '') ? $_GET["addr1"] : '';
            $addr2 = ($_GET["addr2"] != '') ? $_GET["addr2"] : '';
            $city = ($_GET["city"] != '') ? $_GET["city"] : '';
            $zipcode = ($_GET["zipcode"] != '') ? $_GET["zipcode"] : '';
            $tel = ($_GET["tel"] != '') ? $_GET["tel"] : '';
            $telhome = ($_GET["telhome"] != '') ? $_GET["telhome"] : '';
            $amount = ($_GET["amount"] != '') ? $_GET["amount"] : '';
            $creditcardamt = ($_GET["creditcardamt"] != '') ? $_GET["creditcardamt"] : '';
            $creditamt = ($_GET["creditamt"] != '') ? $_GET["creditamt"] : '';
            $pledgeamt = ($_GET["pledgeamt"] != '') ? $_GET["pledgeamt"] : '';
            $remain = ($_GET["remain"] != '') ? $_GET["remain"] : 0;
            $descfreesup = ($_GET["descfreesup"] != '') ? $_GET["descfreesup"] : '';
            $receive = ($_GET["receive"] != '') ? $_GET["receive"] : '';
            $author = ($_GET["author"] != '') ? $_GET["author"] : '';
            $freejib = ($_GET["freejib"] != '') ? $_GET["freejib"] : '';
            $freesupplier = ($_GET["freesupplier"] != '') ? $_GET["freesupplier"] : '';
            $productid = ($_GET["productid"] != '') ? $_GET["productid"] : '';
            $productname = ($_GET["producname"] != '') ? $_GET["producname"] : '';
            $alocate = ($_GET["alocate"] != '') ? $_GET["alocate"] : 0;
            $unitamt = ($_GET["unitamt"] != '') ? $_GET["unitamt"] : 0;
            $totalamt = ($_GET["totalamt"] != '') ? $_GET["totalamt"] : 0;
            $comment = ($_GET["comment"] != '') ? $_GET["comment"] : '';

            if (!empty($amount)) {
                $chk = '1';
            } else {
                $chk = '0';
            }
            if (!empty($creditcardamt)) {
                $chk2 = '1';
            } else {
                $chk2 = '0';
            }
            if (!empty($creditamt)) {
                $chk3 = '1';
            } else {
                $chk3 = '0';
            }
            if (!empty($pledgeamt)) {
                $chk4 = '1';
            } else {
                $chk4 = '0';
            }
            if (!empty($remain)) {
                $chk5 = '1';
            } else {
                $chk5 = '0';
            }

            //echo $creditamt;
            $int = "INSERT INTO pledge SET  
                                orderdoc='$orderdoc', 
                                orderdate=CURDATE(), 
                                customer='$customer', 
                                addr1='$addr1', 
                                addr2='$addr2', 
                                city='$city', 
                                zipcode='$zipcode', 
                                tel='$tel', 
                                telhome='$telhome', 
                                pledgedate='$orderdate',
                                amount='$amount', 
                                remain='$remain', 
                                descfreesup='$descfreesup', 
                                receive='$receive', 
                                author='$author', 
                                pledgeamt='$pledgeamt', 
                                creditamt='$creditamt',
                                creditcardamt='$creditcardamt',
                                freejib='$freejib', 
                                freesupplier='$freesupplier',
                                recdate=CURDATE(),
                                product='$productid',
                                `name`='$productname',
                                alocate='$alocate',
                                unitamt='$unitamt',
                                totalamt='$totalamt',
                                comment='$comment',
                                cash='$chk',
                                creditcard='$chk2',
                                credit='$chk3',
                                pledge='$chk4'
              ";
            //echo $int;
            echo Yii::app()->db->createCommand($int)->execute();
        }
    }

    public function actionProductList() {
        $productid = $_POST['productid'];
        $str = "SELECT productid,productname FROM product WHERE productid LIKE '%$productid%' LIMIT 1 ";
        $data = Yii::app()->db->createCommand($str)->queryRow();
        echo $data['productname'];
    }

    public function actionList(){
    	
    	$this->render("list");
    }

    public function actionListtb()
    {
        $where = " WHERE ";
        $str="SELECT * FROM pledge ";
        if(!empty($_POST['orderdoc'])){
            $str.=$where." orderdoc LIKE '%".$_POST['orderdoc']."%' ";
            $where=" AND ";
        }
        if(!empty($_POST['chkorddate'])){
          if(!empty($_POST['orderdate'])){
                $str.=$where." orderdate = '".MyClass::insertDate($_POST['orderdate'])."' ";
                $where=" AND ";
            }  
        }
        if(!empty($_POST['chkpledgedate'])){
            if(!empty($_POST['pledgedate'])){
                $str.=$where." pledgedate = '".MyClass::insertDate($_POST['pledgedate'])."' ";
                $where=" AND ";
            }
        }
        if(!empty($_POST['customer'])){
            $str.=$where." customer LIKE '%".$_POST['customer']."%' ";
            $where=" AND ";
        }
        if(!empty($_POST['tel'])){
            $str.=$where." tel LIKE '%".$_POST['tel']."%' ";
            $where=" AND ";
        }
        $str.=" ORDER BY orderdate DESC ";
        //echo $str;
        $result=Yii::app()->db->createCommand($str)->queryAll();
        $this->renderPartial('list_table',array(
            'result'=>$result
        ));
    }


    public function actionExportexcel()
    {
        $str="SELECT * FROM pledge ";
        $result=Yii::app()->db->createCommand($str)->queryAll();
        $this->renderPartial('bkexport', array('result'=>$result));
    }

    public function actionBkupdatestatus()
    {
        $orderdoc=$_POST['orderdoc'];
        echo Yii::app()->db->createCommand("UPDATE pledge SET status_rev=1 WHERE orderdoc='$orderdoc'")->execute();
    }


}

?>