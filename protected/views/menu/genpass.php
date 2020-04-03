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
	window.close(); }
	

	</script>

	<?php 

	$str="SELECT shop ,password FROM regisshop
	";

	$result=Yii::app()->db->createCommand($str)->queryAll();



	?>

	<table width="100%" border="0"  >
<thead>
		<tr>
			<th align="center">Booth</th>
			<th align="center">Password</th>
			
		</tr>
	</thead>
	<?php foreach($result as $r){ 
		
		?>
		<tr>
			<td align="center"><?php echo $r["shop"];?></td>
			<td align="center"><?php echo $r["password"];?></td>


		<?php }?>
	</table>

</body>
</html>
<style>
body{
	font-size:12px;
}	

</style>