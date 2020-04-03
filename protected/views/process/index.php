<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<?php
$qr= "SELECT 
TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(O.registertopay))),'%i')as regis_pay,
TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(O.paytostock))),'%i')as paytostock,
TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(O.stoctoitec))),'%i')as stoctoitec,
TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(O.itectosucc))),'%i')as itectosucc,
TIME_FORMAT(SEC_TO_TIME(AVG(TIME_TO_SEC(O.registosucc))),'%i')as registosucc
FROM(SELECT
TIMEDIFF(TIME(a.orderdate),TIME(a.paydate))as registertopay,
TIMEDIFF(TIME(a.paydate),TIME(a.stockdate))as paytostock,
TIMEDIFF(TIME(a.stockdate),TIME(a.itecbilldate))as stoctoitec,
TIMEDIFF(TIME(a.itecbilldate),TIME(a.sucessdate))as itectosucc,
TIMEDIFF(TIME(a.orderdate),TIME(a.sucessdate))as registosucc
FROM orderdoc AS a WHERE
DATE(a.orderdate) = curdate() AND a.status=0 and a.sucess=1 AND a.paydate !='' AND a.stockdate !='' 
AND a.itecbilldate !=''AND a.sucessdate !='' AND a.paytype in('เงินสด','บัตรเครดิต') ORDER BY a.orderid DESC )AS O";
$qry=Yii::app()->db->createCommand($qr)->queryRow();
?>
<body>
	<div class="col-md-12">
		<div class="col-md-3">

			<div class="panel panel-primary">
				<div class="panel-heading"><h1 align="center"><b>PROCESS [ 24 / 06 / 2561 ]</b></h1></div>
				<div class="panel-body">
					<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
						<div class="col-md-6">
							<h2></span></h2>
						</div>


						<div class="col-md-6" align="right">
							<h2><i>Oreder</i></h2>
						</div>
					</div>
					<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
						<div class="col-md-6">
							<h2><span class="glyphicon glyphicon-pencil"> Register</span></h2>
						</div>

						<?php
						$sd1= "SELECT COUNT(a.orderid)as REGISTER FROM orderdoc as a WHERE DATE(a.orderdate) = '20180624' AND a.status = 0 AND a.alocateid = 'JIB'";
						$str1=Yii::app()->db->createCommand($sd1)->queryRow();
						?>
						<div class="col-md-6" align="right">
							<h2><i><?php echo $str1['REGISTER']; ?></h2>
							</div>
						</div>


						<div class="col-md-12 bg-success" style="margin-bottom: 15px;">
							<div class="col-md-6">
								<h2><span class="glyphicon glyphicon-list-alt"> กดบัตรคิว</span></h2>
							</div>
							<?php
							$sd2= "SELECT COUNT(a.orderid)as QUE FROM orderdoc as a WHERE DATE(a.orderdate) = '20180624' AND a.status = 0 AND a.payq != '' AND a.alocateid = 'JIB'";
							$str2=Yii::app()->db->createCommand($sd2)->queryRow();
							?>
							<div class="col-md-6" align="right">
								<h2><?php echo $str2['QUE']; ?></h2>
							</div>
						</div>


						<div class="col-md-12 bg-info" style="margin-bottom: 15px;">
							<div class="col-md-6">
								<h2><span class="glyphicon glyphicon-usd"> Payment</span></h2>
							</div>
							<?php
							$sd3= "SELECT COUNT(a.orderid)as PAYMENT FROM orderdoc as a WHERE DATE(a.orderdate) = '20180624' AND a.status = 0 AND a.pay = 1 AND a.alocateid = 'JIB'";
							$str3=Yii::app()->db->createCommand($sd3)->queryRow();
							?>
							<div class="col-md-6" align="right">
								<h2><?php echo $str3['PAYMENT']; ?></h2>
							</div>
						</div>


						<div class="col-md-12 bg-warning" style="margin-bottom: 15px;">
							<div class="col-md-6">
								<h2><span class="glyphicon glyphicon-inbox"> จัดของ</span></h2>
							</div>
							<?php
							$sd4= "SELECT COUNT(a.orderid)as STOCK FROM orderdoc as a WHERE DATE(a.orderdate) = '20180624' AND a.status = 0 AND a.stock = 1 AND a.alocateid = 'JIB'";
							$str4=Yii::app()->db->createCommand($sd4)->queryRow();
							?>
							<div class="col-md-6" align="right">
								<h2><?php echo $str4['STOCK']; ?></h2>
							</div>
						</div>


						<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
							<div class="col-md-6">
								<h2><span class="glyphicon glyphicon-sound-6-1"> ยิงบิล itec</span></h2>
							</div>
							<?php
							$sd5= "SELECT COUNT(a.orderid)as ITECBILL FROM orderdoc as a WHERE DATE(a.orderdate) = '20180624' AND a.status = 0 AND a.itecbill = 1 AND a.alocateid = 'JIB'";
							$str5=Yii::app()->db->createCommand($sd5)->queryRow();
							?>
							<div class="col-md-6" align="right">
								<h2><?php echo $str5['ITECBILL']; ?></h2>
							</div>
						</div>


						<div class="col-md-12 bg-success" style="margin-bottom: 15px;">
							<div class="col-md-6">
								<h2><span class="glyphicon glyphicon-shopping-cart"> จ่ายสินค้า</span></h2>
							</div>
							<?php
							$sd6= "SELECT COUNT(a.orderid)as SUCCESS FROM orderdoc as a WHERE DATE(a.orderdate) = '20180624' AND a.status = 0 AND a.sucess = 1 AND a.alocateid = 'JIB'";
							$str6=Yii::app()->db->createCommand($sd6)->queryRow();
							?>
							<div class="col-md-6" align="right">
								<h2><?php echo $str6['SUCCESS']; ?></h2>
							</div>
						</div>

						<div class="col-md-12 bg-info" style="margin-bottom: 15px;">
							<div class="col-md-6">
								<h2><span class="glyphicon glyphicon-remove"> ยกเลิก</span></h2>
							</div>
							<?php
							$sd7= "SELECT COUNT(a.orderid)as CANCEL FROM orderdoc as a WHERE DATE(a.orderdate) = '20180624' AND a.status = 1 AND a.alocateid = 'JIB'";
							$str7=Yii::app()->db->createCommand($sd7)->queryRow();
							?>
							<div class="col-md-6" align="right">
								<h2><?php echo $str7['CANCEL']; ?></h2>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading"><h1 align="center"><b>PROCESS [ 23 / 06 / 2561 ]</b></h1></div>
					<div class="panel-body">
						<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
							<div class="col-md-6">
								<h2></span></h2>
							</div>

							
							<div class="col-md-6" align="right">
								<h2><i>Oreder</i></h2>
							</div>
						</div>
						<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
							<div class="col-md-6">
								<h2><span class="glyphicon glyphicon-pencil"> Register</span></h2>
							</div>

							<?php
							$sd1= "SELECT COUNT(a.orderid)as REGISTER FROM orderdoc as a WHERE DATE(a.orderdate) = '20180623' AND a.status = 0 AND a.alocateid = 'JIB'";
							$str1=Yii::app()->db->createCommand($sd1)->queryRow();
							?>
							<div class="col-md-6" align="right">
								<h2><i><?php echo $str1['REGISTER']; ?></h2>
								</div>
							</div>


							<div class="col-md-12 bg-success" style="margin-bottom: 15px;">
								<div class="col-md-6">
									<h2><span class="glyphicon glyphicon-list-alt"> กดบัตรคิว</span></h2>
								</div>
								<?php
								$sd2= "SELECT COUNT(a.orderid)as QUE FROM orderdoc as a WHERE DATE(a.orderdate) = '20180623' AND a.status = 0 AND a.payq != '' AND a.alocateid = 'JIB'";
								$str2=Yii::app()->db->createCommand($sd2)->queryRow();
								?>
								<div class="col-md-6" align="right">
									<h2><?php echo $str2['QUE']; ?></h2>
								</div>
							</div>


							<div class="col-md-12 bg-info" style="margin-bottom: 15px;">
								<div class="col-md-6">
									<h2><span class="glyphicon glyphicon-usd"> Payment</span></h2>
								</div>
								<?php
								$sd3= "SELECT COUNT(a.orderid)as PAYMENT FROM orderdoc as a WHERE DATE(a.orderdate) = '20180623' AND a.status = 0 AND a.pay = 1 AND a.alocateid = 'JIB'";
								$str3=Yii::app()->db->createCommand($sd3)->queryRow();
								?>
								<div class="col-md-6" align="right">
									<h2><?php echo $str3['PAYMENT']; ?></h2>
								</div>
							</div>


							<div class="col-md-12 bg-warning" style="margin-bottom: 15px;">
								<div class="col-md-6">
									<h2><span class="glyphicon glyphicon-inbox"> จัดของ</span></h2>
								</div>
								<?php
								$sd4= "SELECT COUNT(a.orderid)as STOCK FROM orderdoc as a WHERE DATE(a.orderdate) = '20180623' AND a.status = 0 AND a.stock = 1 AND a.alocateid = 'JIB'";
								$str4=Yii::app()->db->createCommand($sd4)->queryRow();
								?>
								<div class="col-md-6" align="right">
									<h2><?php echo $str4['STOCK']; ?></h2>
								</div>
							</div>


							<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
								<div class="col-md-6">
									<h2><span class="glyphicon glyphicon-sound-6-1"> ยิงบิล itec</span></h2>
								</div>
								<?php
								$sd5= "SELECT COUNT(a.orderid)as ITECBILL FROM orderdoc as a WHERE DATE(a.orderdate) = '20180623' AND a.status = 0 AND a.itecbill = 1 AND a.alocateid = 'JIB'";
								$str5=Yii::app()->db->createCommand($sd5)->queryRow();
								?>
								<div class="col-md-6" align="right">
									<h2><?php echo $str5['ITECBILL']; ?></h2>
								</div>
							</div>


							<div class="col-md-12 bg-success" style="margin-bottom: 15px;">
								<div class="col-md-6">
									<h2><span class="glyphicon glyphicon-shopping-cart"> จ่ายสินค้า</span></h2>
								</div>
								<?php
								$sd6= "SELECT COUNT(a.orderid)as SUCCESS FROM orderdoc as a WHERE DATE(a.orderdate) = '20180623' AND a.status = 0 AND a.sucess = 1 AND a.alocateid = 'JIB'";
								$str6=Yii::app()->db->createCommand($sd6)->queryRow();
								?>
								<div class="col-md-6" align="right">
									<h2><?php echo $str6['SUCCESS']; ?></h2>
								</div>
							</div>

							<div class="col-md-12 bg-info" style="margin-bottom: 15px;">
								<div class="col-md-6">
									<h2><span class="glyphicon glyphicon-remove"> ยกเลิก</span></h2>
								</div>
								<?php
								$sd7= "SELECT COUNT(a.orderid)as CANCEL FROM orderdoc as a WHERE DATE(a.orderdate) = '20180623' AND a.status = 1 AND a.alocateid = 'JIB'";
								$str7=Yii::app()->db->createCommand($sd7)->queryRow();
								?>
								<div class="col-md-6" align="right">
									<h2><?php echo $str7['CANCEL']; ?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">

					<div class="panel panel-primary">
						<div class="panel-heading"><h1 align="center"><b>PROCESS [ 22 / 06 / 2561 ]</b></h1></div>
						<div class="panel-body">
							<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
								<div class="col-md-6">
									<h2></span></h2>
								</div>


								<div class="col-md-6" align="right">
									<h2><i>Oreder</i></h2>
								</div>
							</div>
							<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
								<div class="col-md-6">
									<h2><span class="glyphicon glyphicon-pencil"> Register</span></h2>
								</div>

								<?php
								$sd1= "SELECT COUNT(a.orderid)as REGISTER FROM orderdoc as a WHERE DATE(a.orderdate) = '20180622' AND a.status = 0 AND a.alocateid = 'JIB'";
								$str1=Yii::app()->db->createCommand($sd1)->queryRow();
								?>
								<div class="col-md-6" align="right">
									<h2><i><?php echo $str1['REGISTER']; ?></h2>
									</div>
								</div>


								<div class="col-md-12 bg-success" style="margin-bottom: 15px;">
									<div class="col-md-6">
										<h2><span class="glyphicon glyphicon-list-alt"> กดบัตรคิว</span></h2>
									</div>
									<?php
									$sd2= "SELECT COUNT(a.orderid)as QUE FROM orderdoc as a WHERE DATE(a.orderdate) = '20180622' AND a.status = 0 AND a.payq != '' AND a.alocateid = 'JIB'";
									$str2=Yii::app()->db->createCommand($sd2)->queryRow();
									?>
									<div class="col-md-6" align="right">
										<h2><?php echo $str2['QUE']; ?></h2>
									</div>
								</div>


								<div class="col-md-12 bg-info" style="margin-bottom: 15px;">
									<div class="col-md-6">
										<h2><span class="glyphicon glyphicon-usd"> Payment</span></h2>
									</div>
									<?php
									$sd3= "SELECT COUNT(a.orderid)as PAYMENT FROM orderdoc as a WHERE DATE(a.orderdate) = '20180622' AND a.status = 0 AND a.pay = 1 AND a.alocateid = 'JIB'";
									$str3=Yii::app()->db->createCommand($sd3)->queryRow();
									?>
									<div class="col-md-6" align="right">
										<h2><?php echo $str3['PAYMENT']; ?></h2>
									</div>
								</div>


								<div class="col-md-12 bg-warning" style="margin-bottom: 15px;">
									<div class="col-md-6">
										<h2><span class="glyphicon glyphicon-inbox"> จัดของ</span></h2>
									</div>
									<?php
									$sd4= "SELECT COUNT(a.orderid)as STOCK FROM orderdoc as a WHERE DATE(a.orderdate) = '20180622' AND a.status = 0 AND a.stock = 1 AND a.alocateid = 'JIB'";
									$str4=Yii::app()->db->createCommand($sd4)->queryRow();
									?>
									<div class="col-md-6" align="right">
										<h2><?php echo $str4['STOCK']; ?></h2>
									</div>
								</div>


								<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
									<div class="col-md-6">
										<h2><span class="glyphicon glyphicon-sound-6-1"> ยิงบิล itec</span></h2>
									</div>
									<?php
									$sd5= "SELECT COUNT(a.orderid)as ITECBILL FROM orderdoc as a WHERE DATE(a.orderdate) = '20180622' AND a.status = 0 AND a.itecbill = 1 AND a.alocateid = 'JIB'";
									$str5=Yii::app()->db->createCommand($sd5)->queryRow();
									?>
									<div class="col-md-6" align="right">
										<h2><?php echo $str5['ITECBILL']; ?></h2>
									</div>
								</div>


								<div class="col-md-12 bg-success" style="margin-bottom: 15px;">
									<div class="col-md-6">
										<h2><span class="glyphicon glyphicon-shopping-cart"> จ่ายสินค้า</span></h2>
									</div>
									<?php
									$sd6= "SELECT COUNT(a.orderid)as SUCCESS FROM orderdoc as a WHERE DATE(a.orderdate) = '20180622' AND a.status = 0 AND a.sucess = 1 AND a.alocateid = 'JIB'";
									$str6=Yii::app()->db->createCommand($sd6)->queryRow();
									?>
									<div class="col-md-6" align="right">
										<h2><?php echo $str6['SUCCESS']; ?></h2>
									</div>
								</div>

								<div class="col-md-12 bg-info" style="margin-bottom: 15px;">
									<div class="col-md-6">
										<h2><span class="glyphicon glyphicon-remove"> ยกเลิก</span></h2>
									</div>
									<?php
									$sd7= "SELECT COUNT(a.orderid)as CANCEL FROM orderdoc as a WHERE DATE(a.orderdate) = '20180622' AND a.status = 1 AND a.alocateid = 'JIB'";
									$str7=Yii::app()->db->createCommand($sd7)->queryRow();
									?>
									<div class="col-md-6" align="right">
										<h2><?php echo $str7['CANCEL']; ?></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-primary">
							<div class="panel-heading"><h1 align="center"><b>PROCESS [ 21 / 06 / 2561 ]</b></h1></div>
							<div class="panel-body">
								<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
									<div class="col-md-6">
										<h2></span></h2>
									</div>


									<div class="col-md-6" align="right">
										<h2><i>Oreder</i></h2>
									</div>
								</div>
								<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
									<div class="col-md-6">
										<h2><span class="glyphicon glyphicon-pencil"> Register</span></h2>
									</div>

									<?php
									$sd1= "SELECT COUNT(a.orderid)as REGISTER FROM orderdoc as a WHERE DATE(a.orderdate) = '20180621' AND a.status = 0 AND a.alocateid = 'JIB'";
									$str1=Yii::app()->db->createCommand($sd1)->queryRow();
									?>
									<div class="col-md-6" align="right">
										<h2><i><?php echo $str1['REGISTER']; ?></h2>
										</div>
									</div>


									<div class="col-md-12 bg-success" style="margin-bottom: 15px;">
										<div class="col-md-6">
											<h2><span class="glyphicon glyphicon-list-alt"> กดบัตรคิว</span></h2>
										</div>
										<?php
										$sd2= "SELECT COUNT(a.orderid)as QUE FROM orderdoc as a WHERE DATE(a.orderdate) = '20180621' AND a.status = 0 AND a.payq != '' AND a.alocateid = 'JIB'";
										$str2=Yii::app()->db->createCommand($sd2)->queryRow();
										?>
										<div class="col-md-6" align="right">
											<h2><?php echo $str2['QUE']; ?></h2>
										</div>
									</div>


									<div class="col-md-12 bg-info" style="margin-bottom: 15px;">
										<div class="col-md-6">
											<h2><span class="glyphicon glyphicon-usd"> Payment</span></h2>
										</div>
										<?php
										$sd3= "SELECT COUNT(a.orderid)as PAYMENT FROM orderdoc as a WHERE DATE(a.orderdate) = '20180621' AND a.status = 0 AND a.pay = 1 AND a.alocateid = 'JIB'";
										$str3=Yii::app()->db->createCommand($sd3)->queryRow();
										?>
										<div class="col-md-6" align="right">
											<h2><?php echo $str3['PAYMENT']; ?></h2>
										</div>
									</div>


									<div class="col-md-12 bg-warning" style="margin-bottom: 15px;">
										<div class="col-md-6">
											<h2><span class="glyphicon glyphicon-inbox"> จัดของ</span></h2>
										</div>
										<?php
										$sd4= "SELECT COUNT(a.orderid)as STOCK FROM orderdoc as a WHERE DATE(a.orderdate) = '20180621' AND a.status = 0 AND a.stock = 1 AND a.alocateid = 'JIB'";
										$str4=Yii::app()->db->createCommand($sd4)->queryRow();
										?>
										<div class="col-md-6" align="right">
											<h2><?php echo $str4['STOCK']; ?></h2>
										</div>
									</div>


									<div class="col-md-12 bg-danger" style="margin-bottom: 15px;">
										<div class="col-md-6">
											<h2><span class="glyphicon glyphicon-sound-6-1"> ยิงบิล itec</span></h2>
										</div>
										<?php
										$sd5= "SELECT COUNT(a.orderid)as ITECBILL FROM orderdoc as a WHERE DATE(a.orderdate) = '20180621' AND a.status = 0 AND a.itecbill = 1 AND a.alocateid = 'JIB'";
										$str5=Yii::app()->db->createCommand($sd5)->queryRow();
										?>
										<div class="col-md-6" align="right">
											<h2><?php echo $str5['ITECBILL']; ?></h2>
										</div>
									</div>


									<div class="col-md-12 bg-success" style="margin-bottom: 15px;">
										<div class="col-md-6">
											<h2><span class="glyphicon glyphicon-shopping-cart"> จ่ายสินค้า</span></h2>
										</div>
										<?php
										$sd6= "SELECT COUNT(a.orderid)as SUCCESS FROM orderdoc as a WHERE DATE(a.orderdate) = '20180621' AND a.status = 0 AND a.sucess = 1 AND a.alocateid = 'JIB'";
										$str6=Yii::app()->db->createCommand($sd6)->queryRow();
										?>
										<div class="col-md-6" align="right">
											<h2><?php echo $str6['SUCCESS']; ?></h2>
										</div>
									</div>

									<div class="col-md-12 bg-info" style="margin-bottom: 15px;">
										<div class="col-md-6">
											<h2><span class="glyphicon glyphicon-remove"> ยกเลิก</span></h2>
										</div>
										<?php
										$sd7= "SELECT COUNT(a.orderid)as CANCEL FROM orderdoc as a WHERE DATE(a.orderdate) = '20180621' AND a.status = 1 AND a.alocateid = 'JIB'";
										$str7=Yii::app()->db->createCommand($sd7)->queryRow();
										?>
										<div class="col-md-6" align="right">
											<h2><?php echo $str7['CANCEL']; ?></h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



					


					

				</body>
				</html>



				<style type="text/css" media="screen">
				body {
					min-height:350px;
				}

				.fontmitr{
					font-family: 'Mitr', cursive;
				}
			</style>