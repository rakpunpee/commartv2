<script>
$(document).ready(function () {
	   var data = {};
	   var theme = 'darkblue';

	   if(screen.height>=1080){
			wgheigth = 840;
		}else if(screen.height>=768){
			wgheigth = 540;
		}else if(screen.height>=720){
			wgheigth = 500;
		}else{
			wgheigth = 500;
		}

	   var getAdapter = function(){
		  var source =
		   {
				datatype: "json",
				datafields: [
					{ name: 'brand',type: 'string'},
					{ name: 'modelid',type: 'string'},
					{ name: 'productid',type: 'string'},
					{ name: 'producname',type: 'string'},
					{ name: 'stockqty',type: 'number'}
				],
				url: '<?php echo $this->createUrl("site/indexdata");?>',
				cache: false,
				records: 'content',
				filter: function(){
	                $("#wgdisplay").jqxGrid('updatebounddata', 'filter');
	            },
	            sort: function(){
	                $("#wgdisplay").jqxGrid('updatebounddata', 'sort');
	            }
			};		

		  var dataAdapter = new $.jqx.dataAdapter(source);

		  return 	dataAdapter;
	   };

		


		$("#wgdisplay").jqxGrid({
			source : getAdapter(),
			theme: theme,
			width: '100%',
			height: wgheigth,
       		sortable: true,
       		filterable: true,
            showfilterrow: true,
           	sortable: true,
	        columnsresize: true,
	        columnsreorder: true,
	        autoloadstate: true,
	        autosavestate: true,
	        showstatusbar: true,
	        statusbarheight: 30,
	        altrows: true,
	        renderstatusbar: function (statusbar) {
	        	var container = $("<div style='overflow: hidden; position: relative; margin: 5px;'></div>");
	        	var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='glyphicon glyphicon-refresh'></i> <span style='margin-left: 4px; position: relative; top: -3px;'> Reload</span></div>");
	        	var exportbt = $("<div style='float: left; margin-left: 5px;'><i class='glyphicon glyphicon-print'></i> <span style='margin-left: 4px; position: relative; top: -3px;'> export</span></div>");
	        	container.append(reloadButton);
	        	container.append(exportbt);
	        	statusbar.append(container);
                reloadButton.jqxButton({  width: 125, height: 20 });
                exportbt.jqxButton({  width: 125, height: 20 });

                reloadButton.click(function (event) {
                    $("#wgdisplay").jqxGrid({ source: getAdapter() });
                });
				exportbt.click(function (event) {
			      	var url='<?php echo $this->createUrl("/site/Exportexcel"); ?>';
			      	window.location.href=url;
                });

	        },
			columns: [
				{ text: 'Brand',  datafield: 'brand',width:'12%', filtertype: 'list', filteritems: [<?php echo Datasource::BrandJS();?>]},
				{ text: 'รุ่น',  datafield: 'modelid',width:'12%'},
				{ text: 'รหัส',  datafield: 'productid',width:'16%'},
				{ text: 'ชื่อสินค้า', datafield: 'producname',width:'48%' },
				{ text: 'stock' , datafield: 'stockqty',width:'10%', cellsalign: 'right', cellsformat: 'n'}
				
			]
		}); 

		var timeRefresh = function(){
			$("#wgdisplay").jqxGrid({ source: getAdapter() });
		};

		setInterval(timeRefresh, 1000*60*5);

		// $("#btex_group").on("click",function(){
   
  //     	var url='<?php echo $this->createUrl("/site/Exportexcel"); ?>';
  //     	window.location.href=url;

  // });

});


</script>

<div class="row-field">
	<div class="span12">
		<div id="wgdisplay"></div>
	</div>
	<!-- <input type="button" id="btex_group" value="Export"> -->
</div>