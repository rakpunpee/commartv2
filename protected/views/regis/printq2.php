<?php
$baseUrl=Yii::app()->request->baseUrl;
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/qrcode.min.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/nodejs/socket-io.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/barcode/jquery.min.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/barcode/EAN_UPC.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/barcode/CODE128.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/barcode/JsBarcode.js"></script>



</head>
<body>


	<script>
		$(document).ready(function(){
			$("#barcode").JsBarcode("<?php echo $data['cid']; ?>",{width:1,height:25});
			$("#barcode2").JsBarcode("<?php echo $data['cid']; ?>",{width:1,height:25});
		});

		window.onload = function () {
			window.print();
			var qrcode = new QRCode("qrcode", {text: "http://27.131.138.143:2018/qv/<?php echo $data['codechk']; ?> ", width: 70, height: 70, colorDark : "#000000", colorLight : "#ffffff",correctLevel : QRCode.CorrectLevel.M}); qrcode.makeCode();

		}

			// window.onload = function() {
			// 	window.print();
			// 	// window.close();
			// }

		</script>
		<?php


		?>

		<div width="100%" style="margin-bottom: 0px;margin-top: 0px;height:395px;">
			<div width="100%" style="margin-bottom: 0px;margin-top: 0px;height:290.677165354px;">
				<center>ตรวจสอบคิวออนไลน์<p id="qrcode" style="margin-bottom: 0px;margin-top: 0px;"></p></center>

			</div>

			<table width="100%" height:"100%"  >
				<tr>
					<td width="35%" >&nbsp;</td>
					<td width="65%" ></td>
				</tr>
			</table>


		</div>
		<div style="
		padding-top: 0px;
		">
		<table width="100%" height:"100%"  >
			<tr>
				<td width="35%" >&nbsp;</td>
				<td width="65%" ><center><k style="font-size:22px;"><STRONg><?php echo $data['cid']; ?></STRONg></k><br><k style="font-size:12px;"><?php echo $data['timeq']; ?></k></center></td>
			</tr>
		</table>
	</div>
	<div width="100%" style="margin-bottom: 0px;margin-top: 0px;height:24.677165354px; padding-top: 0px;">


	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="col-xs-8">

				<k style="font-size:30px;text-align: right;">
					<center style="height: 0px;"><STRONg><?php echo $data['cid']; ?> </STRONg></center></k>
				</div>
				<div class="col-xs-4" align="right">
					<img id="barcode"/>
				</div>
				<div style="font-size:12px;text-align: center;">
					<?php echo $typename; ?>
				</div>

				<div class="col-xs-12">
					<div style="font-size:12px;text-align: center;">
						<?php echo $data['timeq']; ?>
					</div>
				</div>

		<!-- <div class="col-xs-6">
			<div align="right">
				<img id="barcode"/>
			</div>
		</div> -->

	</div>
</div>
<div width="100%" style="margin-bottom: 0px;margin-top: 0px;height:28px; padding-top: 10px;">



</div>
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-8">
			<k style="font-size:30px;"><center style="height: 0px;"><STRONg><?php echo $data['cid']; ?></STRONg></center></k>
		</div>

		<div class="col-xs-4" align="right">
			<img id="barcode2"/>
		</div>
		<div class="col-xs-12" align="center">
			<k style="font-size:12px;"><?php echo $typename; ?></k><br>

			<k style="font-size:12px;"><?php echo $data['timeq']; ?></k>

		</div>
	</div>
</div>

</body>
</html>