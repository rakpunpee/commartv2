<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <!-- Title and other stuffs -->
        <title>Commart v 2.0</title>
        

        <?php echo CHtml::cssFile("$baseUrl/style/bootstrap.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/font-awesome.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/jquery-ui.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/fullcalendar.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/prettyPhoto.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/rateit.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/bootstrap-datetimepicker.min.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/jquery.gritter.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/bootstrap-toggle-buttons.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/style.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/widgets.css"); ?>
        <?php echo CHtml::cssFile("$baseUrl/style/bootstrap-responsive.css"); ?>
        <!-- <link rel="shortcut icon" href="img/favicon/favicon.png"> -->

        <!-- JS -->
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/bootstrap.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery-ui-1.10.2.custom.min.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/fullcalendar.min.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.rateit.min.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.prettyPhoto.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/zmcustom.js"); ?>

        <!-- CLEditor 
        <link rel="stylesheet" href="style/jquery.cleditor.css"> -->
    </head>

    <body>

        <?php
        $this->beginContent("/layouts/navbar");
        $this->endContent();
        ?>


        <!-- Main content starts -->

        <div class="content">

            <?php
            $this->beginContent("/layouts/sidebar");
            $this->endContent();
            ?>

            <div class="mainbar"><?php echo $content; ?></div>

            <div class="clearfix"></div>

        </div>

        <?php
#$this->beginContent("/layouts/notification");
#$this->endContent();
        ?> 

        <!-- Scroll to top -->
        <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 


        <!-- jQuery Flot -->
        <?php echo CHtml::scriptFile("$baseUrl/js/excanvas.min.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.flot.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.flot.resize.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.flot.pie.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.flot.stack.js"); ?>

        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.gritter.min.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/sparklines.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.cleditor.min.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/bootstrap-datetimepicker.min.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.toggle.buttons.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/filter.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/custom.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/charts.js"); ?>
        <?php echo CHtml::scriptFile("$baseUrl/js/jquery.main.js"); ?>

        <!-- JqWidget -->
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.base.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.ui-smoothness.css"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcore.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxbuttons.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxscrollbar.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxmenu.js"); ?>
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
        <?php #echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxmaskedinput.js"); ?>
        <?php #echo CHtml::scriptFile($baseUrl."/js/jqwidgets/jqwidgets/jqxdata.export.js");?>
        <?php #echo CHtml::scriptFile($baseUrl."/js/jqwidgets/jqwidgets/jqxgrid.export.js");?>
        <?php #echo CHtml::scriptFile($baseUrl."/js/jqwidgets/jqwidgets/jqxpanel.js");?>
        <?php #echo CHtml::scriptFile($baseUrl."/js/jqwidgets/scripts/gettheme.js");?>

    </body>
</html>