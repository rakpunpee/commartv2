
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
    { name: 'sucessdate',type: 'time' },
    { name: 'alocateid',type: 'string' },
    { name: 'runq',type: 'number' },
    { name: 'servicecheck',type: 'number' },
   



    ],

    url: '<?php echo $this->createUrl("/queue/Showsearch");?>',
    cache: false,
  updaterow: function (rowid, rowdata, commit) {
      var rows = {};
     
      rows['runq'] = rowdata.runq;
      rows['servicecheck'] = rowdata.servicecheck;
    $.post('<?php echo $this->createUrl("queue/Updateservicecheck"); ?>', $.param(rows), function(data, textStatus, xhr) {
       commit(true);
     });
     $("#jqxgrid").jqxGrid({source: getAdapter()});
    }

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
              { text: 'คิว',datafield: 'runq',cellsalign: 'center',align: 'center',editable: true },
              { text: 'เลขออเดอร',datafield: 'alocateid',cellsalign: 'center',align: 'center',editable: true },
              { text: 'ช่างที่ปล่อยเครื่อง',datafield: 'servicecheck',cellsalign: 'center',align: 'center',editable: true ,width:'10%' },
              { text: 'เวลา',align: 'center',datafield: 'sucessdate',cellsalign: 'center',  editable: true},
            

              ]
            });



          });

        </script>


        <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading"><h4 align="center"><b>รายการออเดอร์ที่ส่งออก</b></h4></div>
            <button type="button" onclick="location.href='<?php echo $this->createUrl("/queue/View"); ?>';" class="btn btn-success ">ออกบิล itec แล้ว</button>
            <button type="button" onclick="location.href='<?php echo $this->createUrl("/queue/index"); ?>';" class="btn btn-success ">ยิงคิว</button>
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
