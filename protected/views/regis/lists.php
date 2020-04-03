<script>
$(document).ready(function() {
	var data = {};
	var theme = 'ui-smoothness';
	
	$("#orddate1").jqxDateTimeInput({width: '100%', height: '32px'});
	$("#orddate2").jqxDateTimeInput({width: '100%', height: '32px'});

	$("#div-chkdate").jqxTooltip({ content: 'เลือกเพื่อค้นหาวันที่', position: 'top', name: 'movieTooltip'});

	$("#response").load('<?php echo $this->createUrl("regis/listregisdata");?>');
	
	$("#search").on("click",function(){
		var data="search=true";
		data+="&chkdate="+$("input:checkbox[name=chkdate]:checked").val();
		data+="&orddate1="+$("#orddate1").val();
		data+="&orddate2="+$("#orddate2").val();
		data+="&alocateid="+$("#alocateid").val();
		data+="&modelid="+$("#modelid").val();
		data+="&productid="+$("#productid").val();
		data+="&productname="+$("#productname").val();
		data+="&customer="+$("#customer").val();
		data+="&tel="+$("#tel").val();
		
		$.post('<?php echo $this->createUrl("regis/listregisdata");?>',data,function(response){
			$("#response").html(response);
		});
	});

});

function url(orddate,alocate){
	window.location.href='<?php echo $this->createUrl('regis/editor'); ?>'+'/'+orddate+'/'+alocate;
}
</script>

<div class="row form-group">
	<div class="col-md-1">วันที่</div>
	<div class="col-md-2"><div id="orddate1"></div></div>
	<div class="col-md-2"><div id="orddate2"></div></div>
	<div class="col-md-1" id="div-chkdate"><input type="checkbox" name="chkdate" id="chkdate" value="1"></div>
	<div class="col-md-2"><?php echo CHtml::textField("alocateid",null,array("placeHolder"=>"เลขที่จอง","class"=>"form-control"));?></div>
	<div class="col-md-4 text-right">
		<button class="btn btn-info" id="search"><i class="glyphicon glyphicon-zoom-in"></i> Search</button>
	</div>
</div>

<div class="row form-group">
	<div class="col-md-1">Model</div>
	<div class="col-md-2"><?php echo CHtml::textField("modelid",null,array("placeHolder"=>"Model","class"=>"form-control"));?></div>
	<div class="col-md-2"><?php echo CHtml::textField("productid",null,array("placeHolder"=>"Product","class"=>"form-control"));?></div>
	<div class="col-md-5"><?php echo CHtml::textField("productname",null,array("placeHolder"=>"Product(Name)","class"=>"form-control"));?></div>
</div>

<div class="row form-group">
	<div class="col-md-1">ลูกค้า</div>
	<div class="col-md-2"><?php echo CHtml::textField("customer",null,array("placeHolder"=>"ลูกค้า","class"=>"form-control"));?></div>
	<div class="col-md-2"><?php echo CHtml::textField("tel",null,array("placeHolder"=>"โทรศัพท์","class"=>"form-control"));?></div>
</div>

<div class="row">
	<div class="col-md-12" id="response"></div>
</div>