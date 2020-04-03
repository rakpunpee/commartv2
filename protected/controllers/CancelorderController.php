<?php

class CancelorderController extends CController {

  public function actionIndex() {


    $access = Yii::app()->request->cookies['cookie_commart_system']->value;

    $CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128,2, $access);
    $this->render("index",array("access"=>$access,"CAccess"=>$CAccess));
  }
  public function actionShow()
  {


    $content = file_get_contents("http://172.18.0.135:8505/get/register");

    $result  = json_decode($content, true);
    $data=array();
    foreach ($result["data"] as $r ) {
      $data[]=array(

        'orderid'=>$r["orderid"],
        'alocateid'=>$r["alocateid"],
        'payq'=>$r["payq"],
        'modelid'=>$r["modelid"],
        'productid'=>$r["productid"],
        'productname'=>$r["productname"],
        'qty'=>$r["qty"],
        'customer'=>$r["customer"],
        'tel'=>$r["tel"],
        'paytype'=>$r["paytype"],
        'pay'=>$r["pay"],
        'commentregister'=>$r["commentregister"],
        'boots'=>$r["boots"],
        'sucess'=>$r["sucess"],
        'requesvat'=>$r["requesvat"],
        'price'=>$r["price"]

      );
    }
    echo json_encode($data);

  }
  public function actionComment($id,$productid) {


    $id= $_GET["id"];
    $productid= $_GET["productid"];

    $this->renderPartial('comment',array('id'=>$id,'productid'=>$productid));
  }
  public function actionComment2($id) {


    $id= $_GET["id"];

    $this->renderPartial('comment2',array('id'=>$id));
  }
  public function actionSearch() {

   $access = Yii::app()->request->cookies['cookie_commart_system']->value;

   $CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128,2, $access);
   $this->render("search",array("access"=>$access,"CAccess"=>$CAccess));
 }

 public function actionShowsearch()
 {


  $content = file_get_contents("http://172.18.0.135:8505/get/registeralldate/");

  $result  = json_decode($content, true);
  $data=array();
  foreach ($result["data"] as $r ) {
    $data[]=array(

      'orderid'=>$r["orderid"],
      'alocateid'=>$r["alocateid"],

      'modelid'=>$r["modelid"],
      'productid'=>$r["productid"],
      'productname'=>$r["productname"],
      'qty'=>$r["qty"],
      'customer'=>$r["customer"],
      'tel'=>$r["tel"],
      'status'=>$r["status"],

      'pay'=>$r["pay"],
       'paytype'=>$r["paytype"],

      'sucess'=>$r["sucess"]

    );
  }

  echo json_encode($data);
}


public function actionEditor2(){

  $orderid= $_GET["orderid"];
  $str="SELECT * FROM orderdoc WHERE orderid='$orderid'";
  $data=Yii::app()->db->createCommand($str)->queryRow();
  $this->render("edit_register",array(
    'data'=>$data
  ));
}

public function actionEditbillregis(){

  if(!empty($_GET['regis'])=='true'){

    $alocateid='';
    $customer='';
    $register='';
    $addr1='';
    $addr2='';
    $city='';
    $zipid='';
    $tel='';

    $commentregister='';
    $boots='';
    $banking='';

    $alocateid=$_GET['alocateid'];
    $customer=$_GET['customer'];
    $register=$_GET['register'];

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
    }else{
      $regcash=0;
    }
    if(!empty($_GET['regcredit'])){
      $regcredit=$_GET['regcredit'];
    }else{
     $regcredit=0;
   }
   if(!empty($_GET['regloan'])){
    $regloan=$_GET['regloan'];
  }else{
    $regloan=0;
  }
  if(!empty($_GET["boots"])){
    $boots=$_GET["boots"];
  }
  if(!empty($_GET['commentregister'])){
    $commentregister=$_GET['commentregister'];
  }

  if(!empty($_GET['banking'])){
    $banking=$_GET['banking'];
  }

  if(!empty($_GET['price'])){
    $price=$_GET['price'];
  }



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
  boots='$boots',
  commentregister='$commentregister',
  Banking='$banking',
  price='$price'
  WHERE orderid='$alocateid' ";

  $exe1=Yii::app()->db->createCommand($upd)->execute();

}if(!empty($_GET['sms'])=='true')
{
   $alocateid=$_GET['alocateid'];
    $customer=$_GET['customer'];
    $tel=$_GET['tel'];

  $messagestring = '( COMMART )หมายเลขยืนยันการลงทะเบียนของคุณ '.$customer.' คือ '.$alocateid.'   ติดต่อชำระค่าสินค้าได้ที่ห้อง  MEETING ROOM ค่ะ';


  $url = 'https://mapi.jib.co.th/api/v1/sms_jib/send';
  $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => array(
        'Content-type: application/x-www-form-urlencoded',
        'X-JIB-Client-Id: 6602180001',
        'X-JIB-Client-Secret: 985721bc2b97268d28570de73b3f0d2a'),
      'content' => http_build_query(
        array(
          'phone_number' => $tel,
          'message'=> $messagestring
        )
      ),
      'timeout' => 60
    )
  ));

  $resp = file_get_contents($url, FALSE, $context);
}



}


public function actionPrint() {


  $id= $_GET["id"];

  $this->renderPartial('print',array('id'=>$id));
}
public function actionDetail() {


  $id= $_GET["id"];

  $this->renderPartial('detail',array('id'=>$id));
}


public function actionIndex2() {




  $access = Yii::app()->request->cookies['cookie_commart_system']->value;

  $CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128,2, $access);
  $this->render("index2",array("access"=>$access,"CAccess"=>$CAccess));
}





}




?>