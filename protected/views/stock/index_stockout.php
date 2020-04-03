
        <div class="row">
            <div class="col-md-2"><strong>ลำดับ</strong></div>
            <div class="col-md-3">
                <input class="input-medium" type="text" name="orderid" id="orderid">
            </div>
            <div class="col-md-4" id="alert_text"></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2"><strong>เลขที่คิว</strong></div>
            <div class="col-md-6" id="payq"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>รุ่น</strong></div>
            <div class="col-md-6" id="modelid"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>รหัสสินค้า</strong></div>
            <div class="col-md-6" id="productid"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>ชื่อสินค้า</strong></div>
            <div class="col-md-6" id="productname"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>จำนวน</strong></div>
            <div class="col-md-6" id="qty"></div>
        </div>
        <div class="row">
            <div class="col-md-2"><strong>ชื่อลูกค้า</strong></div>
            <div class="col-md-6" id="customer"></div>
        </div>
        <hr>

<script>
    $(document).ready(function() {

        $("#orderid").focus();

        $("#orderid").keyup(function() {
            var orderid = $("#orderid").val();
            $.post('<?php echo $this->createUrl('Stock/Stochoutquery'); ?>', {orderid: orderid}, function(data) {
                if (data == false) {
                    $("#alert_text").html('<div class="text-danger"><i class="glyphicon glyphicon-remove"></i> ไม่พบข้อมูล</div>');
                    $("#payq").html("");
                    $("#modelid").html("");
                    $("#productid").html("");
                    $("#productname").html("");
                    $("#qty").html("");
                    $("#customer").html("");
                } else {
                    var arr = data.split("||");
                    $("#alert_text").html('<div class="text-success"><i class="glyphicon glyphicon-check"></i> กด Enter เพื่อตัดสต็อก</div>');
                    $("#payq").html(arr[0]);
                    $("#modelid").html(arr[1]);
                    $("#productid").html(arr[2]);
                    $("#productname").html(arr[3]);
                    $("#qty").html(arr[4]);
                    $("#customer").html(arr[5]);
                }
            });
        });

        $("#orderid").keyup(function(event) {
            var orderid = $("#orderid").val();
            if (event.keyCode == 13) {
                if ($("#orderid").val() != '') {
                    $.post('<?php echo $this->createUrl('Stock/Stochoutupdate'); ?>', {orderid: orderid}, function(data) {
                        if (data == true) {
                            $("#payq").html("");
                            $("#modelid").html("");
                            $("#productid").html("");
                            $("#productname").html("");
                            $("#qty").html("");
                            $("#customer").html("");
                            alert("บันทึกสำเร็จ");
                            $("#alert_text").html('');
                            $("#orderid").val("");
                            $("#orderid").focus();
                        } else {
                            alert("บันทึกไม่สำเร็จ เนื่องจากลำดับการจัดยังไม่ได้ชำระเงิน");
                            $("#orderid").focus();
                        }
                    });

                }
            }
        });
    });
</script>