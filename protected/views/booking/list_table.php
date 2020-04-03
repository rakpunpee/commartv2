<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>ปริ้น</th>
			<th>สถานะ</th>
			<th>เลขที่ใบจอง</th>
			<th>วันที่จอง</th>
			<th>วันที่รับสินค้า</th>
			<th>ชื่อลูกค้า</th>
			<th>โทรศัพท์</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($result as $r){?>
		<tr>
			<td><a href="<?php echo $this->createUrl("print/printbooking",array("orderdoc"=>$r["orderdoc"]));?>" target="_blank"><i class="glyphicon glyphicon-print"></i></a></td>
			<td>
				<?php if ($r['status_rev']==0): ?>
					<a href="javascript:updateStatus('<?php echo $r['orderdoc']; ?>')" style="color:#ff0000"><i class="glyphicon glyphicon-remove"></i></a>
				<?php else: ?>
					<i class="glyphicon glyphicon-ok" style="color:#00ff00"></i>
				<?php endif ?>
				
			</td>
			<td><?php echo $r["orderdoc"];?></td>
			<td><?php echo $r["orderdate"];?></td>
			<td><?php echo $r["pledgedate"];?></td>
			<td><?php echo $r["customer"];?></td>
			<td><?php echo $r["tel"];?></td>
		</tr>
		<?php }?>
	</tbody>
</table>