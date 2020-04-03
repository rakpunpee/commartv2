<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'options' => array(
        'title' => 'Dialog',
        'width' => 500,
        'heigth' => '200',
        'position' => 'top',
        'modal' => true,
        'buttons' => array(
            'OK' => 'js:function(){ window.location.href=\'../login2018/Started\'; }',
        )
    )
));
?>
<div>!!!...คุณไม่สามารถเข้าใช้งานหน้าจอนี้ได้...!!!</div>
<?php $this->endWidget(); ?>