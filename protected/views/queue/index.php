<script type="text/javascript">
  $(document).ready(function () {




   if (screen.height == 1080) {
    var  wgheigth = 275;
  } else if (screen.height == 768) {
   var   wgheigth = 275;
 } else if (screen.height == 900) {
   var   wgheigth = 275;
 }else if (screen.height == 1050) {
   var   wgheigth = 275;
 }
 if (screen.height == 1080) {
  var  wgheigth2 = 50;
} else if (screen.height == 768) {
 var   wgheigth2 = 50;
} else if (screen.height == 900) {
 var   wgheigth2 = 50;
}else if (screen.height == 1050) {
 var   wgheigth2 = 50;
}
$("#error").hide();
$("#sus").hide();
$("#sus1").hide();
document.getElementById('service').disabled = true;
$("#service").keyup(function(event) {
  $("#response1").val($("#service").val());

});



$('#queue').focus();
$('#queue').change(function() {


  var apiurl = "http://172.18.0.135:8505/updcutq";
  var inputValue=$('#queue').val();
  var inputValue1=$('#date').val();



  $.ajax({
    url: apiurl,
    type: 'PUT',
    contentType: 'application/x-www-form-urlencoded',
        // dataType: 'json',
        data: {payq:inputValue,dateq:inputValue1
        },


        error: function () {
          $("#error").show();
          setTimeout(function () {
            $("#error").hide();
            $('#queue').val(null);
          }, 2500);
        },
        success: function () {
          $("#sus").show();
          $("#last1").val($("#queue").val());

          document.getElementById('queue').disabled = true;
          document.getElementById('service').disabled = false;

          $('#service').focus();
            // $("#sus1").show();
            // $("#sus").hide();



          }

        });

});  

$('#service').change(function() {


  var apiurl = "http://172.18.0.135:8505/updservicecheck";
  var inputValue=$('#service').val();
  var inputValue1=$('#queue').val();
  var inputValue2=$('#date').val();
      // alert(inputValue); alert(inputValue1);

      $.ajax({
        url: apiurl,
        type: 'PUT',
        contentType: 'application/x-www-form-urlencoded',
        // dataType: 'json',
        data: {payq:inputValue1,dateq:inputValue2,servicecheck:inputValue
        },
        // success: handleData,
        error: function () {
          alert("Error please try again");
        },
        success: function () {
          $("#sus").hide();
          $("#sus1").show();


          $('#queue').val(null);
          $('#service').val(null);
          setTimeout(function () {
            $("#sus1").hide();

          }, 2500);
          document.getElementById('queue').disabled = false;
          $('#queue').focus();
          document.getElementById('service').disabled = true;
          $("#jqxgrid").jqxGrid({source: getAdapter()});
          $("#jqxgrid2").jqxGrid({source: getAdapter2()});
          
        }
      });

    });
var getAdapter=function(){
  var source =
  {
    datatype: "json",
    datafields: [
    { name: 'no',type: 'string' },
    { name: 'payq',type: 'string' },
    { name: 'waittime',type: 'string' },



    ],
    url: '<?php echo $this->createUrl("/queue/Show");?>',

    cache: false,
    filter: function()
    {
          // update the grid and send a request to the server.
          $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
        },

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
              // sortable: true,
              // columnsresize: true,

              selectionmode: 'multiplecellsextended',




              columns: [

              { text: 'ช่องเทสเครื่อง',datafield: 'no',cellsalign: 'center',align: 'center',editable: false ,width: '25%'},
              { text: 'คิวลูกค้า',datafield: 'payq',align: 'center',cellsalign: 'center',  editable: false},
              { text: 'เวลา',datafield: 'waittime',align: 'center',cellsalign: 'center',  editable: false},
              { text: '',editable: true, align: 'center' ,columntype: 'button',width: 60 , cellsrenderer: function () {
               return "ยกเลิกคิว";
             }, buttonclick: function (row) {
      // var conf=confirm('คุณต้องการยกเลิกคิวใช่หรือไม่');

      var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
      var rows={};
      rows['no']=datarow.no;
      rows['payq']=datarow.payq;
// alert(datarow.no);

var apiurls = "http://172.18.0.135:8505/upreturnq";

var conf=confirm('คุณต้องการลบคิวนี้ใช่หรือไม่');
if(conf==true){
  $.ajax({
    url: apiurls,
    type: 'PUT',
    contentType: 'application/x-www-form-urlencoded',
        //dataType: 'json',
        data: {no:datarow.no,payq:datarow.payq},
        // success: handleData,
        error: function () {
          alert("Error please try again");
        }

      });
}
setTimeout(function () {
  $("#jqxgrid").jqxGrid("updatebounddata");
}, 2000);
}
}






]
});

            var getAdapter2=function(){
              var source =
              {
                datatype: "json",
                datafields: [
                { name: 'no',type: 'string' },
                { name: 'payq',type: 'string' },
                { name: 'waittime',type: 'string' },



                ],
                url: '<?php echo $this->createUrl("/queue/Show2");?>',

                cache: false,
                filter: function()
                {
          // update the grid and send a request to the server.
          $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
        },

      };

      var dataAdapter = new $.jqx.dataAdapter(source,{
        formatData: function (data) {

          return data;
        }
      }); 

      return dataAdapter;
    };




            ///////////////////////////////////// initialize jqxGrid/////////////////////
            $("#jqxgrid2").jqxGrid(
            {
              source: getAdapter2(),
              theme: 'metrodark',
              width: '100%',
              height: wgheigth,
              // sortable: true,
              // columnsresize: true,

              selectionmode: 'multiplecellsextended',




              columns: [

              { text: 'ช่องเทสเครื่อง',datafield: 'no',align: 'center',cellsalign: 'center', editable: false ,width:'25%'},
              { text: 'คิวลูกค้า',datafield: 'payq',align: 'center',cellsalign: 'center',  editable: false},
              { text: 'เวลา',datafield: 'waittime',align: 'center',cellsalign: 'center',  editable: false},
              { text: '',editable: true, align: 'center' ,columntype: 'button',width: 60 , cellsrenderer: function () {
               return "ยกเลิกคิว";
             }, buttonclick: function (row) {
      // var conf=confirm('คุณต้องการยกเลิกคิวใช่หรือไม่');

      var datarow = $("#jqxgrid2").jqxGrid('getrowdata', row);
      var rows={};
      rows['no']=datarow.no;
      rows['payq']=datarow.payq;
// alert(datarow.no);

var apiurls = "http://172.18.0.135:8505/upreturnq";

var conf=confirm('คุณต้องการลบคิวนี้ใช่หรือไม่');
if(conf==true){
  $.ajax({
    url: apiurls,
    type: 'PUT',
    contentType: 'application/x-www-form-urlencoded',
        //dataType: 'json',
        data: {no:datarow.no,payq:datarow.payq},
        // success: handleData,
        error: function () {
          alert("Error please try again");
        }

      });
}
setTimeout(function () {
  $("#jqxgrid2").jqxGrid("updatebounddata");
}, 2000);
}
}






]
});



            var getAdapter3=function(){
              var source =
              {
                datatype: "json",
                datafields: [
                { name: 'c_orderlastitec',type: 'number' },
                



                ],
                url: '<?php echo $this->createUrl("/queue/Showqueu");?>',

                cache: false,
                filter: function()
                {
          // update the grid and send a request to the server.
          
        },

      };

      var dataAdapter = new $.jqx.dataAdapter(source,{
        formatData: function (data) {

          return data;
        }
      }); 

      return dataAdapter;
    };




            ///////////////////////////////////// initialize jqxGrid/////////////////////
            $("#qwait").jqxGrid(
            {
              source: getAdapter3(),
              theme: 'metrodark',
              width: '20%',
              height: wgheigth2,
              // sortable: true,
              // columnsresize: true,

              selectionmode: 'multiplecellsextended',




              columns: [

              { text: 'คิวที่รอ',datafield: 'c_orderlastitec',align: 'center',cellsalign: 'center', editable: false },

              ]
            });
            window.setTimeout( refreshGrid, 15000);


            function refreshGrid()
            {
              $("#qwait").jqxGrid("updatebounddata");

              window.setTimeout(refreshGrid, 15000);

            }

            $("#btex_group").on("click",function(){
              var conf=confirm('คุณต้องการลบข้อมูลทั้งหมดใช่หรือไม่');
              if(conf==true){
               var url='<?php echo $this->createUrl("/queue/truncate"); ?>';
               window.location.href=url;
             }
           });
            $("#gen").on("click",function(){

             var url='<?php echo $this->createUrl("/queue/gen"); ?>';
             window.location.href=url;

           });
          });
        </script>

        <div class="row">

          <div class="panel panel-primary" id="last">

            <div class="panel-heading"><h4 align="center"><b>คิวล่าสุด</b></h4></div>

            <div class="input-group input-group-lg">
              <span class="input-group-addon" id="sizing-addon1">คิวที่</span>

              <input type="text" class="form-control" align="center" id="last1" placeholder="" aria-describedby="sizing-addon1" disabled> 

            </div>

          </div>

          <div class="col-md-12">
           <div class="col-md-6 ">



            <div id="qwait"></div>
            <button type="button" onclick="location.href='<?php echo $this->createUrl("/queue/View"); ?>';" class="btn btn-success ">ออกบิล itec แล้ว</button>
            <button type="button" onclick="location.href='<?php echo $this->createUrl("/queue/search"); ?>';" class="btn btn-success ">ดูคิวที่ยิงไปแล้ว</button>

          </div>


        </div>
        <div class="col-md-12">
          <div class="col-md-6 ">
            <div id="jqxgrid"></div>
          </div>   
          <div class="col-md-6 ">
            <div id="jqxgrid2"></div>
          </div>
        </div>

        <div align="right"> <!-- <button type="button" class="btn btn-danger" id="gen">ลบข้อมูลตารางทั้งหมด</button> -->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

        <div class="col-md-12">

          <div class="col-md-4">
            <div id="error">
              <div class="alert alert-danger"><h1 align="center"><img src="http://172.18.0.30/commartv02/images/error.png" alt="" height="125" width="125"><br>ไม่พบเลขคิว</h1></div>
            </div>
            <div  id="sus">
              <div class="alert alert-success"><h1 align="center">
                <img src="http://172.18.0.30/commartv02/images/Safe.png" alt="" height="125" width="125"><br>เลือกช่องเทสเครื่อง</h1></div>
              </div>
            </div>


            <div class="col-md-4">
              <div class="panel panel-primary" id="test1">
                <div class="panel-heading"><h3 align="center"><b>ตัดคิวลูกค้า</b></h3></div>
                <div class="panel-body">
                  <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="sizing-addon1">No.</span>
                    <input type="text" class="form-control" id="queue" placeholder="หมายเลขคิว" aria-describedby="sizing-addon1" align="center">
                    <input type="text" class="form-control" id="service" placeholder="ช่องเทสเครื่อง"  aria-describedby="sizing-addon1"  align="center">
                    <input type="hidden" class="form-control" id="date" placeholder="date" value="<?php echo date("Y-m-d");?>" aria-describedby="sizing-addon1">
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-4">


              <div  id="sus1">
                <div class="alert alert-success"><h1 align="center">
                  <img src="http://172.18.0.30/commartv02/images/com.png" alt="" height="125" width="125"><br>บันทึกสำเร็จ</h1></div>
                </div>
              </div>
            </div>
          </div>


          <style type="text/css" media="screen">
          body {
            min-height: 500px;
          }
        </style>
