<!-- Content Header (Page header) -->
<section class="content-header">
  <font size="5">
    <b>ระบบจัดการข้อมูล</b>
    <small>จัดการ QRCODE</small>
  </font>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li class="active">QRCODE</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <font size="4">ระบบจัดการ QRCODE [<a href="?page=views/qrcode_add"> เพิ่ม QR </a>]</font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
    <table id="qrcode" class="display">
        <thead>
          <th width="5%">#</th>
          <th width="10%">รหัสประจำตัว</th>
          <th>ชื่อ-นามสุกล</th>
          <th></th>
          <th></th>
        </thead>
        <?php
        $start = 0;
        $sqlstd = $db->selectAllData('tb_qrcode', '*', $condit = null);
        foreach ($sqlstd as $row) {
          $sqlstd1 = $db->selectOneData('tb_student', '*', $condit1 = 'stdcode='.$row['stdcode']);
          $start++;
        ?>
          <tr>
            <td><?php echo $start; ?></td>
            <td><?php echo $row['stdcode']; ?></td>
            <td><?php echo $sqlstd1['fullname']; ?></td>
            <td><a href="" data-id="<?php echo $row['id'] ?>" class="chk_qr"><i class='fa fa-qrcode'></i></a></td>
            <td><button data-id="<?php echo $row['id'] ?>" class="btn btn-xs btn-danger delQrcode"><i class='fa fa-trash'></i></button></td>
          </tr>
        <?php } ?>
      </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
      https://regis.kpt.ac.th
    </div><!-- /.box-footer-->
  </div><!-- /.box -->

  <!-- Modal -->
<div class="modal fade" id="modalQrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">QRCODE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <div id="show_qr"></div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#qrcode').DataTable({
        "order": [
          [0, "desc"]
        ],
        "pageLength": 25,
        "responsive": true,
        "processing": true,
      });
    });

    $('.chk_qr').click(function(e) {
      e.preventDefault();
      var id=$(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "controller/qrcode.php",
        data: {
          id: id,
          function: 'check_qr'
        },
        dataType: "JSON",
        success: function(data) {
          $('#modalQrcode').modal('show');
          $('#show_qr').html('<img src="uploads/qrcode/' + data.img + '" />');
        }
      });
    });

    $('.delQrcode').click(function() {
      var id=$(this).attr('data-id');
      swal({
        title: "ลบรายการนี้หรือไม่?",
        text: "เมื่อรายการนี้ถูกลบ คุณไม่สามารถกู้คืนได้!!",
        icon: "warning",
        buttons: ['ยกเลิก','ตกลง'],
        dangerMode: true
      }).then(function(isConfirm) {
        if (isConfirm) {
          swal("ลบสำเร็จ!","ข้อมูลถูกลบเรียบร้อยแล้ว.","success");			
          $.ajax({
            type: "POST",
            url: "controller/qrcode.php",
            data: {id:id,function:'function_del'},
            success: function(data){
              
            }
          });

          setTimeout(function(){
            location.reload();
          },1500);

        } else {
          swal("ยกเลิก!" , "ลบผิดพลาด กรุณาลองใหม่!", "error");
        }
      })
    })
  </script>