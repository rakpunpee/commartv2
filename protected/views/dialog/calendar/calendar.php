<script>
    $(function() {
        $('#curdate').datepicker({dateFormat: 'dd/mm/yy'});
        $('#changedate').datepicker({dateFormat: 'dd/mm/yy'});
    });
</script>
<?
if (!empty($months) && !empty($years)) {
    $month = $months;
    $year = $years;
} else {
    $month = date('m');
    $year = date('Y');
}
if ($month == 1) {
    $m_back = 12;
    $m_next = $month + 1;
    $y_back = $year - 1;
    $y_next = $year;
} else if ($month == 12) {
    $m_back = $month - 1;
    $m_next = 1;
    $y_back = $year;
    $y_next = $year + 1;
} else {
    $m_back = $month - 1;
    $m_next = $month + 1;
    $y_back = $year;
    $y_next = $year;
}
$mkdate = mktime(0, 0, 0, $month, 1, $year);
$full_months = date('F', $mkdate);
$weekday = date('w', $mkdate);
$last_days = date('t', $mkdate);
$day = 1;

if ($full_months == 'January') {
    $full_month = 'มกราคม';
} elseif ($full_months == 'February') {
    $full_month = 'กุมภาพันธ์';
} elseif ($full_months == 'March') {
    $full_month = 'มีนาคม';
} elseif ($full_months == 'April') {
    $full_month = 'เมษายน';
} elseif ($full_months == 'May') {
    $full_month = 'พฤษภาคม';
} elseif ($full_months == 'June') {
    $full_month = 'มิถุนายน';
} elseif ($full_months == 'July') {
    $full_month = 'กรกฎาคม';
} elseif ($full_months == 'August') {
    $full_month = 'สิงหาคม';
} elseif ($full_months == 'September') {
    $full_month = 'กันยายน';
} elseif ($full_months == 'October') {
    $full_month = 'ตุลาคม';
} elseif ($full_months == 'November') {
    $full_month = 'พฤศจิกายน';
} elseif ($full_months == 'December') {
    $full_month = 'ธันวาคม';
}
?>
<style>
    #table{
        border:1px solid #999;
        width:90%;
    }
    #cell_top{
        font-family:"Angsana New", AngsanaUPC;
        font-size:40px;
        height:50px;
        background: #f0f9ff; /* Old browsers */
        background: -moz-linear-gradient(top,  #f0f9ff 0%, #cbebff 47%, #a1dbff 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f0f9ff), color-stop(47%,#cbebff), color-stop(100%,#a1dbff)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #f0f9ff 0%,#cbebff 47%,#a1dbff 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #f0f9ff 0%,#cbebff 47%,#a1dbff 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #f0f9ff 0%,#cbebff 47%,#a1dbff 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #f0f9ff 0%,#cbebff 47%,#a1dbff 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0f9ff', endColorstr='#a1dbff',GradientType=0 ); /* IE6-9 */

    }
    #cell_head{
        font-size:30px;
        font-family:"Angsana New", AngsanaUPC;
        background-color:#80FFFF;
        width:14.5%;	
        height:50px;
        text-align:center;
    }
    #cell_body{
        font-family:"Times New Roman", Times, serif;
        font-size:25px;
        height:50px;
        text-align:right;
    }
    #cell_footer{
        font-family:"Angsana New", AngsanaUPC;
        font-size:30px;
        height:50px;
        background: #a1dbff; /* Old browsers */
        background: -moz-linear-gradient(top,  #a1dbff 0%, #cbebff 47%, #f0f9ff 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a1dbff), color-stop(47%,#cbebff), color-stop(100%,#f0f9ff)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #a1dbff 0%,#cbebff 47%,#f0f9ff 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #a1dbff 0%,#cbebff 47%,#f0f9ff 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #a1dbff 0%,#cbebff 47%,#f0f9ff 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #a1dbff 0%,#cbebff 47%,#f0f9ff 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a1dbff', endColorstr='#f0f9ff',GradientType=0 ); /* IE6-9 */

    }
    #font{
        font-family:"Angsana New", AngsanaUPC;
        font-size:12px;
    }
    #chkblock{
        float:left;
        width:15px;
        height:15px;
        margin-top:5;
        margin-bottom:0;
        margin-right:5px;
        border:1px #000000 solid;
    }
</style>
<?php $form = $this->beginWidget("CActiveForm", array()); ?>
<table width="90%" border="0" cellspacing="2" cellpadding="2" align="center">
    <tr>
        <td width="18%">&nbsp;</td>
        <td width="23%">&nbsp;</td>
        <td width="16%">&nbsp;</td>
        <td width="43%">&nbsp;</td>
    </tr>
    <tr>
        <td>วันที่ตัองการเปลี่ยน</td>
        <td><input name="changedate" id="changedate" type="text" style="width:120px;"></td>
        <td>วันที่ต้องการหยุด</td>
        <td><input name="curdate" id="curdate" type="text" style="width:120px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit"><i class="icon-random"></i> Update</button></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>

