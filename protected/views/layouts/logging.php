<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
	<?php $baseUrl=Yii::app()->request->baseUrl;?>
  <!-- Stylesheets -->
  <?php echo CHtml::cssFile("$baseUrl/style/bootstrap.css");?>
  <?php echo CHtml::cssFile("$baseUrl/style/font-awesome.css");?>
  <?php echo CHtml::cssFile("$baseUrl/style/style.css");?>
  <?php echo CHtml::cssFile("$baseUrl/style/bootstrap-responsive.css");?>
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon 
  <link rel="shortcut icon" href="img/favicon/favicon.png">-->
</head>

<body>

<!-- Form area -->
<div class="admin-form">
  <div class="container-fluid">
	<?php echo $content; ?>
  </div> 
</div>
	
		

<!-- JS -->
<?php echo CHtml::scriptFile("$baseUrl/js/jquery.js");?>
<?php echo CHtml::scriptFile("$baseUrl/js/bootstrap.js");?>
</body>
</html>