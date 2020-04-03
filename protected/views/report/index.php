
<div class="row">
	<div class="col-md-6">

		<h3>ลงทะเบียน/ชำระเงิน</h3>

		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Register</th>
					<th>Payment</th>
				</tr>
			</thead>
			<tbody>
	                      <?php
							$rp = "SELECT (SELECT COUNT(*) FROM orderdoc WHERE DATE(orderdate)=CURDATE()) register,
							(SELECT COUNT(*) FROM orderdoc WHERE DATE(orderdate)=CURDATE() AND pay=1) payment";
							$drp = Yii::app ()->db->createCommand ( $rp )->queryRow ();
							?>
	                      	<tr>
					<td><?php echo $drp["register"];?></td>
					<td><?php echo $drp["payment"];?></td>
				</tr>
			</tbody>
		</table>

	</div>
</div>
</div>
<div class="row">

<!-- **********************ยอดขายตาม Brand ********************** -->
	<div class="col-md-6">

		<h3>ยอดขายตาม Brand</h3>



		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Brand</th>
					<th>Qty</th>
					<th>%</th>
				</tr>
			</thead>
			<tbody>
							<?php
							$brandday = "SELECT t.brand,t.alocate,t.allbrand,((t.alocate/t.allbrand)*100) as perbrand
							FROM (
							SELECT b.brand,sum(a.qty) as alocate,(SELECT SUM(qty) FROM orderdoc WHERE `status`=0) allbrand
							FROM orderdoc a INNER JOIN product b ON a.productid=b.productid
							WHERE `status`=0
							GROUP BY b.brand
							ORDER BY sum(a.qty) DESC) t";
							$rsbrandday = Yii::app ()->db->createCommand ( $brandday )->queryAll ();
							$perall = 0;
							foreach ( $rsbrandday as $kbd => $rbd ) {
								?>
	                        <tr>
					<td><?php echo $kbd+1;?></td>
					<td><?php echo $rbd["brand"];?></td>
					<td><div class="text-right"><?php echo $rbd["alocate"];?></div></td>
					<td><div class="text-right"><?php echo number_format($rbd["perbrand"],2,'.',',');?></div></td>
				</tr>
	                        <?php $perall+=$rbd["perbrand"];?>
	                        <?php } ?>
	                      </tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td><div class="text-right"><?php echo $rbd["allbrand"];?></div></td>
					<td><div class="text-right"><?php echo number_format($perall,2,'.',',');?></div></td>
				</tr>
			</tfoot>
		</table>
	</div>

<!-- **********************ยอดขายตาม Brand ประจำวัน********************** -->
	<div class="col-md-6">

		<h3>ยอดขายตาม Brand ประจำวัน</h3>

		<table class="table  table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Brand</th>
					<th>Qty</th>
					<th>%</th>
				</tr>
			</thead>
			<tbody>
							<?php
							$brandday = "SELECT t.brand,t.alocate,t.allbrand,((t.alocate/t.allbrand)*100) as perbrand
							FROM (
							SELECT b.brand,sum(a.qty) as alocate,(SELECT SUM(qty) FROM orderdoc WHERE DATE(orderdate)=CURDATE() AND `status`=0) allbrand
							FROM orderdoc a INNER JOIN product b ON a.productid=b.productid
							WHERE DATE(a.orderdate)=CURDATE() AND `status`=0
							GROUP BY b.brand
							ORDER BY sum(a.qty) DESC) t";
							$rsbrandday = Yii::app ()->db->createCommand ( $brandday )->queryAll ();
							$perall = 0;
							foreach ( $rsbrandday as $kbd => $rbd ) {
								?>
	                        <tr>
					<td><?php echo $kbd+1;?></td>
					<td><?php echo $rbd["brand"];?></td>
					<td><div class="text-right"><?php echo $rbd["alocate"];?></div></td>
					<td><div class="text-right"><?php echo number_format($rbd["perbrand"],2,'.',',');?></div></td>
				</tr>
	                        <?php $perall+=$rbd["perbrand"];?>
	                        <?php } ?>
	                      </tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td><div class="text-right"><?php echo $rbd["allbrand"];?></div></td>
					<td><div class="text-right"><?php echo number_format($perall,2,'.',',');?></div></td>
				</tr>
			</tfoot>
		</table>

	</div>
</div>

<!-- **********************ยอดขายตาม Boot ********************** -->

