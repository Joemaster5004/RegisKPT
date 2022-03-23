<?php
$st = $db->selectOneData('tb_status', '*', $cond = null);
?>
<section class="content-header">
  <font size="5">
    <b>ตั้งค่าระบบ</b>
    <small> SETTING </small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">ตั้งค่าระบบ</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">ตั้งค่าระบบ</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <form method="post">
        <div class="form-group">
          <label for="personName">เปิด/ปิดระบบขึ้นทะเบียนนักศึกษา</label>
          <?php
          if ($st['status_value'] == 1) {
            $msg = "Open";
            $bg = "green";
          } else {
            $msg = "Close";
            $bg = "red";
          }
          ?>
          <span>สถานะขณะนี้</span> <span class="badge badge-pill bg-<?php echo $bg; ?>"><?php echo $msg; ?></span>
          <select class="form-control" id="status_regis">
            <option value="<?php echo $st['status_value']; ?>"><?php if($st['status_value']==1){echo "เปิด";}else{echo "ปิด";} ?></option>
            <option value="1">เปิด</option>
            <option value="2">ปิด</option>
          </select>
        </div>
        <div class="form-group">
          <label for="personName">ข้อความ</label>
          <input type="text" class="form-control" id="message" value="<?php echo $st['status_message']; ?>">
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="cotton_name">รหัสผ่านใหม่</label>
            <input type="password" class="form-control" id="admin_pass" placeholder="กรุณากำหนดรหัสผ่านใหม่">
          </div>

          <div class="form-group col-md-6">
            <label for="cotton_name">ยืนยันรหัสผ่านอีกครั้ง</label>
            <input type="password" class="form-control" id="admin_pass_confirm" placeholder="ยืนยันรหัสผ่านใหม่อีกครั้ง">
          </div>
        </div>
        <input type="submit" class="btn btn-primary editSetting" value="บันทึก">
      </form>

    </div><!-- /.box-body -->
    <div class="box-footer">
      https://regis.kpt.ac.th
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $('.editSetting').click(function(e) {
    e.preventDefault();
    var status = $("#status_regis").val();
    var message = $("#message").val();
    var admin_pass = $("#admin_pass").val();
    var admin_pass_confirm = $("#admin_pass_confirm").val();
    //var id=$(this).attr('data-id');
    $.ajax({
      type: "POST",
      url: "controller/setting.php",
      data: {
        id1: status,
        id2: message,
        id3: admin_pass,
        id4: admin_pass_confirm,
        function: 'function_edit'
      },
      success: function(data) {
        if (data == "success") {
          swal({
            title: "สำเร็จ !",
            text: "แก้ไขข้อมูลเรียบร้อย!!",
            icon: "success",
            buttons: ["ยกเลิก", "ตกลง"],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
              window.location.href = "<?php $url; ?>?page=views/setting";
            }
          })
        }else if(data == "not match"){
          swal({
            title: "ไม่สำเร็จ !",
            text: "กรุณาพิมพ์รหัสผ่านให้ตรงกัน",
            icon: "warning",
            buttons: ["ยกเลิก", "ตกลง"],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
              window.location.href = "<?php $url; ?>?page=views/setting";
            }
          })
        }
      }
    });
  });
</script>