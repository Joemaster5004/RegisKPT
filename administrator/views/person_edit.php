<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>นักเรียน</small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">สมาชิก</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">ระบบแก้ไขข้อมูลนักเรียน</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <?php
      $sql = $db->selectAllData('tb_student', '*', $condit = 'id=' . $_REQUEST['id']);
      foreach ($sql as $rw) { ?>
        <form name="form1" method="post">
          <div class="box-body">
            <div class="form-group">
              <label>รหัสนักศึกษา:</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="number" class="form-control" id="stdcode" value="<?php echo $rw['stdcode']; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label>รหัสประชาชน:</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="number" class="form-control" id="peopleid" value="<?php echo $rw['peopleid']; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="personName">ชื่อ-นามสกุล</label>
              <input type="text" class="form-control" id="fullname" value="<?php echo $rw['fullname']; ?>">
            </div>
            <div class="form-group">
              <label for="personName">วันเกิด</label>
              <input type="text" class="form-control" id="birthdate" value="<?php echo $rw['birthdate']; ?>">
            </div>
            <div class="form-group">
              <label for="personName">เบอร์โทรศัพท์</label>
              <input type="text" class="form-control" id="telephone" value="<?php echo $rw['telephone']; ?>">
            </div>
            <div class="form-group">
              <label>ระดับชั้น</label>
              <select class="form-control" id="cid">
                <?php
                $cond2 = 'cid=' . $rw['cid'];
                $cln = $db->selectOneData('tb_class', '*', $cond2);
                ?>
                <option value="<?php echo $cln['cid']; ?>"><?php echo $cln['cname']; ?></option>
                <?php
                $csql = $db->selectAllData('tb_class', '*', $condition = null);
                foreach ($csql as $crw) {
                ?>
                  <option value="<?php echo $crw['cid']; ?>"><?php echo $crw['cname']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>แผนกวิชา</label>
              <select class="form-control" id="majorid1">
                <?php
                $cond = 'majorid=' . $rw['majorid1'];
                $mj1 = $db->selectOneData('tb_major', '*', $cond);
                ?>
                <option value="<?php echo $mj1['majorid']; ?>"><?php echo $mj1['majorname']; ?></option>
                <?php
                $mjsql = $db->selectAllData('tb_major', '*', $condition = null);
                foreach ($mjsql as $mjrw) { ?>
                  <option value="<?php echo $mjrw['majorid']; ?>"><?php echo $mjrw['majorname']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="personName">ประเภทที่สมัคร</label>
              <select class="form-control" id="regis_type">
                <option value="<?php echo $rw['regis_type']; ?>"><?php echo $rw['regis_type']; ?></option>
                <option value="โควตา">โควตา</option>
                <option value="ปกติ">ปกติ</option>
              </select>
            </div>
            <hr>
          </div>
        <?php } ?>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
      <button type="submit" data-id="<?php echo $rw['id']; ?>" class="btn btn-default editPerson">บันทึก</button>
      <a href="#"><button type="button" class="btn btn-default btn-right">ยกเลิก</button></a>
    </div><!-- /.box-footer-->
    </form>
  </div><!-- /.box -->

</section><!-- /.content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $('.editPerson').click(function(e) {
      e.preventDefault();
      var stdcode = $("#stdcode").val();
      var peopleid = $("#peopleid").val();
      var fullname = $("#fullname").val();
      var birthdate = $("#birthdate").val();
      var telephone = $("#telephone").val();
      var cid = $("#cid").val();
      var majorid1 = $("#majorid1").val();
      var regis_type = $("#regis_type").val();
      var id=$(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "controller/person.php",
        data: {
          id: id,
          id2: stdcode,
          id3: peopleid,
          id4: fullname,
          id5: birthdate,
          id6: telephone,
          id7: cid,
          id8: majorid1,
          id9: regis_type,
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
                window.location.href = "<?php $url; ?>?page=views/person";
              }
            })
          }
        }
      });
    });
</script>