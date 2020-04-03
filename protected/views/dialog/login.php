<script>
    function selectCheck() {
        if (document.getElementById("remember").checked == false) {
            document.getElementById("remember").checked = true;
        } else if (document.getElementById("remember").checked == true) {
            document.getElementById("remember").checked = false;
        }
    }
</script>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'options' => array(
        'title' => 'เข้าสู่ระบบ',
        'width' => 500,
        'heigth' => 'auto',
        'modal' => true
    )
));
?>
<?php $form = $this->beginWidget("CActiveForm", array()); ?>
<table width="100%" border="0" cellspacing="1" cellpadding="5">
    <tr>
        <td width="143"><div align="right">ชื่อผู้ใช้</div></td>
        <td width="198"><input type="text" name="username" id="username" style="text-align:center;" autocomplete="off"></td>
        <td width="125"><i class="icon-user"></i></td>
    </tr>
    <tr>
        <td><div align="right">รหัสผ่าน</div></td>
        <td><input type="password" name="password" id="password" style="text-align:center;" autocomplete="off"></td>
        <td><i class="icon-key"></i></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <div style="float:left;"><input name="remember" type="checkbox" id="remember" value="365"></div>
            <div style="float:left; margin:4px 0 0 10px;" onClick="javascript:selectCheck();">จำข้อมูลการเข้าสู่ระบบ</div>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><div align="center"><button type="submit"><i class="icon-signin"></i> Log-In</button></div></td>
        <td>&nbsp;</td>
    </tr>
    <?php if (!empty($msg)) { ?>
        <tr>
            <td colspan="3"><div align="center"><?= $msg ?></div></td>
        </tr>
    <?php } ?>
</table>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>