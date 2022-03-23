<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

if(isset($_POST['function']) && $_POST['function'] == 'function_insert'){
    $stdcode = $_POST['stdcode'];
    $peopleid = $_POST['txtID1'].$_POST['txtID2'].$_POST['txtID3'].$_POST['txtID4'].$_POST['txtID5'];
    $gender = $_POST['gender'];
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $telephone = $_POST['telephone'];
    $cid = $_POST['cid'];
    $majorid1 = $_POST['majorid1'];
    $regis_type = $_POST['regis_type'];
    $regis_cat = $_POST['regis_cat'];

    $field = 'stdcode,peopleid,gender,fullname,birthdate,telephone,cid,majorid1,regis_type,regis_cat';
    $data = "'$stdcode','$peopleid',$gender,'$fullname','$birthdate','$telephone','$cid','$majorid1','$regis_type','$regis_cat'";

    $sql=$db->insertData('tb_student',$field,$data);

    echo "success";
} else if(isset($_POST['function']) && $_POST['function'] == 'function_edit'){
    $stdcode = $_POST['id2'];
    $peopleid = $_POST['id3'];
    $fullname = $_POST['id4'];
    $birthdate = $_POST['id5'];
    $telephone = $_POST['id6'];
    $cid = $_POST['id7'];
    $majorid1 = $_POST['id8'];
    $regis_type = $_POST['id9'];

    $field = 'stdcode,peopleid,fullname,birthdate,telephone,cid,majorid1,regis_type';
    $data = "'$stdcode','$peopleid','$fullname','$birthdate','$telephone','$cid','$majorid1','$regis_type'";
    $sql=$db->updateData('tb_student', $field, $data, 'id='.$_POST['id']);

    echo "success";
} else if(isset($_POST['function']) && $_POST['function'] == 'function_del'){
    $sql = $db->deleteData('tb_student','id='.$_POST['id']);

    echo "success";
}
