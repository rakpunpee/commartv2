<?php

class ChangeproductController extends Controller {

    public function actionIndex() {
        if (empty(Yii::app()->request->cookies['cookie_point']->value)) {
            $this->redirect(array("Logging/Login"));
            exit();
        }
        
        $this->render("index");
    }
    public function actionChange() {
        
    }
}

?>
