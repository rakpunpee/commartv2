<?php  
header("content-type: application/vnd.ms-excel");
header("content-disposition: attachment; filename=export_booking.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  </head>

  <body>
  	<table border="1">
  		<tr>
  			<td>เลขที่มัดจำ</td>
  			<td>วันที่ทำเอกสาร</td>
  			<td>วันที่นัดรับสินค้า</td>
  			<td>ProductCode</td>
  			<td>ProductName</td>
  			<td>สถานะ</td>
  			<td>จำนวนจอง</td>
  			<td>ราคา/หน่วย</td>
  			<td>ราคารวม</td>
  			<td>เงินสด</td>
  			<td>บัตรเครดิต</td>
  			<td>สินเชื่อ</td>
  			<td>เงินมัดจำ</td>
  			<td>ค้างชำระ</td>  			
  			<td>ชื่อลูกค้า</td>
  			<td>ที่อยู่</td>
  			<td>ที่อยู่</td>
  			<td>จังหวัด</td>
  			<td>รหัสไปรษณี</td>
  			<td>เบอร์โทรศัพท์</td>
  			<td>เบอร์โทรศัพท์(บ้าน)</td>
  			<td>ของแถม</td>
  			<td>สถานที่รับสินค้า</td>
  			<td>หมายเหตุ</td>
  			<td>ผู้รับเรื่อง</td>
  		</tr>
  		<?php foreach ($result as $r): ?>
  		<tr>
			<td><?php echo $r['orderdoc']; ?></td>
			<td><?php echo $r['orderdate']; ?></td>
			<td><?php echo $r['pledgedate']; ?></td>
			<td><?php echo $r['product']; ?></td>
			<td><?php echo $r['name']; ?></td>
			<td><?php echo ($r['status_rev']==0)?'ยังไม่รับ':'รับสินค้าแล้ว'; ?></td>
			<td><?php echo $r['alocate']; ?></td>
			<td><?php echo $r['unitamt']; ?></td>
			<td><?php echo $r['totalamt']; ?></td>
			<td><?php echo $r['amount']; ?></td>
			<td><?php echo $r['creditcardamt']; ?></td>
			<td><?php echo $r['creditamt']; ?></td>
			<td><?php echo $r['pledgeamt']; ?></td>
			<td><?php echo $r['remain']; ?></td>
			<td><?php echo $r['customer']; ?></td>
			<td><?php echo $r['addr1']; ?></td>
			<td><?php echo $r['addr2']; ?></td>
			<td><?php echo $r['city']; ?></td>
			<td><?php echo $r['zipcode']; ?></td>
			<td><?php echo $r['tel']; ?></td>
			<td><?php echo $r['telhome']; ?></td>
			<td><?php echo $r['comment']; ?></td>
			<td><?php echo $r['descfreesup']; ?></td>
			<td><?php echo $r['receive']; ?></td>
			<td><?php echo $r['author']; ?></td>
  		</tr>	
  		<?php endforeach ?>
  	</table>

  </body>
</html>