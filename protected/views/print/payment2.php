<?php
$baseUrl=Yii::app()->request->baseUrl;
?>
<script src="<?php echo $baseUrl; ?>/js/barcode/jquery.min.js"></script>
<script src="<?php echo $baseUrl; ?>/js/barcode/EAN_UPC.js"></script>
<script src="<?php echo $baseUrl; ?>/js/barcode/CODE128.js"></script>
<script src="<?php echo $baseUrl; ?>/js/barcode/JsBarcode.js"></script>

<style>
.weight{
	font-size:16px;
	font-weight: bold;
}
.weight2{
	font-size:14px;
	font-weight: bold;
}
.weight3{
	font-size:10px;
	font-weight: bold;
}
.box{
	float: left;
	width:50%;
	border: 1px solid #000000;
	padding: 20px;
}

</style>

<?php
$str="SELECT a.orderid,a.alocateid,a.modelid,b.brand,a.productid,a.productname,a.qty
FROM orderdoc a INNER JOIN stock b ON a.productid=b.productid
WHERE a.orderid='$alocateid' AND a.payq='$payq' AND `status`=0";

$limit="SELECT * FROM orderdoc WHERE orderid='$alocateid' AND payq='$payq' AND `status`=0 LIMIT 1";

$data=Yii::app()->db->createCommand($limit)->queryRow();
$result=Yii::app()->db->createCommand($str)->queryAll();
?>
<script>
	$(document).ready(function(){
		$("#barcode").JsBarcode("<?php echo $data['alocateid'].$data['orderid']; ?>",{width:1,height:20});
	});
