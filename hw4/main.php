<?php
header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Taipei");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta name="generator"
    content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <title>CodeGeo - OL3</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="http://dmplus.cs.ccu.edu.tw/~s403410035/hw4/css/ol.css" media="all" type="text/css" rel="stylesheet" />
    <link href="http://dmplus.cs.ccu.edu.tw/~s403410035/hw4/css/main.css" media="all" type="text/css" rel="stylesheet" />	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css" />
    <script src="js/jquery-2.2.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/ol-debug.js" defer="defer"></script>	
    <script src="answer.js" defer="defer"></script>
  </head>
  <body>
    <h1>Train Station Query System</h1>
    <form id="map_form">
      <p>範圍設定:請介於1至10公里<input type="number" id='range'> <button  id="button"type='button'>送出</button></p>
    </form>
    <div class="wrap">
		<div class="left" id='mapa'></div>
		<table class="right">
			<thead>
				<tr>
					<th>車站名稱</th>
					<th>車站地址</th> 	
					<th>距離(km)</th>
				</tr>
			</thead>
			<tbody id="result"></tbody>
		</table>
    </div>
  </body>
</html>
<script>

</script>
