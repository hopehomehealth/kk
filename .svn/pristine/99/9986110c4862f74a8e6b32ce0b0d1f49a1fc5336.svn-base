<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> <!doctype html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="http://m.ikaiwan.com/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://m.ikaiwan.com/public/css/style.css" rel="stylesheet" type="text/css">
    <title>收入明细</title></head>
<body> <!--页面表单-->
<div class="main_fluid">
    <div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;"><img
            onclick="window.history.back(-1);" style="width: 36px;height: 36px;"
            src="http://m.ikaiwan.com/public/images/back.png"><span style="text-align: center;">最近收入</span></div>
    <div class="hongbao_list"></div>
</div>
<!--页面表单 over--> </body>
</html>
<script type="text/javascript" src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
<script> $(document).ready(function () {
        var html = "";
        $.post("/welcome/income_ajax", "", function (res) {
            for (var i = 0; i < res.length; i++) {
                html += '<div class="hongbao_box"> ' + '<div class="hongbao_img"><img src="http://m.ikaiwan.com/public/images/hongbao.png"></div> ' + '<div class="hongbao_info">我 ' + '<span class="gray"> ' + res[i].time + '</span><br>' + res[i].appname + '<span class="red">' + res[i].money + '</span> 元' + '</div> ' + '<div class="clearfix"></div> </div>';
            }
            $(".hongbao_list").html(html);
        }, "json");
    }); </script>