<div class="row">
	<div class="col-md-6">

		<h3>ยอดขายตาม Boot</h3>

		<table class="table  table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Boot</th>
					<th>Qty</th>
					<th>%</th>
				</tr>
			</thead>
			<tbody>
							<?php
							$brandday = "SELECT t.boots,t.alocate,t.allboot,((t.alocate/t.allboot)*100) perboot
							FROM (
							SELECT boots,sum(qty) AS alocate ,(SELECT SUM(qty) FROM orderdoc WHERE `status`=0) AS allboot
							FROM orderdoc 
							WHERE `status`=0
							GROUP BY boots
							ORDER BY sum(qty) DESC) t";
							$rsbrandday = Yii::app ()->db->createCommand ( $brandday )->queryAll ();
							$perall = 0;
							foreach ( $rsbrandday as $kbd => $rbd ) {
								?>
	                        <tr>
					<td><?php echo $kbd+1;?></td>
					<td><?php echo $rbd["boots"];?></td>
					<td><div class="text-right"><?php echo $rbd["alocate"];?></div></td>
					<td><div class="text-right"><?php echo number_format($rbd["perboot"],2,'.',',');?></div></td>
				</tr>
	                        <?php $perall+=$rbd["perboot"];?>
	                        <?php } ?>
	                      </tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td><div class="text-right"><?php echo $rbd["allboot"];?></div></td>
					<td><div class="text-right"><?php echo number_format($perall,2,'.',',');?></div></td>
				</tr>
			</tfoot>
		</table>


	</div>

<!-- **********************ยอดขายตาม Boot ประจำวัน********************** -->

	<div class="col-md-6">



		<h3>ยอดขายตาม Boot ประจำวัน</h3>



		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Boot</th>
					<th>Qty</th>
					<th>%</th>
				</tr>
			</thead>
			<tbody>
							<?php
							$brandday = "SELECT t.boots,t.alocate,t.allboot,((t.alocate/t.allboot)*100) perboot
							FROM (
							SELECT boots,sum(qty) AS alocate ,(SELECT SUM(qty) FROM orderdoc WHERE date(orderdate)=curdate() AND `status`=0) AS allboot
							FROM orderdoc 
							WHERE date(orderdate)=curdate() AND `status`=0
							GROUP BY boots
							ORDER BY sum(qty) DESC) t";
							$rsbrandday = Yii::app ()->db->createCommand ( $brandday )->queryAll ();
							$perall = 0;
							foreach ( $rsbrandday as $kbd => $rbd ) {
								?>
	                        <tr>
					<td><?php echo $kbd+1;?></td>
					<td><?php echo $rbd["boots"];?></td>
					<td><div class="text-right"><?php echo $rbd["alocate"];?></div></td>
					<td><div class="text-right"><?php echo number_format($rbd["perboot"],2,'.',',');?></div></td>
				</tr>
	                        <?php $perall+=$rbd["perboot"];?>
	                        <?php } ?>
	                      </tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td><div class="text-right"><?php echo $rbd["allboot"];?></div></td>
					<td><div class="text-right"><?php echo number_format($perall,2,'.',',');?></div></td>
				</tr>
			</tfoot>
		</table>

	</div>

</div>

<!-- **********************ยอดแยกตามเวลา 19-03-2015********************** -->

<div class="row">
	<div class="col-md-6">



		<h3>ยอดแยกตามเวลา 22 / 03 / 2018</h3>



		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Time</th>
					<th>Qty</th>
				</tr>
			</thead>
			<tbody>
		                      <?php
								$brandday = "SELECT CONCAT(DATE_FORMAT(orderdate,'%H'),':00 - ',DATE_FORMAT(orderdate,'%H')+1,':00') times,
								SUM(qty) AS alocate
								FROM orderdoc 
								WHERE DATE(orderdate)='2018-03-22' AND `status`=0
								GROUP BY DATE_FORMAT(orderdate,'%H')";
								$rsbrandday = Yii::app ()->db->createCommand ( $brandday )->queryAll ();
								$perall = 0;
								$sum1=0;
								foreach ( $rsbrandday as $kbd => $rbd ) {
									$sum1=$sum1+$rbd["alocate"];
									?>
		                      	<tr>
					<td><?php echo $rbd["times"];?></td>
					<td><?php echo $rbd["alocate"];?></td>
				</tr>
		                      <?php }?>
		     <tfoot>
		        <tr>
		        	<td></td>
		        	<td><div class="text-right"><?php echo $sum1;?></div></td>
		        </tr>
		    </tfoot>
		                      </tbody>
		</table>

	</div>

