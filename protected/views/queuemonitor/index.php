<script>
	var socket = io.connect('http://172.18.0.135:8506');


	socket.on('requestQuery1', function (data) {
		$.each(data.datacount,function(index,recordset){

			if (recordset.length == 1) {
				var q1=recordset[0].payq;
				var ch1=recordset[0].no;
				var q2='-';
				var ch2='-';
				var q3='-';
				var ch3='-';
				var q4='-';
				var ch4='-';
				var q5='-';
				var ch5='-';
			}else if (recordset.length == 2){
				var q1=recordset[0].payq;
				var ch1=recordset[0].no;
				var q2=recordset[1].payq;
				var ch2=recordset[1].no
				var q3='-';
				var ch3='-';
				var q4='-';
				var ch4='-';
				var q5='-';
				var ch5='-';
			}else if (recordset.length == 3){
				var q1=recordset[0].payq;
				var ch1=recordset[0].no;
				var q2=recordset[1].payq;
				var ch2=recordset[1].no
				var q3=recordset[2].payq;
				var ch3=recordset[2].no;
				var q4='-';
				var ch4='-';
				var q5='-';
				var ch5='-';
			}else if (recordset.length == 4){
				var q1=recordset[0].payq;
				var ch1=recordset[0].no;
				var q2=recordset[1].payq;
				var ch2=recordset[1].no
				var q3=recordset[2].payq;
				var ch3=recordset[2].no;
				var q4=recordset[3].payq;
				var ch4=recordset[3].no;
				var q5='-';
				var ch5='-';
			}else if (recordset.length == 5){
				var q1=recordset[0].payq;
				var ch1=recordset[0].no;
				var q2=recordset[1].payq;
				var ch2=recordset[1].no
				var q3=recordset[2].payq;
				var ch3=recordset[2].no;
				var q4=recordset[3].payq;
				var ch4=recordset[3].no;
				var q5=recordset[4].payq;
				var ch5=recordset[4].no;
			}else{
				var q1='-';
				var q2='-';
				var q3='-';
				var q4='-';
				var q5='-';
				var ch1='-';
				var ch2='-';
				var ch3='-';
				var ch4='-';
				var ch5='-';
			}






			$("#q1").html(q1);
			$("#q2").html(q2);
			$("#q3").html(q3);
			$("#q4").html(q4);
			$("#q5").html(q5);
			$("#ch1").html(ch1);
			$("#ch2").html(ch2);
			$("#ch3").html(ch3);
			$("#ch4").html(ch4);
			$("#ch5").html(ch5);
		});

	});


</script>


<div class="row" align="right">
	<div class="col-md-12" style ="color: white"><P style="font-size:6vw;height: 105px;margin-right: 600px;"><k class="fontmitr" id="ch1"></k></P></div>
</div>
<div class="row" align="center">
	<div class="col-md-12" style ="color: black"><P style="font-size:15vw;height: 380px;;"><k class="fontmitr" id="q1">-</k></div>
	</div>

	<div class="row" align="center">
		<div class="col-md-12" style ="color: white">
			<div class="col-md-3" style="font-size:2vw;"></div>
			<div class="col-md-3" style="font-size:2vw;"></div>
			<div class="col-md-3" style="font-size:2vw;"></div>
			<div class="col-md-3" style="font-size:2vw;"></div>
		</div>
	</div>

	<div class="row" align="right">
		<div class="col-md-12" style ="color: white;height: 180px;">
			<div class="col-md-3" style="font-size:8vw;"><k class="fontmitr" id="ch2" style="margin-right: 50px;"></k></div>
			<div class="col-md-3" style="font-size:8vw;"><k class="fontmitr" id="ch3"style="margin-right: 50px;"></k></div>
			<div class="col-md-3" style="font-size:8vw; color: black;"><k class="fontmitr" id="ch4"style="margin-right: 50px;"></k></div>
			<div class="col-md-3" style="font-size:8vw;"><k class="fontmitr" id="ch5"style="margin-right: 50px;"></k></div>
		</div>
	</div>

	<div class="row" align="center">
		<div class="col-md-12" style ="color: black">
			<div class="col-md-3" style="font-size:13vw;" ><k class="fontmitr" id="q2"></k></div>
			<div class="col-md-3" style="font-size:13vw;" ><k class="fontmitr" id="q3"></k></div>
			<div class="col-md-3" style="font-size:13vw;" ><k class="fontmitr" id="q4"></k></div>
			<div class="col-md-3" style="font-size:13vw;" ><k class="fontmitr" id="q5"></k></div>
		</div>
	</div>


	<style type="text/css" media="screen">
	body {
		margin-right: 15px;
	}

	.k {
		font-size: 100px;
		border-style:
	}

	.fontmitr{
		font-family: 'Concert One', cursive;
}
</style>