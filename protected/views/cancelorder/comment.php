<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  </head>
 <link href="<?php echo $baseUrl;?>/css/style.css" rel="stylesheet">
<link href="<?php echo $baseUrl;?>/bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="<?php echo $baseUrl;?>/js/jquery-1.10.2.min.js"></script>
<script language="JavaScript">
 $(document).ready(function () {

 $("#save").click(function(){


    var rowed ={};
    rowed['orderid'] = '<?php echo $id; ?>'; 
  
    rowed['detail'] = $('#detail').val();
   
    // alert($.param(rowed));
     var apiurls = "http://172.18.0.135:8505/get/registercanceled/"+ rowed['orderid']+"/"+rowed['detail'];
    // var apiurls2 = "http://172.18.0.135:8510/update/stockremain/"+ rowed['productid'];
    var settings = {
      async: true,
      crossDomain: true,
      url: apiurls,
      method: "GET",
     
    }

    $.ajax(settings).done(function (response) {
  alert('Complete');
 
    });

   

  });
 $("#up").click(function(){


    var rowed ={};
    rowed['productid'] = '<?php echo $productid; ?>'; 
  
   
     // alert(rowed['productid']);

     var apiurls2 = "http://172.18.0.135:8510/update/stockremain/"+ rowed['productid'];
    var settings = {
      async: true,
      crossDomain: true,
      url: apiurls2,
      method: "GET",
     
    }

    $.ajax(settings).done(function (response) {
  alert('คืนสต็อกสำเร็จ');
  window.close();
 
    });

   

  });
 $("#uppre").click(function(){


    var rowed ={};
    rowed['productid'] = '<?php echo $productid; ?>'; 
  
   
     // alert(rowed['productid']);

     var apiurls3 = "http://172.18.0.135:8510/update/stockpreorder/"+ rowed['productid'];
    var settings = {
      async: true,
      crossDomain: true,
      url: apiurls3,
      method: "GET",
     
    }

    $.ajax(settings).done(function (response) {
  alert('คืนสต็อกสำเร็จ');
  window.close();
 
    });

   

  });

 
   });
</script>

<div align="center"><textarea name="detail" id="detail" cols="60" rows="10" placeholder="กรุณาใส่เหตุลผลที่ยกเลิกใบจอง"></textarea> 
	<button type="button" id="save" class="btn btn-info"><i class="fa fa-fw fa-save"></i> SAVE</button>
  <button type="button" id="up" class="btn btn-info"><i class="fa fa-fw fa-save"></i> คืนสต๊อก</button>
  <button type="button" id="uppre" class="btn btn-info"><i class="fa fa-fw fa-save"></i> คืนสต๊อกPreorder</button>
</div>
