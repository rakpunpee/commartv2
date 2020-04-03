<?php
$baseUrl=Yii::app()->request->baseUrl;
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>

	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-1.10.2.min.js"></script>




</head>
<body>


	<script>

		window.onload = function() { window.print();
		}


	</script>

	<?php

	$id=$_GET['id'];
	$content =     file_get_contents("http://172.18.0.135:8505/get/register/byorder/".$id);

	$result  = json_decode($content, true);
	foreach ($result["data"] as $r ) {

	}

	?>

	<table width="100%" border="0"  >
		<th colspan="2"><h3><b><?php echo $r["alocateid"]; ?></b></h3></th>
		<tr>
			<td align="left" width="80px;">ชื่อลูกค้า:</td>
			<td align="left"><?php echo $r["customer"];  ?> </td>
		</tr>
			<tr>
			<td align="left" width="80px;">ที่อยู่:</td>
			<td align="left"><?php echo $r["addr"];  ?> </td>
		</tr>
		<tr>
			<td align="left">เบอร์โทร:</td>
			<td align="left"><?php echo $r["tel"]; ?> </td>
		</tr>

		<tr>
			<td align="left">รหัสสินค้า:</td>
			<td align="left"><?php echo $r["productid"]; ?> </td>
		</tr>
		<tr>
			<td align="left">ชื่อสินค้า:</td>
			<td align="left"><?php echo $r["productname"]; ?> </td>
		</tr>
		<tr>
			<td align="left">ราคา:</td>
			<td align="left"><?php echo number_format($r["price"]); ?> </td>
		</tr>
		<tr>
			<td align="left">จำนวน:</td>
			<td align="left"><?php echo $r["qty"]; ?> </td>
		</tr>
		<tr>
			<td align="left">Comment-Register:</td>
			<td align="left"><?php echo $r["commentregister"]; ?> </td>
		</tr>
		<tr>
			<td align="left">การชำระเงิน :</td>
			<td align="left"><?php echo $r["regcash"]; ?><?php echo $r["regcredit"]; ?><?php echo $r["regloan"]; ?></td>
		</tr>
		<tr>
			<td align="left">ธนาคาร :</td>
			<td align="left"><?php echo $r["Banking"]; ?></td>
		</tr>
		<tr>
			<td align="left">ผู้ขาย :</td>
			<td align="left"><?php echo $r["register"]; ?></td>
		</tr>
		





	</table>



</body>
</html>
<style>
body{
	font-size:12px;
}

</style>