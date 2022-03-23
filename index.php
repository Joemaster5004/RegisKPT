<?php
session_start();
error_reporting(~E_NOTICE);
include 'lib/config.inc.php';

//DB1_person
$db = new MySqlConn;
$db->connect();

$ipaddress = $_SERVER['REMOTE_ADDR'];
$field = 'counter_date,counter_ip';
$data = "NOW(),'$ipaddress'";
$sqlCounter = $db->insertData('tb_counter', $field, $data);

$sqlConter = $db->selectOneData('tb_counter', 'count(*) as counter', $condit = null);

$sqlstd = $db->selectOneData('tb_student', 'count(*) as std', $condit = null);
$sqlCount = $db->selectOneData('tb_register', 'count(*) as count', $condit = null);

$condit1 = "cid=1";
$sqlPvc1 = $db->selectOneData('tb_student', 'count(*) as pvc1', $condit1);
$condit2 = "cid=2";
$sqlPvs2 = $db->selectOneData('tb_student', 'count(*) as pvs2', $condit2);


$condit3 = "std_class=1";
$sqlPvc3 = $db->selectOneData('tb_register', 'count(*) as pvc3', $condit3);
$condit4 = "std_class=2";
$sqlPvs4 = $db->selectOneData('tb_register', 'count(*) as pvs4', $condit4);

