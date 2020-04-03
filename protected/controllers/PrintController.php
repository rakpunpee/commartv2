<?php
class PrintController extends Controller
{
	public $layout="//layouts/print";
	
	public function actionPrintbill($alocateid=null,$payq=null){



		$this->render("payment",array(
			'alocateid'=>$alocateid,
			'payq'=>$payq
		));
	}
	public function actionPrintbill2($alocateid=null,$payq=null){



		$this->render("payment2",array(
			'alocateid'=>$alocateid,
			'payq'=>$payq
		));
	}
	
	public function actionPrintbooking($orderdoc=null){
		$this->render("bookprint",array(
			'orderdoc'=>$orderdoc	
		));
	}

	public function actionPrintStick()
	{
		$this->render("printstick");
	}
} 
?>