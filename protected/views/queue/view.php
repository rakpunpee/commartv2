
<script type="text/javascript">
  

  $(document).ready(function () {

    if (screen.height == 1080) {
     var  wgheigth = 680;
   } else if (screen.height == 768) {
     var   wgheigth = 370;
   } else if (screen.height == 900) {
     var   wgheigth = 330;
   }else if (screen.height == 1050) {
     var   wgheigth = 680;
   }

   window.setTimeout( refreshGrid, 15000);


   function refreshGrid()
   {
    $("#jqxgrid").jqxGrid("updatebounddata");

    window.setTimeout(refreshGrid, 15000);

  }



  var getAdapter=function(){
   var source =
   {
    datatype: "json",
    datafields: [
    { name: 'orderid',type: 'string' },
    { name: 'alocateid',type: 'string' },
    { name: 'payq',type: 'string' },
    { name: 'customer',type: 'string' },
    { name: 'modelid',type: 'string' },
    { name: 'productid',type: 'string' },
    { name: 'productname',type: 'string' },



    ],

    url: '<?php echo $this->createUrl("/queue/Showqueue");?>',
    cache: false,


  };

  var dataAdapter = new $.jqx.dataAdapter(source,{
    formatData: function (data) {

     return data;
   }
 }); 

  return dataAdapter;
};




            ///////////////////////////////////// initialize jqxGrid/////////////////////
            $("#jqxgrid").jqxGrid(
            {
            	source: getAdapter(),
            	theme: 'metrodark',
            	width: '100%',
            	height: wgheigth,
            	filterable: true,
            	showfilterrow: true,
            	editable:true,
              // sortable: true,
              columnsresize: true,

              selectionmode: 'multiplecellsextended',




              columns: [
              { text: 'orderid',datafield: 'orderid',cellsalign: 'center',align: 'center',editable: true ,width: '18%',hidden:true},
              { text: 'เลขใบจอง',datafield: 'alocateid',cellsalign: 'center',align: 'center',editable: true ,width: '18%'},
              { text: 'คิว',align: 'center',datafield: 'payq',cellsalign: 'center',  editable: true,width: '5%'},
              { text: 'modelid',align: 'center',datafield: 'modelid',cellsalign: 'center',filterable: false,editable: true,width: '10%'},
              { text: 'productid',align: 'center',datafield: 'productid',cellsalign: 'center',filterable: false,editable: true,width: '10%'},
              { text: 'productname',align: 'center',datafield: 'productname',cellsalign: 'center',filterable: false,editable: true},
              { text: 'ชื่อลูกค้า',align: 'center',datafield: 'customer',cellsalign: 'center',filterable: false,editable: false,width: '20%'},

              ]
            });



          });

        </script>


        <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading"><h4 align="center"><b>แสดงออเดอร์ที่เปิดบิลitecแล้ว</b></h4></div>
            <button type="button" onclick="location.href='<?php echo $this->createUrl("/queue/index"); ?>';" class="btn btn-success ">ยิงคิว</button>
            <button type="button" onclick="location.href='<?php echo $this->createUrl("/queue/search"); ?>';" class="btn btn-success ">ดูคิวที่ยิงไปแล้ว</button>
            <div id="jqxgrid"></div></div>

          </div>





          <style type="text/css" media="screen">
          body {
           min-height: 1000px;
         }
         .col-md-4{
          position: relative;
          min-height: 1px;
          padding-left: 0px;
          padding-right: 15px;
        }
      </style>
