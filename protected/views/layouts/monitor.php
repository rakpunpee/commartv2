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
<!-- <link href="<?php //echo $baseUrl;?>/css/styleq.css" rel="stylesheet"> -->
<script src="<?php echo $baseUrl;?>/js/jquery-1.10.2.min.js"></script>
<!-- Custom scripts required node -->
    <script src="<?php echo $baseUrl;?>/nodejs/socket-io.js"></script>
    <script src="<?php echo $baseUrl;?>/jquery/numeral.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
  </head>
<style>
body {
    min-height:100px;
    background-image: url('/commartv02/images/bgqueue.jpg');
    background-repeat: no-repeat;
    background-size: cover;
  } html{height:500px;}
</style>
  <body>


    <div>

      <?php echo $content;?>

    </div> <!-- /container -->


  <script src="<?php echo $baseUrl;?>/bootstrap3/dist/js/bootstrap.min.js"></script>  	
  </body>
</html>
