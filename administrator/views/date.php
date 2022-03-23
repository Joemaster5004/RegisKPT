<?php
  $y=date("Y")+543;
  if(date("m")=="01"){
    $m = " มกราคม ";
  }elseif (date("m")=="02") {
    $m = " กุมภาพันธ ์";
  }
  elseif (date("m")=="03") {
    $m = " มีนาคม ";
  }elseif (date("m")=="04") {
    $m = " เมษายน ";
  }elseif (date("m")=="05") {
    $m = " พฤษภาคม ";
  }elseif (date("m")=="06") {
    $m = " มิถุนายน ";
  }elseif (date("m")=="07") {
    $m = " กรกฏาคม ";
  }elseif (date("m")=="08") {
    $m = " สิงหาคม ";
  }elseif (date("m")=="09") {
    $m = " กันยายน ";
  }elseif (date("m")=="10") {
    $m = " ตุลาคม ";
  }elseif (date("m")=="11") {
    $m = " พฤษจิกายน ";
  }else{
    $m = " ธันวาคม ";
  }
  $d=date("d");
  $date=$d.$m.$y;
  $y2=date("Y")+543;
  $m2=date("m");
  $date2=$d."/".$m2."/".$y2;
  //$date2=date("Y-m-d");
  $time=date("H:i:s");
?>
