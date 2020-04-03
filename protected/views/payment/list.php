<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-4">
				Report Payment
			</div>
			<div class="col-md-8" align="right">
				<button type="button"  class="btn btn-success" onclick="location.href='<?php echo $this->createUrl("/payment/index"); ?>';">Payment</button>
			</div>

		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<table class="table  table-bordered  table-hover">
				<thead>
					<tr>
						<th>ปริ้น</th>
						<th>คิว</th>
						<th>เลขที่Payment</th>
						<th>Order</th>
						<th>เลขที่Order</th>
						<th>ชื่อลูกค้า</th>
						<th>รุ่น</th>
						<th>ประเภทการจ่าย</th>
						<th>จำนวนเงิน</th>
						<th>ยกเลิก</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $r){?>
						<tr>
							<td><a href="<?php echo $this->createUrl("print/printbill",array("alocateid"=>$r["orderid"],"payq"=>$r["payq"]));?>" target="_blank"><i class="glyphicon glyphicon-print"></i></a></td>
							<td><?php echo $r["payq"];?></td>
							<td><?php echo $r["paydoc"];?></td>
							<td><?php echo $r["orderid"];?></td>
							<td><?php echo $r["alocateid"].$r["orderid"];?></td>
							<td><?php echo $r["customer"];?></td>
							<td><?php echo $r["modelid"];?></td>
							<td><?php echo $r["paytype"];?></td>
							<td><?php echo number_format($r["total"]);?></td>
							<td><a href="<?php echo $this->createUrl("payment/cancelbillpay",array("paydoc"=>$r["orderid"]));?>" onclick="return confirm('คุณต้องการยกเลิกรายการนี้ใช่หรือไม่')"><i class="glyphicon glyphicon-trash"></i></a></td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>