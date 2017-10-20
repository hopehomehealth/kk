<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=4.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="http://m.ikaiwan.com/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://m.ikaiwan.com/public/css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
    <title>任务列表</title>
    <style>
        .task_img {
            height: auto;
        }

        .task_box {
            padding: 10px;
        }

        .task_img img {
            width: 45px;
            height: 45px;
        }

        #black_overlay {
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index: 99;
            -moz-opacity: 0.5;
            opacity: .50;
        }

        #safari {
            position: fixed;
            top: 0%;
            right: 5%;
            z-index: 100;
            display: none;
            width: 50%;
        }
    </style>
</head>

<body>
<div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;" ><img  onclick="window.history.back(-1);" style="width: 36px;height: 36px;" src="http://m.ikaiwan.com/public/images/back.png"></div>
<!--页面表单-->
<div class="main_fluid">




    <div class="task_box online" onclick="window.open('kaiwan://dianle','_self')">
        <div class="task_img"><img src="http://m.ikaiwan.com/public/images/icon_dianle.png"/></div>
        <div class="task_info"><span class="task_title">点乐</span><br>
            <span class="red2">返现概率为百分之百</span></div>
        <div class="clearfix"></div>
    </div>

    <div class="task_box online" onclick="window.open('kaiwan://beiduo','_self')">
        <div class="task_img"><img src="http://m.ikaiwan.com/public/images/zhuan.png"/></div>
        <div class="task_info"><span class="task_title">贝多</span><br>
            <span class="red2">返现概率为百分之百</span></div>
        <div class="clearfix"></div>
    </div>

    <div class="task_box online" onclick="window.open('kaiwan://youmi','_self')">
        <div class="task_img"><img src="http://m.ikaiwan.com/public/images/icon_youmi.png"/></div>
        <div class="task_info"><span class="task_title">有米</span><br>
            <span class="red2">返现概率为百分之百</span></div>
        <div class="clearfix"></div>
    </div>

</div>
<!--页面表单 over-->

</body>
</html>