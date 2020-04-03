<?php

class Datasource {

    public static function ShopList() {
        $str = "SELECT shop FROM shop GROUP BY shop ORDER BY shop ASC ";
        $data = Yii::app()->db->createCommand($str)->queryAll();
        $arr = array();
        $arr[null] = "บูธขาย";
        foreach ($data as $r) {
            $arr[$r["shop"]] = $r["shop"];
        }
        return $arr;
    }

    public static function BrandJS() {
        $str = "SELECT brand FROM stock GROUP BY brand ORDER BY brand ";
        $data = Yii::app()->db->createCommand($str)->queryAll();
        $result = null;
        foreach ($data as $r) {
            $result.=" '" . $r["brand"] . "',";
        }
        $result = rtrim($result, ",");
        return $result;
    }

    public static function Cuswaitpay() {
        $str = "SELECT orderid,alocateid,customer FROM orderdoc WHERE pay=0 AND DATE(orderdate)=CURDATE() AND `status`=0 GROUP BY orderid,customer ORDER BY orderid,customer ASC ";
        $data = Yii::app()->db->createCommand($str)->queryAll();
        $result = null;

        foreach ($data as $r) {
            $alocateid = $r["alocateid"].$r["orderid"];
            $alocateid2 = $r["alocateid"];
            $customer = $r["customer"];
            $result.=" '$alocateid : $customer',";
        }
        $result = rtrim($result, ",");
        return $result;
    }

    public static function Brandbooking() {
        $str = "SELECT brand FROM product GROUP BY brand ORDER BY brand ";
        $data = Yii::app()->db->createCommand($str)->queryAll();
        $result = null;
        foreach ($data as $r) {
            $result.=" '" . $r["brand"] . "',";
        }
        $result = rtrim($result, ",");
        return $result;
    }

    public static function ProductList() {
        $str = "SELECT productid,productname FROM product";
        $data = Yii::app()->db->createCommand($str)->queryAll();
        $arr = array();
        $arr[null] = "Productname";
        $criteria = new CDbCriteria();
        $criteria->order = "productname ASC";
       
        $data = Product::model()->findAll($criteria);
        foreach ($data as $r) {
            $arr[trim($r->productid)] = trim($r->productname);
        }
        return $arr;
    }

}

?>