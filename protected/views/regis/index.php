<script>
$(document).ready(function () {

	document.getElementById("myForm1").reset();


	   var data = {};
	   var theme = 'darkblue';
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
            },
            /*updaterow: function (rowid, newdata, commit) {
            	
             	alert($.param(newdata));
            	commit(true);
            }*/
		};

		var dataAdapter = new $.jqx.dataAdapter(source);
			
		$("#widgetregis").jqxGrid(
		{
		source: dataAdapter,
		theme: theme,
		width: '100%',
		height:200,
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
			{ text: 'รหัส',  datafield: 'productid',width:'15%'},
			{ text: 'ชื่อสินค้า', editable: false, datafield: 'producname',width:'45%' },
			{ text: 'stock', editable: false , datafield: 'stockqty',width:'10%', cellsalign: 'right', cellsformat: 'n'},
			{ text: 'จอง' , datafield: 'booking',width:'10%', cellsalign: 'right', cellsformat: 'n'}
			
		]
	}); 
	/***********************************************/
	var source2 =
	   {
			datatype: "json",
			datafields: [
				{ name: 'brand',type: 'string'},
				{ name: 'modelid',type: 'string'},
				{ name: 'productid',type: 'string'},
				{ name: 'producname',type: 'string'},
				{ name: 'booking',type: 'number'}
			],
			id: 'productid',
			cache: false,
			/*records: 'content'
			,addrow: function (rowid, rowdata, position, commit) {   
                commit(true);
            },
            deleterow: function (rowid, commit) {
                commit(true);
            },*/
            
		};

		var dataAdapter2 = new $.jqx.dataAdapter(source2);
			
		$("#widgetaddregis").jqxGrid(
		{
		source: dataAdapter2,
		theme: theme,
		width: '100%',
		height:200,
		editable: true,
        editmode: 'click',
        columnsresize: true,
        columnsreorder: true,
        /*filterable: true,
        showfilterrow: true,*/
       	showstatusbar: true,
        statusbarheight: 25,
        /*autoloadstate: true,
        autosavestate: true,*/
        sortable: true,
        /*pageable: true,
        pagesize: 50,
        pagesizeoptions: ['20', '50', '100'],*/
        altrows: true,
		/*virtualmode: true,
		rendergridrows: function()
		{
			  return dataAdapter2.records;     
		},*/
		columns: [
			{ text: 'Brand', editable: false,  datafield: 'brand',width:'10%'},
			{ text: 'รุ่น', editable: false,  datafield: 'modelid',width:'10%'},
			{ text: 'รหัส', editable: false,  datafield: 'productid',width:'15%'},
			{ text: 'ชื่อสินค้า', editable: false, datafield: 'producname',width:'45%' },
			{ text: 'จอง', editable: false , datafield: 'booking',width:'10%', cellsalign: 'right', cellsformat: 'n'}
			
		]
	});

	$("#alocateid").keyup(function(){
		$.post('<?php echo $this->createUrl('regis/getalocate');?>',{alocateid:$("#alocateid").val()},function(data){
			$("#regisstate").html(data);
		});
	});

	$("#btn_add_productregis").click(function(){
		var selectedrowindex = $("#widgetregis").jqxGrid('getselectedrowindex');
		var getdata = $("#widgetregis").jqxGrid('getrowdata', selectedrowindex);
		var rowdata={};
		rowdata['brand']=getdata.brand;
		rowdata['modelid']=getdata.modelid;
		rowdata['productid']=getdata.productid;
		rowdata['producname']=getdata.producname;
		rowdata['stockqty']=getdata.stockqty;
		rowdata['booking']=getdata.booking;               //stockqty
		//alert('st = ' + getdata.stockqty + ' bk = ' + getdata.booking);
		if(getdata.stockqty>0){
			if(getdata.booking<=getdata.stockqty && getdata.booking != 0 && getdata.booking != null){
				
				var rowscount = $("#widgetaddregis").jqxGrid('getdatainformation').rowscount;
				
				if(rowscount>0){
					
					var compare=0;
					
					for(var i=0;i<rowscount;i++){
						var rowid = $("#widgetaddregis").jqxGrid('getrowid',i);
						var data = $("#widgetaddregis").jqxGrid('getrowdatabyid',rowid);
						
						if(data.productid == getdata.productid){
							compare++;
						}
						
					}
				}

				if(compare>0){
					alert("สินค้านี้ถูกเลือกไว้แล้ว ถ้าต้องการแก้ไขจำนวนต้องลบในรายการที่เลือกออกก่อน\nแล้วทำการ ADD สินค้าเข้ามาใหม่");
				}else{
					var commit = $("#widgetaddregis").jqxGrid('addrow', null, rowdata);
				}
				/*var rowid = $("#widgetaddregis").jqxGrid('getrowid',0);
				alert(rowid);
				if(rowid != null){
					alert('what the fuck');
					var data = $("#widgetaddregis").jqxGrid('getrowdatabyid',eval(getdata.productid));
					alert(data.productid + ' new add ' + getdata.productid);
					if(data.productid == getdata.productid){
						alert("สินค้านี้ถูกเลือกไว้แล้ว ถ้าต้องการแก้ไขจำนวนต้องลบในรายการที่เลือกออกก่อน\nแล้วทำการ ADD สินค้าเข้ามาใหม่");
					}else{
						var commit = $("#widgetaddregis").jqxGrid('addrow', null, rowdata);
					}
				}else{
					var commit = $("#widgetaddregis").jqxGrid('addrow', null, rowdata);
				}*/
				//alert(commit);
				/*var editda={};
				editda['brand']=getdata.brand;
				editda['modelid']=getdata.modelid;
				editda['productid']=getdata.productid;
				editda['producname']=getdata.producname;
				editda['stockqty']=getdata.stockqty;
				editda['booking']=0;
				
				var commit = $("#widgetregis").jqxGrid('updaterow',getdata.productid, editda);*/
				//alert(commit);
			}else{
				alert('จำนวนสินค้าที่เลือกต้องไม่เกินจำนวนสินค้าที่มีอยู่ในสต็อก และไม่เท่ากับสูนย์');
			}
		}else{
			alert("ไม่มีสต็อกสินค้านี้");
		}
	});

	$("#btn_remove_productregis").click(function(){
		var selectedrowindex = $("#widgetaddregis").jqxGrid('getselectedrowindex');
		var getid = $("#widgetaddregis").jqxGrid('getrowid', selectedrowindex);
		var commit = $("#widgetaddregis").jqxGrid('deleterow', getid);
		
	});

	$("#btn_save_regis").click(function(){
		var regcash=($("#regcash:checked").val())?$("#regcash:checked").val():0;
		var regcredit=($("#regcredit:checked").val())?$("#regcredit:checked").val():0;
		var regloan=($("#regloan:checked").val())?$("#regloan:checked").val():0;
		var regloan1=($("#regloan1:checked").val())?$("#regloan1:checked").val():0;


		if($("#alocateid").val()==''){
			alert("หมายเลขใบจอง : ห้ามเป็นค่าว่าง");
		}else if($("#customer").val()==''){
			alert("ชื่อลูกค่า/บริษัท : ห้ามเป็นค่าว่าง");
		}else if($("#register").val()==''){
			alert("ผู้บันทึก : ห้ามเป็นค่าว่าง");
		/*}else if($("#addr1").val()==''){
			alert("ที่อยู่ : ห้ามเป็นค่าว่าง");*/
		}else if($("#tel").val()==''){
			alert("เบอร์โทรศัพท์ : ห้ามเป็นค่าว่าง");
		}else if($("#boots").val()==''){
			alert("บูธขาย : ห้ามเป็นค่าว่าง");
		}else if(regcash == 0 && regcredit == 0 && regloan == 0 && regloan1==0){
			alert("ยังไม่ได้เลือก การชำระเงิน");
		}else{
			
			var rowscount = $("#widgetaddregis").jqxGrid('getdatainformation').rowscount;
			if(rowscount>0){
				$("#widgetaddregis").jqxGrid('beginupdate');
				for(var i=0;i<rowscount;i++){
					var dataRecord = $('#widgetaddregis').jqxGrid('getrowdata', i);
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
			                  // alert(data);
		                    }
		                });
					}
				}
				$("#widgetaddregis").jqxGrid('endupdate');
				alert("บันทึกข้อมูลเรียบร้อยแล้ว");
				 location.reload();
			}else{
				alert("ยังไม่ได้เลือกสินค้าในรายการจองสินค้า");
			}
		}
	});
	

	
});


