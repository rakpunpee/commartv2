<?php
$baseUrl=Yii::app()->request->baseUrl;
?>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/nodejs/socket-io.js"></script>
<script type="text/javascript">

	$(document).ready(function () {

		if (screen.height == 1080) {
			var  wgheigth = 400;
		} else if (screen.height == 768) {
			var   wgheigth = 400;
		} else if (screen.height == 900) {
			var   wgheigth = 400;
		}else if (screen.height == 1050) {
			var   wgheigth = 400;
		}
		if (screen.height == 1080) {
			var  wgheigth2 = 180;
		} else if (screen.height == 768) {
			var   wgheigth2 = 180;
		} else if (screen.height == 900) {
			var   wgheigth2 = 180;
		}else if (screen.height == 1050) {
			var   wgheigth2 = 180;
		}

// var socket = io.connect('http://27.131.138.143:3002');

var getAdapter=function(){
 var source =
 {
  datatype: "json",
  datafields: [
  { name: 'productid',type: 'string' },
  { name: 'producname',type: 'string' },
  { name: 'stockqty',type: 'string' },
  { name: 'stockremain',type: 'string' },
  { name: 'brand',type: 'string' },
  { name: 'stockpreorder',type: 'number' },
  { name: 'stockpre',type: 'number' },
  { name: 'plus',type: 'number' },
  { name: 'inputpreorder',type: 'number' },




  ],

  url: '<?php echo $this->createUrl("/setstock/Show");?>',
  cache: false,
  updaterow: function (rowid, rowdata, commit) {
    var rows = {};
    rows['productid'] = rowdata.productid;
    rows['plus'] =  rowdata.plus;
    rows['inputpreorder'] =  rowdata.inputpreorder;

    var apiurls = "http://172.18.0.135:8505/up/stockqty";
    var inputValue= rowdata.productid;
    var inputValue1= rowdata.plus;
    var inputValue2= rowdata.inputpreorder;


    $.ajax({
      url: apiurls,
      type: 'PUT',
      contentType: 'application/x-www-form-urlencoded',
        //dataType: 'json',
        data: {productid: inputValue,stockqty:inputValue1,stockpreorder:inputValue2},
        // success: handleData,
        error: function () {
          alert("Error please try again");
        },
        success: function () {
         var socket = io.connect('http://27.131.138.143:3002');
         socket.emit('updatePage');
         $("#jqxgrid").jqxGrid({source: getAdapter()});
       }
     });

  }


};

var dataAdapter = new $.jqx.dataAdapter(source,{
  formatData: function (data) {

   return data;
 }
});

return dataAdapter;
};

var colorstatus = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
  if(value=='0'){
    return "reds";
  }
}



            ///////////////////////////////////// initialize jqxGrid/////////////////////
            $("#jqxgrid").jqxGrid(
            {
            	source: getAdapter(),
            	theme: 'darkblue',
            	width: '100%',
            	height: wgheigth,
            	filterable: true,
            	showfilterrow: true,
            	editable:true,
              // sortable: true,
              columnsresize: true,
 // pageable: true,
 selectionmode: 'multiplecellsadvanced',




 columns: [

 { text: 'PRODUCT_ID',datafield: 'productid',cellsalign: 'center',align: 'center',editable: true ,width: '13%'},
 { text: 'BRAND',datafield: 'brand',align: 'center',cellsalign: 'center',  editable: false,filterable: true},
 { text: 'PRODUCTNAME',datafield: 'producname',align: 'center',cellsalign: 'center',  editable: true},
 { text: 'สต๊อก[ALL]',datafield: 'stockqty',align: 'center',cellsalign: 'center',  editable: false,filterable: true,cellclassname:colorstatus

},
{ text: 'สต๊อก[คงเหลือ]',datafield: 'stockremain',align: 'center',cellsalign: 'center',  editable: false,filterable: true},
{ text: '',editable:false, align: 'center' ,columntype: 'button',width: 80,filterable: false , cellsrenderer: function () {
 return "comment";
}, buttonclick: function (row) {
 var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
 var xx = "http://172.18.0.30/commartv02/index.php/setstock/commentpre?prid="+ escape(datarow.productid);

 window.open(xx,"_blank","toolbar,scrollbars,resizable,top=0,left=0,width=700px,height=880px");

}
},
{ text: 'สต๊อก[PRE]',datafield: 'stockpreorder',align: 'center',cellsalign: 'center',  editable: false,filterable: true},
{ text: 'สต๊อก[PRE]คงเหลือ',datafield: 'stockpre',align: 'center',cellsalign: 'center',  editable: false,filterable: true},

{ text: 'เพิ่ม/ลบ[All]',datafield: 'plus',align: 'center',cellsalign: 'center',filterable: false,editable: true,width: '12%',cellclassname: function(row, column, value, data){
  if(data['plus']<=0 ||data['plus']>=0 ){
    return "reds";
  }
}},
{ text: 'เพิ่ม/ลบ[PRE]',datafield: 'inputpreorder',align: 'center',cellsalign: 'center',filterable: false,editable: true,width: '12%',cellclassname: function(row, column, value, data){
  if(data['inputpreorder']<=0 ||data['inputpreorder']>=0 ){
    return "green";
  }
}},


]
});





            $("#btSave").click(function(event) {

              $("#jqxgrid").jqxGrid({source: getAdapter()});
            });

            // window.setTimeout( refreshGrid, 60000);


// function refreshGrid()
//        {
//           $("#jqxgrid").jqxGrid("updatebounddata");

//            window.setTimeout(refreshGrid, 60000);

//         }
$("#btex_group").on("click",function(){


  var url='<?php echo $this->createUrl("/setstock/export"); ?>';
  window.location.href=url;



});


});

</script>



<div class="panel panel-primary">
 <div class="panel-heading"><h3 align="center"><b>SET STOCK</b></h3></div>
 <!-- <div class="panel-body"> -->
 </div>
 <div class="col-md-12">







   <div align="right"><font color="red" face="verdana"><b>*หมายเหตุ หากต้องการลบสต๊อก กรุณาใส่เครื่องหมาย ( - ) ไว้ข้างหน้า เช่น -10<br>*สต๊อกอัพเดททุก1นาที</b></font>  <button type="button" class="btn btn-primary" id="btSave"> Refresh ตาราง</button><button type="button" id="btex_group" class="btn btn-primary" ></i> EXCEL</button></div><br>
   <div id="jqxgrid"></div>    <br><br>


 </div>
<!--
	/////////////////////////////////////////////////startgrid2//////////////////////////////// -->


  <!-- </div> -->


  <style type="text/css" media="screen">
  body {
   min-height:750px;
 }

</style>
<style>
.reds, .jqx-widget .reds {
  background-color: #ff6347;
  color: #FFB6C1;

}
.green, .jqx-widget .green {
  color: #ff0000;
  background-color: #00FF7F;
}
</style>