<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<head>
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=windows-874" /> -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Commart</title>
	
	<style type="text/css">
		/* * {
			margin:5;
			padding:0;
			font-family:Arial, "times New Roman", tahoma;
			font-size:12px;
		} */
		html {
			font-family:Arial, "times New Roman", tahoma;
			font-size:12px;
			color:#000000;
		}
		body {
			font-family:Arial, "times New Roman", tahoma;
			font-size:12px;
			padding:0;
			margin:0;
			color:#000000;
		}label{
			font-family:Arial, "times New Roman", tahoma;
			font-size:12px;
			margin:5;
			padding:0;
		}input{
			font-family:Arial, "times New Roman", tahoma;
			font-size:12px;
			margin:5;
			padding:0;
		}
		.button {
			background-color: #4CAF50; /* Green */
		    border: none;
		    color: white;
		    padding: 2px 20px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 12px;
		    border-radius: 4px;
		    margin: 4px 2px;
		    -webkit-transition-duration: 0.4s; /* Safari */
		    transition-duration: 0.4s;
		    cursor: pointer;
		}.button1 {
		    background-color: white; 
		    color: black; 
		    border: 2px solid #4CAF50;
		}

		.button1:hover {
		    background-color: #4CAF50;
		    color: white;
		}.button2 {
    background-color: white; 
    color: black; 
    border: 2px solid #008CBA;
}

.button2:hover {
    background-color: #008CBA;
    color: white;
}

.button3 {
    background-color: white; 
    color: black; 
    border: 2px solid #f44336;
}

.button3:hover {
    background-color: #f44336;
    color: white;
}
		.text_bg_black{
			font-size:12px;
			font-family:Arial, "times New Roman", tahoma;
			padding:0;
		}
		.text_whie_left2{
			font-size:12px;
			font-family:Arial, "times New Roman", tahoma;
			padding:0;
		}
		.box_comment{
			font-size:12px;
			font-family:Arial, "times New Roman", tahoma;
			font-weight:bold;
		    padding-left: 5px;
		    padding-top: 5px;
		    padding-bottom: 5px;
		    padding-right: 5px;

		}
		.headTitle {
			font-size:12px;
			font-weight:bold;
			text-transform:uppercase;
		}
		.headerTitle01 {
			border:1px solid #333333;
			border-left:2px solid #000;
			border-bottom-width:2px;
			border-top-width:2px;
			font-size:11px;
		}
		.headerTitle01_r {
			border:1px solid #333333;
			border-left:2px solid #000;
			border-right:2px solid #000;
			border-bottom-width:2px;
			border-top-width:2px;
			font-size:11px;
		}
		/* สำหรับช่องกรอกข้อมูล  */
		.box_data1 {
			font-size:12px;
			font-family:Arial, "times New Roman", tahoma;
			height:18px;
			border:0px solid #333333;
			font-weight:bold;
			border-bottom-width:1px;
		}
		/* กำหนดเส้นบรรทัดซ้าย  และด้านล่าง */
		.left_bottom {
			border-left:2px solid #000;
			border-bottom:1px solid #000;
			font-weight:bold;
		}
		/* กำหนดเส้นบรรทัดซ้าย ขวา และด้านล่าง */
		.left_right_bottom {
			border-left:2px solid #000;
			border-bottom:1px solid #000;
			border-right:2px solid #000;
			font-weight:bold;
		}
		/* สร้างช่องสี่เหลี่ยมสำหรับเช็คเลือก */
		.chk_box {
			display:block;
			width:10px;
			height:10px;
			overflow:hidden;
			border:1px solid #000;
		}
		.text_b_left {	font-family: tahoma, arial, verdana;
			font-size: 13px;
			color: #838383;
			text-align:left;
		}
		.text_b_left {	font-family: tahoma, arial, verdana;
			font-size: 13px;
			color: #000000;
			text-align: left;
		}red {
    text-align: center;
    color: red;
    font-weight:bold;
}
		@media print
		{
			.noprint {visibility:hidden;}
		}

	</style>

</head>

<body class="container">
	<div>
		<fieldset style="width:800px; border:1px #999999 solid;">
			<b><legend>ออเดอร์&nbsp;JIB<?php echo $id; ?></legend></b>
			<div class="table-responsive">
			<?php 

 $id=$_GET['id'];
    $content =     file_get_contents("http://172.18.0.135:8505/get/registeralldate/byorder/".$id);

    $result  = json_decode($content, true);
 foreach ($result["data"] as $r ) {

 }

 ?>
				<table width="1024" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="2">
							<table width="900" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="25" colspan="2" bgcolor="#FFCC66" class="headTitle">ข้อมูลลูกค้า</td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- ชื่อ สกุล</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["customer"]; ?></td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- เบอร์โทร</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["tel"]; ?></td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- ที่อยู่</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["addr1"]; ?> <?php echo $r["addr2"]; ?> <?php echo $r["city"]; ?> <?php echo $r["zipid"]; ?></td>
								</tr>
								
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- รหัสสินค้า</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["productid"]; ?></td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- รหัสรุ่น</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["modelid"]; ?></td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- สินค้า</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["productname"]; ?></td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- จำนวน</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["qty"]; ?></td>
								</tr>
									<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- ราคา</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["price"]; ?></td>
								</tr>
								<tr>
									<td height="25" colspan="2" bgcolor="#FFCC66" class="headTitle">สถานะ</td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- บิลitec</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["itecbill"]; ?></td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- สถานะJOB</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["sucess"]; ?></td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- สถานะ</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["status"]; ?></td>
								</tr>
								<tr>
									<td width="204" bgcolor="#FFFFFF" class="text_bg_black">- สถานะการเงิน</td>
									<td width="1500" bgcolor="#FFFFFF" class="box_data1"><?php echo $r["pay"]; ?></td>
								</tr>
								
																				</table>

																			
																				</td>
																				<td valign="top">
																					
																				</td>
																			</tr>
																			<tr>
																				<td width="379">&nbsp;</td>
																				<td width="645">
																					
																				</td>
																			</tr>
																		</table>
																	 
																</div>
															</fieldset>
														</div>
													</body>
													