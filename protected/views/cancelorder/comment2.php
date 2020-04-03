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
    rowed['orderid'] = <?php echo $id ?>;
    rowed['detail'] = $('#detail').val();
   
    // alert($.param(rowed));
    var apiurls = "http://172.18.0.135:8505/get/registererror/"+ rowed['orderid']+"/"+rowed['detail'];

    var settings = {
      async: true,
      crossDomain: true,
      url: apiurls,
      method: "GET",
      // headers: {
      //   "content-type": "application/x-www-form-urlencoded",
      // },
      // data:$.param(rowed)
    }

    $.ajax(settings).done(function (response) {
  alert('Complete');
  window.close();
    });

  });

 
   });
</script>
<div align="center"><textarea name="detail" id="detail" cols="60" rows="10" placeholder="กรุณาใส่รายละเอียด"></textarea> 
	<button type="button" id="save" class="btn btn-info"><i class="fa fa-fw fa-save"></i> SAVE</button>
</div>
