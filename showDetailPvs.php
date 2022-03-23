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
	<link href="administrator/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="administrator/dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="administrator/dist/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="administrator/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="administrator/dist/css/layout.css" rel="stylesheet">
    <link href="datatables/jquery.dataTables.min.css" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>	
    <div class="container">
        <div class="row">
            <p><font size="5"><b><img src="images/vec.gif" width="30"> วิทยาลัยเทคนิคกำแพงเพชร สรุปผลการรายงานตัวนักศึกษา ประจำวันที่ <?php echo date("d/m/Y"); ?> 
                จำนวนทั้งสิ้น <?php echo $sqlCount['count']; ?> คน</b></font></p>
            <table id="students" class="display">
                <thead>
                    <th>ลำดับที่</th>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ-นักศึกษา</th>
                    <th>สาขาที่สมัคร</th>
                    <th>สถานะลงทะเบียน</th>
                </thead>
                <tbody>
                <?php
                    $start=0;
                    foreach ($sqlShow as $rw) {
                        $stdcode = $rw['stdcode'];

                        $condition="stdcode=".$stdcode;
                        $res = $db->selectOneData('tb_student','*',$condition);
                        $regis1 = $db->selectOneData('tb_register','*',$condition);
                        
                        if($regis1['status']==1){
                            $statusShow = "รออนุมัติ";
                        }elseif($regis1['status']==2){
                            $statusShow = "ลงทะเบียนแล้ว";
                        }else{
                            $statusShow = "<font color='red'>ยังไม่ลงทะเบียน</font>";
                        }
                        
                        $mjid2 = $res['majorid1'];
                        $condition2="majorid=".$mjid2;
                        $res2 = $db->selectOneData('tb_major','*',$condition2);
                        $start++;
                    ?>
                    <tr>
                        <td><?php echo $start; ?></td>
                        <td><?php echo $rw['stdcode']; ?></td>
                        <td><?php echo $res['fullname']; ?></td>
                        <td><?php echo $res2['majorid'].' - '.$res2['majorname']; ?></td>
                        <td><?php echo $statusShow; ?></font></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <a href="index.php"><button class="btn btn-danger"><i class="fa fa-reply"></i> กลับ</button></a>
        </div>
    </div>
	
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="datatables/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script>
      $(document).ready(function() {
          $('#students').DataTable();
      } );
    </script>
<!--===============================================================================================-->

</body>
</html>