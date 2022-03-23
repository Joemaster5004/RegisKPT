<?php
$id = $_GET['id'];
$sql = $db->selectOneData('tb_facuty', '*', 'facute_code=' . $id);
?>
<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>จัดการประเภทวิชา</small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">ประเภทวิชา</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">ฟอร์มแก้ไขประเภทวิชา</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <form name="form1" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="cotton_name">ชื่อประเภทวิชา</label>
            <input type="text" class="form-control" id="facute_name" name="facute_name" value="<?php echo $sql['facute_name']; ?>">
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="submit" data-id="<?php echo $sql['facute_code']; ?>" class="btn btn-default editFacute">บันทึก</button>
      <a href="#"><button type="button" class="btn btn-default btn-right">ยกเลิก</button></a>
    </div>
    </form>
  </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $('.editFacute').click(function(e) {
      e.preventDefault();
      var fc = $("#facute_name").val();
      var id=$(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "controller/facute.php",
        data: {
          id: id,
          fc: fc,
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
                window.location.href = "<?php $url; ?>?page=views/facute";
              }
            })
          }
        }
      });
    });
</script>