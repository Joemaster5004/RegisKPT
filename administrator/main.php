<section class="content-header">
    <font size="5">
        <?php
        if ($_SESSION['user'] == "admin") {
            echo "<b>ระบบขึ้นทะเบียนนักศึกษา REGIS V.3.0</b>";
        }
        ?>
    </font>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-person"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">นักศึกษาสมัคร</span>
                        <span class="info-box-number"><?php echo number_format($sql['std']); ?> คน</span>
                    </div>
                </div>
            </a><!-- /.info-box -->
        </div><!-- /.col -->

        <?php
        if ($_SESSION['user'] == "admin") {
        ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php if ($_SESSION['user'] == "admin") {
                                echo $url."page=views/reportRegisFinish";
                            } else {
                                echo "#";
                            } ?>">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="ion ion-stats-bars"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ขึ้นทะเบียนแล้ว</span>
                            <span class="info-box-number"><?php echo number_format($sql2['regisFinish']); ?> คน</span>
                        </div><!-- /.info-box-content -->
                    </div>
                </a><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-cash"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">รวมค่าขึ้นทะเบียน</span>
                        <span class="info-box-number"><?php echo number_format($payRegis['total_regis']); ?> บาท</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php if ($_SESSION['user'] == "admin") {
                                echo $url."page=views/reportRegisConfirm";
                            } else {
                                echo "#";
                            } ?>">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple"><i class="ion ion-android-warning"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">รออนุมัติขึ้นทะเบียน</span>
                            <span class="info-box-number"><?php echo $sql3['regisConfirm']; ?> คน</span>
                        </div><!-- /.info-box-content -->
                    </div>
                </a><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo $url; ?>page=views/unlockRegis">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-android-lock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ค้างในระบบ</span>
                            <span class="info-box-number"><?php echo $pay3['regisLock']; ?> คน</span>
                        </div><!-- /.info-box-content -->
                    </div>
                </a><!-- /.info-box -->
            </div><!-- /.col -->
        <?php } ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">ข้อมูลระบบ (SYSTEM DETAIL)</div>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-wrench"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="text-center">
                                <font size="5"><b>สถานการณ์ขึ้นทะเบียน ประจำปี 2565</b></font>
                            </div>
                            <hr>

                            <div class="col-md-6">
                                <div><b>ยอดสมัคร ปวช.</b></div>
                                <div>
                                    <font size="30" color="green"><b><?php echo number_format($sqlpvc['std']); ?></b></font>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div><b>ยอดสมัคร ปวส.</b></div>
                                <div>
                                    <font size="30" color="green"><b><?php echo number_format($sqlpvs['std']); ?></b></font>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div><b>ขึ้นทะเบียนแล้ว ปวช.</b></div>
                                <div>
                                    <font size="30" color="red"><b><?php echo $sql21['regisFinish']; ?></b></font>
                                    <font color="blue">ไม่มา <?php echo number_format($sqlpvc['std'] - $sql21['regisFinish']); ?></font>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div><b>ขึ้นทะเบียนแล้ว ปวส.</b></div>
                                <div>
                                    <font size="30" color="red"><b><?php echo $sql22['regisFinish']; ?></b></font>
                                    <font color="blue">ไม่มา <?php echo number_format($sqlpvs['std'] - $sql22['regisFinish']); ?></font>
                                </div>
                            </div>

                        </div>

                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>สถานะการทำงาน</strong>
                            </p>

                            <div class="progress-group">
                                <span class="progress-text">จำนวนนักศึกษาทั้งสิ้น</span>
                                <span class="progress-number"><b><?php echo number_format($sql['std']); ?> คน</b></span>

                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">จำนวนนักศึกษาขึ้นทะเบียน</span>
                                <span class="progress-number"><b><?php echo number_format($sql2['regisFinish']); ?> คน</b></span>

                                <div class="progress sm">
                                    <?php $stdFinish = ($sql2['regisFinish'] * 100) / $sql['std']; ?>
                                    <div class="progress-bar progress-bar-red" style="width: <?php echo $stdFinish; ?>%"></div>
                                </div>
                            </div>
                            <!--------------->
                            <hr>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">รวมค่าขึ้นทะเบียน</span>
                                <span class="progress-number"><b><?php echo number_format($payRegis['total_regis']); ?> บาท</b></span>
                            </div>
                            <!--------------->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section><!-- /.content -->