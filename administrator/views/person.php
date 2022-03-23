<script type="text/javascript">
  function autoTab(obj, typeCheck) {
    if (typeCheck == 1) {
      var pattern = new String("_-____-_____-__-_"); // กำหนดรูปแบบในนี้
      var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
    }
    var returnText = new String("");
    var obj_l = obj.value.length;
    var obj_l2 = obj_l - 1;
    for (i = 0; i < pattern.length; i++) {
      if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
        returnText += obj.value + pattern_ex;
        obj.value = returnText;
      }
    }
    if (obj_l >= pattern.length) {
      obj.value = obj.value.substr(0, pattern.length);
    }
  }
</script>
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
      <font size="4">ระบบจัดการข้อมูลนักเรียน <a href="person_csv.php"><button class="btn btn-xs btn-danger">เพิ่มไฟล์ CSV</button></a></font>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="person" class="display">
        <thead>
          <th style="width: 10px"><a href="" data-toggle="modal" data-target=".add"><i class="fa fa-plus-square-o"></i></th>
          <th width="60">รหัสประจำตัว</th>
          <th width="80">รหัสประชาชน</th>
          <th width="80">คำนำหน้า</th>
          <th width="150">ชื่อ-สกุล</th>
          <th width="300">แผนกวิชา1</th>
          <th>เบอร์โทร</th>
          <th>ประเภท</th>
          <th style="width: 40px"></th>
        </thead>
        <?php
        $start = 1;
        $sqlstd = $db->selectAllData('tb_student', '*', $condit = null);
        foreach ($sqlstd as $row) {
          $condition1 = "majorid=" . $row['majorid1'];
          $major1 = $db->selectOneData('tb_major', '*', $condition1);
          $condition3 = "cid=" . $row['cid'];
          $cls = $db->selectOneData('tb_class', '*', $condition3);
          $start++;
        ?>
          <tr>
            <td width="50"><?php echo $start; ?></td>
            <td><?php echo $row['stdcode']; ?></td>
            <td><?php echo $row['peopleid']; ?></td>
            <?php
            if ($row['gender'] == 11) {
              $title = "นาย";
            } elseif ($row['gender'] == 12) {
              $title = "เด็กชาย";
            } elseif ($row['gender'] == 21) {
              $title = "นางสาว";
            } else {
              $title = "เด็กหญิง";
            }
            ?>
            <td><?php echo $title; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td width="200"><?php echo $major1['majorname']; ?></td>
            <td width="200"><?php echo $row['telephone']; ?></td>
            <td><?php
                if ($row['regis_cat'] == 11) {
                  echo "ม.3";
                } else if ($row['regis_cat'] == 21) {
                  echo "ปวช.";
                } else {
                  echo "ม.6";
                }
                ?></td>
            <td>
              <div class="btn-group">
                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class='fa fa-gear'></i> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="?page=views/person_edit&id=<?php echo $row['id']; ?>">แก้ไข</a></li>
                  <li><a href="#" data-id="<?php echo $row['id']; ?>" class="delPerson">ลบ</a></li>
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

<div class="modal fade add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <font size="4" class="modal-title">ฟอร์มเพิ่มนักเรียน</font>
      </div>
      <div class="modal-body">
        <!-- form start -->
        <form role="form" name="form1" method="post" action="person.php?insert">
          <div class="box-body">
            <div class="form-group">
              <label>เลขประจำตัว:</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="number" class="form-control" id="stdcode" name="stdcode" placeholder="00000000000" />
              </div>
            </div>
            <div class="form-group">
              <label for="Name (Full name)">รหัสประชาชน</label>
              <div class="input-group">
                <input type="text" name="txtID1" id="txtID1" style="width:30px" maxlength=1 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" /> -
                <input type="text" name="txtID2" id="txtID2" style="width:50px" maxlength=4 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" /> -
                <input type="text" name="txtID3" id="txtID3" style="width:60px" maxlength=5 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" /> -
                <input type="text" name="txtID4" id="txtID4" style="width:40px" maxlength=2 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" /> -
                <input type="text" name="txtID5" id="txtID5" style="width:30px" maxlength=1 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" />
              </div>
            </div>
            <div class="form-group">
              <label>คำนำหน้า</label>
              <select class="form-control" id="gender" name="gender">
                <option value="">--กรุณาเลือกคำนำหน้า--</option>
                <option value="11">นาย</option>
                <option value="12">เด็กชาย</option>
                <option value="21">นางสาว</option>
                <option value="22">เด็กหญิง</option>
              </select>
            </div>
            <div class="form-group">
              <label for="personName">ชื่อ-นามสกุล</label>
              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="กรุณาพิมพ์ชื่อและนามสกุลนักเรียน">
            </div>
            <div class="form-group">
              <label for="birthday">วัน/เดือน/ปี เกิด</label>
              <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="กรุณาเลือกวันเกิด">
            </div>
            <div class="form-group">
              <label for="personName">เบอร์โทรศัพท์</label>
              <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="กรุณาพิมพ์เบอร์โทรศัพท์">
            </div>
            <div class="form-group">
              <label>ระดับชั้น</label>
              <select class="form-control" id="cid" name="cid">
                <option value="">--กรุณาเลือกระดับชั้นที่สมัคร--</option>
                <?php
                $classsql = $db->selectAllData('tb_class', '*', $cond = null);
                foreach ($classsql as $cls) {
                ?>
                  <option value="<?php echo $cls['cid']; ?>"><?php echo $cls['cname']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>สาขาที่เลือกอันดับที่ 1</label>
              <select class="form-control" id="majorid1" name="majorid1">
                <option value="">--กรุณาเลือกแผนกวิชา--</option>
                <?php
                $mjsql1 = $db->selectAllData('tb_major', '*', $cond = null);
                foreach ($mjsql1 as $mjrw1) {
                ?>
                  <option value="<?php echo $mjrw1['majorid']; ?>"><?php echo $mjrw1['majorid']; ?> - <?php echo $mjrw1['majorname']; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label>ประเภทที่สมัคร</label>
              <select class="form-control" id="regis_type" name="regis_type">
                <option value="">--กรุณาเลือกประเภทที่สมัคร--</option>
                <option value="โควตา">โควตา</option>
                <option value="ปกติ">ปกติ</option>
              </select>
            </div>

            <div class="form-group">
              <label>วุฒิที่สมัคร</label>
              <select class="form-control" id="regis_cat" name="regis_cat">
                <option value="">--กรุณาเลือกวุฒิที่สมัคร--</option>
                <option value="11">ม.3</option>
                <option value="21">ปวช.</option>
                <option value="22">ม.6</option>
              </select>
            </div>

            <hr>
          </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-default">บันทึก</button>
      <a href="#"><button type="button" class="btn btn-default btn-right">ยกเลิก</button></a>
    </div>
    </form>
  </div>
</div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2>ข้อมูลสมาชิกรายบุคคล</<h2>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">https://regis.kpt.ac.th</div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#person').DataTable({
        "order": [
          [0, "desc"]
        ],
        "pageLength": 25,
        "responsive": true,
        "processing": true,
      });
    });

   $('.delPerson').click(function(e) {
      e.preventDefault();
      var id=$(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "controller/person.php",
        data: {
          id: id,
          function: 'function_del'
        },
        success: function(data) {
          if (data == "success") {
            swal({
              title: "สำเร็จ !",
              text: "ลบข้อมูลเรียบร้อย!!",
              icon: "success",
              buttons: ["ยกเลิก", "ตกลง"],
              dangerMode: true,
            }).then(function(isConfirm) {
              if (isConfirm) {
                window.location.href = "<?php $url; ?>?page=views/person";
              }
            })
          }
        }
      });
    });

  //กรอกรหัสประชาชน
  function Numbers(e) {
    var keynum;
    var keychar;
    var numcheck;
    if (window.event) { // IE
      keynum = e.keyCode;
    } else if (e.which) { // Netscape/Firefox/Opera
      keynum = e.which;
    }
    if (keynum == 13 || keynum == 8 || typeof(keynum) == "undefined") {
      return true;
    }
    keychar = String.fromCharCode(keynum);
    numcheck = /^[0-9]$/;
    return numcheck.test(keychar);
  }

  function keyup(obj, e) {
    var keynum;
    var keychar;
    var id = '';
    if (window.event) { // IE
      keynum = e.keyCode;
    } else if (e.which) { // Netscape/Firefox/Opera
      keynum = e.which;
    }
    keychar = String.fromCharCode(keynum);

    var tagInput = document.getElementsByTagName('input');
    for (i = 0; i <= tagInput.length; i++) {
      if (tagInput[i] == obj) {
        var prevObj = tagInput[i - 1];
        var nextObj = tagInput[i + 1];
        break;
      }
    }
    if (obj.value.length == 0 && keynum == 8) prevObj.focus();

    if (obj.value.length == obj.getAttribute('maxlength')) {
      for (i = 0; i <= tagInput.length; i++) {
        if (tagInput[i].id.substring(0, 5) == 'txtID') {
          if (tagInput[i].value.length == tagInput[i].getAttribute('maxlength')) {
            id += tagInput[i].value;
            if (tagInput[i].id == 'txtID5') break;
          } else {
            tagInput[i].focus();
            return;
          }
        }
      }
      if (checkID(id)) nextObj.focus();
      else alert('รหัสประชาชนไม่ถูกต้อง');
      nextObj.focus();
    }

  }

  function checkID(id) {
    if (id.length != 13) return false;
    for (i = 0, sum = 0; i < 12; i++)
      sum += parseFloat(id.charAt(i)) * (13 - i);
    if ((11 - sum % 11) % 10 != parseFloat(id.charAt(12)))
      return false;
    return true;
  }
</script>