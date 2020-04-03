<?php

class SetstockController extends CController {

    public function actionIndex() {

        $access = Yii::app()->request->cookies['cookie_commart_system']->value;
    // $CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 1, $access);
    // $CAccess2 = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 2, $access);
    // $CAccess3 = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 3, $access);
        $CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128,1, $access);
        $this->render("index",array("access"=>$access,"CAccess"=>$CAccess));
    }

    public function actionUpstock()
    {



        $productid =$_POST["productid"];
        if ($_POST["plus"]=="") {
           $plus =0;
       }else {
           $plus =$_POST["plus"];
       }
       if ($_POST["down"]=="") {
           $down =0;
       }else {
           $down =$_POST["down"];
       }





       $int = "UPDATE stock SET stockqty=stockqty+$plus-$down WHERE productid='$productid' ";
       $chk = Yii::app()->db->createCommand($int)->execute();



   }

   public function actionShow(){


    $str="SELECT
    productid,producname,stockqty,stockremain,brand,stockpreorderqty,stockpreorder
    FROM
    stock


    ";
    if (isset ( $_GET ['filterscount'] )) {
        $filterscount = $_GET ['filterscount'];

        if ($filterscount > 0) {
            $where = " WHERE";
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
                    $where .= "AND";
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
                    $where .= "";
                }

                $tmpfilteroperator = $filteroperator;
                $tmpdatafield = $filterdatafield;
            }
                // build the query.
            $filterquery = $str . $where;
            $str = $str . $where;
        }
    }


    $result=Yii::app()->db->createCommand($str)->queryAll();


    $data=array();
    foreach ($result as $r ) {
        $data[]=array(
            'productid'=>$r['productid'],
            'producname'=>$r['producname'],
            'stockqty'=>$r['stockqty'],
            'stockremain'=>$r['stockremain'],
            'brand'=>$r['brand'],
            'stockpre'=>$r['stockpreorder'],
            'stockpreorder'=>$r['stockpreorderqty'],
            'plus'=>0,
            'inputpreorder'=>0,




        );

    }
    echo json_encode($data);

}

public function actionExport(){


    $str="SELECT
    productid,producname,stockqty,stockremain,brand,stockpreorderqty,stockpreorder FROM stock";


    $result=Yii::app()->db->createCommand($str)->queryAll();


    $this->renderPartial("excel",array(
        'result'=>$result


    ));

}

public function actionCommentpre($prid){


  $productid= urldecode($prid);

  $str="SELECT * FROM stock WHERE productid ='$productid'";
  $data=Yii::app()->db->createCommand($str)->queryRow();


  $this->render("setcommentpre",array(
    'data'=>$data


));

}
public function actionInsertcomment(){
    if(!empty($_GET['regis'])=='true')
    {


     $productid='';
     $commentpreorder='';
     if(!empty($_GET['productid']))
     {
        $productid=urldecode($_GET['productid']);
    }
    if(!empty($_GET['commentpreorder']))
    {
        $commentpreorder=$_GET['commentpreorder'];
    }

    $upd="UPDATE stock SET commentpreorder = '$commentpreorder' WHERE productid = '$productid'";
    $exe1=Yii::app()->db->createCommand($upd)->execute();

}



}



}

?>