<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> -->
<script type="text/javascript">
//   $(function(){
//     $("#pro").val("line 1\r\nline 2");
// });
	$(document).ready(function () {

		if (screen.height == 1080) {
			var  wgheigth = 300;
		} else if (screen.height == 768) {
			var   wgheigth = 275;
		} else if (screen.height == 900) {
			var   wgheigth = 300;
		}else if (screen.height == 1050) {
			var   wgheigth = 300;
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
		$('#brand').select2();
		$('#product').select2();


		$("#brand").change(function(event) {
			$("#promo").val($("#brand").val());

		});


		var getAdapter=function(){
			var source =
			{
				datatype: "json",
				datafields: [
				{ name: 'productid',type: 'string' },
				{ name: 'productname',type: 'string' },
        { name: 'brand',type: 'string' },
        { name: 'pmdetail',type: 'string' },
        { name: 'price',type: 'string' },



        ],

        url: '<?php echo $this->createUrl("/promotion/Show");?>',
        cache: false,
        updaterow: function (rowid, rowdata, commit) {



         var apiurls = "http://172.18.0.135:8505/upbyproduct";
         var inputValue= rowdata.productid;
         var inputValue1= rowdata.pmdetail;
         var inputValue2= rowdata.price;

         var conf=confirm('คุณต้องการเพิ่มโปรโมชั่นนี้ใช่หรือไม่');
         if(conf==true){
          $.ajax({
           url: apiurls,
           type: 'PUT',
           contentType: 'application/x-www-form-urlencoded',
        //dataType: 'json',
        data: {productid: inputValue,pmdetail:inputValue1,price:inputValue2},
        // success: handleData,
        error: function () {
        	alert("Error please try again");
        }

      });
        }
        setTimeout(function () {
          $("#jqxgrid").jqxGrid("updatebounddata");
        }, 1000);
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

              { text: 'PRODUCT ID',datafield: 'productid',cellsalign: 'center',align: 'center',editable: true ,width: '18%'},
              { text: 'PRODUCTNAME',datafield: 'productname',align: 'center',cellsalign: 'center',  editable: true,width: '25%'},
              { text: 'BRAND',align: 'center',datafield: 'brand',cellsalign: 'center',filterable: false,editable: false,width: '10%'},
              { text: 'PROMOTION',datafield: 'pmdetail',align: 'center',cellsalign: 'center',filterable: false,editable: true},
              { text: 'PRICE',align: 'center',datafield: 'price',cellsalign: 'center',filterable: false,editable: true,width: '10%'},

              ]
            });


            $("#btSave").click(function(event) {

            	$("#jqxgrid").jqxGrid({source: getAdapter()});
            });


            $("#btSave1").on("click",function(){
              var conf=confirm('คุณต้องการเพิ่มโปรโมชั่นใช่หรือไม่');
              if(conf==true){

                
               var brand =$('#brand').val();
                var pro=$('#pro').val();

               $.post('<?php echo $this->createUrl("promotion/addpro") ?>', {brand: brand,pro: pro}, function (data) {
               location.reload();
              
             });
              }
            });
           


            var getAdapter2=function(){
             var source =
             {
              datatype: "json",
              datafields: [
              { name: 'brand',type: 'string' },
              { name: 'detail',type: 'string' },
				// { name: 'pmdetail',type: 'string' },



				],

				url: '<?php echo $this->createUrl("/promotion/Showpro");?>',
				cache: false,
				updaterow: function (rowid, rowdata, commit) {
          var rows={};
          rows['brand']=rowdata.brand;
          rows['detail']=rowdata.detail;
         


          $.post('<?php echo $this->createUrl("/promotion/addpro"); ?>', $.param(rows), function(data, textStatus, xhr) {
            commit(true);
            $("#jqxgrid2").jqxGrid({source: getAdapter2()});

          });

        }

			};

			var dataAdapter = new $.jqx.dataAdapter(source,{
				formatData: function (data) {
					// data.brand = $("#brand").val();
     //        data.detail = $("#detail").val();
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
            	height: wgheigth2,
            	filterable: true,
            	showfilterrow: true,
            	editable:true,
              // sortable: true,
              // columnsresize: true,

              selectionmode: 'multiplerowsextended',




              columns: [

              { text: 'BrandName',datafield: 'brand',cellsalign: 'center',align: 'center',editable: false ,width: '25%'},
              { text: 'รายละเอียดโปรโมชั่น',datafield: 'detail',align: 'center',cellsalign: 'center',  editable: true},
              

              ]
            });


            // $("#btSave").click(function(event) {

            // 	$("#jqxgrid").jqxGrid({source: getAdapter()});
            // });


            $("#brand").change(function(event) {

              //$("#pro").val($("#brand").val());
              var brand = $("#brand").val();
              $.post('<?php echo $this->createUrl("promotion/showbrand") ?>', {brand: brand}, function (data) {
               //alert(data);
               $("#pro").val(data);
             });

            });






          });

        </script>
        <?php      
        $str="SELECT * FROM pm_brand ";
        $result=Yii::app()->db->createCommand($str)->queryAll();
        ?>


        <?php      
        $str1="SELECT a.category,a.categoryname FROM stock AS a GROUP BY category ";
        $result1=Yii::app()->db->createCommand($str1)->queryAll();

        ?>


        <div class="col-md-12">
          <div class="panel panel-primary">
           <div class="panel-heading"><h3 align="center"><b>SET PROMOTION !!!</b></h3></div>
         </div>
       

       


            <div class="col-md-12">
              <br>
              <div class="panel panel-success">
                <div class="panel-heading"><h4 align="center"><b>PROMOTION</b></h4></div>
                <div id="jqxgrid2"></div></div>

                <div class="panel panel-danger">
                  <div class="panel-heading"><h4 align="center"><b>PROMOTION  PRODUCT </b></h4></div>
                  <div id="jqxgrid"></div></div>
                </div>






                <style type="text/css" media="screen">
                body {
                 min-height: 1000px;
               }
             </style>
