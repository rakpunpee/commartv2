<style>
.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('><?php echo CHtml::image("images/loadding.gif"); ?>') 50% 50% no-repeat rgb(249,249,249);
}

</style>

<script type="text/javascript">
	$(window).load(function() {
		$(".loader").fadeOut("slow");
	})

	function PopupCenterDual(url, title, w, h) {

		var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
		var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
		width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

		var left = ((width / 2) - (w / 2)) + dualScreenLeft;
		var top = ((height / 2) - (h / 2)) + dualScreenTop;
		var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

		if (window.focus) {
			newWindow.focus();
		}
	}
	$(document).ready(function () {
		var theme = 'darkblue';
		var data = {};
		var source = [<?php echo Datasource::Cuswaitpay();?>];
		var dataAdapter = new $.jqx.dataAdapter(source,
		{
			formatData: function (data) {
				data.name_startsWith = $("#searchwidget").val();
				return data;
			}
		}
		);

		$("#widgetcustomer").jqxListBox({
			source: source, selectedIndex: -1, multipleextended: true, width: '100%', height: 1002, theme: theme,
			rendered: function () {
				$("#widgetcustomer").jqxListBox('focus');
			}
		});

		$("#widgetcustomer").on('change', function () {
			var items = $("#widgetcustomer").jqxListBox('getSelectedItems');
			var selection='';
			for (var i = 0; i < items.length; i++) {
				selection = items[i].label;
			}

			var rows = $("#widgettbpaypd").jqxGrid('getdatainformation').rowscount;
			var boundrows = $("#widgettbpaypd").jqxGrid('getboundrows');
			var rowIDs = new Array();
			for(i=0;i<rows;i++){
				rowIDs.push(boundrows[i].productid);

			}
			var commit = $("#widgettbpaypd").jqxGrid('deleterow', rowIDs);



			$.post('<?php echo $this->createUrl("payment/paycusdata");?>',{customer:selection},function(data){
				var arr=data.split("||");
				var alocate=selection.split(":");
				$("#alocateid").val(alocate[0].substring(3));
				$("#alocateid2").val(arr[1]);
				$("#customer").val(arr[2]);
				$("#addr1").val(arr[3]);
				$("#addr2").val(arr[4]);
				$("#city").val(arr[5]);
				$("#zipid").val(arr[6]);
				$("#tel").val(arr[7]);
				$("#cmr").val(arr[0]);

				var arr=eval(arr[8]);
				for(i=0;i<arr.length;i++){
					var rows={};
					rows["productid"]=arr[i].productid;
					rows["productname"]=arr[i].productname;
					rows["qty"]=arr[i].qty;
					rows["price"]=arr[i].price;
					rows["sumprice"]=arr[i].sumprice;

					var commit = $("#widgettbpaypd").jqxGrid('addrow', null, rows);
				}
			});
		});

		var sourcetb =
		{
			datatype: "json",
			datafields: [
			{ name: 'productid',type: 'string'},
			{ name: 'productname',type: 'string'},
			{ name: 'qty',type: 'number'},
			{ name: 'price',type: 'number'},
			{ name: 'sumprice',type: 'number'},
			],
			id: 'productid',
			//url: '<?php #echo $this->createUrl("regis/addproductregis");?>',
			cache: false,
			//records: 'content',
			addrow: function (rowid, rowdata, position, commit) {
				commit(true);
			},
			deleterow: function (rowid, commit) {
				commit(true);
			}
		};

		var dataAdapterTb = new $.jqx.dataAdapter(sourcetb);

		$("#widgettbpaypd").jqxGrid(
		{
			source: dataAdapterTb,
			theme: theme,
			width: '100%',
			height:200,

			columnsresize: true,
			columnsreorder: true,

			showstatusbar: true,
			statusbarheight: 25,

			altrows: true,

			columns: [
			{ text: 'รหัส', datafield: 'productid',width:'15%'},
			{ text: 'ชื่อสินค้า', datafield: 'productname',width:'45%' },
			{ text: 'จำนวน', datafield: 'qty',width:'10%', cellsalign: 'right', cellsformat: 'n'},
			{ text: 'ราคาตัวละ', datafield: 'price',width:'10%', cellsalign: 'right', cellsformat: 'n'},
			{ text: 'รวม', datafield: 'sumprice',width:'10%', cellsalign: 'right', cellsformat: 'n'},
			]
		});

		$("#poppricebill").jqxWindow({
			width: 990, height: 480, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
		});

		$("#cash,#creditcard,#loan,#tranfer,#percharge").bind('keyup',function(){
			var cash=$('#cash').val();
			var creditcard=$('#creditcard').val();
			var percharge=$('#percharge').val();
			var chargebath=0;
			var loan=$('#loan').val();
			var tranfer=$('#tranfer').val();
			var total=0;

			if(cash==''){ cash=0; }
			if(creditcard==''){ creditcard=0; }
			if(percharge==''){
				percharge=0;
			}else{
				chargebath=parseFloat(creditcard)*(parseFloat(percharge)/100);
			}
			if(chargebath==''){ chargebath=0; }
			if(loan==''){ loan=0; }
			if(tranfer==''){ tranfer=0; }
			if(total==''){ total=0; }

			$('#chargebath').val(chargebath);
			total=parseFloat(cash)+(parseFloat(creditcard)+parseFloat(chargebath))+parseFloat(loan)+parseFloat(tranfer);
			$('#total').val(total);

		});

		$("#btn_save_payment").click(function(){




			if($("#payq").val()==''){
				alert("หมายเลขคิวห้ามเป็นค่าว่าง");
			}else if($("#alocateid").val()==''){
				alert("หมายเลขOrderห้ามเป็นค่าว่าง");
			}else if($("#customer").val()==''){
				alert("ชื่อลูกค้าห้ามเป็นค่าว่าง");

			}else if($("#tel").val()=='' || $("#tel").val().length != '10'){
				alert("หมายเลขโทรศัพท์เป็นค่าว่าง หรือ ไม่ครบ 10 หลัก");
			}else if($("#total").val()==''){
				alert("จำนวนเงินห้ามเป็นค่าว่าง");
			}else{

				$.post('<?php echo $this->createUrl("Payment/Chkpayq"); ?>',{payq:$("#payq").val()},function(data){
					if(data=='true'){
						var bank='';

						if(document.getElementById("BBL").checked == true)
						{
							bank+="BBL";
						}
						if(document.getElementById("KTC").checked == true){
							bank+="KTC";
						}
						if(document.getElementById("TFB").checked == true){
							bank+="TFB";
						}
						if(document.getElementById("TMB").checked == true){
							bank+="TMB";
						}
						if(document.getElementById("FC").checked == true){
							bank+="FC";
						}
						if(document.getElementById("scb").checked == true){
							bank+="SCB";
						}
						if(document.getElementById("KCC").checked == true){
							bank+="KCC";
						}
						if(document.getElementById("TBANK").checked == true){
							bank+="TBANK";
						}if(document.getElementById("uob").checked == true){
							bank+="UOB";
						}


						var data="paytype="+$("#paytype").val();
						data+="&alocateid="+$("#alocateid").val();
						data+="&alocateid2="+$("#alocateid2").val();
						data+="&customer="+$("#customer").val();
						data+="&addr1="+$("#addr1").val();
						data+="&addr2="+$("#addr2").val();
						data+="&city="+$("#city").val();
						data+="&zipid="+$("#zipid").val();
						data+="&tel="+$("#tel").val();
						data+="&payq="+$("#payq").val();
						data+="&cash="+$("#cash").val();
						data+="&creditcard="+$("#creditcard").val();
						data+="&percharge="+$("#percharge").val();
						data+="&chargebath="+$("#chargebath").val();
						data+="&loan="+$("#loan").val();
						data+="&tranfer="+$("#tranfer").val();
						data+="&total="+$("#total").val();
						data+="&payremark="+$("#payremark").val();
						data+="&bank="+bank;

						$.ajax({
							dataType: 'json',
							url: '<?php echo $this->createUrl("Payment/Savepayment"); ?>',
							data: data,
							success: function(data, status, xhr) {
								alert("กำลังบันทึกข้อมูล.....");

								PopupCenterDual('<?php echo $this->createUrl("Print/Printbill"); ?>'+"/alocateid/"+$("#alocateid").val()+"/payq/"+$("#payq").val(),'NIGRAPHIC','1024','768');
								location.reload();

							}
						});
					}else{
						alert("มีเลขที่คิวอยู๋ในระบบแล้ว");
					}
				});
			}
		});

     /*$("#payq").keyup(function(){
         $.post('<?php #$this->createUrl("payment/chkpayq");?>',{payq:$("#payq").val()},function(data){
             if(data !=''){
            	alert(data);
             }
         });
     });*/

 });
