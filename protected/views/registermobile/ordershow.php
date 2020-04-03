<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <!-- Title and other stuffs -->
        <title>Mobile Order</title>
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
    <?php echo CHtml::scriptFile($baseUrl . "/nodejs/socket-io.js"); ?>
    
    <style>
        .column {
            font-weight: bold;
        }
    </style>
    <script>
        $(document).ready(function() {
            var data = {};
            var theme = 'ui-sunny';
            // $("#resolution").html('SCREEN : '+screen.height);
            if(screen.height>=1080){
        		wgheigth = 1080;
                wgheigth2 = 300;
            }else if(screen.height>=900){
            	wgheigth = 800;
                wgheigth2 = 300;
        	}else if(screen.height>=768){
        		wgheigth = 700;
                wgheigth2 = 200;
        	}else if(screen.height>=720){
        		wgheigth = 700;
                wgheigth2 = 200;
        	}else{
            wgheigth = 600;
            wgheigth2 = 200;
            }

            var socket = io.connect('http://172.18.0.30:8888');

            socket.on('commartmobiledata', function(data) {
            $.each(data.commartmobile, function(index, results) {
                commartmobile = [];
              
                
                for (var i = 0; i < results.length; i++) {
                    commartmobile.push(results[i]);    
                };

                $("#widgetstock1").jqxGrid({source: cpuallAdapter()});
             
                });
            });
  

        	var cpuallAdapter = function () {    
            var source =
                    {
                        localdata: commartmobile,
                        datatype: "array",
                        datafields: [
                            {name: 'orderCode', type: 'string'},
                            {name: 'productCode', type: 'string'},
                            {name: 'productname', type: 'string'},
                            {name: 'modelid', type: 'string'},
                            {name: 'productQty', type: 'number'},
                            {name: 'customerName', type: 'string'},
                            {name: 'productStatus', type: 'string'},
                            {name: 'dateorder', type: 'string'},
                            {name: 'wait', type: 'number'},

                        ],
                        cache: false,
                  
                        records: 'content',
 
                        sort: function()
                        {

                            $("#widgetstock1").jqxGrid('updatebounddata', 'sort');
                        }
                    };
                   
                    var dataAdapter = new $.jqx.dataAdapter(source);
                return dataAdapter;     
            };

             var cellclass = function(row, columnfield, value) {
                        
                        if (value == 0) {
                            return 'green';
                        } else if (value < 5) {
                            return 'green';
                        } else if (value >= 5 && value < 15) {
                            return 'yellow';
                        } else
                            return 'red';
                    }

            $("#widgetstock1").jqxGrid(
                    {
                        // source: dataAdapter,
                        theme: theme,
                        width: '100%',
                        height: wgheigth,
                        // editable: true,
                        // editmode: 'click',
                        // columnsresize: true,
                        selectionmode: 'singlerow',
                        columnsheight: 35,
                        rowsheight: 30,
                        showstatusbar: true,
                        statusbarheight: 35,
   
                        altrows: true,
    
                        columns: [
                            {text: 'ORDER',align:'center',cellsalign:'center', editable: false, datafield: 'orderCode', width: '10%'},
                            // {text: 'คิวที่',align:'center', editable: false, datafield: 'payq', width: '5%'},
                           
                            {text: 'รหัสสินค้า',align:'center', editable: false, datafield: 'productCode', width: '10%'},
                            {text: 'ชื่อสินค้า',align:'center', editable: false, datafield: 'productname'},
                            {text: 'รุ่น',align:'center',cellsalign:'center', editable: false, datafield: 'modelid', width: '10%'},
                            {text: 'จำนวน',align:'center',cellsalign:'center', editable: false, datafield: 'productQty', width: '5%'},
                            {text: 'ชื่อลูกค้า',align:'center',cellsalign:'center', editable: false, datafield: 'customerName', width: '10%'},
                            {text: 'สถานะ',align:'center',cellsalign:'center', editable: false, datafield: 'productStatus', width: '10%'},
                            // {text: 'ประเภท',align:'center', editable: false, datafield: 'paytype', width: '10%'},
                            {text: 'เวลาสั่ง',align:'center',cellsalign:'center', editable: false,datafield: 'dateorder', width: '10%'},
                            {text: 'ผ่านมา',align:'center',cellsalign:'center', editable: false, datafield: 'wait', width: '10%' ,cellclassname: cellclass},
                            
                        ]
                    });

        
 
        });
    </script>

 

    <body style="background-color: rgb(2, 5, 111)">
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
        <br><br>
        <div class="row">
            <div class="col-md-12 ">
                <k id="resolution" class="text-right" style="color: green;"></k>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="widgetstock1"></div>
            </div>
        </div>
       
<!-- 
        <h2><div align="center" id="OutputText"></div></h2>
        <div id="OutputText2">
            <div align="center">Please wait...</div>
        </div> -->





    </body>
</html>
