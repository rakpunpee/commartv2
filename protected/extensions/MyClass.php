<?php
class MyClass{
	public static function generateCode($fyear,$fmonth,$fnumb,$ftext,$formats,$fsp){
		#$fyearส่งตัวแปล y=ปีสองหลัก, Y=ปีสี่หลัง
		#$fmonth ส่งตวแป n=เดือนหลักเดียว, m=เดือนสองหลัก
		#$fumb จำนวนหลังที่เจนตัวเลย กำหนดเป็นจำนวนตัวเลข
		#$ftext ตัวอักษรนำหน้าเลขเจน
		#$formats รูปแบบเลขเจนเดิมเพื่อนำมาบวกค่าล่าสุด
		#$fsp กรณีที่จะกำหนดปีเป็น format thai
		$lenword1=strlen($ftext);
		if($fyear=="y"){$lenword2=2;}elseif($fyear=="Y"){$lenword2=4;}
		if($fmonth=="n"){$lenword3=1;}elseif($fmonth=="m"){$lenword3=2;}
		$omonth=$lenword1+$lenword2;
		$omonth=substr($formats,$omonth,$lenword3);
		$setyear=date($fyear);
		if($fsp){
			$setyear=$setyear+$fsp;
		}
		if($omonth==date($fmonth)){
			#$lenword4=strlen($formats);
			#$setpoint=($lenword4-$fnumb)+1;
			$fnumb=$fnumb*(-1);
			$genumb=(substr($formats,$fnumb)+0)+1;
			$fnumb=$fnumb*(-1);
			$generate=$ftext.$setyear.date($fmonth).sprintf("%0".$fnumb."d",$genumb);
		}else{
			$generate=$ftext.$setyear.date($fmonth).sprintf("%0".$fnumb."d",1);
		}
		return $generate;
	}
	
	public static function duplicatekey($tb,$w,$key,$y,$m,$n,$t,$sq,$s){
		$str="SELECT * FROM $tb WHERE $w='$key' ";
		$rcount=count(Yii::app()->db->createCommand($str)->queryAll());
		if($rcount>0){
			$set=Yii::app()->db->createCommand($sq)->queryRow();
			$id=generateCode($y,$m,$n,$t,$set[0],$s);
		}else{
			$id=$key;
		}
		return $id;
	}
	
	public static function insertDate($setdate){
		$date="";
		if($setdate){
			$exp=explode("/",$setdate);
			$date=$exp[2].$exp[1].$exp[0];
		}
		return $date;
	}
	public static function convertDate($setdate){
		$date="";
		if($setdate){
			$exp=explode("-",$setdate);
			$date=$exp[2]."/".$exp[1]."/".$exp[0];
		}
		return $date;
	}
	public static function convertDatetime($setdate){
		$date=null;
		if($setdate){
			$exp=explode(" ",$setdate);
			$exp2=explode("-",$exp[0]);
			$date=$exp2[2]."/".$exp2[1]."/".$exp2[0];
		}
		return $date;
	}
	public static function convertDateshowtime($setdate){
		$date=null;
		if($setdate){
			$exp=explode(" ",$setdate);
			$exp2=explode("-",$exp[0]);
			$date=$exp2[2]."/".$exp2[1]."/".$exp2[0]." ".$exp[1];
		}
		return $date;
	}
	public static function convertShotdate($setdate){
		$date=null;
		if($setdate){
			$exp=explode("-",$setdate);
			$y=(substr($exp[0],2,2)+0)+43;
			$date=$exp[2]."/".$exp[1]."/".$y;
		}
		return $date;
	}
	public  static function ageWork($birthday) {
		list($day,$month,$year) = explode("/", $birthday);
					
		$datedeb=mktime(0,0,0,$month,$day,$year); 
		$datefin=time();
					
		$aad=date("Y",$datedeb);
		$mmd=date("m",$datedeb);
		$jjd=date("d",$datedeb);
					
		$aaf=date("Y",$datefin);
		$mmf=date("m",$datefin);
		$jjf=date("d",$datefin);
					
		$nbj=array(0,31,28,31,30,31,30,31,31,30,31,30,31); //ÇÑ¹áµèÅÐà´×Í¹
		if(($aaf % 4)==0){$nbj[2]=29;} //»ÕÍ¸Ô¡ÊØÃ·Ô¹
		if((($aaf % 100)==0)&(($aaf % 400)!=0)){$nbj[2]=28;} //»ÕÍ¸Ô¡ÊØÃ·Ô¹
					
		if($jjf<$jjd){$jjf=$jjf+$nbj[(int)$mmf];$mmf=$mmf-1;}
		if($mmf<$mmd){$mmf=$mmf+12;$aaf=$aaf-1;}
			
		return "".sprintf("%02d",($aaf-$aad))." ปี ".sprintf("%02d",($mmf-$mmd))." เดือน ".sprintf("%02d",($jjf-$jjd))." วัน ";
	}
	
	public function ThaiBahtConversion($amount_number)
	{
		$amount_number = number_format($amount_number, 2, ".","");
		//echo "<br/>amount = " . $amount_number . "<br/>";
		$pt = strpos($amount_number , ".");
		$number = $fraction = "";
		if ($pt === false)
			$number = $amount_number;
		else
		{
			$number = substr($amount_number, 0, $pt);
			$fraction = substr($amount_number, $pt + 1);
		}
	
		//list($number, $fraction) = explode(".", $number);
		$ret = "";
		$baht = ReadNumber ($number);
		if ($baht != "")
			$ret .= $baht . "บาท";
	
		$satang = ReadNumber($fraction);
		if ($satang != "")
			$ret .=  $satang . "สตางค์";
		else
			$ret .= "ถ้วน";
		return iconv("UTF-8", "TIS-620", $ret);
		return $ret;
	}
	
	private function ReadNumber($number)
	{
		$position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
		$number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
		$number = $number + 0;
		$ret = "";
		if ($number == 0) return $ret;
		if ($number > 1000000)
		{
			$ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
			$number = intval(fmod($number, 1000000));
		}
	
		$divider = 100000;
		$pos = 0;
		while($number > 0)
		{
			$d = intval($number / $divider);
			$ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
			((($divider == 10) && ($d == 1)) ? "" :
					((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
			$ret .= ($d ? $position_call[$pos] : "");
			$number = $number % $divider;
			$divider = $divider / 10;
			$pos++;
		}
		return $ret;
	}
}
?>