</script>
<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-4">
				Payment
			</div>
			<div class="col-md-8" align="right">
				<button type="button"  class="btn btn-success" onclick="location.href='<?php echo $this->createUrl("/payment/list"); ?>';">Report Payment</button>
			</div>

		</div>
	</div>
	<div class="panel-body">



		<div class="row">
			<div class="col-md-3">
				<!-- <div class="row">
					<?php #echo CHtml::textField("searchwidget",null,array("style"=>"width:100%","placeholder"=>"เลือกลูกค้า"));?>
				</div> -->
				<div class="row">
					<div id="widgetcustomer"></div>
				</div>
			</div>

			<div class="col-md-9">
				<div class="row form-group">
					<div class="col-md-2 text-right">ประเภทการชำระ</div>
					<div class="col-md-4">
						<?php echo CHtml::dropDownList("paytype",null,array("เงินสด"=>"เงินสด","บัตรเครดิต"=>"บัตรเครดิต","สินเชื่อ"=>"สินเชื่อ","สินเชื่อเครดิต"=>"สินเชื่อเครดิต","เงินโอน"=>"เงินโอน"),array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-2 text-right"></div>
					<div class="loader"></div>

					<div class="col-md-3">
						<?php echo CHtml::textField("alocateid2",null,array("style"=>"width:100%","readOnly"=>true,"class"=>"form-control"));?>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2 text-right">ชื่อลูกค้า *</div>
					<div class="col-md-4">
						<?php echo CHtml::textField("customer",null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-2 text-right"></div>
					<div class="col-md-2">
						<?php echo CHtml::hiddenField("alocateid",null,array("style"=>"width:100%","readOnly"=>true,"class"=>"form-control"));?>

					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2 text-right">ที่อยู่ </div>
					<div class="col-md-4">
						<?php echo CHtml::textField("addr1",null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<?php echo CHtml::textField("addr2",null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2 text-right">จังหวัด</div>
					<div class="col-md-4">
						<?php echo CHtml::textField("city",null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>


				</div>

				<div class="row form-group">
					<div class="col-md-2 text-right">รหัสไปรณีย์</div>
					<div class="col-md-4">
						<?php echo CHtml::textField("zipid",null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-2 text-right">โทรศัพท์ *</div>
					<div class="col-md-4">
						<?php echo CHtml::textField("tel",null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-2 text-right">Comment จากRegister</div>
					<div class="col-md-4">
						<?php echo CHtml::textArea("cmr",null,array("style"=>"width:100%",'rows' => 6,"readOnly"=>true,"class"=>"form-control"));?>
					</div>
				</div>
				<hr>

				<div class="row form-group">
					<div class="col-md-2 text-right">หมายเลขคิว *</div>
					<div class="col-md-4">
						<?php echo CHtml::textField("payq",null,array("style"=>"width:100%","class"=>"form-control"));?>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-2 text-right">คิวล่าสุด : <?php echo $lastq; ?></div>
					<div class="col-md-4" id="paymsg"></div>

				</div>
				<div class="row form-group">
					<div class="col-md-2 text-right">เงินสด(บาท)</div>
					<div class="col-md-4">
						<?php echo CHtml::textField("cash",null,array("style"=>"width:100%;text-align:right;","class"=>"form-control"));?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-2 text-right">บัตรเครดิต (บาท)</div>
					<div class="col-md-4">
						<?php echo CHtml::textField("creditcard",null,array("style"=>"width:100%;text-align:right;","class"=>"form-control"));?>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-2 text-right">ค่าชาร์ด (%)</div>
					<div class="col-md-1">
						<?php echo CHtml::textField("percharge",null,array("style"=>"width:100%;text-align:right;","class"=>"form-control"));?>
					</div>
					<div class="col-md-2">
						<?php echo CHtml::textField("chargebath",null,array("style"=>"width:100%;text-align:right;","readonly"=>true,"class"=>"form-control"));?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<div class="row form-group">
							<div class="col-md-6 text-right">สินเชื่อ (บาท)</div>
							<div class="col-md-6">
								<?php echo CHtml::textField("loan",null,array("style"=>"width:100%;text-align:right;","class"=>"form-control"));?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-6 text-right">เงินโอน (บาท)</div>
							<div class="col-md-6">
								<?php echo CHtml::textField("tranfer",null,array("style"=>"width:100%;text-align:right;","class"=>"form-control"));?>
							</div>

						</div>
						<div class="row form-group">
							<div class="col-md-6 text-right">รวม (บาท)</div>
							<div class="col-md-6">
								<?php echo CHtml::textField("total",null,array("style"=>"width:100%;text-align:right;","readonly"=>true,"class"=>"form-control"));?>
							</div>

						</div>

					</div>
					<div class="col-md-8">
						<div class="col-md-4">
							<h3>สินเชื่อเครดิต</h3>
							<label class="checkbox inline">
								<input type="checkbox" name="BBL"  id ="BBL" value="BBL"> BBL (กรุงเทพฯ)
							</label>
							<label class="checkbox inline">
								<input
								type="checkbox" name="KTC"  id ="KTC" value="KTC"> KTC (กรุงไทย)
							</label>
							<label class="checkbox inline">
								<input type="checkbox" name="TFB"  id ="TFB" value="TFB"> TFB (กสิกร)
							</label>
							<label class="checkbox inline">
								<input
								type="checkbox" name="scb"  id ="scb" value="SCB"> SCB (ไทยพาณิชย์)
							</label>
							<label class="checkbox inline">
								<input
								type="checkbox" name="TMB"  id ="TMB" value="TMB"> TMB (ทหารไทย)
							</label>
						</div>
						<div class="col-md-4">
							<h3>สินเชื่อ</h3>
							<label class="checkbox inline">
								<input type="checkbox" name="FC"   id ="FC" value="FC"> FC (เฟิร์สชอยส์)
							</label>

							<label class="checkbox inline">
								<input type="checkbox" name="CTB"  id ="CTB" value="CTB"> CTB (ซิตี้แบงค์)
							</label>
							<label class="checkbox inline">
								<input
								type="checkbox" name="KCC"  id ="KCC" value="KCC"> KCC (กรุงศรี)
							</label>
							<label class="checkbox inline">
								<input
								type="checkbox" name="TBANK"  id ="TBANK" value="TBANK"> TBANK (ธนชาติ)
							</label>
							<label class="checkbox inline">
								<input type="checkbox" name="uob"  id ="uob" value="UOB"> UOB (ยูโอบี)
							</label>
						</div>
			<!-- 	<div class="col-md-4">
					<label class="checkbox inline">
						<input type="checkbox" name="bbl"
						value="BBL"> BBL
					</label>

				<label class="checkbox inline">
					<input
					type="checkbox" name="scib" value="SCIB"> SCIB
				</label>
			</div> -->
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2 text-right">หมายเหตุ</div>
		<div class="col-md-7">
			<?php echo CHtml::textField("payremark",null,array("style"=>"width:100%","class"=>"form-control"));?>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-11 text-right">
			<button type="button" class="btn btn-success"
			id="btn_save_payment">
			<i class="icon-save"></i> SAVE
		</button>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-12">
		<div id="widgettbpaypd"></div>
	</div>
</div>
</div>


</div>
</div>
</div>

