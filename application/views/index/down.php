<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta charset="utf-8">
    <link href="http://m.ikaiwan.com/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://m.ikaiwan.com/public/css/style.css" rel="stylesheet" type="text/css">
    <title>下载开玩</title>
    <style>
        #maskLayer {
            display: none;
            width: 100%;
            height: 900px;
            background-color: #000000;
            opacity: 0.5;
            -moz-opacity: 0.5;
            filter: alpha(opacity=50);
        }
    </style>
</head>

<body style=" background:#fff;">
<div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;"><img
        onclick="window.history.back(-1);" style="width: 36px;height: 36px;"
        src="http://m.ikaiwan.com/public/images/back.png"></div>
<div class="main_fluid">
    <div class="app_info" style="margin: 0px auto;margin-top: 50px;">
        <div class="icon_hu" style=" background:#fff;"><img src="http://m.ikaiwan.com/public/images/Icon-76.png"></div>
        <span class="app_name">开玩</span><br>
        <span class="app_version">v<span class="app_version_num">1.4</span></span>
    </div>
    <div class="app_download_info">下载安装后，请尽快打开客户端<br>开玩显示登录成功前，请勿关闭该页面</div>
    <div class="app_download_btn">
        <button>点击下载开玩</button>
    </div>
</div>

<div id="maskLayer">遮罩层</div>
</body>
</html>
<script type="text/javascript" src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
<script>

    var u = navigator.userAgent, app = navigator.appVersion;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

    function isWeiXin(){
        var ua = window.navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            return true;
        }else{
            return false;
        }
    }

    $(document).ready(function(){
        $("button").click(function(){
            if(isWeiXin()){
                alert("请从浏览器打开");return;
            }else{
                if(isAndroid){
                    location.href="http://www.pgyer.com/akaiwan";
                }
                if(isiOS){
                    location.href="https://www.pgyer.com/nuaq";
                }
            }
        });
    });
</script>
