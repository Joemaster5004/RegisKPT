<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข่าวสาร</b>
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
      <?php
      $sql = $db->selectAllData('tb_major', '*', 'majorid=' . $_GET['id']);
      foreach ($sql as $row) {
        $facute_code = $row['facute_code'];
        $fsql = $db->selectOneData('tb_facuty', '*', 'facute_code=' . $facute_code);
      ?>
        <form name="form1" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="cotton_name">ชื่อประเภทวิชา</label>
              <input type="text" class="form-control" id="facute_code" value="<?php echo $fsql['facute_name']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="cotton_name">รหัสแผนกวิชา</label>
              <input type="text" class="form-control" id="majorid" value="<?php echo $row['majorid']; ?>">
            </div>
            <div class="form-group">
              <label for="cotton_name">ชื่อแผนกวิชา</label>
              <input type="text" class="form-control" id="depart_name" value="<?php echo $row['majorname']; ?>">
            </div>
          </div>
    </div>
    <div class="modal-footer">
      <button type="submit" data-id="<?php echo $row['majorid']; ?>" class="btn btn-default editDep">บันทึก</button>
      <a href="#"><button type="button" class="btn btn-default btn-right">ยกเลิก</button></a>
    </div>
    </form>
  <?php } ?>
  </div><!-- /.box-body -->
  <div class="box-footer">
    https://regis.kpt.ac.th
  </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $('.editDep').click(function(e) {
      e.preventDefault();
      var majorid = $("#majorid").val();
      var depart_name = $("#depart_name").val();
      var id=$(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "controller/department.php",
        data: {
          id: id,
          id1: majorid,
          id2: depart_name,
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
                window.location.href = "<?php $url; ?>?page=views/department";
              }
            })
          }
        }
      });
    });
</script>