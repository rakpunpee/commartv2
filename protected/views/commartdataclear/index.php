<script>


		$(document).ready(function() {
			
			$('#load').hide();
			$("#popupApply").jqxWindow({  //กำหนด popup ตรวจสอบ
		        theme: 'darkblue',width: 450,height:310, resizable: true,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
		     });

			$("#clear") .click(function() {
		       $("#popupApply").jqxWindow('open');
		    });
		    $("#Cancelapp") .click(function() {
		       $("#popupApply").jqxWindow('close');
		    });

		     $("#OKApp").click(function(event) {
		    	$('#load').show();
		    	  $.post('<?php echo $this->createUrl("/commartdataclear/clearofData") ?>', function(data, textStatus, xhr) {

		    	$('#load').hide();
		    	$("#popupApply").jqxWindow('close');
		    	 window.location.href='<?php echo $this->createUrl("/commartdataclear/index")  ?>';
               });

		    });

		    	
				$('#clear').attr('disabled','disabled');

							

							$('#ckpassword').on('keyup', function(event) {
								if($('#ckpassword').val()=='commart999' || $('#ckpassword').val()=='COMMART999'){
									$('#clear').removeAttr('disabled');
								}else{
									$('#clear').attr('disabled','disabled');
								}	
							});






		});



</script>

<div class="contrainner"><br>
	
	<div class="row">
		<div class="col-md-3">
		  <span class="input-group-addon" id="basic-addon1"><l class="glyphicon glyphicon-lock"></l> Password</span>
		  <input type="password" class="form-control" id="ckpassword" aria-describedby="basic-addon1">
		</div>
<!-- 		<div class="col-md-3 glyphicon glyphicon-lock"><input type="password" id="ckpassword" class="form-control"></div>
 -->
		

		<div class="col-md-2"><button type="button" class="btn btn-warning" id="clear">Delete Data Of Table</button></div>
	</div><br>
	<div class="row">
		<div class="col-md-5">

				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Table</th>
							<th>count(DATA)</th>
						</tr>
					</thead>
					<tbody>
               
				        <tr>
							<td>Logorder</td>
							<?php $sum1 = Yii::app ()->db->createCommand ( "SELECT Count(*) AS sum FROM logorder AS a" )->queryAll (); ?>
							<td><div class="text-right"><?php echo $sum1[0]['sum'];?></div></td>
						</tr>
						<tr>
							<td>Logupdatestock</td>
							<?php $sum2 = Yii::app ()->db->createCommand ( "SELECT Count(*) AS  sum FROM logupdatestock AS a" )->queryAll (); ?>
							<td><div class="text-right"><?php echo $sum2[0]['sum'];?></div></td>
						</tr>
						<tr>
							<td>Orderdoc</td>
							<?php $sum3 = Yii::app ()->db->createCommand ( "SELECT Count(*) AS sum FROM orderdoc AS a" )->queryAll (); ?>
							<td><div class="text-right"><?php echo $sum3[0]['sum'];?></div></td>
						</tr>
						<tr>
							<td>Pledge</td>
							<?php $sum4 = Yii::app ()->db->createCommand ( "SELECT Count(*) AS sum FROM pledge AS a" )->queryAll (); ?>
							<td><div class="text-right"><?php echo $sum4[0]['sum'];?></div></td>
						</tr>
						<tr>
							<td>Product</td>
							<?php $sum5 = Yii::app ()->db->createCommand ( "SELECT Count(*) AS sum FROM product AS a" )->queryAll (); ?>
							<td><div class="text-right"><?php echo $sum5[0]['sum'];?></div></td>
						</tr>
						<tr>
							<td>Shop</td>
							<?php $sum6 = Yii::app ()->db->createCommand ( "SELECT Count(*) AS sum FROM shop AS a" )->queryAll (); ?>
							<td><div class="text-right"><?php echo $sum6[0]['sum'];?></div></td>
						</tr>
						<tr>
							<td>Stock</td>
							<?php $sum7 = Yii::app ()->db->createCommand ( "SELECT Count(*) AS sum FROM stock AS a" )->queryAll (); ?>
							<td><div class="text-right"><?php echo $sum7[0]['sum'];?></div></td>
						</tr>
				                      </tbody>
				</table>

			</div>
	</div>

	
		<div id="popupApply" style="display: none;">
		    <div > ยืนยันการล้างข้อมูลในตาราง</div>

		    <div style="padding: 10px;" class="container">

		        <div class="col-md-12">

		            <div>คุณตกลงที่จะล้างข้อมูลในตารางดังนี้</div><br>
		            <div>- Logorder</div><br>
		            <div>- Logupdatestock</div><br>
		            <div>- Orderdoc</div><br>
		            <div>- Pledge</div><br>
		            <div>- Stock</div><br>
		            <div class="row form-group">
		                <div class="col-md-2">
		                    <button class="btn btn-success" id="OKApp"><span>ยืนยัน</span></button>

		                </div> 
		                <div class="col-md-2">
		                    <button class="btn btn-danger" id="Cancelapp"><span>ยกเลิก</span></button>
		                </div>    
		            </div>
		    </div>
		    <div id="load"><img src="<?php echo Yii::app()->request->baseUrl;?>/img/loading.gif"></div>
		</div>
		</div>


</div>