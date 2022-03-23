<section class="content-header">
  <font size="5">
    <b>ระบบจัดการการลงทะเบียน</b>
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
      <font size="4">สรุปนักศึกษาที่มีปัญหาค้างในระบบ</font>
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
          <th width="120">รหัสประชาชน</th>
          <th width="200">ชื่อ-สกุล</th>
          <th width="350">แผนกวิชา1</th>
          <th></th>
        </thead>
        <?php
        $start = 1;
        $condit='status = 3 ORDER BY id DESC';
        $sql = $db->selectAllData('tb_register','*',$condit); 
        foreach ($sql as $row) {
          $stdcode = $row['stdcode'];
          $condition = "stdcode=" . $stdcode;
          $res1 = $db->selectOneData('tb_student', '*', $condition);
          $majorid = $res1['majorid1'];
          $condition2 = "majorid=" . $majorid;
          $res2 = $db->selectOneData('tb_major', '*', $condition2);
          $start++;
        ?>
          <tr>
            <td><?php echo $start; ?></td>
            <td><?php echo $row['stdcode']; ?></td>
            <td><?php echo $row['peopleid']; ?></td>
            <td><?php echo $res1['fullname']; ?></td>
            <td><?php echo $res2['majorid'] . ' - ' . $res2['majorname']; ?></td>
            <td>
              <?php
              $stdcode = $row['stdcode'];
              $condition = 'stdcode=' . $stdcode;
              $sql = $db->selectOneData('tb_register', '*', $condition);
              $img = $sql['image'];
              $status = $sql['status'];
              if ($img != null) {
                if ($status == 3) {
                  echo "<a href='../student/uploads/slip/" . $img . "' target='_blank'><button class='btn btn-block btn-danger btn-xs'><i class='fa fa-warning'></i> ปัญหาลงทะเบียน</button></a>";
                  echo "<center><font size='1px'>" . $sql['regis_date'] . "</font></center>";
                }
              }
              ?>
            </td>
            <td>
              <?php
              if ($img != null) {
                if ($status == 3) {
                  echo "<div class='btn-group'>";
                  echo "<button class='btn btn-primary btn-xs dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                  echo "<i class='fa fa-gear'></i> <span class='caret'></span>";
                  echo "</button>";
                  echo "<ul class='dropdown-menu'>";
                  echo "<li><a href='#' class='unlockRegis' data-id='".$sql['stdcode'] ."'>ปลดล็อค</a></li>";
                  echo "</ul></div>";
                }
              }
              ?>
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
  $('.unlockRegis').click(function(e) {
      e.preventDefault();
      var id=$(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "controller/unlockRegis.php",
        data: {
          id: id,
          function: 'unlockRegis'
        },
        success: function(data) {
          if (data == "success") {
            swal({
              title: "สำเร็จ !",
              text: "ปลดล๊อคเรียบร้อย!!",
              icon: "success",
              buttons: ["ยกเลิก", "ตกลง"],
              dangerMode: true,
            }).then(function(isConfirm) {
              if (isConfirm) {
                window.location.href = "<?php $url; ?>?page=views/unlockRegis";
              }
            })
          }
        }
      });
    });
</script>