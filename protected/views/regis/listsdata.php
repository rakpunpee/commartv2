<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>วันที่</th>
				<th>เลขที่จอง</th>
				<th>Model</th>
				<th>Product</th>
				<th>Product(Name)</th>
				<th>ลูกค้า</th>
				<th>โทรศัพท์</th>
				<th>บูธขาย</th>
				<th>ผู้บันทึก</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $r){?>
			<tr onclick="javascript:url('<?php echo $r["orderdate"]; ?>','<?php echo $r["alocateid"]; ?>')">
				<td><?php echo $r["orderdate"]; ?></td>
				<td><?php echo $r["alocateid"]; ?></td>
				<td><?php echo $r["modelid"]; ?></td>
				<td><?php echo $r["productid"]; ?></td>
				<td><?php echo $r["productname"]; ?></td>
				<td><?php echo $r["customer"]; ?></td>
				<td><?php echo $r["tel"]; ?></td>
				<td><?php echo $r["boots"]; ?></td>
				<td><?php echo $r["register"]; ?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>