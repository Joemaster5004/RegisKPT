<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/user.png" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p>ผู้ดูแลระบบ</p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li class="header">เมนูหลัก</li>
      <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>

      <li class='treeview'>
        <a href='#'><i class='fa fa-pie-chart'></i><span>โครงสร้างวิทยาลัย</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='<?php $url; ?>?page=views/facute'><i class='fa fa-gear'></i> จัดการประเภทวิชา</a></li>
          <li><a href='<?php $url; ?>?page=views/department'><i class='fa fa-star'></i> จัดการสาขางาน</a></li>
          <li><a href='<?php $url; ?>?page=views/class'><i class='fa fa-bar-chart'></i> จัดการระดับชั้น</a></li>
        </ul>
      </li>
      <li><a href='<?php $url; ?>?page=views/person'><i class='fa fa-user'></i><span>ระบบจัดการนักเรียน</span></a></li>
      <li><a href='<?php $url; ?>?page=views/qrcode'><i class='fa fa-qrcode'></i><span>ระบบจัดการ QRCODE</span></a></li>
      <li><a href='<?php $url; ?>?page=views/reportRegis'><i class='fa fa-bar-chart'></i> สรุปผลขึ้นทะเบียน</a></li>
      <li><a href='<?php $url; ?>?page=views/setting'><i class='fa fa-cogs'></i> ตั้งค่าระบบ</a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>