if (isset($_GET['captcha'])) {
  $userCaptcha = filter_var($_POST["captcha_code"]);
  $pid = filter_var($_POST["pid"]);
  if ($_SESSION['CAPTCHA_CODE'] == $userCaptcha) {
    header('Location: checkStatus.php?id=' . $pid);
  } else {
    $error_message = "<font color='red' size='2'>กรุณาตรวจสอบรหัสความปลอดภัย!</font>";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="propeller" content="0e078f4488ac7e98704d040ff3751016">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KPT REGIS.V.3.0</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Athiti&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #333366;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">

  <div class="wrapper">
    <section class="content">
      <div class="container-fluid">

        <!-- =========================================================== -->
        <p class="text-center"><img src="images/vec.gif" width="100"><br> <b>
            <font size="5" color="white">วิทยาลัยเทคนิคกำแพงเพชร</font>
          </b><br>
          <font color="white" size="4">ระบบขึ้นทะเบียนนักศึกษาใหม่<br>ประจำวันที่ <?php echo date("d/m/Y"); ?> <br>
            จำนวนนักศึกษาใหม่ทั้งสิ้น <?php echo number_format($sqlstd['std'], 0, '.', ','); ?> คน ขึ้นทะเบียน <?php echo number_format($sqlCount['count'], 0, '.', ','); ?> คน
        </p>
        </font>


        <div class="row">
          <div class="col-1"></div>
          <div class="col-10">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h1 class="card-title p-3">
                  <font size="5"><i class="fas fa-home"></i></font>
                </h1>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"><i class="fas fa-lock"></i> LOGIN</a></li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">สรุปยอด <span class="caret"></span></a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" tabindex="-1" href="#tab_2" data-toggle="tab">ระดับ ปวช.</a>
                      <a class="dropdown-item" tabindex="-1" href="#tab_3" data-toggle="tab">ระดับ ปวส.</a>
                      <a class="dropdown-item" tabindex="-1" href="#tab_Detail" data-toggle="tab">ค่าขึ้นทะเบียน</a>
                  </li>
                  <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab"><i class="fas fa-search"></i> ตรวจสอบสถานะ</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="tab-pane active" id="tab_1">

                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10 col-sm-10 col-12">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user-lock"></i> เข้าสู่ระบบสำหรับขึ้นทะเบียน</h3>
                          </div>
                          <form id="form_std" role="form">
                            <div class="card-body">
                              <label>รหัสประจำตัวผู้สมัคร</label>
                              <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                </div>
                                <input type="number" class="form-control" name="username" id="username" placeholder="กรุณากรอกรหัสประจำตัวผู้สมัคร" required>
                              </div>

                              <label>รหัสประชาชน 13 หลัก</label>
                              <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fas fa-key"></i></div>
                                </div>
                                <input type="password" class="form-control" name="password" id="password" placeholder="กรุณากรอกรหัสประชาชน 13 หลัก" required>
                              </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                              <button type="submit" class="btn btn-primary float-right"><i class="fas fa-sign-in-alt"></i> ล็อคอิน</button>
                            </div>
                          </form>
                        </div><!-- /.card -->
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="tab_Detail">
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-12 col-sm-6 col-12">
                        <img src="images/detail.jpg" class="img-fluid">
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_Order">
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-12 col-sm-6 col-12">
                        <img src="images/pay01.jpg" class="img-fluid">
                        <img src="images/pay02.jpg" class="img-fluid">
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_Size">
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-12 col-sm-6 col-12">
                        <img src="files/size_Page1.jpg" class="img-fluid">
                        <img src="files/size_Page2.jpg" class="img-fluid">
                        <img src="files/size_Page3.jpg" class="img-fluid">
                        <img src="files/size_Page4.jpg" class="img-fluid">
                        <img src="files/size_Page5.jpg" class="img-fluid">
                      </div>
                    </div>
                  </div>

                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">

                    <div class="row d-flex justify-content-center">
                      <div class="col-md-12 col-sm-6 col-12">
                        <div class="info-box bg-info">
                          <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">ระดับ ปวช. จำนวนทั้งสิ้น <?php echo $sqlPvc1['pvc1']; ?> คน</span>

                            <div class="progress">
                              <?php
                              $percent_pvc = 0;
                              $percent_pvc = ($sqlPvc3['pvc3'] * 100) / $sqlPvc1['pvc1'];
                              ?>
                              <div class="progress-bar" style="width: <?php echo $percent_pvc; ?>%"></div>
                            </div>
                            <span class="progress-description">ขึ้นทะเบียนแล้ว <?php echo $sqlPvc3['pvc3']; ?> คน</span>
                            <span class="progress-description">คิดเป็น <?php echo number_format($percent_pvc, 2, '.', ','); ?> %</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                      </div>
                      <div class="col-md-12 col-sm-6 col-12"><?php include('chart/pvc.php'); ?></div>
                      <div><?php include('showGroupPvc.php'); ?></div>
                    </div>

                  </div>


                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">

                    <div class="row d-flex justify-content-center">
                      <div class="col-md-12 col-sm-6 col-12">
                        <div class="info-box bg-success">
                          <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">ระดับ ปวส. จำนวนทั้งสิ้น <?php echo $sqlPvs2['pvs2']; ?> คน</span>

                            <div class="progress">
                              <?php
                              $percent_pvs = 0;
                              $percent_pvs = ($sqlPvs4['pvs4'] * 100) / $sqlPvs2['pvs2'];
                              ?>
                              <div class="progress-bar" style="width: <?php echo $percent_pvs; ?>%"></div>
                            </div>
                            <span class="progress-description">ขึ้นทะเบียนแล้ว <?php echo $sqlPvs4['pvs4']; ?> คน</span>
                            <span class="progress-description">คิดเป็น <?php echo number_format($percent_pvs, 2, '.', ','); ?> %</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                      </div>
                      <div class="col-md-12 col-sm-6 col-12"><?php include('chart/pvs.php'); ?></div>
                      <div><?php include('showGroupPvs.php'); ?></div>
                    </div>

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_4">

                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10 col-sm-10 col-12">
                        <div class="card card-warning">
                          <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-search"></i> ตรวจสอบสถานะการขึ้นทะเบียนนักศึกษาใหม่</h3>
                          </div>
                          <form id="form_chk" role="form" method="POST" action="?captcha">
                            <div class="card-body">
                              <div class="form-group">
                                <label>รหัสประชาชน</label>
                                <input type="text" class="form-control" name="pid" placeholder="กรอกรหัสประชาชน 13 หลัก" required>
                              </div>
                              <div class="form-row">
                                <div class="col-sm-12 col-md-3">
                                  <img src="Captcha.php" alt="PHP Captcha">
                                </div>
                                <div class="col-sm-12 col-md-9">
                                  <input name="captcha_code" type="text" class="form-control" placeholder="กรอกรหัสความปลอดภัย 6 หลัก">
                                  <span><?php if (isset($error_message)) {
                                          echo $error_message;
                                        } ?></span>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                              <button type="submit" class="btn btn-warning float-right">ตรวจสอบ</button>
                            </div>
                          </form>
                        </div><!-- /.card -->
                      </div>

                    </div>


                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- ./card -->
            </div>
            <div class="col-1"></div>
            <!-- /.col -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
    <!-- ./wrapper -->

    <div class="text-center">
      <span>[ <a href="https://regis.kpt.ac.th/admin_login.php">สำหรับงานทะเบียน</a> ]
        <!--[ <a href="https://regis.kpt.ac.th/order_login.php">สำหรับงานส่งเสริมฯ</a> ]-->
      </span>
      <font color="white">
        <div class="pull-right hidden-xs"><b>โปรแกรม KPT REGIS.V.3.0</b></div>
        <span><i class="fas fa-street-view"></i> เข้าใช้งาน <font color="#FF00FF"><?php echo number_format($sqlConter['counter']); ?></font> ครั้ง</span><br>
        <strong>Copyright &copy; 2022 <a href="https://regis.kpt.ac.th">วท.กำแพงเพชร</a>.</strong> All rights reserved.
      </font>
    </div>

    <!-- jQuery -->
    <script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
    <script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      //$("form").submit(function (event) {
      $('#form_std').submit(function(e) {
        e.preventDefault();
        var user = $("#username").val();
        var pass = $("#password").val();
        $.ajax({
          type: "POST",
          url: "chklogin.php",
          data: {
            user: user,
            pass: pass,
            function: 'student_login'
          },
          success: function(data) {
            if (data == "student_success") {
              swal({
                title: "ยินดีต้อนรับ",
                text: "เข้าสู่ระบบขึ้นทะเบียนนักศึกษา",
                icon: "success",
                buttons: ["ยกเลิก", "ตกลง"],
                dangerMode: true,
              }).then(function(isConfirm) {
                if (isConfirm) {
                  window.location.href = "student/index.php";
                } else {
                  swal("ยกเลิก !", "กลับหน้าล็อคอิน", "error");
                  window.location.href = "index.php";
                }
              })

            } else if (data == "no_success") {
              swal({
                title: "ข้อผิดพลาด!",
                text: "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบใหม่",
                icon: "warning",
                buttons: ["ยกเลิก", "ตกลง"],
                dangerMode: true,
              }).then(function(isConfirm) {
                if (isConfirm) {
                  window.location.href = "index.php";
                }
              })
            } else if (data == "limit_error") {
              swal({
                title: "คำเตือน!",
                text: "ยังไม่เปิดระบบให้ใช้งาน กรุณาติดต่อวิทยาลัยฯ !!",
                icon: "warning",
                buttons: ["ยกเลิก", "ตกลง"],
                dangerMode: true,
              }).then(function(isConfirm) {
                if (isConfirm) {
                  window.location.href = "index.php";
                }
              })
            }
          }
        });
      });
    </script>
</body>

</html>