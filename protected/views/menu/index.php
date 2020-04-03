<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-2">
		</div>
		<div class="col-md-4">
			<div class="well">
				<?php 
				//$access = Yii::app()->request->cookies['cookie_commart_system']->value;
				//$CAccess = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 1, $access);
				// $CAccess2 = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 2, $access);
				// $CAccess3 = AccessApp::accesspage(Yii::app()->request->cookies['cookie_commart_id']->value, 128, 3, $access); 
				?>
				

				<button type="button" onclick="location.href='<?php echo $this->createUrl("/setstock/index"); ?>';" class="btn btn-danger btn-lg btn-block">SET - STOCK [ จัดซื้อ ]</button>
				<button type="button" onclick="location.href='<?php echo $this->createUrl("/promotion/index"); ?>';" class="btn btn-danger btn-lg btn-block">SET - PROMOTION [ จัดซื้อ ]</button>
				
				<button type="button" onclick="location.href='<?php echo $this->createUrl("/cancelorder/index"); ?>';" class="btn btn-info btn-lg btn-block">รายการ Register ในวัน</button>
				<button type="button" onclick="location.href='<?php echo $this->createUrl("/cancelorder/search"); ?>';" class="btn btn-info btn-lg btn-block">ค้นหาใบ Register ทั้งหมด</button>
				<button type="button" onclick="location.href='<?php echo $this->createUrl("/report/total"); ?>';" class="btn btn-warning btn-lg btn-block">ยอดขาย ทุกบูท</button>
				<button type="button" onclick="location.href='<?php echo $this->createUrl("/report/totalallbrand"); ?>';" class="btn btn-warning btn-lg btn-block">ยอดขายทุกบูทแยกแบรนด์</button>
				<button type="button" onclick="location.href='<?php echo $this->createUrl("/report/totalallbrandonly"); ?>';" class="btn btn-warning btn-lg btn-block">ยอดขาย แยกแบรนด์</button>
				

				<button type="button" onclick="location.href='<?php echo $this->createUrl("/payment/list"); ?>';" class="btn btn-success btn-lg btn-block">PAYMENT [Report]</button>

				<button type="button" onclick="location.href='<?php echo $this->createUrl("/menu/misconfig"); ?>';" class="btn btn-default btn-lg btn-block"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> MIS CONFIG <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button>
				
				
				
				
			</div>
			<div align="right">
				<button onclick="location.href='<?php echo $this->createUrl("/Login2018/Logout2018"); ?>';" type="button" class="btn btn-danger "><i class="glyphicon glyphicon-log-out"></i> Config Exit</button>
			</div>
		</div>
		

	</div>
</div>
