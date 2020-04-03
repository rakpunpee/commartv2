<script>
$(document).ready(function() {
	var theme = 'darkblue';

            var getDatabrand=function(){
				var source1 =
				{
					datatype: "json",
					datafields: [
						{ name: 'brand', type: 'string' },
					],
					url: '<?php echo $this->createUrl("showbrand/getdatabrand"); ?>',
					cache: false,			
			};
				var dataAdapter = new $.jqx.dataAdapter(source1);
				 return dataAdapter;
			};
			var getList=function(){
							var source2 =
							{
								datatype: "json",
								datafields: [
									{ name: 'productid', type: 'string' },
									{ name: 'productname', type: 'string' },
									{ name: 'categoryid', type: 'string' },
								],
								url: '<?php echo $this->createUrl("showbrand/getdatalist"); ?>',
								cache: false,
								filter: function()
								{
								// update the grid and send a request to the server.
									$("#showproduct").jqxGrid('updatebounddata', 'filter');
								},			
						};
							var dataAdapter = new $.jqx.dataAdapter(source2,{
					            formatData: function (data) {
					              data.brand = $('#groupidhide').val();     
					              return data;
					          }
					        });
							 return dataAdapter;
						};
	
$("#showbrand").jqxGrid(
		{
		source: getDatabrand(),
		theme: theme,
		width: '100%',
		height:500,
        columnsresize: true,
        columnsreorder: true,
       	showstatusbar: true,
        statusbarheight: 20,
        altrows: true,
		columns: [
			{ text: 'Brand', editable: false,  datafield: 'brand'},
		]
	});
$("#showproduct").jqxGrid(
		{
		//source: dataAdapter,
		theme: theme,
		width: '100%',
		height:500,
        columnsresize: true,
        columnsreorder: true,
       	showstatusbar: true,
       	showfilterrow: true,

        filterable: true,
        statusbarheight: 20,
        altrows: true,
		columns: [
			{ text: 'product', editable: false,  datafield: 'productid',width:'20%'},
			{ text: 'Name', editable: false,  datafield: 'productname'},
			{ text: 'categoryid', editable: false,  datafield: 'categoryid',width:'25%',filtertype:'list'},
		]
	});

 $("#showbrand").on('rowselect', function (event) {

                // var selectedrowindexes = $('#groupdata').jqxGrid('selectedrowindexes'); 
        var dataread = $('#showbrand').jqxGrid('getrowdata',event.args.rowindex);
 		//alert(dataread.brand);
 		$('#groupidhide').val(dataread.brand);
        $("#showproduct").jqxGrid({source: getList()});
       
        });


});

</script>




<div class="contrainer">
	<h3>Product</h3>
		<div class="row">
			<div class="col-md-6">
				<div id="showbrand"></div>
			</div>
			<div class="col-md-6">
				<div id="showproduct"></div>
			</div>
		</div>
<?php echo CHtml::hiddenField('groupidhide', null, array()); ?>
</div>