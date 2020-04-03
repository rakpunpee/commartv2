<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'options' => array(
        'title' => 'Success',
        'width' => 500,
        'height' => 200,
        'modal' => true,
        'buttons' => array(
            'OK' => 'js:function(){window.location.href=\'' . $link . '\';}',
        )
    )
));
?>
<div style="display:block;">
    <div style="float:left; margin-right:20px;"><img src="images/success.png"></div>
    <div style="float:left; margin:5px; width:300px;"><?php echo $msg; ?></div>
</div>
<?php $this->endWidget(); ?>