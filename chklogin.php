<?php
session_start();
include 'lib/config.inc.php';

//DB1_person
$db = new MySqlConn;
$db->connect();

if (isset($_POST['function']) && $_POST['function'] == 'admin_login') {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sqlLogin = $db->selectOneData('tb_status','*',$condLogin=null);
    
    if($username== $sqlLogin['admin_user'] && $password==$sqlLogin['admin_pass']){
        $_SESSION["user"] = $username;
        $_SESSION["pass"] = $password;
        $_SESSION["firstname"] = "administrator";
        $_SESSION["lastname"] = "kpt";
        session_write_close();
        echo "admin_success";
    }else{
        echo "no_success";
    }
}else if(isset($_POST['function']) && $_POST['function'] == 'student_login'){
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $condLogin = "stdcode=".$username." AND peopleid=".$password;
    $sqlLogin = $db->selectOneData('tb_student','*',$condLogin);

    if($username == $sqlLogin['stdcode'] && $password == $sqlLogin['peopleid']){
        $sqlChkRegis = $db->selectOneData('tb_status','*',$chkRegis=null);
        if($sqlChkRegis['status_value'] == 1){
            $_SESSION['username'] = $sqlLogin['stdcode'];
            $_SESSION['fullname'] = $sqlLogin['fullname'];
            session_write_close();
            echo "student_success";
        }else{
            echo "limit_error";
        } 
    }else{
        echo "no_success";
    }
}

?>
