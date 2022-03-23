<script src="dist/js/dropzone.min.js"></script>
<link rel="stylesheet" href="dist/css/dropzone.min.css" type="text/css" />
<!-- Content Header (Page header) -->
<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>เพิ่ม QRCODE ใหม่</small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">ADD QRCODE</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">ระบบเพิ่ม QRCODE ใหม่</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="form-group">
        <label for="cotton_name">ไฟล์ QRCODE (แนบได้มากกว่า 1 ไฟล์)</label>
        <main>
          <form id="frmDropzone" action="controller/file_upload.php" class="dropzone">
            <div class="dz-message needsclick">
              <strong>ลากไฟล์วางหรือคลิกที่นี่เพื่ออัพโหลดไฟล์</strong><br />
              <span class="note needsclick">จำกัดขนาดไฟล์ไม่เกิน 8 MB ต่อไฟล์</span>
            </div>
          </form>
        </main>
      </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
      https://regis.kpt.ac.th
    </div><!-- /.box-footer-->
  </div><!-- /.box -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
    $('#insert').click(function(e) {
      e.preventDefault();
      var facute_name = $("#facute_name").val();
      $.ajax({
        type: "POST",
        url: "controller/facute.php",
        data: {
          id: facute_name,
          function: 'insert'
        },
        success: function(data) {
          if (data == "success") {
            swal({
              title: "สำเร็จ !",
              text: "บันทึกข้อมูลเรียบร้อย!!",
              icon: "success",
              buttons: ["ยกเลิก", "ตกลง"],
              dangerMode: true,
            }).then(function(isConfirm) {
              if (isConfirm) {
                window.location.href = "<?php $url; ?>?page=views/facute";
              }
            })
          }
        }
      });
    });

    $('.delFacute').click(function() {
      var id = $(this).attr('data-id');
      swal({
        title: "ลบรายการนี้หรือไม่?",
        text: "เมื่อรายการนี้ถูกลบ คุณไม่สามารถกู้คืนได้!!",
        icon: "warning",
        buttons: ['ยกเลิก', 'ตกลง'],
        dangerMode: true
      }).then(function(isConfirm) {
        if (isConfirm) {
          swal("ลบสำเร็จ!", "ข้อมูลถูกลบเรียบร้อยแล้ว.", "success");
          $.ajax({
            type: "POST",
            url: "controller/facute.php",
            data: {
              id: id,
              function: 'function_del'
            },
            success: function(data) {

            }
          });

          setTimeout(function() {
            location.reload();
          }, 1500);

        } else {
          swal("ยกเลิก!", "ลบผิดพลาด กรุณาลองใหม่!", "error");
        }
      })
    })
  </script>