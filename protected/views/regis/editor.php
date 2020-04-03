<script>
$(document).ready(function () {
	   var data = {};
	   var theme = 'darkblue';
	   /*var source =
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
			url: '<?php #echo $this->createUrl("regis/addproductregis");?>',
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
                $("#widgetregiseditor").jqxGrid('updatebounddata', 'filter');
            },
            sort: function()
            {
                // update the grid and send a request to the server.
                $("#widgetregiseditor").jqxGrid('updatebounddata', 'sort');
            }
		};

		var dataAdapter = new $.jqx.dataAdapter(source);
			
		$("#widgetregiseditor").jqxGrid(
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
			{ text: 'Brand', editable: false,  datafield: 'brand',width:'10%', filtertype: 'list', filteritems: [<?php #echo Datasource::BrandJS();?>]},
			{ text: 'รุ่น', editable: false,  datafield: 'modelid',width:'10%'},
			{ text: 'รหัส', editable: false,  datafield: 'productid',width:'15%'},
			{ text: 'ชื่อสินค้า', editable: false, datafield: 'producname',width:'45%' },
			{ text: 'stock', editable: false , datafield: 'stockqty',width:'10%', cellsalign: 'right', cellsformat: 'n'},
			{ text: 'จอง' , datafield: 'booking',width:'10%', cellsalign: 'right', cellsformat: 'n'}
			
		]
	}); */
	/***********************************************/
	var source2 =
	   {
			datatype: "json",
			datafields: [
				{ name: 'brand',type: 'string'},
				{ name: 'modelid',type: 'string'},
				{ name: 'productid',type: 'string'},
				{ name: 'producname',type: 'string'},
				{ name: 'newproductid',type: 'string'},
				{ name: 'booking',type: 'number'}
			],
			//id: 'productid',
			url: '<?php echo $this->createUrl("regis/editorproduct");?>',
			cache: false,
			updaterow: function (rowid, newdata, commit) {
			    var newproduct=newdata.newproductid;
			    var booking=newdata.booking;
			    var productname='';
			    $.post('<?php echo $this->createUrl("regis/searchproduct"); ?>',{product:newproduct,booking:booking},function(data){
				    if(data==0){
					    alert('ไม่มีสินค้าในระบบ หรือสินค้าในสต็อกไม่พอ');
					    //newdata.newproductid=null;
					    commit(false);
				    }else{
					    alert(data);
				    	commit(true);
				    }
			    	
			    });
			    
			    
			}
			
            
		};

	

		var dataAdapter2 = new $.jqx.dataAdapter(source2,{
		        formatData: function (data) {
		        data.orddate = '<?php echo $orddate; ?>';
		        data.alocateid = '<?php echo $alocateid; ?>';
		        return data;
		        }
	        });
			
		$("#widgetaddregiseditor").jqxGrid(
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
		columns: [
			{ text: 'Brand', editable: false,  datafield: 'brand',width:'100'},
			{ text: 'รุ่น', editable: false,  datafield: 'modelid',width:'100'},
			{ text: 'รหัส', editable: false,  datafield: 'productid',width:'140'},
			{ text: 'ชื่อสินค้า', editable: false, datafield: 'producname',width:'460' },
			{ text: 'รหัส(แก้ไข)',  datafield: 'newproductid',width:'140'},
			{ text: 'จอง' , editable: false, datafield: 'booking',width:'60', cellsalign: 'right', cellsformat: 'n'}
			
		]
	});

	$("#alocateid").keyup(function(){
		$.post('<?php echo $this->createUrl('regis/getalocate');?>',{alocateid:$("#alocateid").val()},function(data){
			$("#regisstate").html(data);
		});
	});

	$("#btn_add_productregis").click(function(){
		var selectedrowindex = $("#widgetregiseditor").jqxGrid('getselectedrowindex');
		var getdata = $("#widgetregiseditor").jqxGrid('getrowdata', selectedrowindex);
		var rowdata={};
		rowdata['brand']=getdata.brand;
		rowdata['modelid']=getdata.modelid;
		rowdata['productid']=getdata.productid;
		rowdata['producname']=getdata.producname;
		rowdata['booking']=getdata.booking;
		if(getdata.stockqty>0){
			if(getdata.booking<=getdata.stockqty){
				var commit = $("#widgetaddregiseditor").jqxGrid('addrow', null, rowdata);
			}else{
				alert('จำนวนสินค้าที่จองเกินจำนวนสินค้าที่มีอยู่ในสต็อก');
			}
		}else{
			alert("ไม่มีสต็อกสินค้านี้");
		}
	});

	$("#btn_remove_productregis").click(function(){
		var selectedrowindex = $("#widgetaddregiseditor").jqxGrid('getselectedrowindex');
		var getid = $("#widgetaddregiseditor").jqxGrid('getrowid', selectedrowindex);
		var commit = $("#widgetaddregiseditor").jqxGrid('deleterow', getid);
	});

	$("#btn_save_regis").click(function(){
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
		}else{
			
			var rowscount = $("#widgetaddregiseditor").jqxGrid('getdatainformation').rowscount;
			if(rowscount>0){
				$("#widgetaddregiseditor").jqxGrid('beginupdate');
				for(var i=0;i<rowscount;i++){
					var dataRecord = $('#widgetaddregiseditor').jqxGrid('getrowdata', i);
					rowdata={};
					//rowdata["modelid"]=dataRecord.modelid;
					rowdata["productid"]=dataRecord.productid;
					rowdata["newproductid"]=dataRecord.newproductid;
					//rowdata["newproducname"]=dataRecord.newproducname;
					rowdata["booking"]=dataRecord.booking;
					if(dataRecord.newproductid!=null && rowdata["booking"]>0){
						var data="regis=true";
						data+="&alocateid="+$("#alocateid").val();
						data+="&orderdate=<?php echo $orddate;?>";
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
						//alert(data);
						$.ajax({
							dataType: 'json',
		                    url: '<?php echo $this->createUrl("Regis/Editbillproductregis"); ?>',
		                    data: data,
		                    success: function(data, status, xhr) {
			                  // alert(data);
		                    }
		                });
					}
				}
				$("#widgetaddregiseditor").jqxGrid('endupdate');
				alert("บันทึกแก้ไขข้อมูลเรียบร้อยแล้ว");
				location.reload();
			}else{
				alert("ยังไม่ได้เลือกสินค้าในรายการจองสินค้า");
			}
		}
	});
	

	
});


