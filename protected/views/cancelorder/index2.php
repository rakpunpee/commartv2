

<script type="text/javascript">
	$(document).ready(function () {

		if (screen.height == 1080) {
			var  wgheigth = 600;
		} else if (screen.height == 768) {
			var   wgheigth = 600;
		} else if (screen.height == 900) {
			var   wgheigth = 600;
		}else if (screen.height == 1050) {
			var   wgheigth = 600;
		}
		if (screen.height == 1080) {
			var  wgheigth2 = 200;
		} else if (screen.height == 768) {
			var   wgheigth2 = 200;
		} else if (screen.height == 900) {
			var   wgheigth2 = 200;
		}else if (screen.height == 1050) {
			var   wgheigth2 = 200;
		}
		
var colorstatus = function (row, columnfield, value, defaulthtml, columnproperties, datafield) {
        if(value =='ยังไม่ปิด-JOB-'){
            return "color1";
        }else if(value=='ปิด-JOB-สำเร็จ'){
            return "color3";
        } else if(value=='ลด'){
            return "color1";
        } 
            return "";
    }
    var getAdapter=function(){
     var source =
     {
      datatype: "json",
      datafields: [
      { name: 'orderid',type: 'number' },
      { name: 'alocateid',type: 'string' },
      { name: 'modelid',type: 'string' },
      { name: 'productid',type: 'string' },
      { name: 'productname',type: 'string' },
      { name: 'qty',type: 'number' },
      { name: 'customer',type: 'string' },
      { name: 'tel',type: 'string' },
      { name: 'paytype',type: 'string' },
      { name: 'pay',type: 'number' },
      { name: 'commentregister',type: 'string' },
      { name: 'sucess',type: 'string' },
      { name: 'requesvat',type: 'string' },
      { name: 'payq',type: 'string' },
      { name: 'price',type: 'string' },
      



      ],

      url: '<?php echo $this->createUrl("/cancelorder/Show");?>',
      cache: false,
      updaterow: function (rowid, rowdata, commit) {
    var rows = {};
    rows['customer'] = rowdata.customer;
    rows['tel'] =  rowdata.tel;
    

   
     var apiurls = "http://172.18.0.135:8505/get/registercanceled/"+ rowed['customer']+"/"+rowed['tel'];


    var settings = {
      async: true,
      crossDomain: true,
      url: apiurls,
      method: "GET",
    
    }

  }

  };

  var dataAdapter = new $.jqx.dataAdapter(source,{
    formatData: function (data) {
     data.brand = $("#brand").val();
     return data;
   }
 }); 

  return dataAdapter;
};




            ///////////////////////////////////// initialize jqxGrid/////////////////////
            $("#jqxgrid").jqxGrid(
            {
            	source: getAdapter(),
            	theme: 'bootstap',
            	width: '100%',
            	height: wgheigth,
            	filterable: true,
            	showfilterrow: true,
            	editable:true,
              sortable: true,
              columnsresize: true,

              selectionmode: 'multiplecellsextended',




              columns: [

              { text: 'PRINT',editable:false, align: 'center' ,columntype: 'button',width: 80,filterable: false , cellsrenderer: function () {
               return "Print";
             }, buttonclick: function (row) {
               var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);

               window.open("http://172.18.0.30/commartv02/index.php/cancelorder/print?id="+datarow.orderid 
                ,"_blank","toolbar,scrollbars,resizable,top=0,left=0,width=700px,height=880px");

             }
           },
           { text: 'NO.',datafield: 'orderid',cellsalign: 'center',align: 'center',filterable: false,editable: false ,width: '5%',hidden: true},
           { text: 'เลขออร์เดอร์',datafield: 'alocateid',align: 'center',cellsalign: 'center',filterable: true,  editable: false,width: '5%',columntype: 'button', buttonclick: function (row) {
            var dataread = $('#jqxgrid').jqxGrid('getrowdata',row);
            var orderid = dataread.orderid;
            window.open("http://172.18.0.30/commartv02/index.php/cancelorder/detail?id="+orderid,"_blank","toolbar,scrollbars,resizable,top=0,left=0,width=680px,height=400px");
          }},
          { text: 'modelid',datafield: 'modelid',align: 'center',cellsalign: 'center',filterable: true,  editable: true,width: '5%'},
          // { text: 'บัตรคิว',datafield: 'payq',align: 'center',cellsalign: 'center',filterable: true,editable: false,width: '5%'},
          { text: 'รหัสสินค้า',datafield: 'productid',align: 'center',cellsalign: 'center',filterable: true,editable: true,width: '10%'},

          { text: 'ชื่อสินค้า',datafield: 'productname',align: 'center',cellsalign: 'center',filterable: false,editable: true},
          { text: 'จำนวน',datafield: 'qty',align: 'center',cellsalign: 'center',filterable: false,editable: true,width: '5%'},
           { text: 'ราคา',datafield: 'price',align: 'center',cellsalign: 'center',filterable: false,editable: true,width: '5%'},
          { text: 'ชื่อลูกค้า',datafield: 'customer',align: 'center',cellsalign: 'center',filterable: true,editable: true,width: '10%'},
          { text: 'เบอร์โทร',datafield: 'tel',align: 'center',cellsalign: 'center',filterable: true,editable: true,width: '5%'},
          { text: 'สถานะ',datafield: 'pay',align: 'center',cellsalign: 'center',filterable: false,editable: true,width: '5%'},
          { text: 'ประเภทการชำระ',datafield: 'paytype',align: 'center',cellsalign: 'center',filterable: false,editable: true,width: '5%'},
          { text: 'สถานะJOB',datafield: 'sucess',align: 'center',cellsalign: 'center',filterable: false,editable: true,cellclassname:colorstatus,width: '5%'},

          { text: 'ยกเลิกใบจอง',editable:false, align: 'center' ,columntype: 'button',width: 80,filterable: false , cellsrenderer: function () {
           return "ยกเลิกใบจอง";
         }, buttonclick: function (row) {

          var conf=confirm('คุณต้องการยกเลิกใบจองใช่หรือไม่');
          var access = '<?php echo $CAccess[3]; ?>';
           if(conf==true  && access==1){
             var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
             var productid= datarow.productid
 $.post('<?php echo $this->createUrl("cancelorder/comment") ?>', {productid: productid}, function (data) {
              
              
             });
             window.open("http://172.18.0.30/commartv02/index.php/cancelorder/comment?id="+datarow.orderid,"_blank","toolbar,scrollbars,resizable,top=0,left=0,width=480px,height=280px");
           }else{
            alert('ไม่มีสิทธิิ์ในการยกเลิกใบจอง');
           }

         }
       },
       { text: 'ยกเลิกของเสีย',editable:false, align: 'center' ,columntype: 'button',width: 80,filterable: false , cellsrenderer: function () {
         return "ยกเลิกของเสีย";
       }, buttonclick: function (row) {
         var conf=confirm('คุณต้องการยกเลิกของเสียใช่หรือไม่');
          var access = '<?php echo $CAccess[3]; ?>';
           if(conf==true  && access==1){
           var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);

           window.open("http://172.18.0.30/commartv02/index.php/cancelorder/comment2?id="+datarow.orderid,"_blank","toolbar,scrollbars,resizable,top=0,left=0,width=480px,height=280px");
         }else{
            alert('ไม่มีสิทธิิ์ในการยกเลิกของเสีย');
           }

       }
     }


     ]
   });


            window.setTimeout( refreshGrid, 7500);


            function refreshGrid()
            {
              $("#jqxgrid").jqxGrid("updatebounddata");

              window.setTimeout(refreshGrid, 7500);

            }





          });

        </script>






      </div>

      <div class="col-md-12">
        <br>

        <div class="panel panel-primary">
          <div class="panel-heading"><h4 align="center"><b>รายการRegister(ByDay)</b></h4></div>
           <!-- <div class="col-md-3"><br>
            <input type="text" class="form-control" id="find" name="find"><button type="button" class="btn btn-success btn-lg" id="search"> ค้นหา</button></div> -->


            <div id="jqxgrid"></div></div>
          </div>

<!-- 
	/////////////////////////////////////////////////startgrid2//////////////////////////////// -->




  <style type="text/css" media="screen">
  body {
   min-height: 1000px;
 } .color1, .jqx-widget .color1 {
     color: #FF3333;

  }
  .color2, .jqx-widget .color2 {
     color: #00CC99;
   
  }
  .color3, .jqx-widget .color3 {
     color: #0000CC;
     
  }
</style>
