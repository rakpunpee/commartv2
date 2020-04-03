<script>
$(document).ready(function () {
	   var data = {};
	   var theme = 'darkblue';
	   var source =
	   {
			datatype: "json",
			datafields: [
				{ name: 'orderid',type: 'string'},
				{ name: 'alocateid',type: 'string'},
				{ name: 'paydoc',type: 'string'},
				{ name: 'productid',type: 'string'},
				{ name: 'productname',type: 'string'},
				{ name: 'qty',type: 'number'},
				{ name: 'customer',type: 'string'},
				{ name: 'tel',type: 'string'},
				{ name: 'paytxt',type: 'string'}
			],
			id: 'orderid',
			url: '<?php echo $this->createUrl("editbill/cancelbilldata");?>',
			cache: false,
			root: 'Rows',
			records: 'content',
            beforeprocessing: function(data)
            {
                source.totalrecords = data[0].TotalRows;
            },
			filter: function()
            {
                // update the grid and send a request to the server.
                $("#widgetcutbill").jqxGrid('updatebounddata', 'filter');
            },
            sort: function()
            {
                // update the grid and send a request to the server.
                $("#widgetcutbill").jqxGrid('updatebounddata', 'sort');
            }
		};

		var dataAdapter = new $.jqx.dataAdapter(source);
			
		$("#widgetcutbill").jqxGrid(
		{
		source: dataAdapter,
		theme: theme,
		width: '100%',
		height:350,
        columnsresize: true,
        columnsreorder: true,
        filterable: true,
        showfilterrow: true,
       	showstatusbar: true,
        statusbarheight: 25,
        sortable: true,
        pageable: true,
        pagesize: 50,
        pagesizeoptions: ['20', '50', '100'],
        altrows: true,
		virtualmode: true,
		rendergridrows: function()
		{
			  return dataAdapter.records;     
		},
		columns: [
			{ text: 'No.', datafield: 'orderid',width:'6%'},
			{ text: 'ใบจองสินค้า.', datafield: 'alocateid',width:'6%'},
			{ text: 'เลขที่เอกสาร', datafield: 'paydoc',width:'10%'},
			{ text: 'รหัสสินค้า',  datafield: 'productid',width:'10%'},
			{ text: 'ชื่อ', datafield: 'productname',width:'45%'},
			{ text: 'จำนวน', datafield: 'qty',width:'6%', cellsalign: 'right', cellsformat: 'n' },
			{ text: 'ชื่อลูกค้า', datafield: 'customer',width:'10%'},
			{ text: 'สถานะ' , datafield: 'paytxt',width:'10%'}
		]
	});

	$("#btn_select_cut").click(function(){
		var selectedrowindex = $("#widgetcutbill").jqxGrid('getselectedrowindex');
        var rowscount = $("#widgetcutbill").jqxGrid('getdatainformation').rowscount;
        
        if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
            var rows = $("#widgetcutbill").jqxGrid('getrowdata', selectedrowindex);
            
            var con=confirm('คุณต้องการยกเลิกรายการนี้ใช่หรือไม่');
            if(con==true){
                var data="delete=true&"+$.param({alocateid:rows.alocateid});
                
            	$.ajax({
                    dataType: 'json',
                    url: '<?php echo $this->createUrl("editbill/cancelbilldata"); ?>',
                    cache: false,
                    data: data,
                    success: function(data, status, xhr) {
                        location.reload();
                    }
                });
            }
        }
	});
});
</script>


		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-danger" id="btn_select_cut"><i class="icon-trash"></i> ยกเลิกออเดอร์</button>
			</div>
		</div>
		<div class="clearfix"><br></div>
		
		<div class="row">
			<div id="widgetcutbill"></div>
		</div>
