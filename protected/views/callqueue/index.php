<script type="text/javascript">
	$(document).ready(function () {






	});





    function load_print(id){


        window.open("http://172.18.0.30/commartv02/index.php/regis/Searchprint?id="+id,"_blank","toolbar,scrollbars,resizable,top=0,left=0,width=226.771px,height=642.51px");
        location.reload();
    }
</script>
<?php 
$content = file_get_contents("http://172.18.0.135:8505/getque");

$result  = json_decode($content, true);
// $time = $result["data"][0]["timeupd"];
// $payq = $result["data"][0]["payq"];
        // if ($result["data"][0]["timeupd"]="") {
        //      $time = 0;
        // }else{
        //     $time = $result["data"][0]["timeupd"];
        // }
if ($result["data"]!=null) {
 
   $payq = $result["data"][0]["payq"];
      $time = "เวลา ".date ('H:i',strtotime( $result["data"][0]["timeupd"]));
}else{
      $payq ='' ;
   $time = '';
}
?>

<div class="col-md-12">
    <div class="panel panel-success">
    	<div class="panel-heading"><h1 align="center"><b>กดบัตรคิว</b></h1></div>
    	<div class="panel-body">

            <br>
            <div class="col-md-4">
                <P align=center><a href="#" onClick="javascript:load_print(1);"><img src="/commartv02/images/money.png" onmouseover= "src='/commartv02/images/money2.png'" onmouseout="src='/commartv02/images/money.png'" alt="คิวเงินสด" style="width: 100%;"></a></P>
            </div>

            <div class="col-md-4">
               <div class="panel panel-danger">
                   <div class="panel-heading"><h2 align="center"><b>คิวล่าสุด</b></h2></div>
                   <div class="panel-body">
                    <h2 style="font-size:5vw;" align="center"><b><?php echo $payq; ?></b></h2>
                    <hr>
                    <h4 align="center"><?php echo $time;  ?> </h4>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <P align=center><a href="#" onClick="javascript:load_print(2);"><img src="/commartv02/images/cradit.png" onmouseover= "src='/commartv02/images/cradit2.png'" onmouseout="src='/commartv02/images/cradit.png'" alt="คิวสินเชื่อ" style="width: 100%;"></a></P>
        </div>
    </div>
</div>
</div>

<style type="text/css" media="screen">
body {
	min-height:350px;
}
</style>