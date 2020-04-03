<script>
$(document).ready(function() {
	var data = {};
	var theme = 'ui-smoothness';

	$("#orderdate").jqxDateTimeInput({width: '100%', height: '32px', disabled: true });
	$("#pledgedate").jqxDateTimeInput({width: '100%', height: '32px', disabled: true });

	$('#chkorddate').change(function(event) {
		if(this.checked==true){
			$("#orderdate").jqxDateTimeInput({ disabled: false});
		}else{
			$("#orderdate").jqxDateTimeInput({ disabled: true});
		}
	});

	$('#chkpledgedate').change(function(event) {
		if(this.checked==true){
			$("#pledgedate").jqxDateTimeInput({ disabled: false });
		}else{
			$("#pledgedate").jqxDateTimeInput({ disabled: true });
		}
	});

	

	$('#bt_search_pledge').click(function(event) {
		$("#imgloader").css('display','block');

		var rows={};
		rows['orderdoc']=$("#orderdoc").val();
		rows['chkorddate']=$('input[id=chkorddate]:checked').val();
		rows['orderdate']=$('#orderdate').val();
		rows['chkpledgedate']=$('input[id=chkpledgedate]:checked').val();
		rows['pledgedate']=$('#pledgedate').val();
		rows['customer']=$('#customer').val();
		rows['tel']=$('#tel').val();

		$.post('<?php echo $this->createUrl("booking/listtb"); ?>', $.param(rows), function(response) {
			$("#imgloader").css('display','none');
			$('#listpledge').html(response);
		});
	});


});


function updateStatus(orderdoc){
	$("#imgloader").css('display','block');
	$.post('<?php echo $this->createUrl("booking/bkupdatestatus"); ?>', {orderdoc:orderdoc}, function(data, textStatus, xhr) {
		var rows={};
		rows['orderdoc']=$("#orderdoc").val();
		rows['chkorddate']=$('input[id=chkorddate]:checked').val();
		rows['orderdate']=$('#orderdate').val();
		rows['chkpledgedate']=$('input[id=chkpledgedate]:checked').val();
		rows['pledgedate']=$('#pledgedate').val();
		rows['customer']=$('#customer').val();
		rows['tel']=$('#tel').val();
		$.post('<?php echo $this->createUrl("booking/listtb"); ?>', $.param(rows), function(response) {
			$("#imgloader").css('display','none');
			$('#listpledge').html(response);
		});
	});
}

/*function getExcel(){
	var rows={};
	rows['orderdoc']=$("#orderdoc").val();
	rows['chkorddate']=$('input[id=chkorddate]:checked').val();
	rows['orderdate']=$('#orderdate').val();
	rows['chkpledgedate']=$('input[id=chkpledgedate]:checked').val();
	rows['pledgedate']=$('#pledgedate').val();
	rows['customer']=$('#customer').val();
	rows['tel']=$('#tel').val();

	$.post('<?php echo $this->createUrl("booking/exportexcel"); ?>', $.param(rows), function(data, textStatus, xhr) {
		
	});
}*/
</script>
<div class="row form-group">
	<div class="col-md-1">เลขที่จอง</div>
	<div class="col-md-2"><?php echo CHtml::textField('orderdoc',null, array('class'=>'form-control')); ?></div>
	<div class="col-md-1"><label>วันที่จอง<input type="checkbox" id="chkorddate" value="1"></label></div>
	<div class="col-md-2"><div id="orderdate"></div></div>
	<div class="col-md-1"><label>วันที่รับสินค้า<input type="checkbox" id="chkpledgedate" value="1"></label></div>
	<div class="col-md-2"><div id="pledgedate"></div></div>
	<div class="col-md-3 text-right">
		<button class="btn btn-default" id="bt_search_pledge">Search</button>
		<a href="<?php echo $this->createUrl("booking/exportexcel"); ?>" class="btn btn-info" target="_blank">Export</a>
	</div>
</div>

<div class="row form-group">
	<div class="col-md-1">ชื่อลูกค้า</div>
	<div class="col-md-3"><?php echo CHtml::textField('customer',null, array('class'=>'form-control')); ?></div>
	<div class="col-md-2">เบอร์โทรศัพท์</div>
	<div class="col-md-3"><?php echo CHtml::textField('tel',null, array('class'=>'form-control')); ?></div>
</div>

<img src="<?php echo Yii::app()->request->baseUrl ?>/images/ajax-loader.gif" id="imgloader" style="display:none">

<div class="row">
	<div class="col-md-12">
		<div id="listpledge"></div>
	</div>
</div>
