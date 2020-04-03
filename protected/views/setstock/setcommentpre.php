<!DOCTYPE html>
<script>
	$(document).ready(function () {

		$("#btn_save").click(function(){
			if($("#productid").val()==''){
				alert("หมายเลขใบจอง : ห้ามเป็นค่าว่าง");
			}else{

				var data="regis=true";
				data+="&productid="+escape($("#productid").val());
				data+="&commentpreorder="+$("#commentpreorder").val();

				$.ajax({
					dataType: 'json',
					url: '<?php echo $this->createUrl("setstock/insertcomment"); ?>',
					data: data,
					success: function(data, status, xhr) {
			                  // alert(data);
			              }
			          });
				alert("บันทึกข้อมูลเรียบร้อย");
				location.reload();

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

					<div class="col-md-2 has-error">
						<?php echo CHtml::textField("productid",($data['productid'])?$data['productid']:null,array("style"=>"width:100%","class"=>"form-control","readonly"=>true));?>
					</div>
					<div class="col-md-4" id=""></div>
				</div>
				<div class="row form-group">
					<div class="col-md-2">Product Name *</div>
					<div class="col-md-2 has-error">
						<?php echo CHtml::textField("producname",($data['producname'])?$data['producname']:null,array("style"=>"width:100%","class"=>"form-control","readonly"=>true));?>
					</div>
					<div class="col-md-4" id=""></div>
				</div>

				<div class="row form-group">
					<div class="col-md-2">Comment PreOrder*</div>
					<div class="col-md-4 has-error">
						<?php echo CHtml::textArea("commentpreorder",($data['commentpreorder'])?$data['commentpreorder']:null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>

					<div class="col-md-1"></div>
					<div class="col-md-3">

					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<button type="button" class="btn btn-success btn-large" id="btn_save">
							<i class="icon-save"></i> SAVE
						</button>
					</div>
				</div>

			</form>
		</div>
	</div>

</body>
</html>