<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--
    <link rel="shortcut icon" href="<?php #echo "$baseUrl/images/commart2014.png";?>">
-->
<title>Commart</title>

<!-- Bootstrap core CSS -->
<link href="<?php echo $baseUrl;?>/bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="<?php echo $baseUrl;?>/css/style.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo $baseUrl;?>/js/jquery-1.10.2.min.js"></script>
</head>

<body>

    <!-- Static navbar -->
    <?php
        // $this->beginContent("/layouts/navbar");
    $this->beginContent("/layouts/navbaraoi");
    $this->endContent();
    ?>


    <div class="container">

      <?php echo $content;?>

  </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="<?php echo $baseUrl;?>/bootstrap3/dist/js/bootstrap.min.js"></script>
        <!-- JqWidget -->
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.base.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.darkblue.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.orange.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.metrodark.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.black.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.dark.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.android.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/plugins/select2/select2.min.css"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcore.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxbuttons.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxscrollbar.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxmenu.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxtooltip.js"); ?>
        <?php #echo CHtml::scriptFile($baseUrl."/js/jqwidgets/jqwidgets/jqxinput.js");?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcheckbox.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxlistbox.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdropdownlist.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdatetimeinput.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcalendar.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxwindow.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.sort.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.edit.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.storage.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.selection.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.filter.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.columnsresize.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.columnsreorder.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.pager.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.grouping.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.aggregates.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdata.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/plugins/select2/select2.min.js"); ?>
    </body>
    </html>
