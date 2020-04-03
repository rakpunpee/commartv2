<?php $baseUrl = Yii::app()->request->baseUrl; ?>
 <script src="<?php echo $baseUrl;?>/js/jquery-1.10.2.min.js"></script>
<script>

	

	 window.onload = function() { window.print(); 
	window.close(); }

</script>
<?php 
	$str="SELECT dateq,typeq,runq,CONCAT(DATE_FORMAT(upd,'%m/%d/%Y %H:%i')) AS timeq,cid FROM ddcountq WHERE typeq='$q' AND dateq=CURDATE()  ORDER BY runq DESC LIMIT 1";
		$data=Yii::app()->db->createCommand($str)->queryRow();
		if($data['typeq']=='A'){
			$typename='เงินสด/บัตรเครดิต';
		}else{
			$typename='สินเชื่อ';
		}

	 ?>


<div width="100%" style="margin-bottom: 0px;margin-top: 0px;height:398.18897638px;">

	 <center><p id="qrcode"></p></center>

</div>
<div>
<table width="100%" height:"100%"  >	
				<tr>
					<td width="35%" >&nbsp;</td>
					<td width="65%" ><center><k style="font-size:22px;"><STRONg><?php echo $data['cid']; ?></STRONg></k><br><k style="font-size:12px;"><?php echo $data['timeq']; ?></k></center></td>
				</tr>
		</table>
</div>
<div width="100%" style="margin-bottom: 0px;margin-top: 0px;height:24.677165354px;">



</div>
<div>
<center><k style="font-size:30px;"><STRONg><?php echo $data['cid']; ?></STRONg></k><br>
<k style="font-size:12px;"><?php echo $typename; ?></k><br><k style="font-size:12px;"><?php echo $data['timeq']; ?></k>
</center>
</div>
<div width="100%" style="margin-bottom: 0px;margin-top: 0px;height:30.236220472px;">



</div>
<div>
<center><k style="font-size:30px;"><STRONg><?php echo $data['cid']; ?></STRONg></k><br>
<k style="font-size:12px;"><?php echo $typename; ?></k><br><k style="font-size:12px;"><?php echo $data['timeq']; ?></k>
</center>
</div>