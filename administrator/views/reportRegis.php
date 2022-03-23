<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>นักเรียน</small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">นักเรียน</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">สรุปการรายงานตัวออนไลน์ <a href="?page=views/report_excel">[Export Excel]</a></font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="products" class="display">
        <thead>
          <th style="width: 10px">#</th>
          <th width="100">รหัสประจำตัว</th>
          <th width="200">ชื่อ-สกุล</th>
          <th width="350">แผนกวิชา1</th>
          <th width="120">เบอร์โทร</th>
          <th>ยอดเงิน</th>
          <th></th>
          <th></th>
        </thead>
        <?php
        $start = 1;
        $condit = 'id ORDER BY id DESC';
        $sql = $db->selectAllData('tb_student', '*', $condit);
        foreach ($sql as $row) {
          $mj1 = $row['majorid1'];

          $condition1 = "majorid=" . $mj1;
          $major1 = $db->selectOneData('tb_major', '*', $condition1);
          $start++;
        ?>
          <tr>
            <td><?php echo $start; ?></td>
            <td><?php echo $row['stdcode']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $major1['majorname']; ?></td>
            <td><?php echo $row['telephone']; ?></td>
            <?php
            $condition = 'stdcode=' . $row['stdcode'];
            $sqlrg = $db->selectOneData('tb_register', '*', $condition);
            $status = @($sqlrg['status']);
            echo "<td>" . @($sqlrg['money']) . "</td>";
            echo "<td>";
            if ($status == 1) {
              echo "<a href='../student/uploads/slip/" . $sqlrg['image'] . "' target='_blank'><button class='btn btn-block btn-warning btn-xs'><i class='fa fa-warning'></i> รออนุมัติ</button></a>";
              echo "<center><font size='1px'>" . @($sql['regis_date']) . "</font></center>";
            } else if ($status == 2) {
              echo "<a href='../student/uploads/slip/" . @($sqlrg['image']) . "' target='_blank'><button class='btn btn-block btn-success btn-xs'><i class='fa fa-check'></i> ลงทะเบียนแล้ว</button></a>";
              echo "<center><font size='1px'>" . @($sqlrg['regis_date']) . "</font></center>";
            } else {
              echo "<button class='btn btn-block btn-danger btn-xs'><i class='fa fa-close'></i> ไม่ลงทะเบียน</button>";
            }
            echo "</td>";
            ?>
            <td>
              <div class="btn-group">
                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class='fa fa-gear'></i> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#" data-id="<?php echo $row['stdcode']; ?>" class="updateRegis">อนุมัติ</a></li>
                  <li><a href="#" data-id="<?php echo $row['stdcode']; ?>" class="regisCancle">ยกเลิก</a></li>
                </ul>
              </div>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
    </div><!-- /.box-footer-->
  </div><!-- /.box -->
</section><!-- /.content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#reportRegis').DataTable({
        //"ajax": 'controller/reportRegis_ajax.php',
        "order": [
          [0, "desc"]
        ],
        "pageLength": 25,
        "responsive": true,
        "processing": true,
      });
    });

  $('.updateRegis').click(function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
      type: "POST",
      url: "controller/reportRegis.php",
      data: {
        id: id,
        function: 'updateRegis'
      },
      success: function(data) {
        if (data == "success") {
          swal({
            title: "สำเร็จ !",
            text: "ยกเลิกเรียบร้อย!!",
            icon: "success",
            buttons: ["ยกเลิก", "ตกลง"],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
              window.location.href = "<?php $url; ?>?page=views/reportRegis";
            }
          })
        }
      }
    });
  });

  $('.regisCancle').click(function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
      type: "POST",
      url: "controller/reportRegis.php",
      data: {
        id: id,
        function: 'regisCancle'
      },
      success: function(data) {
        if (data == "success") {
          swal({
            title: "สำเร็จ !",
            text: "อนุมัติเรียบร้อย!!",
            icon: "success",
            buttons: ["ยกเลิก", "ตกลง"],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
              window.location.href = "<?php $url; ?>?page=views/reportRegis";
            }
          })
        }
      }
    });
  });
</script>
