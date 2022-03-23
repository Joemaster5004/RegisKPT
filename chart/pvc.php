<?php
  session_start();
  error_reporting(~E_NOTICE);
  require_once 'lib/config.inc.php';

  $db = new MySqlConn;
  $db->connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>KPT: Regis Chart</title>
</head>
<body >
<?Php
  $cid = "1";
  $cond = "cid=".$cid." GROUP BY majorid1";
  $sql = $db->selectAllData('tb_student','majorid1,COUNT(*)',$cond);
  $php_data_array = Array();
  foreach($sql as $row){
    $php_data_array[] = $row;
  }

  echo "<script>var my_2d = ".json_encode($php_data_array)."</script>";
?>


<div id="chart_div"></div>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(draw_my_chart);

    function draw_my_chart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'majorid1');
      data.addColumn('number', 'value');
		  for(i = 0; i < my_2d.length; i++)
        data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
        var options = {title:'ระดับชั้น ปวช.',
                       width:600,
                       height:500};
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
</html>