</script>


		<div class="row">
			
				<div class="row">
					<div id="widgetregis"></div>
				</div>
				<br>
				
				<div class="row">
					<button type="button" class="btn btn-info" id="btn_add_productregis"><i class="glyphicon glyphicon-plus"></i> ADD</button>
					<button type="button" class="btn btn-danger" id="btn_remove_productregis"><i class="glyphicon glyphicon-minus"></i> REMOVE</button>
					<button type="button" class="btn btn-success btn-large" id="btn_save_money" onClick="javascript:load_print(1);">
										<i class="glyphicon glyphicon-print"></i> บัตรคิวเงินสด
									</button>
									<button type="button" class="btn btn-success btn-large" id="btn_save_sin" onClick="javascript:load_print(2);">
										<i class="glyphicon glyphicon-print"></i> บัตรคิวสินเชื่อ
									</button>
				</div>
				<br>
				
				<div class="row">
					<div id="widgetaddregis"></div>
				</div>
				<br>
				<div class="row">
					<!-- <div class="col-md-12"> -->
						<form role="form" id="myForm1">

							<div class="row form-group">
								<div class="col-md-2">หมายเลขใบจอง *</div>
								<div class="col-md-2 has-error">
									<?php echo CHtml::textField("alocateid",null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
								<div class="col-md-4" id="regisstate"></div>
							</div>
							
							<div class="row form-group">
								<div class="col-md-2">ชื่อลูกค้า/บริษัท *</div>
								<div class="col-md-4 has-error">
									<?php echo CHtml::textField("customer",null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
								
								<div class="col-md-1">ผู้บันทึก *</div>
								<div class="col-md-3 has-error">
									<?php echo CHtml::textField("register",null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-2">ที่อยู่ </div>
								<div class="col-md-4 has-success">
									<?php echo CHtml::textField("addr1",null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-2"></div>
								<div class="col-md-4 has-success">
									<?php echo CHtml::textField("addr2",null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-6">

									<div class="row form-group">
										<div class="col-md-4">จังหวัด</div>
										<div class="col-md-4 has-success">
											<?php echo CHtml::textField("city",null,array("style"=>"width:100%","class"=>"form-control"));?>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-4">รหัสไปรษณีย์</div>
										<div class="col-md-4 has-success">
											<?php echo CHtml::textField("zipid",null,array("style"=>"width:100%","class"=>"form-control"));?>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-4">โทรศัพท์ *</div>
										<div class="col-md-4 has-error">
											<?php echo CHtml::textField("tel",null,array("style"=>"width:100%","class"=>"form-control"));?>
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

									<?php echo CHtml::dropDownList("boots",null,Datasource::ShopList(),array("style"=>"width:100%;margin-top:4px;","class"=>"form-control"));?>
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-2"></div>
								<div class="col-md-4">
									<button type="button" class="btn btn-success btn-large" id="btn_save_regis">
										<i class="glyphicon glyphicon-save"></i> SAVE
									</button>

								</div>
								<!-- <div class="col-md-4 text-right">
									<button type="button" class="btn btn-danger btn-large" id="btn_save_money" onClick="javascript:load_print(1);">
										<i class="glyphicon glyphicon-print"></i> บัตรคิวเงินสด
									</button>
									<button type="button" class="btn btn-danger btn-large" id="btn_save_sin" onClick="javascript:load_print(2);">
										<i class="glyphicon glyphicon-print"></i> บัตรคิวสินเชื่อ
									</button>
									
								</div> -->
							</div>
						</form>
					<!-- </div> -->
				</div>
			<!-- </div> -->
		</div>

<script>
	

function load_print(id){
	
	
	window.open("http://172.18.0.30/commartv02/index.php/regis/Searchprint?id="+id,"_blank","toolbar,scrollbars,resizable,top=0,left=0,width=226.771px,height=642.51px");

}



</script>