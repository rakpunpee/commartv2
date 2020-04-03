<?php
class PaymentController extends Controller
{
	public function actionIndex(){
		
		$str="SELECT MAX(payq) AS lastq FROM orderdoc WHERE DATE(orderdate)=CURDATE()";
		$data=Yii::app()->db->createCommand($str)->queryRow();

		$this->render("index",array(
			'lastq'=>$data["lastq"]
		));

	}

	public function actionPaycusdata(){


		$cus=$_POST["customer"];

		$newcus = explode(":",$cus);
		$alo=trim($newcus[0]);
		$alocateid = substr($alo, 3);
		 // echo $sss;
		// $cusname=trim(end(explode(":",$cus)));
		$str="SELECT *,IFNULL(price*qty,0) as pricesum,CONCAT(alocateid,orderid) as alocateid4 FROM orderdoc WHERE orderid='$alocateid' AND DATE(orderdate)=CURDATE() AND `status`=0 ";
		$limit="  LIMIT 1 ";
		$data=Yii::app()->db->createCommand($str.$limit)->queryRow();
		$source=Yii::app()->db->createCommand($str)->queryAll();
		$paypd=array();
		foreach($source as $r){
			$paypd[]=array(
				'productid'=>$r["productid"],
				'productname'=>$r["productname"],
				'qty'=>$r["qty"],
				'price'=>$r["price"],
				'sumprice'=>$r["price"]*$r["qty"],

			);
		}
		echo $data["commentregister"]."||".$data["alocateid4"]."||".$data["customer"]."||".$data["addr1"]."||".$data["addr2"]."||".$data["city"]."||".$data["zipid"]."||".$data["tel"]."||".json_encode($paypd);
	}

	public function actionSavepayment(){
		$paytype=$_GET["paytype"];
		$alocateid=$_GET["alocateid"];

		$customer=$_GET["customer"];
		if(!empty($_GET["addr1"])){ $addr1=$_GET["addr1"]; }else{ $addr1=''; }
		if(!empty($_GET["addr2"])){ $addr2=$_GET["addr2"]; }else{ $addr2=''; }
		if(!empty($_GET["city"])){ $city=$_GET["city"]; }else{ $city=''; }
		if(!empty($_GET["zipid"])){ $zipid=$_GET["zipid"]; }else{ $zipid=''; }
		$tel=$_GET["tel"];
		$payq=$_GET["payq"];
		$cash=$_GET["cash"];
		$creditcard=$_GET["creditcard"];
		$percharge=$_GET["percharge"];
		$chargebath=$_GET["chargebath"];
		$loan=$_GET["loan"];
		$tranfer=$_GET["tranfer"];
		$total=$_GET["total"];
		if(!empty($_GET["payremark"])){ $payremark=$_GET["payremark"]; }else{ $payremark=''; }
		if(!empty($_GET["bank"])){ $bank=$_GET["bank"]; }else{ $bank=''; }

		$str="SELECT MAX(paydoc) AS lastid  FROM orderdoc";
		$data=Yii::app()->db->createCommand($str)->queryRow();
		if(!empty($data["lastid"])){
			$lastid=substr($data["lastid"],6,5)+0;
		}else{
			$lastid=1;
		}
		$lastid++;
		$paydoc=date("Ym").sprintf("%05d",$lastid);

		$upd="UPDATE orderdoc as a SET

		a.customer='$customer',
		a.addr1='$addr1',
		a.addr2='$addr2',
		a.city='$city',
		a.zipid='$zipid',
		a.tel='$tel',
		a.payq='$payq',
		a.pay=1,
		a.paydoc='$paydoc',
		a.paytype='$paytype',
		a.paydate=NOW(),
		a.cash='$cash',
		a.creditcard='$creditcard',
		a.percharge='$percharge',
		a.chargebath='$chargebath',
		a.loan='$loan',
		a.tranfer='$tranfer',
		a.total='$total',
		a.payremark='$payremark',
		a.bank='$bank'
		WHERE a.orderid='$alocateid' AND DATE(a.orderdate)=CURDATE()";


		$ckcodeque ="SELECT dateq,typeq,runq,payq,timeupd,codechk FROM runqcommart WHERE dateq=CURDATE() AND payq ='$payq'";
		$datacode=Yii::app()->db->createCommand($ckcodeque)->queryRow();

		$messagestring = 'ตรวจสอบคิวได้ที่: http://27.131.138.143:2018/qv/'.$datacode['codechk'];


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


		echo Yii::app()->db->createCommand($upd)->execute();


	}


	public function actionList(){
		
		$str="SELECT * FROM orderdoc WHERE DATE(orderdate)=CURDATE() AND `status`=0 AND pay=1 ORDER BY payq DESC ";//curdate()
		$result=Yii::app()->db->createCommand($str)->queryAll();

		$this->render("list",array(
			'result'=>$result
		));
	}
	public function actionList21(){
		
		$str="SELECT * FROM orderdoc WHERE `status`=0 AND pay=1 AND date(orderdate)='2018-06-21' ORDER BY payq DESC ";//curdate()
		$result=Yii::app()->db->createCommand($str)->queryAll();

		$this->render("list2",array(
			'result'=>$result
		));
	}
	public function actionList22(){
		
		$str="SELECT * FROM orderdoc WHERE `status`=0 AND pay=1 AND date(orderdate)='2018-06-22' ORDER BY payq DESC ";//curdate()
		$result=Yii::app()->db->createCommand($str)->queryAll();

		$this->render("list2",array(
			'result'=>$result
		));
	}
	public function actionList23(){
		
		$str="SELECT * FROM orderdoc WHERE `status`=0 AND pay=1 AND date(orderdate)='2018-06-23' ORDER BY payq DESC ";//curdate()
		$result=Yii::app()->db->createCommand($str)->queryAll();

		$this->render("list2",array(
			'result'=>$result
		));
	}
	public function actionList24(){
		
		$str="SELECT * FROM orderdoc WHERE `status`=0 AND pay=1 AND date(orderdate)='2018-06-24' ORDER BY payq DESC ";//curdate()
		$result=Yii::app()->db->createCommand($str)->queryAll();

		$this->render("list2",array(
			'result'=>$result
		));
	}

	public function actionCancelbillpay($paydoc){
		$upd="UPDATE orderdoc as a LEFT JOIN runqcommart as b ON a.payq = b.payq SET a.payq='',a.pay=0,b.flaq=0 WHERE a.orderid='$paydoc' AND a.pay=1 ";
		if(Yii::app()->db->createCommand($upd)->execute()){
			$this->redirect(array("payment/list"));
		}

	}

	public function actionChkpayq(){
		$payq=$_POST["payq"];
		$str="SELECT COUNT(*) AS countpay FROM orderdoc WHERE DATE(orderdate)=CURDATE() AND `status`=0 AND payq='$payq' ";
		$data=Yii::app()->db->createCommand($str)->queryRow();
		if($data["countpay"]>0){
			echo "false";
		}else{
			echo "true";
		}
	}
}
?>