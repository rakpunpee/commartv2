<script>
$(document).ready(function () {
	   var data = {};
	   var theme = 'ui-smoothness';
	   var source =
	   {
			datatype: "json",
			datafields: [
				{ name: 'brand',type: 'string'},
				{ name: 'modelid',type: 'string'},
				{ name: 'productid',type: 'string'},
				{ name: 'producname',type: 'string'},
				{ name: 'stockqty',type: 'number'},
				{ name: 'booking',type: 'number'}
			],
			id: 'productid',
			url: '<?php echo $this->createUrl("regis/addproductregis");?>',
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
                $("#widgetregis").jqxGrid('updatebounddata', 'filter');
            },
            sort: function()
            {
                // update the grid and send a request to the server.
                $("#widgetregis").jqxGrid('updatebounddata', 'sort');
            }
		};

		var dataAdapter = new $.jqx.dataAdapter(source);
			
		$("#widgetregis").jqxGrid(
		{
		source: dataAdapter,
		theme: theme,
		width: '100%',
		height:250,
		editable: true,
        editmode: 'click',
        columnsresize: true,
        columnsreorder: true,
        filterable: true,
        showfilterrow: true,
       	showstatusbar: true,
        statusbarheight: 25,
        autoloadstate: true,
        autosavestate: true,
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
			{ text: 'Brand', editable: false,  datafield: 'brand',width:'10%', filtertype: 'list', filteritems: [<?php echo Datasource::BrandJS();?>]},
			{ text: 'รุ่น', editable: false,  datafield: 'modelid',width:'10%'},
			{ text: 'รหัส', editable: false,  datafield: 'productid',width:'15%'},
			{ text: 'ชื่อสินค้า', editable: false, datafield: 'producname',width:'45%' },
			{ text: 'stock', editable: false , datafield: 'stockqty',width:'10%', cellsalign: 'right', cellsformat: 'n'},
			{ text: 'จอง' , datafield: 'booking',width:'10%', cellsalign: 'right', cellsformat: 'n'}
			
		]
	}); 

	$("#btn_save_regis").click(function(){
		if($("#alocateid").val()==''){
			alert("หมายเลขใบจอง : ห้ามเป็นค่าว่าง");
		}else if($("#customer").val()==''){
			alert("ชื่อลูกค่า/บริษัท : ห้ามเป็นค่าว่าง");
		}else if($("#register").val()==''){
			alert("ผู้บันทึก : ห้ามเป็นค่าว่าง");
		}else if($("#addr1").val()==''){
			alert("ที่อยู่ : ห้ามเป็นค่าว่าง");
		}else if($("#tel").val()==''){
			alert("เบอร์โทรศัพท์ : ห้ามเป็นค่าว่าง");
		}else if($("#boots").val()==''){
			alert("บูธขาย : ห้ามเป็นค่าว่าง");
		}else{
			
			var rowscount = $("#widgetregis").jqxGrid('getdatainformation').rowscount;
			$("#widgetregis").jqxGrid('beginupdate');
			
			for(var i=0;i<rowscount;i++){
				var dataRecord = $('#widgetregis').jqxGrid('getrowdata', i);
				rowdata={};
				rowdata["modelid"]=dataRecord.modelid;
				rowdata["productid"]=dataRecord.productid;
				rowdata["producname"]=dataRecord.producname;
				rowdata["booking"]=dataRecord.booking;
				if(rowdata["booking"] > 0){
					var data="regis=true";
					data+="&alocateid="+$("#alocateid").val();
					data+="&customer="+$("#customer").val();
					data+="&register="+$("#register").val();
					data+="&addr1="+$("#addr1").val();
					data+="&addr2="+$("#addr2").val();
					data+="&city="+$("#city").val();
					data+="&zipid="+$("#zipid").val();
					data+="&tel="+$("#tel").val();
					data+="&regcash="+$("input:checkbox[name=regcash]:checked").val();
					data+="&regcredit="+$("input:checkbox[name=regcredit]:checked").val();
					data+="&regloan="+$("input:checkbox[name=regloan]:checked").val();
					data+="&regloan1="+$("input:checkbox[name=regloan1]:checked").val();
					data+="&boots="+$("#boots").val();
					data += "&" + $.param(rowdata);

					$.ajax({
						dataType: 'json',
	                    url: '<?php echo $this->createUrl("Regis/Saveproductregis"); ?>',
	                    data: data,
	                    success: function(data, status, xhr) {
		                   //alert(data);
	                    }
	                });
				}
			}
			$("#widgetregis").jqxGrid('endupdate');
			alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			location.reload();
		}
	});
	/*var addfilter = function (brand) {
		$("#widgetregis").jqxGrid('clearfilters');
	    var filtergroup = new $.jqx.filter();
	    filtergroup.operator = 'or';
	    var filter_or_operator = 1;
	    var filtervalue = brand;
	    var filtercondition = 'contains';
	    var  filter = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
	    filtergroup.addfilter(filter_or_operator, filter);
	    $("#widgetregis").jqxGrid('addfilter', 'brand', filtergroup);
	    $("#widgetregis").jqxGrid('applyfilters');
	};

	$("#btn_dell").click(function(){ filter('dell');});
	$("#btn_acer").click(function(){ filter('acer');});
	$("#btn_msi").click(function(){ filter('msi');});
	$("#btn_asus").click(function(){ filter('asus');});
	$("#btn_hp").click(function(){ filter('hp');});
	$("#btn_toshiba").click(function(){ filter('toshiba');});
	$("#btn_benq").click(function(){ filter('benq');});
	$("#btn_samsung").click(function(){ filter('samsung');});
	$("#btn_lenovo").click(function(){ filter('lenovo');});*/

	
});


