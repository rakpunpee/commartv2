<!DOCTYPE html>
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
						<?php echo CHtml::textField("alocateid",($data['alocateid'])?$data['alocateid']:null,array("style"=>"width:100%","class"=>"form-control","readonly"=>true));?>
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
							<div class="col-md-4 has-success">
								<?php echo CHtml::textField("city",($data['city'])?$data['city']:null,array("style"=>"width:100%","class"=>"form-control"));?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-4">รหัสไปรษณีย์</div>
							<div class="col-md-4 has-success">
								<?php echo CHtml::textField("zipid",($data['zipid'])?$data['zipid']:null,array("style"=>"width:100%","class"=>"form-control"));?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-4">โทรศัพท์ *</div>
							<div class="col-md-4 has-error">
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
						<label><input type='checkbox' id='regloan1' name='regloan1' value='1' <?php echo ($data['regloan1'])?'checked':''; ?>/>
						ชำระเป็นสินเชื่อส่วนกลาง</label>

						<?php echo CHtml::dropDownList("boots",($data['boots'])?$data['boots']:null,Datasource::ShopList(),array("style"=>"width:100%;margin-top:4px;","class"=>"form-control"));?>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<button type="button" class="btn btn-success btn-large" id="btn_save_regis">
							<i class="icon-save"></i> SAVE
						</button>
					</div>
				</div>
			</form>

		</div>

	</div>
</body>
</html>