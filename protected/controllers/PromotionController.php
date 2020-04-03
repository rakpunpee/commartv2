<?php

class PromotionController extends CController {

    public function actionIndex() {
     
    $access = Yii::app()->request->cookies['cookie_commart_system']->value;
    // $CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 1, $access);
    // $CAccess2 = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 2, $access);
    // $CAccess3 = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 3, $access);
    $CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128,1, $access);
    $this->render("index",array("access"=>$access,"CAccess"=>$CAccess));
       
    }

    public function actionShow(){


        $str="SELECT
        a.productid,a.producname,a.pmdetail,a.price,a.brand
        FROM
        stock AS a 

        GROUP BY productid ORDER BY a.producname ASC
        ";

        $result=Yii::app()->db->createCommand($str)->queryAll();


        $data=array();
        foreach ($result as $r ) {
            $data[]=array(
                'productid'=>$r['productid'],
                'productname'=>$r['producname'],
                'pmdetail'=>$r['pmdetail'],
                'brand'=>$r['brand'],
                'price'=>$r['price'],

                

            );
            
        }
        echo json_encode($data);

    }
    public function actionShowbrand(){
     

      $brand=$_POST["brand"];

      $str="SELECT * FROM pm_brand WHERE brandname='$brand' ";

      $res=Yii::app()->db->createCommand($str)->queryRow();

      echo $res['detail'];
    

}


public function actionAddpro()
{


  $brand=$_POST['brand'];
  $pro=$_POST['detail'];
   


    $int = "UPDATE pm_brand SET detail='$pro',status='1' WHERE brandname='$brand' ";
    $chk = Yii::app()->db->createCommand($int)->execute();
    echo "<script>alert('Save is success'); window.location.href = '" . $this->createUrl('site/index') . "'</script>";



}

public function actionShowpro(){


    $str="SELECT * FROM pm_brand";

    $result=Yii::app()->db->createCommand($str)->queryAll();


    $data=array();
    foreach ($result as $r ) {
        $data[]=array(
            'brand'=>$r['brandname'],
            'detail'=>str_replace("<br />",'',$r['detail'])

// str_replace("\n",'<br>',$pro);
        );

    }
    echo json_encode($data);

}


}

?>