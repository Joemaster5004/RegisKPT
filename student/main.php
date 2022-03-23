<section class="content-header">
    <font size="5">
        <b>ระบบขึ้นทะเบียนออนไลน์ REGIS V.2.5</b>
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
        <?php
        $sqlstatus = $db->selectOneData('tb_status', '*', $condstatus = null);
        if ($sqlstatus['status_value'] == 1) {
        ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-android-person"></i></span>
                    <div class="info-box-content text-center">
                        <span class="info-box-text">สถานะขึ้นทะเบียน</span>
                        <?php
                        $condition = 'stdcode=' . $stdcode;
                        $sql = $db->selectOneData('tb_register', '*', $condition);
                        $status = @($sql['status']);
                        if ($status == 1) {
                            echo "<span class='info-box-number'><font color='yellow'>รอการอนุมัติ</font></span>";
                            echo "<font color='yellow' size='5'><i class='fa fa-warning'></i></font>";
                        } elseif ($status == 2) {
                            echo "<span class='info-box-number'><font color='green'>ขึ้นทะเบียนแล้ว</font></span>";
                            echo "<font color='green' size='5'><i class='fa fa-check-circle'></i></font>";
                        } elseif ($status == 3) {
                            echo "<span class='info-box-number'><font color='red'>ติดต่อวิทยาลัย</font></span>";
                            echo "<button class='btn btn-block btn-primary btn-xs' disabled>คลิกขึ้นทะเบียน</button>";
                        } else {
                            echo "<span class='info-box-number'><font color='red'>ยังไม่ขึ้นทะเบียน</font></span>";
                            echo "<a href='?page=views/register'><button class='btn btn-block btn-primary btn-xs'>คลิกขึ้นทะเบียน</button></a>";
                        }
                        ?>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        <?php } ?>
    </div>

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <font size="4">คำชี้แจงการขึ้นทะเบียนออนไลน์</font>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body text-center">
            <img src="img/vec.gif" width="100">
            <p>
                <font size="4"><b>ระบบบริการรับขึ้นทะเบียนนักเรียนนักศึกษาใหม่ออนไลน์ วิทยาลัยเทคนิคกำแพงเพชร</b></font>
            </p>
            <p>ระบบบริการรับขึ้นทะเบียนออนไลน์จัดทำขึ้นเพื่ออำนวยความสะดวกให้กับผู้ที่ผ่านการคัดเลือกเข้าศึกษาต่อที่วิทยาลัยเทคนิคกำแพงเพชร<br>
                ในช่วงสถานการณ์การแพร่ระบาดของไวรัสโคโรนา (COVID-19) เพื่อลดความเสี่ยงในการติดเชื้อไวรัส โดยผู้มีสิทธิ์เข้าศึกษาต่อ<br>
                สามารถแจ้งการชำระเงินค่าขึ้นทะเบียนขึ้นทะเบียนผ่านระบบออนไลน์โดยไม่ต้องเดินทางมาที่วิทยาลัยฯ</p>
            <p>หลังจากวิทยาลัยฯ ได้ตรวจสอบหลักฐานการโอนเงินเป็นที่เรียบร้อยแล้วจะประกาศรายชื่อผู้ขึ้นทะเบียนเป็นนักเรียนนักศึกษาผ่านทางเว็บไซต์และเพจของวิทยาลัยต่อไป</p>
            <br>
            <p><b>จึงแจ้งมาเพื่อให้ทราบ<br>วิทยาลัยเทคนิคกำแพงเพชร</b></p><br>


        </div><!-- /.box-body -->
        <div class="box-footer clearfix">งานทะเบียน</div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->