<?php
session_start();
//error_reporting(0);
include '../lib/config.inc.php';
$url = $_SERVER['PHP_SELF'] . "?";

if ($_SESSION["user"] == "") {
  header('Location: ../index.php');
}

$db = new MySqlConn;
$db->connect();

$sql = $db->selectOneData('tb_student', 'count(*) as std', $condition = null);
$sqlpvc = $db->selectOneData('tb_student', 'count(*) as std', $condition = "cid = 1");
$sqlpvs = $db->selectOneData('tb_student', 'count(*) as std', $condition = "cid = 2");
$sql2 = $db->selectOneData('tb_register', 'count(*) as regisFinish', $condition = "status = 2");
$sql21 = $db->selectOneData('tb_register', 'count(*) as regisFinish', $condition = "status = 2 AND std_class = 1");
$sql22 = $db->selectOneData('tb_register', 'count(*) as regisFinish', $condition = "status = 2 AND std_class = 2");
$sql3 = $db->selectOneData('tb_register', 'count(*) as regisConfirm', $condition = "status = 1");
$pay1 = $db->selectOneData('tb_pay', 'count(*) as payFinish', $condition = "status = 2");
$pay11 = $db->selectOneData('tb_pay', 'count(*) as payFinish', $condition = "status = 2 AND std_class=1");
$pay12 = $db->selectOneData('tb_pay', 'count(*) as payFinish', $condition = "status = 2 AND std_class=2");
$pay2 = $db->selectOneData('tb_pay', 'count(*) as payConfirm', $condition = "status = 1");
$pay3 = $db->selectOneData('tb_register', 'count(*) as regisLock', $condition = "status = 3");
$pay4 = $db->selectOneData('tb_pay', 'count(*) as payLock', $condition = "status = 3");
$payTotal = $db->selectOneData('tb_pay', 'sum(money) as total_pay', $condition = null);
$payRegis = $db->selectOneData('tb_register', 'sum(money) as total_regis', $condition = null);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>KPT REGIS V.3.0</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="dist/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <link href="dist/css/layout.css" rel="stylesheet">
  <link href="../datatables/jquery.dataTables.min.css" rel="stylesheet">

</head>

<body class="skin-green">
  <div class="wrapper">
    <?php include("nav.php"); ?>
    <?php include("menu_left.php"); ?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
      
      <?php
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      }

      if (!isset($_GET['page'])) {
      ?>
        <?php include('main.php'); ?>
      <?php
      } else {
        $url = "$page.php";
        include($url);
      }
      ?>

    </div><!-- /.content-wrapper -->

    <?php include("footer.php"); ?>

  </div><!-- ./wrapper -->

  <!--<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>-->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="dist/js/app.min.js" type="text/javascript"></script>
  <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>
  <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>
  <script src="dist/js/demo.js" type="text/javascript"></script>
  <script src="../../datatables/jquery-3.3.1.js" type="text/javascript"></script>
  <script src="../datatables/jquery.dataTables.min.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $('#products').DataTable({
        "order": [
          [0, "desc"]
        ],
        "pageLength": 25,
        "responsive": true,
        "processing": true,
      });
    });
  </script>
</body>

</html>