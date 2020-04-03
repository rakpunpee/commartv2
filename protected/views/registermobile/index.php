
<script>
	$(document).ready(function() {
		
    $("#success") .click(function() { //popup เปุ่ม โอเค

        var reply={};
        reply['orderCode']='JIB07123456';
        reply['productCode']='0432049030';
       	reply['productStatus']='2';

        $.post('<?php echo $this->createUrl("/registermobile/Updatestatus") ?>', $.param(reply), function(data, textStatus, xhr) {
                       


        });



   }); 






	});



</script>


<br><br><br><br>
<div id="status"></div><br><br>
<input class="btn btn-success" type="button" id="success" value="ส่งข้อมูล">