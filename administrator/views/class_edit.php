<style>
  #showImage {
    display: none;
  }

  #showImage[src] {
    display: block;
    height: 200px;
    border: solid 3px #fff;
    border-radius: 10px;
    margin-top: 30px;
  }
</style>

<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>แก้ไขระดับชั้น</small>
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
      <font size="4">ฟอร์มแก้ไขระดับชั้น</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>

    <div class="box-body">
      <?php
      $sql = $db->selectAllData('tb_class', '*', 'cid=' . $_REQUEST['id']);
      foreach ($sql as $row) { ?>
        <form name="form1" method="post" action="?page=controller/class&update=<?php echo $row['cid']; ?>" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="cotton_name">ระดับชั้น</label>
              <input type="text" class="form-control" id="cname" name="cname" value="<?php echo $row['cname']; ?>">
            </div>

            <div class="form-group">
              <label for="cotton_name">ค่าขึ้นทะเบียน</label>
              <input type="number" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>">
            </div>

            <div class="form-group">
              <label for="qrUpload">เพิ่มหลักฐานการชำระเงิน</label>
              <input type="file" id="file_qrcode" name="file_qrcode">
              <p class="help-block"><small>กรุณาอัพโหลด QR-CODE</small></p>
            </div>

            <div><img id="showImage" /></div>
            <?php
            if (isset($row['qrcode']) != null) {
              echo '<img src="uploads/' . $row['qrcode'] . '">';
            } else {
              echo '<img src="uploads/nopic.png" width="200">';
            }
            ?>
          </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-default">บันทึก</button>
      <a href="class.php"><button type="button" class="btn btn-default btn-right">ยกเลิก</button></a>
    </div>
    </form>
  <?php } ?>
  </div><!-- /.box-body -->
  <div class="box-footer">
    https://effective.kpt.ac.th
  </div><!-- /.box-footer-->
  </div><!-- /.box -->
</section><!-- /.content -->

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