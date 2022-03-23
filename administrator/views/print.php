<?php
  session_start();
  include("lib/class_db.inc.php");
  
   //select
   $db = new MySqlConn;
   $db->connect();

   $subjectid = $_REQUEST['id'];
   $gcode = $_REQUEST['gcode'];

   $condition='subjectid='.$subjectid.' AND groupcode='.$gcode;
   $sql = $db->selectAllData('tb_subject','*',$condition);

   foreach($sql as $ta){
    $teacherid = $ta['teacherid'];
   }
   
   $condition='teacherid='.$teacherid;
   $tea = $db->selectAllData('tb_teacher','*',$condition);

   $eff = $db->selectAllData('tb_effect','*',$condition=null);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Kampheangphet Technical College.</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/layout.css" rel="stylesheet">
    <link href="dist/fonts/thsarabunnew.css" rel="stylesheet">

    <style>
      header,footer {
        display: none;
      }
      .textAlignVer{
          display:block;
          filter: flipv fliph;
          -webkit-transform: rotate(-90deg); 
          -moz-transform: rotate(-90deg); 
          transform: rotate(-90deg); 
          position:relative;
          width:20px;
          white-space:nowrap;
          font-size:12px;
          margin-bottom:10px;
          text-align:center;
      }

      body {
        font-family: 'THSarabunNew', sans-serif;
        font-size: 16;
      }

      d { border-bottom: 1px dotted; }
    </style>
  </head>
  <body class="skin-blue">
  <?php
      foreach ($sql as $rw){
        $_SESSION['subjectid'] = $rw['subjectid'];
        $_SESSION['groupcode'] = $rw['groupcode'];
        foreach($tea as $t){ 
          $_SESSION['teacher'] = $t['fullname'];   
  ?>
  <div class="container">
        <div class="row">
        <center><h4>แบบประเมินคุณธรรม จริยธรรมนักศึกษา วิทยาลัยเทคนิคกำแพงเพชร</h4>
        ครูผู้สอน: <?php echo $t['fullname']; ?> รหัสวิชา: <?php echo $rw['subjectid']; ?>  ชื่อวิชา: <?php echo $rw['subjectname'];  ?><br>
        ระดับ: <?php echo $rw['classname']; ?> ห้อง: <?php echo $rw['groupname']; ?> ภาคเรียนที่: <?php echo $rw['term']; ?> </center>

    <?php
      }
    }
    ?><br>
    <center>
    <table border="1">
      <thead>
        <tr height="120">
          <td rowspan="2" width="30"><center>ที่</center></td>
          <th rowspan="2" width="150"><center>รหัสประจำตัว</center></th>
          <th rowspan="2" width="350"><center>ชื่อ-นามสกุล</center></th>
          <?php foreach($eff as $ef){ ?>
            <th valign="bottom"><span class="textAlignVer"><center><?php echo $ef['title']; ?></center></span></th>
          <?php } ?>
          <th valign="bottom"><span class="textAlignVer"><center>คะแนนรวม</center></span></th>
        </tr>
        <tr>
        <?php 
          $sum = 0;
          foreach($eff as $s){ 
            $sum += $s['score'];
        ?>
          <th width="30"><center><?php echo $s['score'] ?></center></th>
        <?php } ?> 
          <th width="35"><center><?php echo $sum; ?></center></th>   
        </tr>
      </thead>
      <tbody>
      <?php 
        $condition='groupcode='.$_SESSION['groupcode'].' AND subjectid ='.$_SESSION['subjectid'];
        $std = $db->selectAllData('tb_addeffect','*',$condition);
        $i=1;
        $sum = 0;
        $sum_total = 0;
        foreach($std as $student){ 
      ?>
        <tr height="20">
            <td><center><?php echo $i; ?></center></td>
            <td><center><?php echo $student['studentid']; ?></center></td>
            <?php  
              $condition='studentid ='.$student['studentid'];
              $stdname = $db->selectAllData('tb_student','*',$condition);
              foreach($stdname as $sn){
            ?>
            <td><font size="2"><?php echo $sn['fullname']; ?></font></td>
            <?php } ?>
            <td><center><?php echo $student['score1']; ?></center></td>
            <td><center><?php echo $student['score2']; ?></center></td>
            <td><center><?php echo $student['score3']; ?></center></td>
            <td><center><?php echo $student['score4']; ?></center></td>
            <td><center><?php echo $student['score5']; ?></center></td>
            <td><center><?php echo $student['score6']; ?></center></td>
            <td><center><?php echo $student['score7']; ?></center></td>
            <td><center><?php echo $student['score8']; ?></center></td>
            <td><center><?php echo $student['score9']; ?></center></td>
            <td><center><?php echo $student['score10']; ?></center></td>
            <?php
              $sum = $student['score1'] + $student['score2'] + $student['score3'] + $student['score4'] + $student['score5'] + $student['score6'] + $student['score7'] + $student['score8'] + $student['score9'] + $student['score10'];
              $sum_total += $sum;
            ?>
            <td><center><?php echo $sum; ?></center></td>
            <?php ?>
        </tr>
      <?php $i++; } 
        $condition='subjectid ='.$_SESSION['subjectid'];
        $field = 'sum(score1) as s1,sum(score2) as s2,sum(score3) as s3,sum(score4) as s4,sum(score5) as s5,sum(score6) as s6,sum(score7) as s7,sum(score8) as s8,sum(score9) as s9,sum(score10) as s10,count(*) as count';
        $total = $db->selectAllData('tb_addeffect',$field,$condition);
        
        foreach($total as $t){
      ?>
        <tr height="30">
            <td colspan="3"><b>รวมเฉลี่ยรายข้อ</b></td>
            <td><center><?php echo number_format($t['s1']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s2']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s3']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s4']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s5']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s6']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s7']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s8']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s9']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($t['s10']/$t['count'],2,'.',''); ?></center></td>
            <td><center><?php echo number_format($sum_total/$t['count'],2,'.',''); ?></center></td>
        </tr>
        <?php } ?>
      </tbody>
    </table><br><br>
    <div>
        <p>ลงชื่อครูผู้สอน ........................................................................</p>
        <p>( <?php echo $_SESSION['teacher']; ?> )</p>  
        <p>............... / ............... / ...............</p>      
    </div>
    </div>
  </div>
  <script type="text/javascript">
    window.print();
  </script>
  </body>
</html>
