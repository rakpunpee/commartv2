<script>
    $(document).ready(function() {
        var data = {};
        var theme = 'ui-smoothness';
        var source =
                {
                    datatype: "json",
                    datafields: [
						{name: 'orderid', type: 'number'},
						{name: 'modelid', type: 'string'},
                        {name: 'productid', type: 'string'},
                        {name: 'productname', type: 'string'},
                        {name: 'qty', type: 'number'}
                    ],
                    id: 'orderid',
                    //url: '<?php //echo $this->createUrl("stock/stocklist");                 ?>',
                    cache: false,
                    //root: 'Rows',
                    records: 'content',
                    addrow: function(rowid, rowdata, position, commit) {

                        commit(true);
                    },
                    deleterow: function(rowid, commit) {

                        commit(true);
                    },
                    updaterow: function(rowid, newdata, commit) {
                        $.post('<?php echo $this->createUrl("Editbill/Selectproduct"); ?>', {productid: newdata.productid}, function(data) {
                            var arr=data.split("||");
                            newdata.modelid = arr[0];
                            newdata.productname = arr[1];
                           commit(true);
                        });
                        

                    }
                };

        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#widgetchangproduct").jqxGrid(
                {
                    source: dataAdapter,
                    theme: theme,
                    width: '100%',
                    height: 250,
                    editable: true,
                    editmode: 'click',
                    columnsresize: true,
                    columnsreorder: true,
                    //filterable: true,
                    //showfilterrow: true,
                    //showstatusbar: true,
                    statusbarheight: 25,
                    //autoloadstate: true,
                    //autosavestate: true,
                    sortable: true,
                    /*pageable: true,
                     pagesize: 50,
                     pagesizeoptions: ['20', '50', '100'],*/
                    altrows: true,
                    virtualmode: true,
                    rendergridrows: function()
                    {
                        return dataAdapter.records;
                    },
                    columns: [
						{text: 'ลำดับ', editable: false, datafield: 'orderid', width: '5%'},
						{text: 'เลขกล่อง', editable: false, datafield: 'modelid', width: '10%'},
                        {text: 'รหัสสินค้า', datafield: 'productid', width: '15%'},
                        {text: 'ชื่อสินค้า', editable: false, datafield: 'productname', width: '70%'},
                        {text: 'จำนวน', editable: false, datafield: 'qty', width: '10%'}
                    ]
                });
        
        $("#btn_search").on('click', function() {
            var rowscount = $("#widgetchangproduct").jqxGrid('getdatainformation').rowscount;
	   		var boundrows = $("#widgetchangproduct").jqxGrid('getboundrows');
	   		var rowIDs = new Array();
	   		for(i=0;i<rowscount;i++){
	   			rowIDs.push(boundrows[i].orderid);
	   		 	
	   		}
	   		var commit = $("#widgetchangproduct").jqxGrid('deleterow', rowIDs);
	   		
            for (i = 0; i < rowscount; i++) {
                var id = $("#widgetchangproduct").jqxGrid('getrowdata', i);
                var commit = $("#widgetchangproduct").jqxGrid('deleterow', id);
            }

            var txt_search = $("#search").val();

            $.post('<?php echo $this->createUrl("editbill/changeproduct"); ?>', {txt_search: txt_search}, function(data) {
                //alert(data);
                var dtsource = eval(data);
                for (i = 0; i < dtsource.length; i++) {
                    var commit = $("#widgetchangproduct").jqxGrid('addrow', null, dtsource[i]);
                }
            });

        });

        $("#btn_change_save").on('click',function(){
        	var rowscount = $("#widgetchangproduct").jqxGrid('getdatainformation').rowscount;
        	$("#widgetchangproduct").jqxGrid('beginupdate');
	   		for(i=0;i<rowscount;i++){
	   			var getdata = $("#widgetchangproduct").jqxGrid('getrowdata', i);
	   			var datarow={};
	   			datarow["orderid"]=getdata.orderid;
	   			datarow["productid"]=getdata.productid;
	   			datarow["productname"]=getdata.productname;
	   			datarow["modelid"]=getdata.modelid;
	   			datarow["qty"]=getdata.qty;

	   			var data="change=true";
	            data+="&paydoc="+$("#search").val();
	            data+="&"+$.param(datarow);
	            
	            $.ajax({
					dataType: 'json',
                    url: '<?php echo $this->createUrl("Editbill/Savechange"); ?>',
                    data: data,
                    success: function(data, status, xhr) {
	                   
                    }
                });
	   		}
	   		$("#widgetchangproduct").jqxGrid('endupdate');
	   		alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			location.reload();
            
        });
    });
</script>
<div id="a"></div>
<div class="page-head">
    <h2 class="pull-left">
        เปลี่ยนสินค้า <span class="page-meta">Commart v 2.0</span>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="matter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">เลขที่บิล</div>
            <div class="col-md-2">
                <?php echo CHtml::textField("search", null, array("placeholder" => "เลขที่บิล", "style" => "width:100%")); ?>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success" id="btn_search">
                    <i class="icon-search"></i> Search
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><div id="widgetchangproduct"></div></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 text-right"><button type="button" class="btn btn-info" id="btn_change_save"><i class="icon-save"></i> SAVE</button></div>
        </div>
    </div>
</div>
