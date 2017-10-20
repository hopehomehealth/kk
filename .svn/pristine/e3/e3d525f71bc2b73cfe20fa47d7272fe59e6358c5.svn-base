<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 header("refresh:3;url=$url");
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=4.0, user-scalable=no" />
<title>出错啦！</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px 0px 0px 0px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
	
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
	text-align:center;
}

p {
	margin: 12px 15px 12px 15px;
}

.bg{
    text-align: left;
    background-size: contain;
    background-repeat: no-repeat;
    background-position:right center;
    background-image: url("/application/public/image/404.jpg");
    min-height: 100px;
}
</style>
</head>
<body>
	<div id="container" style="border-radius:6px;">
		<h1><?php echo $heading; ?></h1>
        <div class="bg">
            <?php echo $message; ?>
            <p>系统将在<strong style="color:red;">三秒</strong>后 跳转</p>
            <p>点击<a href="/">这里</a>直接跳转到首页</p>
        </div>

	</div>
</body>
</html>