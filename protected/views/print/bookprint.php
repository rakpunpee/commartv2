<style>
.weight{
	font-size:16px;
	font-weight: bold;
}
.weight2{
	font-size:14px;
	font-weight: bold;
}
.box{
	float: left;
	width:60%;
	border: 1px solid #000000;
	padding: 20px;
}

</style>

<?php
$str="SELECT product,name,alocate,unitamt,totalamt FROM pledge WHERE orderdoc='$orderdoc'";

$limit="SELECT *,SUM(totalamt) AS nettotalamt  FROM pledge WHERE orderdoc='$orderdoc' LIMIT 1";

$data=Yii::app()->db->createCommand($limit)->queryRow();
$result=Yii::app()->db->createCommand($str)->queryAll();
?>
<?php for($x=0;$x<2;$x++){?>
<?php
	if($x==0){
		$title="(ต้นฉบับ - สำหรับลูกค้า)";
	}else if($x==1){
		$title="(สำเนา)";
	}
	?>
<div class="page-break<?=($x==0)?"-no":""?>">&nbsp;</div>
<div style="float: left" class="weight">บริษัท เจ.ไอ.บี. คอมพิวเตอร์ กรุ๊ป จำกัด</div>
<div style="float: right; margin-right: 20px;">เลขที่ใบจอง &nbsp;&nbsp;&nbsp; <?php echo $data["orderdoc"];?></div>

<div style="clear: both;"></div>
<div style="float: left">เลขที่ 21 ถนนพหลโยธิน แขวงสนามบิน เขตดอนเมือง กรุงเทพ ฯ</div>
<div style="float: right; margin-right: 21px;">วันที่จอง &nbsp;&nbsp;&nbsp;<?php echo MyClass::convertDate($data["orderdate"]);?></div>

<div style="clear: both;"></div>
<div style="float: left">โทร. 0-2791-2000</div>
<div style="float: right; margin-right: 22px;">วันที่รับสินค้า &nbsp;&nbsp; <?php echo MyClass::convertDate($data["pledgedate"]);?></div>
<br><br>

<div style="clear: both;"></div>
<div style="text-align: center;" class="weight">ใบจองสินค้า/ใบมัดจำสินค้า</div>
<div style="clear: both;"></div>
<div style="text-align: center;" class="weight2"><?php echo $title;?></div>
<br>

<div style="clear: both;"></div>
<div class="box">
	<div style="float: left; width:80px;">ชื่อลูกค้า</div>
	<div style="float: left;"><?php echo $data["customer"];?></div>
	<br>
	<div style="float: left; width:80px;">ที่อยู่</div>
	<div style="float: left;"><?php echo $data["addr1"];?></div>
	<br>
	<div style="float: left; width:80px;">.</div>
	<div style="float: left;"><?php echo $data["addr2"];?></div>
	<br>
	<div style="float: left; width:80px;">.</div>
	<div style="float: left;"><?php echo $data["city"];?> <?php echo $data["zipcode"];?></div>
	<br>
	<div style="float: left; width:80px;">โทรศัพท์</div>
	<div style="float: left;"><?php echo $data["tel"];?></div>
</div>



<div style="clear: both;"></div><br>
<div>
<table cellpadding="4" cellspacing="0" border="0" width="100%" style="font-size: 12px;">
	<thead>
	<tr>
		<td width="6%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">ลำดับ</td>
		<td width="70%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">รายการสินค้า</td>
		<td width="6%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">จำนวน</td>
		<td width="8%" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">ราคา/หน่วย</td>
		<td width="8%" align="right" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000;">จำนวนเงิน</td>
	</tr>
	</thead>
	<tbody>
	<?php $n=0;?>
	<?php foreach($result as $r){?>
	<?php $n++;?>
	<tr>
		<td><?php echo $n;?></td>
		<td><?php echo $r["product"];?> <?php echo $r["name"];?></td>
		<td><?php echo $r["alocate"];?></td>
		<td align="right"><?php echo number_format($r["unitamt"],2,'.',',');?></td>
		<td align="right"><?php echo number_format($r["totalamt"],2,'.',',');?></td>
	</tr>
	<?php }?>
	<?php if($n<=10){?>
	<?php $blank=10-$n;?>
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
	</tbody>
	<tfoot>
		<tr>
			<td style="border-top:1px #000000 solid">&nbsp;</td>
			<td style="border-top:1px #000000 solid">&nbsp;</td>
			<td style="border-top:1px #000000 solid">&nbsp;</td>
			<td style="border-top:1px #000000 solid">รวมเงิน</td>
			<td style="border-top:1px #000000 solid;border-bottom:1px #000000 solid" align="right"><?php echo number_format($data["nettotalamt"],2,'.',',');?></td>
		</tr>
	</tfoot>
</table>
</div>
<div style="clear: both;"></div>
<div>

<table border="0" cellspacing="2" cellpadding="2" width="35%">
<tr>
	<td>สถานที่รับสินค้า</td>
	<td colspan="3"><?php echo $data["receive"];?></td>
</tr>
<tr>
	<td>ชำระโดย</td>
	<td>เงินสด</td>
	<td align="right"><?php echo number_format($data["amount"],2,'.',',');?></td>
	<td>บาท</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>บัตรเครดิต</td>
	<td align="right"><?php echo number_format($data["creditcardamt"],2,'.',',');?></td>
	<td>บาท</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>สินเชื่อ</td>
	<td align="right"><?php echo number_format($data["creditamt"],2,'.',',');?></td>
	<td>บาท</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>เงินมัดจำ</td>
	<td align="right"><?php echo number_format($data["pledgeamt"],2,'.',',');?></td>
	<td>บาท</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>คงเหลือ</td>
	<td align="right"><?php echo number_format($data["remain"],2,'.',',');?></td>
	<td>บาท</td>
</tr>

</table>
</div>
<div style="clear: both;"></div>
<br>
<br>
<br>
<div>
<?php echo ($data["freejib"]==1)?'รับของแถม J.I.B':'';?>&nbsp;&nbsp;
<?php echo ($data["freesupplier"]==1)?'รับของแถม Supplier':'';?>&nbsp;&nbsp;
<?php echo $data["descfreesup"];?>
</div>
<div>หมายเหตุ : <?php echo $data["comment"];?></div>
<br>
<br>
<br>
<div style="float: left;">ผู้รับจอง</div>
<div style="float: left;">.....................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="float: left;">ผู้สั่งจอง</div>
<div style="float: left;">.....................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<?php } ?>

<?php
echo "<script>javascript:window.print()</script>";
?>





