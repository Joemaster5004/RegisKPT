<?php
$stdcode = $_SESSION['username'];

$condition = 'stdcode=' . $stdcode;
$sql1 = $db->selectOneData('tb_student', '*', $condition);
$_SESSION['peopleid'] = $sql1['peopleid'];
$_SESSION['cid'] = $sql1['cid'];
$mjid = $sql1['majorid1'];
?>
<style>
  #showImage {
    display: none;
  }

  #showImage[src] {
    display: block;
    height: 400px;
    border: solid 3px #fff;
    border-radius: 10px;
    margin-top: 30px;
  }
</style>

<section class="content-header">
  <font size="5"><b>ข้อมูลทั่วไป</b></font><br>
  <button class="btn btn-info">ขั้นตอนที่ 1</button>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">ข้อมูลทั่วไป</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <font size="4"><i class="fa fa-user"></i> ข้อมูลทั่วไปของผู้สมัคร</font>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="200">
                <font size="3"><b>เลขประจำตัว :</b></font>
              </td>
              <td>
                <font size="3"><?php echo $sql1['stdcode']; ?></font>
              </td>
            </tr>
            <tr>
              <td>
                <font size="3"><b>รหัสประจำตัวประชาชน :</b></font>
              </td>
              <td>
                <font size="3"><?php echo $sql1['peopleid']; ?></font>
              </td>
            </tr>
            <tr>
              <td>
                <font size="3"><b>คำนำหน้า :</b></font>
              </td>
              <?php
              $congen = 'stdcode=' . $sql1['stdcode'];
              $gensql = $db->selectOneData('tb_student', '*', $congen);

              if ($gensql['gender'] == 11) {
                $title = "นาย";
                $_SESSION['gender'] = $gensql['gender'];
              } else if ($gensql['gender'] == 21) {
                $title = "นางสาว";
                $_SESSION['gender'] = $gensql['gender'];
              } else {
                $title = "เด็กหญิง";
              }
              ?>
              <td>
                <font size="3"><?php echo $title; ?></font>
              </td>
            </tr>
            <tr>
              <td>
                <font size="3"><b>ชื่อ-สกุล :</b></font>
              </td>
              <td>
                <font size="3"><?php echo $sql1['fullname']; ?></font>
              </td>
            </tr>
            <tr>
              <td>
                <font size="3"><b>วันเดือนปีเกิด :</b></font>
              </td>
              <td>
                <font size="3"><?php echo $sql1['birthdate']; ?></font>
              </td>
            </tr>
            <?php
            $condition3 = 'cid=' . $sql1['cid'];
            $clssql = $db->selectOneData('tb_class', '*', $condition3);
            ?>
            <tr>
              <td>
                <font size="3"><b>ระดับ :</b></font>
              </td>
              <td>
                <font size="3"><?php echo $clssql['cname']; ?></font>
              </td>
              <?php $_SESSION['cname'] = $clssql['cname']; ?>
            </tr>
            <?php
            $condition1 = 'majorid=' . $sql1['majorid1'];
            $mj1 = $db->selectOneData('tb_major', '*', $condition1);
            ?>
            <tr>
              <td>
                <font size="3"><b>สาขาอันดับ 1 :</b></font>
              </td>
              <td>
                <font size="3"><?php echo $mj1['majorid']; ?> - <?php echo $mj1['majorname']; ?></font>
              </td>
              <?php
              $_SESSION['majorid'] = $mj1['majorid'];
              ?>
            </tr>
            <tr>
              <td>
                <font size="3"><b>ประเภท :</b></font>
              </td>
              <td>
                <font size="3"><?php
                                if ($sql1['regis_cat'] == 11) {
                                  echo "ม.3";
                                } else if ($sql1['regis_cat'] == 21) {
                                  echo "ปวช.";
                                } else {
                                  echo "ม.6";
                                }

                                ?></font>
              </td>
            </tr>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
          http://regis.kpt.ac.th
        </div><!-- /.box-footer-->
      </div><!-- /.box -->
    </div>

    <div class="col-md-6">

      <div class="box">
        <div class="box-header with-border">
          <font size="4"><i class="fa fa-money"></i> รายละเอียดการชำระเงิน</font>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <a href="../images/detail.jpg" target="_blank"><button class="btn btn-success btn-xs"><i class="fa fa-search"></i> รายละเอียดค่าขึ้นทะเบียน</button></a><br><br>
            </div>
          </div>
          <font size="5">แบบฟอร์มตรวจสอบจำนวนเงิน</font><br>
          <?php

          echo "<div class='alert alert-info text-center' role='alert'>";
          echo "<font size='4' color='red'>คุณเรียนต่อระดับ " . $clssql['cname'] . " ชำระทั้งสิ้น " . $clssql['price'] . " บาท</font><br>";
          echo "</div>";

          ?>
          <div class="alert alert-info text-center" role="alert">
            บัญชีชำระค่าขึ้นทะเบียน <br><img src="img/ktb_01.png" width="30">
            <font size="4">ธ.กรุงไทย(KTB) เลขที่บัญชี 620-6-08304-7 <br> ชื่อบัญชี "ลงทะเบียนวิทยาลัยเทคนิคกำแพงเพชร" </font><br>
            <center><img src='../administrator/uploads/<?php echo $clssql['qrcode']; ?>' width="200"></center>
          </div>
          <form role="form" name="frmslip" method="post" action="controller/register.php?insert" enctype="multipart/form-data">
            <div class="form-group">
              <label for="imageUpload">เพิ่มหลักฐานการชำระเงิน</label>
              <input type="file" id="file_image" name="file_image" required>
              <p class="help-block"><small>กรุณาอัพโหลดไฟล์สลิป</small></p>
            </div>
            <div><img id="showImage" /></div>
            <div class="form-group">
              <label for="confirm">ยืนยันยอดเงินที่ชำระ (บาท)</label>
              <input type="number" class="form-control" id="txtMoney" name="txtMoney" placeholder="กรอกยอดให้ตรงกับสลิปที่ชำระ" required>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button><br>
              <span>
                <font color="red"><small>*กรุณาตรวจสอบให้แน่ใจก่อนบันทึก เพราะจะไม่สามารถแก้ไขได้</small></font>
              </span>
            </div>

          </form>
        </div><!-- /.box-body -->
        <div class="box-footer">
          http://regis.kpt.ac.th
        </div><!-- /.box-footer-->
      </div><!-- /.box -->
    </div>

  </div><!-- row -->
</section><!-- /.content -->

<script>
  var filename = document.getElementById('file_image');
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