</script>


		<div class="row">
				<!--
				<div class="row">
					<div id="widgetregiseditor"></div>
				</div>
				<br>
				
				<div class="row">
					<button type="button" class="btn btn-warning" id="btn_add_productregis"><i class="icon-plus-sign"></i> ADD</button>
					<button type="button" class="btn btn-danger" id="btn_remove_productregis"><i class="icon-minus-sign"></i> REMOVE</button>
				</div>
				<br>
				  -->
				<div class="row">
					<div id="widgetaddregiseditor"></div>
				</div>
				<br>
				<div class="row">
					<!-- <div class="col-md-12"> -->
						<form role="form">

							<div class="row form-group">
								<div class="col-md-2">หมายเลขใบจอง *</div>
								<div class="col-md-2 has-error">
									<?php echo CHtml::textField("alocateid",($data['alocateid'])?$data['alocateid']:null,array("style"=>"width:100%","class"=>"form-control","readonly"=>true));?>
								</div>
								<div class="col-md-4" id="regisstate"></div>
							</div>
							
							<div class="row form-group">
								<div class="col-md-2">ชื่อลูกค้า/บริษัท *</div>
								<div class="col-md-4 has-error">
									<?php echo CHtml::textField("customer",($data['customer'])?$data['customer']:null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
								
								<div class="col-md-1">ผู้บันทึก *</div>
								<div class="col-md-3 has-error">
									<?php echo CHtml::textField("register",($data['register'])?$data['register']:null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-2">ที่อยู่ </div>
								<div class="col-md-4 has-success">
									<?php echo CHtml::textField("addr1",($data['addr1'])?$data['addr1']:null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-2"></div>
								<div class="col-md-4 has-success">
									<?php echo CHtml::textField("addr2",($data['addr2'])?$data['addr2']:null,array("style"=>"width:100%","class"=>"form-control"));?>
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-6">

									<div class="row form-group">
										<div class="col-md-4">จังหวัด</div>
										<div class="col-md-4 has-success">
											<?php echo CHtml::textField("city",($data['city'])?$data['city']:null,array("style"=>"width:100%","class"=>"form-control"));?>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-4">รหัสไปรษณีย์</div>
										<div class="col-md-4 has-success">
											<?php echo CHtml::textField("zipid",($data['zipid'])?$data['zipid']:null,array("style"=>"width:100%","class"=>"form-control"));?>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-4">โทรศัพท์ *</div>
										<div class="col-md-4 has-error">
											<?php echo CHtml::textField("tel",($data['tel'])?$data['tel']:null,array("style"=>"width:100%","class"=>"form-control"));?>
										</div>
									</div>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-3">

									<label><input type='checkbox' id='regcash' name='regcash' value='1' <?php echo ($data['regcash'])?'checked':''; ?>/>
										ชำระเป็นเงินสด</label> 
									<label><input type='checkbox' id='regcredit' name='regcredit' value='1' <?php echo ($data['regcredit'])?'checked':''; ?>/> 
										ชำระเป็นบัตรเครดิต</label> 
									<label><input type='checkbox' id='regloan' name='regloan' value='1' <?php echo ($data['regloan'])?'checked':''; ?>/>
										ชำระเป็นสินเชื่อรออนุมัติ</label> 
									<label><input type='checkbox' id='regloan1' name='regloan1' value='1' <?php echo ($data['regloan1'])?'checked':''; ?>/>
										ชำระเป็นสินเชื่อส่วนกลาง</label>

									<?php echo CHtml::dropDownList("boots",($data['boots'])?$data['boots']:null,Datasource::ShopList(),array("style"=>"width:100%;margin-top:4px;","class"=>"form-control"));?>
								</div>
							</div>

							<div class="row form-group">
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

