<script>
    $(document).ready(function() {
        var data = {};
        var theme = 'darkblue';

        $("#orderdate").jqxDateTimeInput({width: '100%', height: '32px'});
        
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'productid', type: 'string'},
                        {name: 'producname', type: 'string'},
                        {name: 'unitamt', type: 'number'},
                        {name: 'alocate', type: 'number'},
                        {name: 'totalamt', type: 'number'},
                    ], id: 'productid',
                    // url: '<?php //echo $this->createUrl("Booking/addproductbooking");                                                           ?>',
                    cache: false,
                    records: 'content',
                    addrow: function(rowid, rowdata, position, commit) {

                        commit(true);
                    },
                    updaterow: function(rowid, newdata, commit) {
                        newdata.totalamt = newdata.alocate * newdata.unitamt
                        commit(true);
                    },
                    deleterow: function(rowid, commit) {

                        commit(true);
                    },
                };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#widgetbooking").jqxGrid(
                {
                    source: dataAdapter,
                    theme: theme, width: '100%',
                    height: 250, editable: true,
                    editmode: 'click',
                    columnsresize: true,
                    columnsreorder: true,
                    altrows: true,
                    virtualmode: true,
                    rendergridrows: function()
                    {
                        return dataAdapter.records;
                    }, columns: [
                        {text: 'รหัส', editable: false, datafield: 'productid', width: '15%'},
                        {text: 'ชื่อสินค้า', editable: false, datafield: 'producname', width: '55%'},
                        {text: 'จอง', editable: true, datafield: 'alocate', width: '6%', cellsalign: 'right', cellsformat: 'n'},
                        {text: 'ราคาต่อหน่วย', datafield: 'unitamt', width: '10%', cellsalign: 'right', cellsformat: 'n2'},
                        {text: 'จำนวนเงิน', editable: false, datafield: 'totalamt', width: '10%', cellsalign: 'right', cellsformat: 'n2'},
                    ]
                });
        $("#btn_save_booking").click(function() {
            
            if ($("#orderdoc").val() == '') {
                alert("เลขที่ใบสั่งชื้อ : ห้ามเป็นค่าว่าง");
            } else if ($("#customer").val() == '') {
                alert("ชื่อลูกค่า/บริษัท : ห้ามเป็นค่าว่าง");
            } else if ($("#author").val() == '') {
                alert("ผู้บันทึก : ห้ามเป็นค่าว่าง");
            } else if ($("#addr1").val() == '') {
                alert("ที่อยู่ : ห้ามเป็นค่าว่าง");
            } else if ($("#tel").val() == '') {
                alert("เบอร์โทรศัพท์ : ห้ามเป็นค่าว่าง");
            } else if ($("#author").val() == '') {
                alert("ผู้รับจอง : ห้ามเป็นค่าว่าง");
            } else {
                var rowscount = $("#widgetbooking").jqxGrid('getdatainformation').rowscount;
                $("#widgetbooking").jqxGrid('beginupdate');
                for (var i = 0; i < rowscount; i++) {
                    var dataRecord = $('#widgetbooking').jqxGrid('getrowdata', i);
                    rowdata = {};
                    rowdata["productid"] = dataRecord.productid;
                    rowdata["producname"] = dataRecord.producname;
                    rowdata["alocate"] = dataRecord.alocate;
                    rowdata["unitamt"] = dataRecord.unitamt;
                    rowdata["totalamt"] = dataRecord.totalamt;
                   // if (rowdata["alocate"] > 0) {
                        var data = "booking=true";
                        data += "&orderdoc=" + $("#orderdoc").val();
                        data += "&orderdate=" + $("#orderdate").val();
                        data += "&customer=" + $("#customer").val();
                        data += "&addr1=" + $("#addr1").val();
                        data += "&addr2=" + $("#addr2").val();
                        data += "&city=" + $("#city").val();
                        data += "&zipcode=" + $("#zipcode").val();
                        data += "&tel=" + $("#tel").val();
                        data += "&telhome=" + $("#telhome").val();
                        data += "&amount=" + $("#amount").val();
                        data += "&creditcardamt=" + $("#creditcardamt").val();
                        data += "&creditamt=" + $("#creditamt").val();
                        data += "&pledgeamt=" + $("#pledgeamt").val();
                        data += "&remain=" + $("#remain").val();
                        data += "&descfreesup=" + $("#descfreesup").val();
                        data += "&receive=" + $("#receive").val();
                        data += "&author=" + $("#author").val();
                        data += "&freejib=" + $("#freejib").val();
                        data += "&freesupplier=" + $("#freesupplier").val();
                        data += "&comment=" + $("#comment").val();
                        data += "&" + $.param(rowdata);
                        //alert(data);
                        $.ajax({
                            dataType: 'json',
                            url: '<?php echo $this->createUrl("Booking/Saveproductbooking"); ?>',
                            data: data,
                            success: function(data, status, xhr) {
                                //alert(data);
                            }
                        });
                    //}
                }
                $("#widgetbooking").jqxGrid('endupdate');
                alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                location.reload();
            }
        });
        $("#productname").change(function() {
            $("#productid").val($("#productname").val());
        });
        $("#productid").keyup(function() {
            $.post('<?php echo $this->createUrl("Booking/ProductList"); ?>', {productid: $("#productid").val()}, function(data) {
                $('#productname').val(data);
            })
        });
        $("#btn_add_booking").click(function() {
            var rowdata = {};
            rowdata["productid"] = $('#productid').val();
            rowdata["producname"] = $('#productname').val();
            rowdata["alocate"] = 0;
            rowdata["unitamt"] = 0;
            rowdata["totalamt"] = 0;
            rowdata["booking"] = 0;
            var commit = $("#widgetbooking").jqxGrid('addrow', null, rowdata);
        });
        $("#btn_del_booking").click(function() {
            var rowdata = {};
            rowdata["productid"] = $('#productid').val();
            rowdata["producname"] = $('#producname').val();
            rowdata["alocate"] = 0;
            rowdata["unitamt"] = 0;
            rowdata["totalamt"] = 0;
            rowdata["booking"] = 0;
            var commit = $("#widgetbooking").jqxGrid('deleterow', null, rowdata);
        });
        $("#btn_del_booking").on('click', function() {
            var selectedrowindex = $("#widgetbooking").jqxGrid('getselectedrowindex');
            var rowscount = $("#widgetbooking").jqxGrid('getdatainformation').rowscount;
            if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                var id = $("#widgetbooking").jqxGrid('getrowid', selectedrowindex);
                var commit = $("#widgetbooking").jqxGrid('deleterow', id);
            }
        });
        //คำนวน keyup
        $("#amount,#creditcardamt,#creditamt,#pledgeamt").bind('keyup', function() {
            calbooking();
        });
        var calbooking = function() {
            var amount = $("#amount").val();
            var creditcardamt = $("#creditcardamt").val();
            var creditamt = $("#creditamt").val();
            var pledgeamt = $("#pledgeamt").val();
            if (amount == '') {
                amount = 0
            }
            ;
            if (creditcardamt == '') {
                creditcardamt = 0
            }
            ;
            if (creditamt == '') {
                creditamt = 0
            }
            ;
            if (pledgeamt == '') {
                pledgeamt = 0
            }
            ;

            var cal = 0;
            cal = (parseFloat(amount) + parseFloat(creditcardamt) + parseFloat(creditamt)) - parseFloat(pledgeamt);
            $("#remain").val(cal);

        }
        /*var addfilter = function (brand) {
         $("#widgetregis").jqxGrid('clearfilters');
         var filtergroup = new $.jqx.filter();
         filtergroup.operator = 'or';
         var filter_or_operator = 1;
         var filtervalue = brand;
         var filtercondition = 'contains';
         var  filter = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
         filtergroup.addfilter(filter_or_operator, filter);
         $("#widgetregis").jqxGrid('addfilter', 'brand', filtergroup);
         $("#widgetregis").jqxGrid('applyfilters');
         };
         
         $("#btn_dell").click(function(){ filter('dell');});
         $("#btn_acer").click(function(){ filter('acer');});
         $("#btn_msi").click(function(){ filter('msi');});
         $("#btn_asus").click(function(){ filter('asus');});
         $("#btn_hp").click(function(){ filter('hp');});
         $("#btn_toshiba").click(function(){ filter('toshiba');});
         $("#btn_benq").click(function(){ filter('benq');});
         $("#btn_samsung").click(function(){ filter('samsung');});
         $("#btn_lenovo").click(function(){ filter('lenovo');});*/
       
    });
