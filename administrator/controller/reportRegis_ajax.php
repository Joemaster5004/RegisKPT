<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

$condit = 'id ORDER BY id DESC';
$sql = $db->selectAllData('tb_student', '*', $condit);
foreach ($sql as $row) {
  $mj1 = $row['majorid1'];
  $condition1 = "majorid=" . $mj1;
  $major1 = $db->selectOneData('tb_major', '*', $condition1);

  $data[] = array(
    'stdcode' => $row['stdcode'],
    'fullname' => $row['fullname'],
    'majorname' => $major1['majorname'],
    'telephone' => $row['telephone'],
  );
}

$json_data = array(
  "status"      => "sucess",
  "data"        => $data
  );

echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
?>
