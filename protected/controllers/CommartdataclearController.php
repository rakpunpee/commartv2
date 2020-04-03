<?php

/**
 * 
 */
class CommartdataclearController extends CController
{
    public function actionIndex()
    {
       $this->render('index'); 
    }
    public function actionClearofData()
    {
    	 echo Yii::app()->db->createCommand("TRUNCATE TABLE logorder")->execute();
    	 echo Yii::app()->db->createCommand("TRUNCATE TABLE logupdatestock")->execute();
    	 echo Yii::app()->db->createCommand("TRUNCATE TABLE orderdoc")->execute();
    	 echo Yii::app()->db->createCommand("TRUNCATE TABLE pledge")->execute();
    	 echo  Yii::app()->db->createCommand("TRUNCATE TABLE stock")->execute();

    	 
    }

	
}