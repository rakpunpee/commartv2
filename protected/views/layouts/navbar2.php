<?php $baseUrl=Yii::app()->request->baseUrl;?>
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <!-- Menu button for smallar screens -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      </a>
      <!-- Site name for smallar screens -->
      <a href="index.html" class="brand"><?php echo CHtml::image("$baseUrl/images/navtitle.png"); ?></a>

      <!-- Navigation starts -->
      <div class="nav-collapse collapse">        
	  <?php if(!empty(Yii::app()->request->cookies['cookie_point']->value)){ ?>
        <!-- Links -->
        <ul class="nav pull-right">
          <li class="dropdown pull-right">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
               <?php echo Yii::app()->request->cookies['cookie_point']->value; ?> <b class="caret"></b>              
            </a>
            
            <!-- Dropdown menu -->
            <ul class="dropdown-menu">
              <li><a href="<?php echo $this->createUrl("logging/logout"); ?>"><i class="icon-off"></i> Logout</a></li>
            </ul>
          </li>
          
        </ul>
        <?php }else{ ?>
        <ul class="nav pull-right">
          <li class="dropdown pull-right">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo $this->createUrl("Logging/Login");?>"><i class="icon-lock"></i> Login</a>
          </a>
        </li>
        <?php } ?>

		

        
        <!-- <ul class="nav pull-right">
          
          
            <li class="dropdown dropdown-big">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="icon-comments"></i> Chats <span   class="badge badge-info">6</span> 
              </a>

                <ul class="dropdown-menu">
                  <li>
                    
                    <h5><i class="icon-comments"></i> Chats</h5>
                    
                    <hr />
                  </li>
                  <li>
                    
                    <a href="#">Hi :)</a> <span class="label label-warning pull-right">10:42</span>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <a href="#">How are you?</a> <span class="label label-warning pull-right">20:42</span>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <a href="#">What are you doing?</a> <span class="label label-warning pull-right">14:42</span>
                    <div class="clearfix"></div>
                    <hr />
                  </li>                  
                  <li>
                    <div class="drop-foot">
                      <a href="#">View All</a>
                    </div>
                  </li>                                    
                </ul>
            </li>

            
            <li class="dropdown dropdown-big">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="icon-envelope-alt"></i> Inbox <span class="badge badge-important">6</span> 
              </a>

                <ul class="dropdown-menu">
                  <li>
                   
                    <h5><i class="icon-envelope-alt"></i> Messages</h5>
                    
                    <hr />
                  </li>
                  <li>
                    
                    <a href="#">Hello how are you?</a>
                   
                    <p>Quisque eu consectetur erat eget  semper...</p>
                    <hr />
                  </li>
                  <li>
                    <a href="#">Today is wonderful?</a>
                    <p>Quisque eu consectetur erat eget  semper...</p>
                    <hr />
                  </li>
                  <li>
                    <div class="drop-foot">
                      <a href="#">View All</a>
                    </div>
                  </li>                                    
                </ul>
            </li>

           
            <li class="dropdown dropdown-big">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="icon-user"></i> Users <span   class="badge badge-success">6</span> 
              </a>

                <ul class="dropdown-menu">
                  <li>
                    
                    <h5><i class="icon-user"></i> Users</h5>
                    
                    <hr />
                  </li>
                  <li>
                   
                    <a href="#">Ravi Kumar</a> <span class="label label-warning pull-right">Free</span>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <a href="#">Balaji</a> <span class="label label-important pull-right">Premium</span>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <a href="#">Kumarasamy</a> <span class="label label-warning pull-right">Free</span>
                    <div class="clearfix"></div>
                    <hr />
                  </li>                  
                  <li>
                    <div class="drop-foot">
                      <a href="#">View All</a>
                    </div>
                  </li>                                    
                </ul>
            </li> 

        </ul> -->

      </div>

    </div>
  </div>
</div>