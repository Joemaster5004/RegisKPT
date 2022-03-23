<?php
require_once '../lib/config.inc.php';
$url = $_SERVER['PHP_SELF'] . "?";

$db = new MySqlConn;
$db->connect();

if (isset($_GET['insert'])) {
    $class = $_POST['class'];
    $price = $_POST['price'];

    if (trim($_FILES["file_qrcode"]["tmp_name"]) != "") {
        $type = strrchr($_FILES["file_qrcode"]["name"], ".");
        $images = $_FILES["file_qrcode"]["tmp_name"];
        $imgQr = "qr_" . date("Ymd") . rand(0000, 9999) . $type;
        copy($_FILES["file_qrcode"]["tmp_name"], "uploads/" . $imgQr);

        $field = 'cname,price,qrcode';
        $data = "'$class','$price','$imgQr'";
        $sql = $db->insertData('tb_class', $field, $data);

        echo "<script>";
        echo "window.location.href ='" . $url . "page=views/class'";
        echo "</script>";
    }
} else if (isset($_GET['update'])) {
    $cname = $_POST['cname'];
    $price = $_POST['price'];

    if (trim($_FILES["file_qrcode"]["tmp_name"]) != "") {
        $type = strrchr($_FILES["file_qrcode"]["name"], ".");
        $images = $_FILES["file_qrcode"]["tmp_name"];
        $imgQr = "qr_" . date("Ymd") . rand(0000, 9999) . $type;
        copy($_FILES["file_qrcode"]["tmp_name"], "uploads/" . $imgQr);

        $field = 'cname,price,qrcode';
        $data = "'$cname','$price','$imgQr'";
        $sql = $db->updateData('tb_class', $field, $data, 'cid=' . $_GET['update']);
        echo "<script>";
        echo "window.location.href ='" . $url . "page=views/class'";
        echo "</script>";
    } else {
        $field = 'cname,price';
        $data = "'$cname','$price'";
        $sql = $db->updateData('tb_class', $field, $data, 'cid=' . $_GET['update']);
        echo "<script>";
        echo "window.location.href ='" . $url . "page=views/class'";
        echo "</script>";
    }
} else if (isset($_GET['remove'])) {
    $sql = $db->deleteData('tb_class', 'cid=' . $_GET['remove']);

    echo "<script>";
    echo "window.location.href ='" . $url . "page=views/class'";
    echo "</script>";
}