</script>
<?php for($x=0;$x<3;$x++){?>

	<?php
	if($x==0){
		$title="(ต้นฉบับ - สำหรับลูกค้า)";
	}else if($x==1){
		$title="(สำเนา - สำหรับการเงิน)";
	}else if($x==2){
		$title="(สำเนา - สำหรับสต็อก)";
	}
	?>
	<div class="page-break<?php echo ($x==0)?"-no":"";?>">&nbsp;</div>
	<div style="float: left" class="weight">บริษัท เจ.ไอ.บี. คอมพิวเตอร์ กรุ๊ป จำกัด</div>
	<div style="float: right; margin-right: 50px;">ลำดับคิว &nbsp;&nbsp; <?php echo $payq;?> </div>

	<div style="clear: both;"></div>
	<div style="float: left">99 เซียร์รังสิต ชั้น 4 ห้องเอฟซี 111-115 หมู่ 8 ถ.พหลโยธิน ต.คูคต อ.ลำลูกกา</div>
	<div style="float: right; margin-right: 11px;">เลขที่ &nbsp;&nbsp;&nbsp;<?php echo $data["paydoc"];?></div>

	<div style="clear: both;"></div>
	<div style="float: left">จ.ปทุมธานี 12130 โทร. 0-2992-6051</div>
	<div style="float: right; margin-right: 22px;">วันที่ &nbsp;&nbsp; <?php echo MyClass::convertDatetime($data["orderdate"]);?><br></div>
	<br><br>

	<div style="clear: both;"></div>
	<div style="text-align: center;" class="weight">ใบเสร็จรับเงินชั่วคราว/ใบรับประกันสินค้า</div>
	<div style="clear: both;"></div>
	<div style="text-align: center;" class="weight3"><?php echo $title;?></div>
	<br>

	<div style="clear: both;"></div>
	<div class="box">



		<div style="float: left; width:70px;">ชื่อลูกค้า</div>
		<div style="float: left;"><?php echo $data["customer"];?></div>
		<div style="clear: both;"></div>
		<div style="float: left; width:70px;">ที่อยู่</div>
		<div style="float: left;"><?php echo $data["addr1"];?></div>
		<div style="clear: both;"></div>
		<div style="float: left; width:70px;">.</div>
		<div style="float: left;"><?php echo $data["addr2"];?></div>
		<div style="clear: both;"></div>
		<div style="float: left; width:70px;">.</div>
		<div style="float: left;"><?php echo $data["city"];?> <?php echo $data["zipid"];?></div>
		<div style="clear: both;"></div>
		<div style="float: left; width:70px;">โทรศัพท์</div>
		<div style="float: left;"><?php echo $data["tel"];?></div>
	</div>

	<div style="float: right; margin-right:30px;font-size:12px;">
		เวลาเริ่ม Register&nbsp;&nbsp;&nbsp;&nbsp;<?php echo MyClass::convertDateshowtime($data["orderdate"]);?>
		<br>
		<?php if($data["requesvat"] == 1) {?>
			<div class="weight2">- ต้องการใบกำกับภาษี [ Tax invoice ]</div>
		<?php } else { ?>

		<?php } ?>		
		<div>- ผู้ขาย &nbsp;&nbsp;<?php echo $data['register'] ?></div>
		<div>- บูทขาย &nbsp;&nbsp;<?php echo $data['boots'] ?></div>
		<div>- เลขที่ออเดอร์ &nbsp;&nbsp;<?php echo $data['alocateid'].$data['orderid']; ?> <br><img id="barcode"/></div>


	</div>

	<div style="clear: both;"></div><br>
	<div>
		<table cellpadding="4" cellspacing="0" border="0" width="100%" style="font-size: 12px;">
			<thead>
				<tr>
					<td width="6%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">ลำดับ</td>
					<td width="10%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">ยี่ห้อ</td>
					<td width="6%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">#</td>
					<td width="6%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">รุ่น</td>
					<td width="16%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">รหัสสินค้า</td>
					<td width="70%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">ชื่อ</td>
					<td width="6%" align="right" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">จำนวน</td>
				</tr>
			</thead>
			<tbody>
				<?php $n=0;?>
				<?php foreach($result as $r){?>
					<?php $n++;?>
					<tr>
						<td><?php echo $n;?></td>

						<td><?php echo $r["brand"];?></td>
						<td><?php echo $r["alocateid"].$r["orderid"];?></td>
						<td><?php echo $r["modelid"];?></td>
						<td><?php echo $r["productid"];?></td>
						<td><?php echo $r["productname"];?></td>
						<td align="right"><?php echo $r["qty"];?></td>
					</tr>
				<?php }?>
				<?php if($n<=14){?>
					<?php $blank=14-$n;?>
					<?php for($i=0;$i<$blank;$i++){?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					<?php }?>
				<?php }?>
				<tr>
					<td colspan="5">รายการของแถม : <?php echo $data["promotiondetail"];?></td>
				</tr>
				<tr>
					<td colspan="5">หมายเหตุ Register : <?php echo $data["commentregister"];?></td>
				</tr>
				<tr>
					<td colspan="5">หมายเหตุ Payment : <?php echo $data["payremark"];?></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">(<?php echo ThaiBahtConversion($data["total"]);?>)</td>
					<td align="center" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;"><strong>รวมเงิน</strong></td>
					<td style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;"><strong><?php echo number_format($data["total"],2,'.',',')?></strong></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<br>
	<div>ประเภทการชำระ : <?php echo $data["paytype"];?>

	<?php if($data["bank"] != ""){ ?>


		ธนาคาร : <?php echo $data["bank"];?>
	<?php  } ?>

</div>
<table cellpadding="4" cellspacing="2" border="0" width="100%">
	<tr>
		<td>เงินสด</td>
		<td><?php echo ($data["cash"]!=0)?number_format($data["cash"],'2','.',','):"";?></td>
		<td>บาท</td>
		<td>บัตรเครดิต</td>
		<td><?php echo ($data["creditcard"]!=0)?number_format($data["creditcard"],'2','.',','):"";?></td>
		<td>บาท</td>
		<td>สินเชื่อ</td>
		<td><?php echo ($data["loan"]!=0)?number_format($data["loan"],'2','.',','):"";?></td>
		<td>บาท</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>ค่าชาร์จ</td>
		<td><?php echo ($data["chargebath"]!=0)?number_format($data["chargebath"],'2','.',','):"";?></td>
		<td>บาท</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<br>
<br>
<div style="clear: both;"></div>
<div><strong>ได้รับสินค้าตามรายการข้างบนถูกต้องครบถ้วนแล้ว</strong></div><br><br><br>
<div style="float: left;">ผู้รับสินค้า</div>
<div style="float: left;">.......................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="float: left;">ผู้ขาย</div>
<div style="float: left;">.......................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="float: left;">ผู้รับเงิน</div>
<div style="float: left;">.......................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<br />

<?php }?>
<?php
function ThaiBahtConversion($amount_number)
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
	//return iconv("UTF-8", "TIS-620", $ret);
	return $ret;
}

function ReadNumber($number)
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

echo "<script>javascript:window.print()</script>";
?>
<script>
var oMyObject = window.dialogArguments; // รับค่า window object มา
oMyObject.location='<?php echo $this->createUrl("payment/index");?>'; // ชื่อไฟล์หน้าหลัก ที่ต้องการ โหลด


</script>






