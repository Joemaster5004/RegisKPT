<?php
session_start();
include("../lib/config.inc.php");
unset($_SESSION['subject_cart']);

if (!isset($_SESSION["username"])) {
  header('Location: ../index.php');
}

$stdcode = $_SESSION['username'];

$db = new MySqlConn;
$db->connect();

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

</head>

<body class="skin-purple">
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

  <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="dist/js/app.min.js" type="text/javascript"></script>
  <script src="dist/js/demo.js" type="text/javascript"></script>
</body>

</html>