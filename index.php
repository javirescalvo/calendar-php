<?php include('calendar.php');?>
<html>
<head>
<link href="public/css/app.css" rel="stylesheet">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <h1>Calendar</h1>
    </div>
    <div class="row no-gutters">
      <?php for($x=1;$x<=12;$x++):?>
        <?=draw_calendar($x);?>
      <?php endfor;?>
    </div>
  </div>
  <script src="public/js/app.js"></script>
</body>
</html>
