<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <!-- Title and other stuffs -->
        <title>Commart v 2.0 จัดสินค้า</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
    </head>
    <?php $baseUrl = Yii::app()->request->baseUrl; ?>

    <?php echo CHtml::scriptFile("$baseUrl/js/jquery.js"); ?>

    <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.base.css"); ?>
    <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.darkblue.css"); ?>
    <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.ui-sunny.css"); ?>
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcore.js"); ?>
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxbuttons.js"); ?>
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxscrollbar.js"); ?>
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxmenu.js"); ?>
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxinput.js"); ?>
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
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdata.export.js"); ?>
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.export.js"); ?>
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxpanel.js"); ?>
    <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/scripts/gettheme.js"); ?>
    <style>
        .column {
            font-weight: bold;
        }
    </style>
    <script>
        $(document).ready(function() {
            var data = {};
            var theme = 'ui-sunny';

            if(screen.height>=1080){
        		wgheigth = 940;
            }else if(screen.height>=900){
            	wgheigth = 800;
        	}else if(screen.height>=768){
        		wgheigth = 620;
        	}else if(screen.height>=720){
        		wgheigth = 600;
        	}else{
            wgheigth = 500;
            }

        	
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'orderid', type: 'string'},
                            {name: 'payq', type: 'string'},
                            {name: 'modelid', type: 'string'},
                            {name: 'productid', type: 'string'},
                            {name: 'productname', type: 'string'},
                            {name: 'qty', type: 'number'},
                            {name: 'customer', type: 'string'},
                            {name: 'paytype', type: 'string'},
                            {name: 'waittime', type: 'string'},
                            {name: 'min', type: 'number'}

                        ],
                        id: 'orderid',
                        url: '<?php echo $this->createUrl("stock/stocklist"); ?>',
                        cache: false,
                        //root: 'Rows',
                        records: 'content',
                        /*beforeprocessing: function(data)
                         {
                         source.totalrecords = data[0].TotalRows;
                         },*/
                        /*filter: function()
                         {
                         // update the grid and send a request to the server.
                         $("#widgetstock1").jqxGrid('updatebounddata', 'filter');
                         },
                         */
                        sort: function()
                        {
                            // update the grid and send a request to the server.
                            $("#widgetstock1").jqxGrid('updatebounddata', 'sort');
                        }
                    };
            var cellclass = function(row, columnfield, value) {
                if (value == "") {
                    return '';
                } else if (value < 30) {
                    return 'green';
                } else if (value >= 30 && value < 60) {
                    return 'yellow';
                } else
                    return 'red';
            }
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#widgetstock1").jqxGrid(
                    {
                        source: dataAdapter,
                        theme: theme,
                        width: '100%',
                        height: wgheigth,
                        editable: true,
                        editmode: 'click',
                        columnsresize: true,
                        columnsreorder: true,
                        //filterable: true,
                        //showfilterrow: true,
                        showstatusbar: true,
                        statusbarheight: 25,
                        //autoloadstate: true,
                        //autosavestate: true,
                        sortable: true,
                        /*pageable: true,
                         pagesize: 50,
                         pagesizeoptions: ['20', '50', '100'],*/
                        altrows: true,
                       /* virtualmode: true,
                        rendergridrows: function()
                        {
                            return dataAdapter.records;
                        },*/
                        columns: [
                            {text: 'ลำดับ', editable: false, datafield: 'orderid', width: '5%', cellclassname: 'column'},
                            {text: 'คิวที่', editable: false, datafield: 'payq', width: '5%'},
                            {text: 'รุ่น', editable: false, datafield: 'modelid', width: '10%', cellclassname: 'column'},
                            {text: 'จำนวน', editable: false, datafield: 'qty', width: '5%', cellclassname: 'column'},
                            {text: 'รหัสสินค้า', editable: false, datafield: 'productid', width: '10%'},
                            {text: 'ชื่อสินค้า', editable: false, datafield: 'productname', width: '30%'},
                            {text: 'ชื่อลูกค้า', editable: false, datafield: 'customer', width: '10%'},
                            {text: 'ประเภท', editable: false, datafield: 'paytype', width: '10%'},
                            {text: 'เวลารอ', editable: false, datafield: 'waittime', width: '10%'},
                            {text: 'นาที', editable: false, datafield: 'min', cellclassname: cellclass, width: '5%'}
                        ]
                    });
            /* var reloadTable = function(){
             $('#widgetstock1').jqxGrid('refreshdata');
             };*/
		//##################timeRefresh###########################################################################	
		function timeRefresh(){
				$("#widgetstock1").jqxGrid({ source: dataAdapter });
		}
		setInterval(timeRefresh, 1000*60*1);  
			 
            setInterval('location.reload()', 1000 * 60);
        });
    </script>

  


    <body style="background-color: rgb(139,131,120)">
        <style>   
            .green:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .green:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
                color: #000;
                background-color: #99FFA0;
                font-weight: bold;
            }
            .yellow:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .yellow:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
                color: #000;
                background-color: #FFF799;
                font-weight: bold;
            }
            .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
                color: #000;
                background-color: #FF9999;
                font-weight: bold;
            }
        </style>
        <div class="row">
            <div class="col-md-12">
                <div id="widgetstock1"></div>
            </div>
        </div>

     <!--    <h2><div align="center" id="OutputText"></div></h2> -->
      





    </body>
</html>
