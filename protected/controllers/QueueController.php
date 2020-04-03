<?php

class QueueController extends CController {

    public function actionIndex() {
       
        $this->render("index");
    }
    public function actionShow(){

        $str="SELECT
        nocheck.`no`,
        TIMEDIFF(NOW(),qtime) as waittime,
        nocheck.payq
        FROM 
        nocheck LIMIT 0,10 
        ";

        $result=Yii::app()->db->createCommand($str)->queryAll();


        $data=array();
        foreach ($result as $r ) {
            $data[]=array(
                'no'=>$r['no'],
                'payq'=>$r['payq'],
                'waittime'=>$r['waittime'],

                

            );
            
        }
        echo json_encode($data);

    }
    public function actionShow2(){

        $str="SELECT
        nocheck.`no`,
        TIMEDIFF(NOW(),qtime) as waittime,
        nocheck.payq
        FROM 
        nocheck LIMIT 10,20 
        ";

        $result=Yii::app()->db->createCommand($str)->queryAll();


        $data=array();
        foreach ($result as $r ) {
            $data[]=array(
                'no'=>$r['no'],
                'payq'=>$r['payq'],
                'waittime'=>$r['waittime'],

                

            );
            
        }
        echo json_encode($data);

    }
     public function actionShowsearch(){

        $str="SELECT r.runq,CONCAT(o.alocateid,o.orderid)as alocateid,TIME(o.sucessdate) as sucessdate,r.servicecheck
FROM runqcommart as r 
LEFT JOIN orderdoc as o ON r.payq = o.payq AND DATE(o.orderdate) = DATE(r.dateq) 
WHERE DATE(r.dateq) = curdate() AND r.flaq = 2 ORDER BY r.runq DESC
        ";

        $result=Yii::app()->db->createCommand($str)->queryAll();


        $data=array();
        foreach ($result as $r ) {
            $data[]=array(
                'runq'=>$r['runq'],
                'alocateid'=>$r['alocateid'],
                'sucessdate'=>$r['sucessdate'],
                'servicecheck'=>$r['servicecheck'],

                

            );
            
        }
        echo json_encode($data);

    }

    public function actionTruncate(){

        $str="UPDATE nocheck SET payq='',qtime=null ";

        $result=Yii::app()->db->createCommand($str)->execute();

        echo "<script>alert('Clear SuCCess'); window.location.href = '" . $this->createUrl('queue/index') . "'</script>";


    }
    public function actionShowqueu()
    {


        $content = file_get_contents("http://172.18.0.135:8505/get/count/lastitecbill");

        $result  = json_decode($content, true);
        $data=array();
        foreach ($result as $r ) {
          $data[]=array(

            'c_orderlastitec'=>$r["c_orderlastitec"]


        );
      }

      echo json_encode($data);






  }

  public function actionView() {

    $this->render("view");
}
 public function actionSearch() {

    $this->render("search");
}

public function actionUpdateservicecheck()
    {
       
        $runq=$_POST['runq'];
        $servicecheck=$_POST['servicecheck'];
        
            $up="UPDATE runqcommart SET servicecheck='$servicecheck' 
            WHERE runq='$runq'";
            echo Yii::app()->db->createCommand($up)->execute();
       
        

    }


public function actionShowqueue()
{


    $content = file_get_contents("http://172.18.0.135:8505/get/orderafteritecbill");

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