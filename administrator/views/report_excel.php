<?php
    include("lib/class_db.inc.php");
    $db = new MySqlConn;
    $db->connect();

    $strExcelFileName="ReportRegisKPT.xls";
    header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
    header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
    header("Pragma:no-cache");

    $sql = $db->selectAllData('tb_student','*',$cond);
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
    <table x:str border=0 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
        <tr>
            <td><strong>รหัสประจำตัว</strong></td>
            <td><strong>รหัสประชาชน</strong></td>
            <td><strong>ชื่อ-สกุล</strong></td>
            <td><strong>สาขาที่1</strong></td>
            <td><strong>สาขาที่2</strong></td>
            <td><strong>สถานะลงทะเบียน</strong></td>
            <td><strong>จำนวนเงิน</strong></td>
            <td><strong>สถานะสั่งเครื่องแบบ</strong></td>
            <td><strong>จำนวนเงิน</strong></td>
        </tr>
    <?php
        foreach ($sql as $row) {
            $stdcode = $row['stdcode'];
            
            $condition='stdcode='.$stdcode;
            $regis = $db->selectOneData('tb_register','*',$condition);
            $pay = $db->selectOneData('tb_pay','*',$condition);

            $cond = 'majorid='.$row['majorid1'];
            $major1 = $db->selectOneData('tb_major','*',$cond);
            $cond2 = 'majorid='.$row['majorid2'];
            $major2 = $db->selectOneData('tb_major','*',$cond2);
                
    ?>
        <tr>
            <td><?php echo $row['stdcode'];?></td>
            <td><?php echo $row['peopleid'];?></td>
            <td><?php echo $row['fullname'];?></td>
            <td><?php echo $major1['majorname'];?></td>
            <td><?php echo $major2['majorname'];?></td>
            <td><?php echo $regis['status']?></td>
            <td><?php echo $regis['money']?></td>
            <td><?php echo $pay['status']?></td>
            <td><?php echo $pay['money']?></td>
        </tr>
    <?php
        }
    ?>
    </table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>