<table border="1" cellspacing="3" cellpadding="3" align="center" id="table">
    <tr>
        <td id="cell_top" colspan="7"><center><b>
            <a href="index.php?r=Calendar/EditCalendar&personal_id=<?= $personal_id ?>&months=<?= $m_back ?>&years=<?= $y_back ?>"><?php echo CHtml::image('images/left.png', '', array('style' => 'width:40px')) ?></a>
            <span style="margin:0 100px 0 100px;"><?= $full_month ?>&nbsp;&nbsp;<?= $year ?></span>
            <a href="index.php?r=Calendar/EditCalendar&personal_id=<?= $personal_id ?>&months=<?= $m_next ?>&years=<?= $y_next ?>"><?php echo CHtml::image('images/right.png', '', array('style' => 'width:40px')) ?></a>
        </b></center></td>
</tr>
<tr>
    <td id="cell_head">อาทิตย์</td>
    <td id="cell_head">จันทร์</td>
    <td id="cell_head">อังคาร</td>
    <td id="cell_head">พุธ</td>
    <td id="cell_head">พฤหัสบดี</td>
    <td id="cell_head">ศุกร์</td>
    <td id="cell_head">เสาร์</td>
</tr>
<tr>
    <?php
    $start = 1;
    while ($start <= $weekday) {
        echo '<td id="cell_body" bgcolor="#CCCCCC"> &nbsp; </td>';
        $start++;
    }
    $weekday++;

    while ($day <= $last_days) {
        $_calendardate = $year . "-" . sprintf("%02d", $month) . "-" . sprintf("%02d", $day);
        $chkper = "SELECT * FROM calendar WHERE personalid='$personal_id' AND calendardate='" . $_calendardate . "'";
        $setchkper = Yii::app()->db->createCommand($chkper)->queryRow();
        //echo $chkper.'<br>';
        if (!empty($setchkper)) {
            $bkcolor = "#A6FFA6";
            $status = 'วันทำงาน';
        } else {
            $holiday = "SELECT * FROM holiday a LEFT JOIN holiday_personal b ON a.holidayid=b.holidayid 
					WHERE b.personalid='$personal_id' AND holidaydate='$_calendardate' ";
            //echo $holiday.'<br>';
            $rs_holiday = Yii::app()->db->createCommand($holiday)->queryRow();
            if (!empty($rs_holiday)) {
                $bkcolor = "#FFB164";
                $status = $rs_holiday['holidayname'];
            } else {
                $bkcolor = "#FFA6A6";
                $status = 'วันหยุด';
            }
        }

        if (date("d") == $day && date("m") == $month && date("Y") == $year) {//เช็ควันปัจจุบัน สีช่อง
            //เช็ควันหยุดตรงกับวันปัจจุบัน
            $curday = "SELECT * FROM calendar WHERE personalid='$personal_id' AND calendardate='" . $_calendardate . "'";
            $chkcurday = Yii::app()->db->createCommand($curday)->queryRow();
            if (empty($chkcurday)) {
                echo '<td id="cell_body" bgcolor="' . $bkcolor . '">' . $day . '<div id="font">' . $status . '</div></td>'; //ตรง
            } else {
                echo '<td id="cell_body" bgcolor="#FFFF80">' . $day . '<div id="font">วันปัจจุบัน</div></td>';
            }
        } else {//วันทั่วไป
            echo '<td  id="cell_body" bgcolor="' . $bkcolor . '">' . $day . '<div id="font">' . $status . '</div></td>';
        }

        if ($weekday == 7 and $day <> $last_days) {
            echo '</tr><tr>';
            $weekday = '0';
        }
        $day++;
        $weekday++;
    }
    while ($weekday <= 7) {
        echo '<td id="cell_body"  bgcolor="#CCCCCC"> &nbsp; </td>';
        $weekday++;
    }
    ?>
</tr>
<tr bgcolor="#BBBBBB">
    <td id="cell_footer" colspan="7"><center>
    <?
    $m_today = date('m');
    $y_today = date('Y');
    ?>
    <a href="index.php?r=Calendar/EditCalendar&personal_id=<?= $personal_id ?>&months=<?= $m_today ?>&years=<?= $y_today ?>" style="color:#000000;">วันที่ปัจจุบัน วันที่&nbsp;<?php echo date('d/m/Y') ?></a>
</center></td>
</tr>	
</table>

<div style="margin:20px 0 0 100px;">
    <div><div id="chkblock" style="background:#FFFF80"></div> = วันปัจจุบัน</div>
    <div style="margin:-20px 0 0 300px;"><div id="chkblock" style="background:#A6FFA6"></div> = วันทำงาน</div>
    <div><div id="chkblock" style="background:#FFA6A6"></div> = วันหยุด</div>
    <div style="margin:-20px 0 0 300px;"><div id="chkblock" style="background:#FFB164"></div> = วันหยุดนักขัตฤกษ์</div>
</div>
<?php $this->endWidget(); ?>


