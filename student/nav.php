<header class="main-header">
  <!-- Logo -->
  <a href="index.php" class="logo"><b>KPT REGIS.V.2.5</b></a>
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
            <span class="hidden-xs"><?php echo $_SESSION['fullname']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="dist/img/profile.png" class="img-circle" alt="User Image" />
              <p>ยินดีต้อนรับ <?php echo $_SESSION['fullname']; ?>
                <small>ประจำวันที่ <?php echo date("d/m/Y"); ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Log out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