</script>

<div class="page-head">
	<h2 class="pull-left">
		Register <span class="page-meta">Commart v 2.0</span>
	</h2>
	<div class="clearfix"></div>
</div>

<div class="matter">
	<div class="container-fluid">
		<div class="row">
		<!-- 
		<div class="col-md-3">
				<div class="row">
					<button type="button" class="btn btn-info btn-large span6"
						id="btn_dell">DELL</button>
					<button type="button" class="btn btn-info btn-large span6"
						id="btn_acer">ACER</button>
				</div>
				<br />
				<div class="row">
					<button type="button" class="btn btn-success btn-large span6"
						id="btn_msi">MSI</button>
					<button type="button" class="btn btn-success btn-large span6"
						id="btn_asus">ASUS</button>
				</div>
				<br />
				<div class="row">
					<button type="button" class="btn btn-warning btn-large span6"
						id="btn_hp">HP</button>
					<button type="button" class="btn btn-warning btn-large span6"
						id="btn_toshiba">TOSHIBA</button>
				</div>
				<br />
				<div class="row">
					<button type="button" class="btn btn-primary btn-large span6"
						id="btn_benq">BENQ</button>
					<button type="button" class="btn btn-primary btn-large span6"
						id="btn_samsung">SAMSUNG</button>
				</div>
				<br />
				<div class="row">
					<button type="button" class="btn btn-info btn-large span6"
						id="btn_lenovo">LENOVO</button>
				</div>
			</div>
		 -->
			
		<!-- <div class="col-md-9"> -->
			
				<div class="row">
					<div id="widgetregis"></div>
				</div>
				<div class="row">
					<!-- <div class="col-md-12"> -->
						<form>

							<div class="row">
								<div class="col-md-2">หมายเลขใบจอง *</div>
								<div class="col-md-2">
									<?php echo CHtml::textField("alocateid",null,array("style"=>"width:100%"));?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">ชื่อลูกค้า/บริษัท *</div>
								<div class="col-md-4">
									<?php echo CHtml::textField("customer",null,array("style"=>"width:100%"));?>
								</div>
								
								<div class="col-md-1">ผู้บันทึก *</div>
								<div class="col-md-3">
									<?php echo CHtml::textField("register",null,array("style"=>"width:100%"));?>
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">ที่อยู่ *</div>
								<div class="col-md-4">
									<?php echo CHtml::textField("addr1",null,array("style"=>"width:100%"));?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-4">
									<?php echo CHtml::textField("addr2",null,array("style"=>"width:100%"));?>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">

									<div class="row">
										<div class="col-md-4">จังหวัด</div>
										<div class="col-md-4">
											<?php echo CHtml::textField("city",null,array("style"=>"width:100%"));?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">รหัสไปรษณีย์</div>
										<div class="col-md-4">
											<?php echo CHtml::textField("zipid",null,array("style"=>"width:100%"));?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">โทรศัพท์ *</div>
										<div class="col-md-4">
											<?php echo CHtml::textField("tel",null,array("style"=>"width:100%"));?>
										</div>
									</div>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-3">

									<label><input type='checkbox' id='regcash' name='regcash' value='1' />
										ชำระเป็นเงินสด</label> <label><input type='checkbox'
										id='regcredit' name='regcredit' value='1' /> ชำระเป็นบัตรเครดิต</label> <label><input
										type='checkbox' id='regloan' name='regloan' value='1' />
										ชำระเป็นสินเชื่อรออนุมัติ</label> <label><input
										type='checkbox' id='regloan1' name='regloan1' value='1' />
										ชำระเป็นสินเชื่อส่วนกลาง</label>

									<?php echo CHtml::dropDownList("boots",null,Datasource::ShopList(),array("style"=>"width:100%;margin-top:4px;"));?>
								</div>
							</div>

							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-4">
									<button type="button" class="btn btn-success btn-large" id="btn_save_regis">
										<i class="icon-save"></i> SAVE
									</button>
								</div>
							</div>
						</form>
					<!-- </div> -->
				</div>
			<!-- </div> -->
		</div>
	</div>
</div>
