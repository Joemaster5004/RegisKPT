<?php
  session_start();
  session_destroy();
  echo"<script language='javascript'>window.location='../admin_login.php';</script>";
?>
