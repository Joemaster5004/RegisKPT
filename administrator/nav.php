<header class="main-header">
  <!-- Logo -->
  <a href="index.php" class="logo"><b>KPT A</b>dmin</a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="dist/img/user.png" class="user-image" alt="User Image"/>
            <span class="hidden-xs">ผู้ดูแลระบบ</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="dist/img/profile.png" class="img-circle" alt="User Image" />
              <p>ยินดีต้อนรับ <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?>
                <small>ประจำวันที่ <?php echo date("d/m/Y"); ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="" onclick="confirmLogout(event);" class="btn btn-default btn-flat">Log out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  //ยืนยันออกจากระบบ
function confirmLogout(e) {
	e.preventDefault();
	var frm = e.target.form;
	swal({
		title: "คำเตือน!",
		text: "คุณต้องการออกจากระบบใช่หรือไม่ ?",
		icon: "warning",
		buttons: ['ยกเลิก','ตกลง'],
		dangerMode: true,
	}).then(function(isConfirm) {
		if (isConfirm) {			
			window.location.href = "logout.php";
		} else {
			swal("ยกเลิก !" , "กลับสู่หน้าหลัก", "error");
		}
	})
}

</script>
