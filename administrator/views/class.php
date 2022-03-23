<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>จัดการระดับชั้น</small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">ระดับชั้น</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">ระบบจัดการระดับชั้น</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-striped">
        <tr>
          <th style="width: 10px"><a href="" data-toggle="modal" data-target=".add"><i class="fa fa-plus-square-o"></i></th>
          <th>ระดับชั้น</th>
          <th>ค่าขึ้นทะเบียน</th>
          <th>QR จ่ายเงิน</th>
          <th style="width: 40px"></th>
          <th style="width: 40px"></th>
        </tr>
        <?php
        $i = 0;
        $sql = $db->selectAllData('tb_class', '*', $condition = null);
        foreach ($sql as $rw) {
          $i++;
        ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $rw['cname']; ?></td>
            <td><?php echo $rw['price']; ?></td>
            <td><img src="uploads/<?php echo $rw['qrcode']; ?>" width="50"></td>
            <td><a href="?page=views/class_edit&id=<?php echo $rw['cid']; ?>"><button class="btn btn-block btn-success btn-xs"><i class="fa fa-edit"></i></button></a></td>
            <td><a href="?page=controller/class&remove=<?php echo $rw['cid']; ?>" onclick="return confirm('ต้องการลบข้อมูลนี้ใช่หรือไม่?')"><button class="btn btn-block btn-danger btn-xs"><i class="fa fa-remove"></i></button></a></td>
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
        <font size="4" class="modal-title">ฟอร์มเพิ่มปีการศึกษา</font>
      </div>
      <div class="modal-body">
        <!-- form start -->
        <form role="form" name="frmcat" method="post" action="?page=controller/class&insert" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="cotton_name">ระดับชั้น</label>
              <input type="text" class="form-control" id="class" name="class" placeholder="กรุณาพิมพ์ระดับชั้น">
            </div>
            <div class="form-group">
              <label for="cotton_name">ค่าขึ้นทะเบียน</label>
              <input type="text" class="form-control" id="price" name="price" placeholder="กรุณาพิมพ์ค่าขึ้นทะเบียน">
            </div>
            <div class="form-group">
              <label for="qrUpload">เพิ่มหลักฐานการชำระเงิน</label>
              <input type="file" id="file_qrcode" name="file_qrcode" required>
              <p class="help-block"><small>กรุณาอัพโหลด QR-CODE</small></p>
            </div>
            <div><img id="showImage" /></div>
          </div><!-- /.box-body -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">บันทึก</button>
        <a href="class.php"><button type="button" class="btn btn-default btn-right">ยกเลิก</button></a>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
  var filename = document.getElementById('file_qrcode');
  filename.onchange = function() {
    var files = filename.files[0];
    var reader = new FileReader();
    reader.readAsDataURL(files);
    reader.onload = function() {
      var result = reader.result;
      document.getElementById('showImage').src = result;
    };
  };
</script>