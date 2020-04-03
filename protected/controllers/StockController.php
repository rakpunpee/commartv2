<?php

class StockController extends Controller {

    public function actionIndex() {
        if (empty(Yii::app()->request->cookies['cookie_point']->value)) {
            $this->redirect(array("Logging/Login"));
            exit();
        }

        $this->renderPartial("index");
    }

    public function actionStocklist() {
        /* ไม่มี pager
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
         */

        $str = "SELECT R.* FROM (SELECT a.orderid,IFNULL(a.payq,'') AS payq,b.modelid,a.productid,a.productname,a.qty,a.customer,a.paytype,
            TIMEDIFF(NOW(),paydate) as waittime,IFNULL(TIMESTAMPDIFF(MINUTE,paydate,CURRENT_TIMESTAMP),0) as min
            FROM orderdoc a
            LEFT JOIN stock b ON a.productid=b.productid
            WHERE status=0 AND DATE(orderdate)= CURDATE() AND stock=0) AS R 
            WHERE R.min < 120 AND R.payq <> ''
            ORDER BY R.min ASC,R.payq ASC";
        /* ไม่มีกรองข้อมูล
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
         */
        if (isset($_GET['sortdatafield'])) {
            $sortfield = $_GET['sortdatafield'];
            $sortorder = $_GET['sortorder'];

            if ($sortfield != NULL) {
                //if ($_GET['filterscount'] == 0) {
                if ($sortorder == "desc") {
                    $str = $str . " ORDER BY " . $sortfield . " DESC ";
                } else if ($sortorder == "asc") {
                    $str = $str . " ORDER BY " . $sortfield . " ASC ";
                }
                /* } 
                  else {
                  if ($sortorder == "desc") {
                  $filterquery .= " ORDER BY" . " " . $sortfield . " DESC ";
                  } else if ($sortorder == "asc") {
                  $filterquery .= " ORDER BY" . " " . $sortfield . " ASC ";
                  }
                  $str = $filterquery;
                  } */
            }
        }

        //$str = $str . " LIMIT $start, $pagesize ";
        $result = Yii::app()->db->createCommand($str)->queryAll();
        /* $sql = "SELECT FOUND_ROWS() AS `found_rows`;";
          $rows = Yii::app()->db->createCommand($sql)->queryRow();
          $total_rows = $rows['found_rows']; */

        $productregis = array();
        foreach ($result as $r) {
            $productregis[] = array(
                'orderid' => trim($r["orderid"]),
                'payq' => trim($r["payq"]),
                'modelid' => trim($r["modelid"]),
                'productid' => trim($r["productid"]),
                'productname' => trim($r["productname"]),
                'qty' => trim($r["qty"]),
                'customer' => trim($r["customer"]),
                'paytype' => trim($r["paytype"]),
                'waittime' => trim($r["waittime"]),
                'min' => trim($r["min"])
            );
        }
        /* $data[] = array(
          'TotalRows' => $total_rows,
          'Rows' => $productregis
          ); */
        echo json_encode($productregis);
    }

    public function actionStockout() {
        if (empty(Yii::app()->request->cookies['cookie_point']->value)) {
            $this->redirect(array("Logging/Login"));
            exit();
        }

        $this->render("index_stockout");
    }

    public function actionStochoutquery() {
        $orderid = $_POST['orderid'];
        $query = "SELECT * FROM orderdoc WHERE DATE(orderdate)=CURDATE() AND status=0 AND pay=1 AND stock=0 AND orderid='$orderid'";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        if (!empty($rs)) {
            $stockout = $rs['payq'] . '||' . $rs['modelid'] . '||' . $rs['productid'] . '||' . $rs['productname'] . '||' . $rs['qty'] . '||' . $rs['customer'];
        } else {
            $stockout = false;
        }
        echo $stockout;
    }

    public function actionStochoutupdate() {
        $orderid = $_POST['orderid'];
        $query = "UPDATE orderdoc SET stock=1 WHERE DATE(orderdate)=CURDATE() AND status=0 AND pay=1 AND stock=0 AND orderid='$orderid'";
        if (Yii::app()->db->createCommand($query)->execute()) {
            $orderid = true;
        } else {
            $orderid = false;
        }
        echo $orderid;
    }

}

?>
