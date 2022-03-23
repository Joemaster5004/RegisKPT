<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>จัดการจำนวนเงินขึ้นทะเบียน</small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">จำนวนเงิน</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">ฟอร์มแก้ไขจำนวนเงินขึ้นทะเบียน</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <?php
      $sql = $db->selectAllData('tb_register', '*', 'stdcode=' . $_REQUEST['id']);
      foreach ($sql as $row) { ?>
        <form name="form1" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="cotton_name">จำนวนเงินขึ้นทะเบียน</label>
              <input type="text" class="form-control" id="money" value="<?php echo $row['money']; ?>">
            </div>
          </div>
    </div>
    <div class="modal-footer">
      <button type="submit" data-id="<?php echo $row['stdcode']; ?>" class="btn btn-default editMoney">บันทึก</button>
      <a href="#"><button type="button" class="btn btn-default btn-right">ยกเลิก</button></a>
    </div>
    </form>
  <?php } ?>
  </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $('.editMoney').click(function(e) {
      e.preventDefault();
      var mn = $("#money").val();
      var id=$(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "controller/money_edit.php",
        data: {
          id1: id,
          id2: mn,
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
                window.location.href = "<?php $url; ?>?page=views/reportRegisConfirm";
              }
            })
          }
        }
      });
    });
</script>