<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/user.png" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p>นักศึกษา</p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">เมนูหลัก</li>
      <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
      <!--<li><a href="../files/size.pdf" target="_blank"><i class="fa fa-check"></i> ข้อมูลขนาดเครื่องแบบ</a></li>
      <li><a href="order_list.php"><i class="fa fa-shopping-cart"></i> การสั่งซื้อ</a></li>-->
      <li><a href="" onclick="confirmLogout(event);"><i class="fa fa-window-close"></i> ออกจากระบบ</a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

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