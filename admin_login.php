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
    <div class="limiter">
	<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
            <form class="login100-form validate-form">
                <span class="login100-form-logo"><image src="icon/admin.png" width="100"></span>
                <span class="login100-form-title p-b-34 p-t-27">สำหรับผู้ดูแลระบบ</span>
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input class="input100" type="text" id="username" placeholder="ชื่อผู้ใช้งาน">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" id="password" placeholder="รหัสผ่าน">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn"><i class="zmdi zmdi-home zmdi-hc-fw"></i>เข้าสู่ระบบ</button>
                </div>

                <div class="text-center p-t-90">
                    <a class="txt1" href="#">ระบบขึ้นทะเบียนนักศึกษา KPT REGIS.V.3.0</a>
                </div>
            </form>
            </div>
	</div>
    </div>
	
    <div id="dropDownSelect1"></div>
	
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>

    //$("form").submit(function (event) {
    $('form').submit(function(e) {
        e.preventDefault();
        var user = $("#username").val();
        var pass = $("#password").val();
        $.ajax({
        type: "POST",
        url: "chklogin.php",
        data: {user:user,pass:pass,function:'admin_login'},
        success: function(data){
            if(data == "admin_success"){
                swal({
                    title: "ยินดีต้อนรับ",
                    text: "เข้าสู่ผู้ดูแลระบบขึ้นทะเบียนนักศึกษา",
                    icon: "success",
                    buttons: ["ยกเลิก","ตกลง"],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {			
                        window.location.href = "administrator/index.php";
                    } else {
                        swal("ยกเลิก !" , "กลับหน้าล็อคอิน", "error");
                        window.location.href = "admin_login.php";
                    }
                })

            }else if(data == "no_success"){
                swal({
                    title: "ข้อผิดพลาด!",
                    text: "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบใหม่",
                    icon: "warning",
                    buttons: ["ยกเลิก","ตกลง"],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {			
                        window.location.href = "admin_login.php";
                    }
                })
            }else{
                swal({
                    title: "ข้อผิดพลาด!",
                    text: "กรุณากรอกชื่อผู็ใช้และรหัสผ่านก่อน",
                    icon: "warning",
                    buttons: ["ยกเลิก","ตกลง"],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {			
                        window.location.href = "admin_login.php";
                    }
                })
            }
        }
        }); 
    });
    </script>
</body>
</html>