<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<?php
$cont=null;
$act=null;
if(isset(Yii::app()->controller->id)){
	$cont=Yii::app()->controller->id;
}
if(isset(Yii::app()->controller->action->id)){
	$act=Yii::app()->controller->action->id;
}
?>
<div class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="http://172.18.0.30/commartv02/index.php/main/index"><?php echo CHtml::image("$baseUrl/images/jibcommart.png","this is alt tag of image",array("width"=>"85px" ,"height"=>"45px"));?></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li <?php echo ($cont=='site'&&$act=='index')?' class="active"':'';?>><a href="<?php echo $this->createUrl("site/index");?>"><i class="glyphicon glyphicon-home"></i></a></li>
				<?php if(Yii::app()->request->cookies['cookie_point']->value=='Register'){ ?>
				<li <?php echo ($cont=='regis'&&$act=='index')?' class="active"':'';?>><a href="<?php echo $this->createUrl("regis/index");?>">บันทึกใบจอง</a></li>
				<li <?php echo ($cont=='regis'&&$act=='listregis')?' class="active"':'';?>><a href="<?php echo $this->createUrl("regis/listregis");?>">แก้ไขใบจอง</a></li>
				<li <?php echo ($cont=='editbill'&&$act=='cancelbill')?' class="active"':'';?>><a href="<?php echo $this->createUrl("editbill/cancelbill");?>">ยกเลิกใบจอง</a></li>
				<?php } ?>
				
				<?php if(Yii::app()->request->cookies['cookie_point']->value=='Payment'){ ?>
				<li <?php echo ($cont=='payment'&&$act=='index')?' class="active"':'';?>><a href="<?php echo $this->createUrl("payment/index");?>">จ่ายเงิน</a></li>
				<li <?php echo ($cont=='payment'&&$act=='list')?' class="active"':'';?>><a href="<?php echo $this->createUrl("payment/list");?>">รายการจ่ายเงินประจำวัน</a></li>
				<?php } ?>
				
				<?php if(Yii::app()->request->cookies['cookie_point']->value=='Booking'){ ?>
				<li <?php echo ($cont=='booking'&&$act=='index')?' class="active"':'';?>><a href="<?php echo $this->createUrl("booking/index");?>">บันทึกจอง/มัดจำสินค้า</a></li>
				<li <?php echo ($cont=='booking'&&$act=='list')?' class="active"':'';?>><a href="<?php echo $this->createUrl("booking/list");?>">รายการจอง/มัดจำสินค้า</a></li>
				<?php } ?>
				
				<?php if(Yii::app()->request->cookies['cookie_point']->value=='Stock'){ ?>
				<li><a href="<?php echo $this->createUrl("stock/index");?>" target="_blank">จัดสินค้า</a></li>
				<li <?php echo ($cont=='stock'&&$act=='stockout')?' class="active"':'';?>><a href="<?php echo $this->createUrl("stock/stockout");?>">ตัดสินค้า</a></li>
				<?php }?>
				<?php if(Yii::app()->request->cookies['cookie_point']->value=='queue'){ ?>
				<li <?php echo ($cont=='queue'&&$act=='index')?' class="active"':'';?>><a href="<?php echo $this->createUrl("queue/index");?>">ยิงคิว</a></li>
				
				<?php } ?>
				<?php if(Yii::app()->request->cookies['cookie_point']->value=='promotion'){ ?>
				<li <?php echo ($cont=='queue'&&$act=='index')?' class="active"':'';?>><a href="<?php echo $this->createUrl("promotion/index");?>">Setโปรโมชั่น</a></li>
				
				<?php } ?>
				<?php if(Yii::app()->request->cookies['cookie_point']->value=='OrderMobileApp'){ ?>
				<li <?php echo ($cont=='registermobile'&&$act=='showorder')?' class="active"':'';?>><a target="_blank" href="<?php echo $this->createUrl("registermobile/showorder");?>">OrderMonitor</a></li>
				<li <?php echo ($cont=='registermobile'&&$act=='Showjudorder')?' class="active"':'';?>><a target="_blank" href="<?php echo $this->createUrl("registermobile/Showjudorder");?>">JudMonitor</a></li>
				<?php }else{ ?>
				<li <?php echo ($cont=='report'&&$act=='index')?' class="active"':'';?>><a href="<?php echo $this->createUrl("report/index");?>">Report</a></li>

				<li <?php echo ($cont=='report'&&$act=='index')?' class="active"':'';?>><a href="http://commarts:8000" target="_bank">DashBoard</a></li>
				<?php } ?>


				
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-share"></i> <?php echo Yii::app()->request->cookies['cookie_point']->value;?></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->createUrl("Logging/Slmodule",array("module"=>"Dashboard"));?>">Dashboard</a></li>
						<li><a href="<?php echo $this->createUrl("Logging/Slmodule",array("module"=>"Register"));?>">Register</a></li>
						<li><a href="<?php echo $this->createUrl("Logging/Slmodule",array("module"=>"Payment"));?>">Payment</a></li>
						<li><a href="<?php echo $this->createUrl("Logging/Slmodule",array("module"=>"Booking"));?>">บันทึกจอง/มัดจำสินค้า</a></li>
						<li><a href="<?php echo $this->createUrl("Logging/Slmodule",array("module"=>"Stock"));?>">สต็อกจัดสินค้า</a></li>
						<li><a href="<?php echo $this->createUrl("Logging/Slmodule",array("module"=>"OrderMobileApp"));?>">สั่งผ่านแอปพลิเคชัน</a></li>
						<li><a href="<?php echo $this->createUrl("Logging/Slmodule",array("module"=>"queue"));?>">ยิงคิว</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>