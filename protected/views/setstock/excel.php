<?php
header("content-type:application/vnd.ms-excel");
header("content-disposition:attachment; filename=Stock.xls");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<table border="1">
	<h2>Stock</h2>
	
	<thead>
		<tr>
			<th>Productid</th>
			<th>Productname</th>
			<th>Brand</th>
			<th>สต๊อก[ALL]</th>
			<th>สต๊อก[คงเหลือ]</th>
			<th>สต๊อก[พรี]</th>
			<th>สต๊อก[พรีคงเหลือ]</th>
			
		</tr>
	</thead>
	<tbody>
	<?php foreach($result as $r){ 
	
		?>
		<tr>
			<td><?php echo $r["productid"];?></td>
			<td><?php echo $r["producname"];?></td>
			<td><?php echo $r["brand"];?></td>
			
			<td><?php echo $r["stockqty"];?></td>
			<td><?php echo $r["stockremain"];?></td>
			
			<td><?php echo $r["stockpreorder"];?></td>
			<td><?php echo $r["stockpreorderqty"];?></td>


		</tr>
	<?php }?>
	</tbody>
</table>


</body>
</html>
