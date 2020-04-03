<?php
class ReportController extends Controller
{
	public function actionIndex(){
		$this->render("index");
	}

	public function actionTotal(){
		$this->render("total");
	}
	public function actionTotalallbrand(){
		$this->render("totalbrand");
	}
	public function actionTotalallbrandonly(){
		$this->render("totalbrandonly");
	}
	
} 
?>