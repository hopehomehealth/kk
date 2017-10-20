<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>IOS9用户</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="http://m.ikaiwan.com/public/css/swiper.min.css">

    <!-- Demo styles -->
    <style>
        html, body {
            position: relative;
            height: 100%;
        }

        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>
</head>
<body>
<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div>
                <img src="http://m.ikaiwan.com/public/images/ll_1.png" style="width: 90%;height: auto;">
                <br/>
                <label style="color: #B92324;">1.打开设置----> 通用</label>
            </div>
        </div>
        <div class="swiper-slide">
            <div>
                <img src="<?=base_url();?>/public/img/setting.png" style="width: 90%;height: auto;">
                <br/>
                <label style="color: #B92324;">2.通用 -----> 设备管理</label>
            </div>
        </div>
        <div class="swiper-slide">
            <div>
                <img src="<?=base_url()?>/public/img/desfile.png" style="width: 90%;height: auto;">
                <br/>
                <label style="color: #B92324;">3.描述文件 -----> 开玩钥匙</label>
            </div>
        </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>

<!-- Swiper JS -->
<script src="http://m.ikaiwan.com/public/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true
    });
</script>
</body>
</html>