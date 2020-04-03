<?php echo CHtml::cssFile("lib/datatable/css/demo_page.css"); ?>
<?php echo CHtml::cssFile("lib/datatable/css/demo_table.css"); ?>
<?php echo CHtml::scriptFile("lib/datatable/js/jquery.dataTables.js"); ?>
<script>
    $(function() {
        $('#startdate').datepicker({dateFormat: 'dd/mm/yy'});
        $('#enddate').datepicker({dateFormat: 'dd/mm/yy'});
        $('table').dataTable({
            "sScrollY": 500,
            "sScrollX": "100%",
            "sScrollXInner": "100%",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true
        });
    });
    function MultiBox() {
        if (document.getElementById("multichk").checked == true) {
            var x = document.getElementsByTagName("input");
            for (i = 0; i <= x.length; i++) {
                x[i].checked = true;
            }
        } else if (document.getElementById("multichk").checked == false) {
            var x = document.getElementsByTagName("input");
            for (i = 0; i <= x.length; i++) {
                x[i].checked = false;
            }
        }
    }
</script>

<div class="header">
    <h1 class="page-title">Time</h1>
</div>
<ul class="breadcrumb">
    <li><a href="?r=Timeat/TimeJob">อัพเดทปฏิทิน</a> <span class="divider">/</span></li>
    <li class="active">New</li>
</ul>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="block"> <a href="#" class="block-heading" data-toggle="collapse"><i class="icon-plus-sign"></i> New</a>
            <div id="page-stats" class="block-body collapse in">
                <?php $form = $this->beginWidget('CActiveForm', array()); ?>
                <br/>
                <div>วันที่&nbsp;&nbsp;&nbsp;
                    <input name="startdate" id="startdate" type="text" value="<?php echo date('d/m/Y'); ?>" style="width:120px">
                    &nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;
                    <input name="enddate" id="enddate" type="text" value="<?php echo date('d/m/Y'); ?>" style="width:120px">
                    &nbsp;&nbsp;&nbsp;
                    <button type="submit"><i class="icon-random"></i> UpDate</button>
                </div>
                <div>
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'dataProvider' => $personal,
                        'enablePagination' => false,
                        'enableSorting' => false,
                        'summaryText' => false,
                        'itemsCssClass' => 'display',
                        'id' => '',
                        'rowCssClass' => array('odd gradeA', 'even gradeA'),
                        'htmlOptions' => array('class' => ''),
                        'columns' => array(
                            array(
                                /* 'header'=>CHtml::link('All',"javascript:MultiBox()",array('style'=>'color:#FFFFFF')), */
                                'header' => CHtml::checkBox("multichk", null, array(
                                    'id' => 'multichk',
                                    'onclick' => 'MultiBox()'
                                )),
                                'class' => 'CCheckBoxColumn',
                                'id' => 'personal_id',
                                'value' => '$data->personal_id',
                                'htmlOptions' => array(
                                    'align' => 'center'
                                )
                            ),
                            'personal_id',
                            'personal_name',
                            'personal_lastname',
                        /*
                          array(
                          'name'=>'line.linedescript',
                          'value'=>'$data->line->linedescript'
                          ),
                          array(
                          'name'=>'depart.departdescript',
                          'value'=>'$data->depart->departdescript'
                          ),
                          array(
                          'name'=>'rank.rankdescript',
                          'value'=>'$data->rank->rankdescript'
                          ),
                         */
                        )
                    ));
                    ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
