<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<head>
  <!-- <meta http-equiv="Content-Type" content="text/html; charset=windows-874" /> -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Commart</title>
  

</head>
<?php 
$sd= "SELECT o.boots as shop,s.brand,sum(o.price)as sumprice,count(o.orderid)as corder FROM orderdoc as o LEFT JOIN stock as s ON o.productid = s.productid 
WHERE o.status = 0 AND o.sucess=1 AND o.alocateid = 'JIB' AND DATE(o.orderdate) = '2018-06-24' GROUP BY o.boots,s.brand";
$str=Yii::app()->db->createCommand($sd)->queryAll();

$sd2= "SELECT o.boots as shop,s.brand,sum(o.price)as sumprice,count(o.orderid)as corder FROM orderdoc as o LEFT JOIN stock as s ON o.productid = s.productid 
WHERE o.status = 0 AND o.sucess=1 AND o.alocateid = 'JIB' AND DATE(o.orderdate) = '2018-06-23' GROUP BY o.boots,s.brand";
$str2=Yii::app()->db->createCommand($sd2)->queryAll();

$sd3= "SELECT o.boots as shop,s.brand,sum(o.price)as sumprice,count(o.orderid)as corder FROM orderdoc as o LEFT JOIN stock as s ON o.productid = s.productid 
WHERE o.status = 0 AND o.sucess=1 AND o.alocateid = 'JIB' AND DATE(o.orderdate) = '2018-06-22' GROUP BY o.boots,s.brand";
$str3=Yii::app()->db->createCommand($sd3)->queryAll();

$sd4= "SELECT o.boots as shop,s.brand,sum(o.price)as sumprice,count(o.orderid)as corder FROM orderdoc as o LEFT JOIN stock as s ON o.productid = s.productid 
WHERE o.status = 0 AND o.sucess=1 AND o.alocateid = 'JIB' AND DATE(o.orderdate) = '2018-06-21' GROUP BY o.boots,s.brand";
$str4=Yii::app()->db->createCommand($sd4)->queryAll();



?>
<body class="container">


  <div class="container">
    <h2>วันที่ 24 / 06 / 2561</h2>

    <table class="table">
      <thead>
        <tr>
          <th>Booth</th>
          <th>แบรนด์</th>
          <th>ยอดขาย(รวม)</th>
          <th>จำนวนออเดอร์</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($str as $r) {?>
         <tr>
           <td><?php echo $r['shop']; ?></td>
           <td><?php echo $r['brand']; ?></td>
           <td><?php echo number_format($r['sumprice'],2); ?></td>
           <td><?php echo $r['corder']; ?></td>
         </tr>

       <?php } ?>   
       <?php 
     $qsum4 = "SELECT sum(price)as sumprice,COUNT(orderid) as coutorder  FROM orderdoc  where sucess=1 AND date(orderdate) ='2018-06-24' ";
     $sum4=Yii::app()->db->createCommand($qsum4)->queryRow();
     ?>
     <tr>
       <td><b>ยอดขายรวม</b></td>
       <td></td>
       <td><b><?php echo number_format($sum4['sumprice'],2); ?></b></td>
       <td><?php echo number_format($sum4['coutorder']); ?></td>
     </tr>     
     </tbody>
   </table>
 </div>
 <div class="container">
  <h2>วันที่ 23 / 06 / 2561</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Booth</th>
        <th>แบรนด์</th>
        <th>ยอดขาย(รวม)</th>
        <th>จำนวนออเดอร์</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($str2 as $r2) {?>
       <tr>
         <td><?php echo $r2['shop']; ?></td>
         <td><?php echo $r2['brand']; ?></td>
         <td><?php echo number_format($r2['sumprice'],2); ?></td>
         <td><?php echo $r2['corder']; ?></td>
       </tr>

     <?php } ?> 

     <?php 
     $qsum3 = "SELECT sum(price)as sumprice,COUNT(orderid) as coutorder  FROM orderdoc  where sucess=1 AND date(orderdate) ='2018-06-23' ";
     $sum3=Yii::app()->db->createCommand($qsum3)->queryRow();
     ?>
     <tr>
       <td><b>ยอดขายรวม</b></td>
       <td></td>
       <td><b><?php echo number_format($sum3['sumprice'],2); ?></b></td>
       <td><b><?php echo number_format($sum3['coutorder']); ?></b></td>
     </tr>      
   </tbody>
 </table>
</div>
<div class="container">
  <h2>วันที่ 22 / 06 / 2561</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Booth</th>
        <th>แบรนด์</th>
        <th>ยอดขาย(รวม)</th>
        <th>จำนวนออเดอร์</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($str3 as $r3) {?>
       <tr>
         <td><?php echo $r3['shop']; ?></td>
         <td><?php echo $r3['brand']; ?></td>
         <td><?php echo number_format($r3['sumprice'],2); ?></td>
         <td><?php echo $r3['corder']; ?></td>
       </tr>
     <?php } ?>
     <?php 
     $qsum2 = "SELECT sum(price)as sumprice,COUNT(orderid) as coutorder  FROM orderdoc  where sucess=1 AND date(orderdate) ='2018-06-22' ";
     $sum2=Yii::app()->db->createCommand($qsum2)->queryRow();
     ?>
     <tr>
       <td><b>ยอดขายรวม</b></td>
       <td></td>
       <td><b><?php echo number_format($sum2['sumprice'],2); ?></b></td>
       <td><b><?php echo number_format($sum2['coutorder']); ?></b></td>
     </tr>            
   </tbody>
 </table>
</div>
<div class="container">
  <h2>วันที่ 21 / 06 / 2561</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Booth</th>
        <th>แบรนด์</th>
        <th>ยอดขาย(รวม)</th>
        <th>จำนวนออเดอร์</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($str4 as $r4) {?>
       <tr>
         <td><?php echo $r4['shop']; ?></td>
         <td><?php echo $r4['brand']; ?></td>
         <td><?php echo number_format($r4['sumprice'],2); ?></td>
         <td><?php echo $r4['corder']; ?></td>
       </tr>
     <?php } ?> 
       <?php 
     $qsum1 = "SELECT sum(price)as sumprice,COUNT(orderid) as coutorder  FROM orderdoc  where sucess=1 AND date(orderdate) ='2018-06-21' ";
     $sum1=Yii::app()->db->createCommand($qsum1)->queryRow();
     ?>
     <tr >
       <td><b>ยอดขายรวม</b></td>
       <td></td>
       <td><b><?php echo number_format($sum1['sumprice'],2); ?></b></td>
       <td><b><?php echo number_format($sum1['coutorder']); ?></b></td>
     </tr>                  
   </tbody>
 </table>
</div>
</body>