</script>

        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="row form-group">
                        <div class="col-md-4">เลขที่ใบสั่งชื้อ *</div>
                        <div class="col-md-6"><?php echo CHtml::textField("orderdoc", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row form-group">
                        <div class="col-md-4">วันที่นัดรับสินค้า</div>
                        <div class="col-md-6"><div id="orderdate">  
                        		<!--    
                                <input type="text" name="orderdate" id="orderdate" data-format="dd/MM/yyyy" style="width: 100%" class="form-control">
                                <span class="add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                    </i>
                                </span> -->
                            </div>
                        </div>                       
                    </div>                  
                </div>
                <div class="col-md-4">
                    <div class="row form-group">
                        <div class="col-md-3">ผู้รับจอง *</div>
                        <div class="col-md-6"><?php echo CHtml::textField("author", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
                    </div>
                </div>
            </div>          
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="row form-group">
                        <div class="col-md-4">ชื่อลูกค้า/บริษัท *</div>
                        <div class="col-md-8"><?php echo CHtml::textField("customer", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
                    </div>
                </div>     
                <div class="col-md-4">
                    <div class="row form-group">
                        <div class="col-md-4">เบอร์โทร *</div>
                        <div class="col-md-6"><?php echo CHtml::textField("tel", null, array("style" => "width:100%","type" => "number","class"=>"form-control")); ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row form-group">
                        <div class="col-md-3">เบอร์บ้าน</div>
                        <div class="col-md-6"><?php echo CHtml::textField("telhome", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="row form-group">
                        <div class="col-md-4">ที่อยู่ *</div>
                        <div class="col-md-8"><?php echo CHtml::textField("addr1", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4"></div>
                        <div class="col-md-8"><?php echo CHtml::textField("addr2", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row form-group">
                        <div class="col-md-4">จังหวัด</div>
                        <div class="col-md-6"><?php echo CHtml::textField("city", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
                    </div>
                </div>
                <div class="col-md-4">                 
                    <div class="row form-group">
                        <div class="col-md-3">ไปรษณีย์</div>
                        <div class="col-md-6"><?php echo CHtml::textField("zipcode", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
                    </div>        
                </div>
            </div>
        </div>  

        <hr>
        <div class="row">         
            <div class="col-md-4">
                <div class="row form-group">
                    <div class="col-md-4">เงินสด (บาท)</div>
                    <div class="col-md-4"><?php echo CHtml::textField("amount", null, array("style" => "width:100%", "placeholder" => "0.00","class"=>"form-control")); ?></div>                 
                </div>
            </div>
            <div class="col-md-4">
                <div class="row form-group">
                    <div class="col-md-4">บัตรเครดิต (บาท)</div>
                    <div class="col-md-4"><?php echo CHtml::textField("creditcardamt", null, array("style" => "width:100%", "placeholder" => "0.00","class"=>"form-control")); ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row form-group">
                    <div class="col-md-4">สินเชื่อ (บาท)</div>
                    <div class="col-md-4"><?php echo CHtml::textField("creditamt", null, array("style" => "width:100%", "placeholder" => "0.00","class"=>"form-control")); ?></div>
                </div>
            </div>            
        </div>
        <div class="row">         
            <div class="col-md-4">
                <div class="row form-group">
                    <div class="col-md-4">เงินมัดจำ (บาท)</div>
                    <div class="col-md-4"><?php echo CHtml::textField("pledgeamt", null, array("style" => "width:100%", "placeholder" => "0.00","class"=>"form-control")); ?></div>                 
                </div>
            </div>
            <div class="col-md-4">
                <div class="row form-group">
                    <div class="col-md-4">ค้างชำระ (บาท)</div>
                    <div class="col-md-4"><?php echo CHtml::textField("remain", null, array("readonly" => TRUE, "style" => "width:100%", "placeholder" => "0","class"=>"form-control")); ?></div>
                </div>
            </div>          
            <div class="col-md-4">
                <div class="row form-group">
                    <div class="col-md-6"></div>
                </div>
            </div>           
        </div>

        <hr>
        <div class="row form-group">
            <div class="col-md-4"><label style="font-size: small"><input type='checkbox' id='freejib' name='freejib' value='1'/> รับของแถม JIB แล้ว</label></div>          
            <div class="col-md-6"><label style="font-size: small"><input type='checkbox' id='freesupplier' name='freesupplier' value='1'/> รับของแถม supplier แล้ว</label></div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">ระบุ</div>
            <div class="col-md-10"><?php echo CHtml::textField("descfreesup", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
        </div>
        <hr>
        <div class="row form-group">
            <div class="col-md-2">สถานที่รับ</div>
            <div class="col-md-10"><?php echo CHtml::textField("receive", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">หมายเหตุ</div>
            <div class="col-md-10"><?php echo CHtml::textField("comment", null, array("style" => "width:100%","class"=>"form-control")); ?></div>
        </div>
		<hr>
		
        <div class="row form-group">
            <div class="col-md-2"><input id="productid" name="productid" type="text" style="width: 100%" placeholder="รหัสสินค้า" class="form-control"></div>
            <div class="col-md-6"> <?php
                echo CHtml::textField("productname", null, array("style" => "width:100%","class"=>"form-control"))
                ?>
            </div> 
            <div class="col-md-3"><button class="btn btn-primary" type="submit" id="btn_add_booking"><i class="icon-download-alt"> เพิ่มสินค้าจอง</i></button>
                <button class="btn btn-danger" type="submit" id="btn_del_booking"><i class="icon-remove"> ลบสินค้าจอง</i></button></div>     
        </div>
        <div class="row form-group">           
            <div id="widgetbooking"></div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <button type="button" class="btn btn-success btn-large" id="btn_save_booking">
                    <i class="icon-save"></i> SAVE
                </button>
            </div>
        </div>

