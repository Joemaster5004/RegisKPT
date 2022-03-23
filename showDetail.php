<?php
    session_start();
    include 'lib/config.inc.php';

    //DB1_person
    $db = new MySqlConn;
    $db->connect();
    
    $id = $_REQUEST['id'];
    
    $condit = "majorid=".$id;
    $sqlCount = $db->selectOneData('tb_register','count(*) as count',$condit);
    
    if(isset($_GET['search'])){
        //Search stdcode
        $stdcode = $_POST['txtsearch'];

        $cond='stdcode='.$stdcode;
        $sqlShow = $db->selectAllData('tb_register','*',$cond);
        
  //Don't Search
  }else{
    $condit='majorid='.$id;   
    $sqlShow = $db->selectAllData('tb_register','*',$condit);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>KPT REGIS.V.1.0</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
        <link href="https://fonts.googleapis.com/css2?family=Athiti&display=swap" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>	
    <div class="container">
        <div class="row">
            <p><font size="5"><b><img src="images/vec.gif" width="30"> วิทยาลัยเทคนิคกำแพงเพชร สรุปผลการรายงานตัวนักศึกษา ประจำวันที่ <?php echo $date; ?> 
                จำนวนทั้งสิ้น <?php echo $sqlCount['count']; ?> คน</b></font></p>
                <form class="form-inline" role="form" name="frmsearch" method="post" action="?search">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="txtsearch" name="txtsearch" placeholder="พิมพ์รหัสประจำตัว" aria-describedby="basic-addon1">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button> 
                </form>
                <a href="showRegis.php"><button class="btn btn-danger"><i class="fa fa-reply"></i> กลับ</button></a>
            <table class="table table-striped">
                <thead>
                    <th>ลำดับที่</th>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ-นักศึกษา</th>
                    <th>สาขาที่สมัคร</th>
                    <th>สถานะลงทะเบียน</th>
                    <th>สถานะสั่งจองเครื่องแบบ</th>
                </thead>
                <tbody>
                <?php
                    foreach ($sqlShow as $rw) {
                        $stdcode = $rw['stdcode'];
                        $majorid1 = $rw['majorid1'];
                        $condition="stdcode=".$stdcode;
                        $res = $db->selectOneData('tb_student','*',$condition);
                        $regis1 = $db->selectOneData('tb_register','*',$condition);
                        $pay1 = $db->selectOneData('tb_pay','*',$condition);
                        if($regis1['status']==1){
                            $statusShow = "รออนุมัติ";
                        }elseif($regis1['status']==2){
                            $statusShow = "ลงทะเบียนแล้ว";
                        }else{
                            $statusShow = "<font color='red'>ยังไม่ลงทะเบียน</font>";
                        }
                        
                        if($pay1['status']==1){
                            $payShow = "รออนุมัติ";
                        }elseif($pay1['status']==2){
                            $payShow = "ชำระแล้ว";
                        }else{
                            $payShow = "<font color='red'>ยังไม่ชำระ</font>";
                        }
                        
                        $majorid = $res['majorid1'];
                        $condition2="majorid=".$majorid;
                        $res2 = $db->selectOneData('tb_major','*',$condition2);
                        $start++;
                    ?>
                    <tr>
                        <td><?php echo $start; ?></td>
                        <td><?php echo $rw['stdcode']; ?></td>
                        <td><?php echo $res['fullname']; ?></td>
                        <td><?php echo $res2['majorid'].' - '.$res2['majorname']; ?></td>
                        <td><?php echo $statusShow; ?></font></td>
                        <td><?php echo $payShow; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>
<!--===============================================================================================-->

</body>
</html>