
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

      url: '<?php echo $this->createUrl("/billitec/Show");?>',
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
            	// filterable: true,
            	// showfilterrow: true,
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

            $("#order").change(function(){


              var orderid =$('#order').val();

    // alert($.param(rowed));
    var apiurls = "http://172.18.0.135:8505/upd/itecbill/"+orderid.substring(3);

    var settings = {
      async: true,
      crossDomain: true,
      url: apiurls,
      method: "GET",
     
    }

    $.ajax(settings).done(function (response) {
      alert('Complete');
      $('#order').val(null);
      $("#jqxgrid").jqxGrid({source: getAdapter()});
    });

  }); 

          });

        </script>


         <div class="col-md-12">

       
          <div class="panel panel-primary">
           <div class="panel-heading"><h3 align="center"><b>Bill_itec</b></h3></div>
         </div>


          <div class="col-md-4">
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="sizing-addon1">No.</span>

            <input type="text" class="form-control" align="center" id="order" placeholder="เลขใบออเดอร์" aria-describedby="sizing-addon1"> 

          </div>
 </div> </div>
   <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading"><h4 align="center"><b>รายการ </b></h4></div>
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
