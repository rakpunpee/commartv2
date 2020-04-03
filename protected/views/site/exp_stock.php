<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Stockview_commart.xls");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script>
alert('ddd');
window.close();
</script>
<body>
	<table border="1">
		<h3>Report Stock Commart</h3>
		<thead>
			<tr bgcolor="#FFFF00">
				<th  align="center">brand</th>
				<th  align="center">modelid</th>
				<th  align="center">productid</th>
				<th  align="center">producname</th>
				<th  align="center">stockqty</th>
				
				
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $r) { ?>
				<tr>
					<td><?php echo $r["brand"];?></td>
					<td><?php echo $r["modelid"];?></td>
					<td><?php echo $r["productid"];?></td>
					<td><?php echo $r["producname"];?></td>
					<td><?php echo $r["stockqty"];?></td>
					
				</tr>

				<?php }?>
			</tbody>
		</table>


	</body>
	</html>
