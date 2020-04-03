<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'options' => array(
        'title' => 'เปลี่ยนรหัสผ่าน',
        'width' => 500,
        'heigth' => 'auto',
        'modal' => true
    )
));
?>
<?php $form = $this->beginWidget("CActiveForm", array()); ?>
<table width="500" border="0" cellspacing="1" cellpadding="5">
    <tr>
        <td width="169"><div align="right">รหัสผ่านเดิม</div></td>
        <td width="308"><input type="password" name="oddpass" id="oddpass" style="text-align:center;" autocomplete="off"></td>
    </tr>
    <tr>
        <td><div align="right">รหัสผ่านใหม่</div></td>
        <td><input type="password" name="newpass" id="newpass" style="text-align:center;" autocomplete="off"></td>
    </tr>
    <tr>
        <td><div align="right">ยืนยันรหัสผ่าน</div></td>
        <td><input type="password" name="conpass" id="conpass" style="text-align:center;" autocomplete="off"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><button type="submit"><i class="icon-refresh"></i> Change Password</button></td>
    </tr>
    <?php if (!empty($msg)) { ?>
        <tr>
            <td colspan="2"><div align="center"><?= $msg ?></div></td>
        </tr>
    <?php } ?>
</table>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>