<!-- **********************ยอดแยกตามเวลา 20-03-2015********************** -->

	<div class="col-md-6">


		<h3>ยอดแยกตามเวลา 23 / 03 / 2018</h3>


		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Time</th>
					<th>Qty</th>
				</tr>
			</thead>
			<tbody>
		                      <?php
								$brandday = "SELECT CONCAT(DATE_FORMAT(orderdate,'%H'),':00 - ',DATE_FORMAT(orderdate,'%H')+1,':00') times,
								SUM(qty) AS alocate
								FROM orderdoc 
								WHERE DATE(orderdate)='2018-03-23' AND `status`=0
								GROUP BY DATE_FORMAT(orderdate,'%H')";
								$rsbrandday = Yii::app ()->db->createCommand ( $brandday )->queryAll ();
								$perall = 0;
								$sum2=0;
								foreach ( $rsbrandday as $kbd => $rbd ) {
									$sum2=$sum2+$rbd["alocate"];
									?>
		                      	<tr>
					<td><?php echo $rbd["times"];?></td>
					<td><?php echo $rbd["alocate"];?></td>
				</tr>
		                      <?php }?>

		    <tfoot>
		        <tr>
		        	<td></td>
		        	<td><div class="text-right"><?php echo $sum2;?></div></td>
		        </tr>
		    </tfoot>
		                      </tbody>
		</table>


	</div>
</div>

<!-- **********************ยอดแยกตามเวลา 21-03-2015********************** -->

<div class="row">
	<div class="col-md-6">



		<h3>ยอดแยกตามเวลา 24 / 03 / 2018</h3>



		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Time</th>
					<th>Qty</th>
				</tr>
			</thead>
			<tbody>
		                      <?php
								$brandday = "SELECT CONCAT(DATE_FORMAT(orderdate,'%H'),':00 - ',DATE_FORMAT(orderdate,'%H')+1,':00') times,
								SUM(qty) AS alocate
								FROM orderdoc 
								WHERE DATE(orderdate)='2018-03-24' AND `status`=0
								GROUP BY DATE_FORMAT(orderdate,'%H')";
								$rsbrandday = Yii::app ()->db->createCommand ( $brandday )->queryAll ();
								$perall = 0;
								$sum3=0;
								foreach ( $rsbrandday as $kbd => $rbd ) {
									$sum3=$sum3+$rbd["alocate"];
									?>
		                      	<tr>
					<td><?php echo $rbd["times"];?></td>
					<td><?php echo $rbd["alocate"];?></td>
				</tr>
		                      <?php }?>
		    <tfoot>
		        <tr>
		        	<td></td>
		        	<td><div class="text-right"><?php echo $sum3;?></div></td>
		        </tr>
		    </tfoot>
		                      </tbody>
		</table>

	</div>

<!-- **********************ยอดแยกตามเวลา 22-03-2015********************** -->

	<div class="col-md-6">

		<h3>ยอดแยกตามเวลา 25 / 03 / 2018</h3>



		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Time</th>
					<th>Qty</th>
				</tr>
			</thead>
			<tbody>
		                      <?php
								$brandday = "SELECT CONCAT(DATE_FORMAT(orderdate,'%H'),':00 - ',DATE_FORMAT(orderdate,'%H')+1,':00') times,
								SUM(qty) AS alocate
								FROM orderdoc 
								WHERE DATE(orderdate)='2018-03-25' AND `status`=0
								GROUP BY DATE_FORMAT(orderdate,'%H')";
								$rsbrandday = Yii::app ()->db->createCommand ( $brandday )->queryAll ();
								$perall = 0;
								$sum4=0;
								foreach ( $rsbrandday as $kbd => $rbd ) {
									$sum4=$sum4+$rbd["alocate"];
									?>
		                      	<tr>
					<td><?php echo $rbd["times"];?></td>
					<td><?php echo $rbd["alocate"];?></td>
				</tr>
		    <?php }?>
		    <tfoot>
		        <tr>
		        	<td></td>
		        	<td><div class="text-right"><?php echo $sum4;?></div></td>
		        </tr>
		    </tfoot>
		    </tbody>
		</table>


	</div>
</div>

<script type="text/javascript">
    window.onload = setupRefresh;

    function setupRefresh() {
      setTimeout("refreshPage();", 60000); // milliseconds
    }
    function refreshPage() {
       window.location = location.href;
    }
  </script> 