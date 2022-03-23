<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>จัดการประเภท</small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">ประเภท</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">ระบบจัดการแผนกวิชา</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-striped">
        <tr>
          <th style="width: 10px"><a href="" data-toggle="modal" data-target=".add"><i class="fa fa-plus-square-o"></i></th>
          <th>รหัสแผนก</th>
          <th>ชื่อแผนกวิชา</th>
          <th style="width: 40px"></th>
          <th style="width: 40px"></th>
        </tr>
        <?php
        $i = 0;
        $sql = $db->selectAllData('tb_major', '*', $condition = null);
        foreach ($sql as $row) {
          $i++;
        ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['majorid']; ?></td>
            <td><?php echo $row['majorname']; ?></td>
            <td><a href="?page=views/department_edit&id=<?php echo $row['majorid']; ?>"><button class="btn btn-block btn-success btn-xs"><i class="fa fa-edit"></i></button></a></td>
            <td><button class="btn btn-block btn-danger btn-xs delDep" data-id="<?php echo $row['majorid']; ?>"><i class="fa fa-remove"></i></button></td>
          </tr>
        <?php } ?>
      </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
      https://regis.kpt.ac.th
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

</section><!-- /.content -->

<div class="modal fade add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <font size="4" class="modal-title">ฟอร์มเพิ่มแผนกวิชา</font>
      </div>
      <div class="modal-body">
        <!-- form start -->
        <form id="frmDep" method="post">
          <div class="form-group">
            <label for="cotton_name">รหัสแผนก</label>
            <input type="text" class="form-control" id="majorid" placeholder="กรุณาพิมพ์รหัสแผนก">
          </div>
          <div class="form-group">
            <label>ประเภทวิชา</label>
            <select class="form-control" id="facute">
              <option value="">-- กรุณาเลือกประเภทวิชา --</option>
              <?php
              $fsql = $db->selectAllData('tb_facuty', '*', $condition = null);
              foreach ($fsql as $rwf) {
              ?>
                <option value="<?php echo $rwf['facute_code']; ?>"><?php echo $rwf['facute_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>ระดับชั้น</label>
            <select class="form-control" id="stdclass">
              <option value="">-- กรุณาเลือกระดับชั้น --</option>
              <option value="1">ปวช.</option>
              <option value="2">ปวส.</option>
            </select>
          </div>
          <div class="form-group">
            <label for="cotton_name">ชื่อแผนกวิชา</label>
            <input type="text" class="form-control" id="majorname" placeholder="กรุณาพิมพ์แผนกวิชา">
          </div>
      </div><!-- /.box-body -->
    </div>
    <div class="modal-footer">
      <button type="submit" id="insertDep" class="btn btn-default">บันทึก</button>
      <a href="#"><button type="button" class="btn btn-default btn-right">ยกเลิก</button></a>
    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $('#insertDep').click(function(e) {
    e.preventDefault();
    var majorid = $("#majorid").val();
    var stdclass = $('#stdclass').val();
    var facute_code = $('#facute').val();
    var majorname = $('#majorname').val();
    $.ajax({
      type: "POST",
      url: "controller/department.php",
      data: {
        id1: majorid,
        id2: stdclass,
        id3: facute_code,
        id4: majorname,
        function: 'function_insert'
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
              window.location.href = "<?php $url; ?>?page=views/department";
            }
          })
        }
      }
    });
  });

  $('.delDep').click(function() {
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
          url: "controller/department.php",
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