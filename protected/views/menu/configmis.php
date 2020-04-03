<!DOCTYPE html>
<html>
<script type="text/javascript">
	$(document).ready(function () {
		$("#btn").click(function(){
			var con=confirm('คุณต้องการอัพเดต Price 1 ทั้งหมด');
			if(con==true){
				$.post('<?php echo $this->createUrl("menu/Configoption"); ?>',function(data)
				{
					alert('อัพเดต Price 1 ทั้งหมด = '+data+' รายการ');
				});
			}

		});
		$("#btn2").click(function(){
			var con=confirm('คุณต้องการอัพเดต CATEGORY ทั้งหมด');
			if(con==true){
				$.post('<?php echo $this->createUrl("menu/Configoption2"); ?>',function(data)
				{
					alert('อัพเดต CATEGORY ทั้งหมด = '+data+' รายการ');
				});
			}
		});
		$("#btn3").click(function(){
			var con=confirm('คุณต้องการอัพเดต Stock จาก branch 51 ทั้งหมด');
			if(con==true){
				$.post('<?php echo $this->createUrl("menu/Configoption3"); ?>',function(data)
				{
					alert('อัพเดต Stock จาก branch 51 = '+data+' รายการ');
				});
			}
		});
		$("#btn4").click(function(){
			var con=confirm('คุณต้องการINSERT pro จาก commart-sticker ที่ไม่มีทั้งหมด');
			if(con==true){
				$.post('<?php echo $this->createUrl("menu/Configoption4"); ?>',function(data)
				{
					alert('INSERT pro จาก commart-sticker ที่ไม่มี = '+data+' รายการ');
				});
			}
		});
		$("#btn5").click(function(){
			var con=confirm('คุณต้องการย้าย Stock คงเหลือ ไปเป็น Stock หลัก หรือไม่');
			if(con==true){
				$.post('<?php echo $this->createUrl("menu/Configoption5"); ?>',function(data)
				{
					alert('ย้าย Stock คงเหลือ ไปเป็น Stock หลัก = '+data+' รายการ');
				});
			}
		});
		$("#gen").click(function(){
             
              
            $.post('<?php echo $this->createUrl("/menu/gen"); ?>',function(data)
				{
				
				});
           
              window.open("http://172.18.0.30/commartv02/index.php/menu/genpass","_blank","toolbar,scrollbars,resizable,top=0,left=0,width=480px,height=280px");
           });
		$("#showpass").click(function(){
             
              
            $.post('<?php echo $this->createUrl("/menu/Showpass"); ?>',function(data)
				{
				
				});
           
              window.open("http://172.18.0.30/commartv02/index.php/menu/Showpass","_blank","toolbar,scrollbars,resizable,top=0,left=0,width=480px,height=280px");
           });
		$("#truncate").click(function(){
             
              var con=confirm('คุณต้องการเคลียคิว หรือไม่');
			if(con==true){
            $.post('<?php echo $this->createUrl("/menu/truncate"); ?>',function(data)
				{
				
				});
           }
             
           });

	});

</script>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				<div class="panel panel-success">
					<div class="panel-heading">Mis Config</div>

					<div class="panel-body">

						<!-- Standard button -->
						<button type="button" class="btn btn-default btn-lg btn-block"  id="btn">อัพเดตราคา price 1</button>
						<button type="button" class="btn btn-primary btn-lg btn-block" id="btn2">อัพเดต CATEGORY</button>
						<button type="button" class="btn btn-success btn-lg btn-block" id="btn3">อัพเดต Stock จาก branch 51 </button>
						<button type="button" class="btn btn-info btn-lg btn-block" id="btn4">INSERT pro จาก commart-sticker ที่ไม่มี</button>
						<button type="button" class="btn btn-warning btn-lg btn-block" id="btn5">ย้าย Stock คงเหลือ ไปเป็น Stock หลัก</button>
						<button type="button" class="btn btn-primary btn-lg btn-block" id="gen">GENรหัสShop</button>
						<button type="button" class="btn btn-primary btn-lg btn-block" id="showpass">ดูรหัสBooth</button>
						<button type="button" class="btn btn-primary btn-lg btn-block" id="truncate">เคลียคิว</button>
						<button type="button" class="btn btn-danger btn-lg btn-block">Default</button>



					</div>
				</div>
			</div>
			<div class="col-md-2">
			</div>
		</div>
	</div>

</body>
</html>