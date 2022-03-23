<?php  
    $condit="cid=1";
    $sql = $db->selectAllData('tb_major','*',$condit);

    $condition="cid=1";
    $sqlCount = $db->selectOneData('tb_student','count(*) as cn',$condition);

    $condit2="std_class=1";
    $sqlRegis = $db->selectOneData('tb_register','count(*) as rs',$condit2);
?>
<div class="wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php
            $percent = 0;
            foreach ($sql as $row){
              $condit="majorid1=".$row['majorid'];
              $sqlPvc = $db->selectOneData('tb_student','count(*) as pvc',$condit);

              $condit1="majorid=".$row['majorid'];
              $sqlPvc1 = $db->selectOneData('tb_register','count(*) as pvc1',$condit1);

              $percent = @(($sqlPvc1['pvc1']*100)/$sqlPvc['pvc']);
          ?>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="showDetailPvc.php?id=<?php echo $row['majorid']; ?>"><div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
              <div class="info-box-content">
                <span class="info-box-number"><?php echo $row['majorid'].'-'.$row['majorname'] ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $percent; ?>%"></div>
                </div>
                <span class="progress-description">ลงทะเบียนแล้ว <?php echo $sqlPvc1['pvc1']; ?>  คน</span>
                <span class="progress-description">จากทั้งสิ้น <?php echo $sqlPvc['pvc']; ?> คน คิดเป็น <?php echo number_format($percent,2,'.',','); ?>  %</span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
            </a></div>
            <?php } ?>

        </div>
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div>
