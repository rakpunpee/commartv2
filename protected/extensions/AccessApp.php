<?php
class AccessApp{
	public function accesspage($id,$program,$menu,$access){
		$CAccess=array();
		
		$attributes=array();
		$attributes["menu_id"]=$menu;
		$attributes["program_id"]=$program;
		$attributes["user_id"]=$id;
		
		if($access==0){
			$model=Sysusermenu::model()->findByAttributes($attributes);
			if(!empty($model)){
				if($model["views"] !=0){
					$CAccess[0]=$model["views"];
					$CAccess[1]=$model["creates"];
					$CAccess[2]=$model["edits"];
					$CAccess[3]=$model["deletes"];
					$CAccess[4]=$model["approves"];
					$CAccess[5]=$model["printed"];			
					return $CAccess;
				}else{
					$this->render("//dialog/unaccess");exit();
				}
			}else{
				$this->render("//dialog/unaccess");exit();
			}
		}else{
			$CAccess[0]=1;
			$CAccess[1]=1;
			$CAccess[2]=1;
			$CAccess[3]=1;
			$CAccess[4]=1;
			$CAccess[5]=1;
			
			return $CAccess; 
		}
	}
}
?>
