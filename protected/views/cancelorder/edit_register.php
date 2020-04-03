<!DOCTYPE html>
<script>
	$(document).ready(function () {

		$("#btn_save_regis").click(function(){
			if($("#alocateid").val()==''){
				alert("หมายเลขใบจอง : ห้ามเป็นค่าว่าง");
			}else if($("#customer").val()==''){
				alert("ชื่อลูกค่า/บริษัท : ห้ามเป็นค่าว่าง");
			}else if($("#register").val()==''){
				alert("ผู้บันทึก : ห้ามเป็นค่าว่าง");

			}else if($("#tel").val()==''){
				alert("เบอร์โทรศัพท์ : ห้ามเป็นค่าว่าง");
			}else if($("#boots").val()==''){
				alert("บูธขาย : ห้ามเป็นค่าว่าง");
			}else{

				var data="regis=true";
				data+="&alocateid="+$("#alocateid").val().substring(3);
				data+="&customer="+$("#customer").val();
				data+="&register="+$("#register").val();
				data+="&addr1="+$("#addr1").val();
				data+="&addr2="+$("#addr2").val();
				data+="&city="+$("#city").val();
				data+="&zipid="+$("#zipid").val();
				data+="&tel="+$("#tel").val();
				data+="&regcash="+$("input:checkbox[name=regcash]:checked").val();
				data+="&regcredit="+$("input:checkbox[name=regcredit]:checked").val();
				data+="&regloan="+$("input:checkbox[name=regloan]:checked").val();
				data+="&boots="+$("#boots").val();
				data+="&commentregister="+$("#commentregister").val();
				data+="&banking="+$("#banking").val();
				data+="&price="+$("#price").val();
				$.ajax({
					dataType: 'json',
					url: '<?php echo $this->createUrl("cancelorder/Editbillregis"); ?>',
					data: data,
					success: function(data, status, xhr) {
			                  // alert(data);
			              }
			          });
				alert("บันทึกแก้ไขข้อมูลเรียบร้อยแล้ว");
				location.reload();

			}
		});
		$("#btn_sms").click(function(){
			if($("#alocateid").val()==''){
				alert("หมายเลขใบจอง : ห้ามเป็นค่าว่าง");
			}else{

				var data="sms=true";
				data+="&alocateid="+$("#alocateid").val();
				data+="&customer="+$("#customer").val();
				
				$.ajax({
					dataType: 'json',
					url: '<?php echo $this->createUrl("cancelorder/Editbillregis"); ?>',
					data: data,
					success: function(data, status, xhr) {
			                  // alert(data);
			              }
			          });
				alert("ส่ง SMS เรียบร้อย รอ 1 - 5 นาที");
			

			}
		});



	});


</script>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div class="row">
		<div class="col-md-12">
			<form role="form">

				<div class="row form-group">
					<div class="col-md-2">หมายเลขใบจอง *</div>
					<div class="col-md-2 has-error">
						<?php echo CHtml::textField("alocateid",($data['alocateid'].$data['orderid'])?$data['alocateid'].$data['orderid']:null,array("style"=>"width:100%","class"=>"form-control","readonly"=>true));?>
					</div>
					<div class="col-md-4" id="regisstate"></div>
				</div>

				<div class="row form-group">
					<div class="col-md-2">ชื่อลูกค้า/บริษัท *</div>
					<div class="col-md-4 has-error">
						<?php echo CHtml::textField("customer",($data['customer'])?$data['customer']:null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>

					<div class="col-md-1">ผู้บันทึก *</div>
					<div class="col-md-3 has-error">
						<?php echo CHtml::textField("register",($data['register'])?$data['register']:null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2">ที่อยู่ </div>
					<div class="col-md-4 has-success">
						<?php echo CHtml::textField("addr1",($data['addr1'])?$data['addr1']:null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-4 has-success">
						<?php echo CHtml::textField("addr2",($data['addr2'])?$data['addr2']:null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-6">

						<div class="row form-group">
							<div class="col-md-4">จังหวัด</div>
							<div class="col-md-8 has-success">
								<?php echo CHtml::textField("city",($data['city'])?$data['city']:null,array("style"=>"width:100%","class"=>"form-control"));?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-4">รหัสไปรษณีย์</div>
							<div class="col-md-8 has-success">
								<?php echo CHtml::textField("zipid",($data['zipid'])?$data['zipid']:null,array("style"=>"width:100%","class"=>"form-control"));?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-4">โทรศัพท์ *</div>
							<div class="col-md-8 has-error">
								<?php echo CHtml::textField("tel",($data['tel'])?$data['tel']:null,array("style"=>"width:100%","class"=>"form-control"));?>
							</div>

						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-3">

						<label><input type='checkbox' id='regcash' name='regcash' value='1' <?php echo ($data['regcash'])?'checked':''; ?>/>
						ชำระเป็นเงินสด</label>
						<label><input type='checkbox' id='regcredit' name='regcredit' value='1' <?php echo ($data['regcredit'])?'checked':''; ?>/>
						ชำระเป็นบัตรเครดิต</label>
						<label><input type='checkbox' id='regloan' name='regloan' value='1' <?php echo ($data['regloan'])?'checked':''; ?>/>
						ชำระเป็นสินเชื่อรออนุมัติ</label>


						<?php echo CHtml::textField("boots",($data['boots'])?$data['boots']:null,array("style"=>"width:100%;margin-top:4px;","class"=>"form-control","readonly"=>true));?>
					</div>

				</div>
				<div class="row form-group">
					<div class="col-md-2">Comment จาก Register</div>
					<div class="col-md-4 has-error">
						<?php echo CHtml::textArea("commentregister",($data['commentregister'])?$data['commentregister']:null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>

					<div class="col-md-1">ธนาคาร</div>
					<div class="col-md-3 has-error">
						<?php echo CHtml::textField("banking",($data['Banking'])?$data['Banking']:null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
				</div>



				<div class="row form-group">
					<div class="col-md-12">

						<div class="row form-group">
							<div class="col-md-2">รหัสสินค้า</div>
							<div class="col-md-4 has-success">
								<?php echo CHtml::textField("productid",($data['productid'])?$data['productid']:null,array("style"=>"width:100%","readonly"=>true,"class"=>"form-control"));?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">ชื่อสินค้า</div>
							<div class="col-md-8 has-success">
								<?php echo CHtml::textField("productname",($data['productname'])?$data['productname']:null,array("style"=>"width:100%","readonly"=>true,"class"=>"form-control"));?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">ราคา *</div>
							<div class="col-md-4 has-error">
								<?php echo CHtml::textField("price",($data['price'])?$data['price']:null,array("style"=>"width:100%","class"=>"form-control"));?>
							</div>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-3">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<button type="button" class="btn btn-success btn-large" id="btn_save_regis">
							<i class="icon-save"></i> SAVE
						</button>
						<button type="button" class="btn btn-danger btn-large" id="btn_sms">
							<i class="icon-save"></i> ส่ง SMS
						</button>
					</div>
				</div>
			</form>

		</div>

	</div>
</body>
</html>