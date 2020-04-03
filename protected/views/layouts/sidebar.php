<?php
$url=$_SERVER['REQUEST_URI'];
$urlexp=explode('/',$url);
$urlctrl=$urlexp[3];
?>
<div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

        <div class="sidebar-inner">

          <ul class="navi">

            <li class="nred <?php if(empty($urlctrl) OR $urlctrl=="site"){echo "current";}?>">
            	<a href="<?php echo $this->createUrl("site/index");?>"><i class="icon-home"></i> Home</a>
            </li>
			<?php if(Yii::app()->request->cookies['cookie_point']->value=='Register'){ ?>
            <li class="ngreen <?php if($urlctrl=="regis"){echo "current";}?>">
            	<a href="<?php echo $this->createUrl("regis/index");?>"><i class="icon-user"></i> Register</a>
            </li>
            <?php } ?>
            <?php if(Yii::app()->request->cookies['cookie_point']->value=='Payment'){ ?>
            <li class="has_submenu norange <?php if($urlctrl=="payment"){echo "current open";}?>">
            	<a href="#"><i class="icon-inbox"></i> Payment
            	
            	<span class="pull-right"><i class="icon-angle-right"></i></span></a>
	            	<ul>
		              <li <?php echo ($urlexp[4]=="index")?'class="active"':''; ?>>
			              <a href="<?php echo $this->createUrl("payment/index");?>">
			              <i class="icon-tag"></i> จ่ายเงิน</a>
		              </li>
		              <li <?php echo ($urlexp[4]=="list")?'class="active"':''; ?>>
		              	<a href="<?php echo $this->createUrl("payment/list");?>">
		              	<i class="icon-align-justify"></i> รายการจ่ายเงินประจำวัน</a>
		              </li>
		            </ul>
            </li>
            
            
            
            
            
            
            <?php }?>
            <?php if(Yii::app()->request->cookies['cookie_point']->value=='Booking'){ ?>
             <li class="nblue <?php if($urlctrl=="booking"){echo "current";}?>">
            	<a href="<?php echo $this->createUrl("booking/index");?>"><i class="icon-inbox"></i> บันทึกจอง/มัดจำสินค้า</a>
            </li>
            <li class="nblue <?php if($urlctrl=="booking"){echo "current";}?>">
            	<a href="<?php echo $this->createUrl("booking/list");?>"><i class="icon-inbox"></i> รายการจอง/มัดจำสินค้า</a>
            </li>
            <?php }?>
            <?php if(Yii::app()->request->cookies['cookie_point']->value=='Register'){ ?>
             <li class="has_submenu nlightblue <?php if($urlctrl=="editbill"){echo "current open";}?>">
            	<a href="#"><i class="icon-edit"></i> Edit Document
            	<span class="pull-right"><i class="icon-angle-right"></i></span></a>
            	<ul>
            		<!--
            		 <li <?php #echo ($urlexp[4]=="changelist")?'class="active"':''; ?>>
		              <a href="<?php #echo $this->createUrl("editbill/change");?>">
		              <i class="icon-pencil"></i> เปลี่ยน/แก้ไขสินค้า</a>
	              </li> 
            		 -->
	             
	              <li <?php echo ($urlexp[4]=="cancelbill")?'class="active"':''; ?>>
	              	<a href="<?php echo $this->createUrl("editbill/cancelbill");?>">
	              	<i class="icon-trash"></i> ยกเลิกใบสั่งซื้อ</a>
	              </li>
	            </ul>
            </li>
            <?php }?>
            <?php if(Yii::app()->request->cookies['cookie_point']->value=='Stock'){ ?>
             <li class="has_submenu nviolet <?php if($urlctrl=="stock"){echo "current open";}?>">
            	<a href="#"><i class="icon-share"></i> Stock
            	<span class="pull-right"><i class="icon-angle-right"></i></span></a>
            	<ul>
	              <li <?php echo ($urlexp[4]=="index")?'class="active"':''; ?>>
		              <a href="<?php echo $this->createUrl("stock/index");?>" target="_blank">
		              <i class="icon-th-large"></i> จัดสินค้า</a>
	              </li>
	              <li <?php echo ($urlexp[4]=="stockout")?'class="active"':''; ?>>
	              	<a href="<?php echo $this->createUrl("stock/stockout");?>">
	              	<i class="icon-th-list"></i> ตัดสินค้า</a>
	              </li>
	            </ul>
            </li>
            <?php }?>

          <!-- Date 

          <div class="sidebar-widget">
            <div id="todaydate"></div>
          </div>
          -->



        </div>

    </div>