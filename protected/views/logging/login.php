<div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="widget worange">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="icon-lock"></i> Login 
              </div>

              <div class="widget-content">
                <div class="padd">
                  <!-- Login form -->
                  <form class="form-horizontal" method="post" action="<?php $this->createUrl("logging/login");?>">
                    <!-- Email -->
                    <div class="control-group">
                      <label class="control-label" for="username">Position</label>
                      <div class="controls">
                        <?php
                        echo CHtml::dropDownList("point",null,array(
														''=>'#####',
														'Dashboard'=>'Dashboard',
														'Register'=>'Register',
														'Payment'=>'Payment',
														'Booking'=>'บันทึกจอง/มัดจำสินค้า',
														'Stock'=>'จัดสินค้า',
                            'OrderMobileApp'=>'สั่งผ่านแอปพลิเคชัน',
                            'queue'=>'ยิงคิว'
												),array("style"=>"width:100%")) 
                        ?>
                      </div>
                    </div>    
                    <!-- Remember me checkbox and sign in button --> 
                    <div class="control-group">
                      <div class="controls">
                        <button type="submit" class="btn btn-danger">Sign in</button>
                        <button type="reset" class="btn">Reset</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
                <div class="widget-foot">
                <?php echo $msg; ?>
                  <!-- Not Registred? <a href="#">Register here</a>  -->
                </div>
            </div>  
      </div>
    </div>