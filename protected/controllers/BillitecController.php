<?php

class BillitecController extends CController {

    public function actionIndex() {

        $this->render("index");
    }
    public function actionShow()
    {


        $content = file_get_contents("http://172.18.0.135:8505/get/orderbeforitecbill");

        $result  = json_decode($content, true);
        $data=array();
        foreach ($result as $r ) {
          $data[]=array(

            'orderid'=>$r["orderid"],
            'alocateid'=>$r["alocateid"],
            'payq'=>$r["payq"],
            'customer'=>$r["customer"],
            'modelid'=>$r["modelid"],
            'productid'=>$r["productid"],
            'productname'=>$r["productname"]


        );
      }

      echo json_encode($data);






  }


}

?>