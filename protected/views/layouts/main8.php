 <?php $baseUrl = Yii::app()->request->baseUrl; ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Commart</title>
  <link href="<?php echo $baseUrl;?>/bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--   <link href="<?php echo $baseUrl;?>/css/style.css" rel="stylesheet"> -->
  <script src="<?php echo $baseUrl;?>/js/jquery-1.10.2.min.js"></script>

</head>
<style>
/*body {
    min-height:100%;
    background-image: url('/commartv02/images/bg-commart.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    } html{height:100%;}*/
  </style>
  <body>
   <?php $this->beginContent("//layouts/background"); $this->endContent(); ?>

   <div class="container">
     <div class="row" style="padding-top: 20px">
      <div id="contentweb" class="col-md-12" style="margin-top: 0px;">
        <?php echo $content;?>
      </div>
    </div>

  </div> <!-- /container -->


  <script src="<?php echo $baseUrl;?>/bootstrap3/dist/js/bootstrap.min.js"></script>
</body>
</html>
