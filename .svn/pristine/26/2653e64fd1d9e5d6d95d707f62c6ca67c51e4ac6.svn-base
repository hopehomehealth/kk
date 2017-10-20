<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta charset="utf-8">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/swiper.min.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <title>下载开玩</title>

    <style>
        body {
            background-color: #f3f6f8;
        }

        .head {
            width: 100%;
            height: 280px;
            background-color: #198abf;
            text-align: center;
        }

        .head_content {
            margin: 0 auto;
            padding-top: 10px;
        }

        /*.head_content img{width: 80%;height: 150px;}*/
        .head_title h2 {
            font-family: cursive;
        }

        .head_title h4 {
            color: #B92324;
        }

        .head_down {
            width: 50%;
            height: 60px;
            margin: 0 auto;
            margin-top: 20px;
            background-color: #a0cbdf;
            border-radius: 10px;
            line-height: 60px;
        }

        .head_down label {
            color: #fff;
            font-size: 16px;
        }

        .rank {
            width: 90%;
            height: 240px;
            margin: 0 auto;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 6px;
        }

        .rank_list_pic {
            width: 15%;
            display: inline-block;
            height: 240px;
            vertical-align: top;
            border-radius: 6px;
        }

        .rank_list_pic_text {
            text-align: center;
            vertical-align: middle;
            font-size: 30px;
            line-height: 80px;
            color: #666;
        }

        .rank_list {
            width: 80%;
            display: inline-block;
            vertical-align: top;
        }

        .rank_list img {
            width: 60px;
            height: 60px;
        }

        .rank_first {
            height: 80px;
            border-bottom: 1px solid #ccc;
        }

        .rank_list img {
            margin-left: 15px;
            display: inline-block;
            vertical-align: middle;
            text-align: left;
            margin-top: 10px;
            border-radius: 50%;
        }

        .rank_list p {
            margin-left: 10%;
            display: inline-block;
            vertical-align: middle;
            text-align: right;
            margin-top: 20px;
        }

        .rank_second {
            height: 80px;
            border-bottom: 1px solid #ccc;
        }

        .rank_three {
            height: 80px;
        }

        .reward {
            width: 90%;
            height: 80px;
            margin: 0 auto;
            margin-top: 6px;
            background-color: #ffffff;
            border-radius: 6px;
            box-shadow: 1px 1px 3px #A9A8A8;
            opacity: 0.8;
        }

        .reward_wrap {
            width: 90%;
            margin: 0 auto;
        }

        .reward_img {
            display: inline-block;
            line-height: 80px;
            vertical-align: top;
        }

        .reward_img img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            line-height: 80px;
        }

        .reward_info {
            margin-left: 8%;
            width: 70%;
            display: inline-block;
            vertical-align: middle;
            line-height: 18px;
            font-size: 12px;
            padding-top: 20px;
        }

        .clear {
            clear: both;
        }

        .body_bottom {
            height: 40px;
        }

        #black_overlay {
            display: none;
            position: absolute;
            top: 82px;
            left: 0%;
            width: 100%;
            height: 250%;
            background-color: black;
            z-index: 99;
            -moz-opacity: 0.6;
            opacity: .60;
            text-align: center;
        }

        #safari {
            position: fixed;
            top: 0%;
            right: 5%;
            z-index: 100;
            display: none;
            width: 50%;
        }

        #maskLayer {
            width: 100%;
            height: 900px;
            background-color: #000000;
            opacity: 0.5;
            -moz-opacity: 0.5;
            filter: alpha(opacity=50);
            position: fixed;
            top: 0px;
            left: 0px;
        }

        .swiper-container {
            position: fixed;
            top: 10%;
            left: 5%;
            width: 85%;
            height: 80%;
            border-radius: 10px;
            z-index: 999;
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

<div class="wrap">
    <div class="head">
        <div class="head_content">
            <!--<img src="public/images/kaiwan.png" />-->
            <h1 style="font-size: 60px;color: #ffffff;word-spacing: 5px;">开玩</h1>
            <h6 style="font-size: 14px;color: #ffffff;letter-spacing: 2px;">ikaiwan.com</h6>
        </div>
        <div class="head_title"><h2 style="font-size: 18px;color: #ffffff;word-spacing: 4px;">一款能用手机赚钱的APP</h2>
            <h4 onclick="location.href='/son/notice'">IOS9用户请点我</h4>
        </div>
        <a href="javascript:void(0);" onclick="jump()">
            <div class="head_down"><label>下载开玩钥匙</label></div>
        </a>
    </div>
    <div class="rank">
        <div class="rank_list_pic">
            <div class="rank_list_pic_text">
                ①
            </div>
            <div class="rank_list_pic_text">
                ②
            </div>
            <div class="rank_list_pic_text">
                ③
            </div>
        </div>
        <div class="rank_list">
            <div class="rank_first">
                <img src="http://m.ikaiwan.com/public/images/avatar.jpeg"/>

                <p>
                    <strong>姐只是个传说</strong>
                    <br/>
                    <strong>共赚 <label style="color: #DC143C;">89,362</label> 元 </strong>
                </p>
            </div>
            <div class="rank_second">
                <img src="http://img5.duitang.com/uploads/item/201408/28/20140828140102_zCjmR.jpeg"/>

                <p>
                    <strong>萌萌哒</strong>
                    <br/>
                    <strong>共赚 <label style="color: #DC143C;">62,372</label> 元 </strong>
                </p>
            </div>
            <div class="rank_three">
                <img src="http://www.wzfzl.cn/uploads/allimg/140211/1_140211114657_2.jpg"/>

                <p>
                    <strong>糍粑</strong>
                    <br/>
                    <strong>共赚 <label style="color: #DC143C;">52,726</label> 元 </strong>
                </p>
            </div>
        </div>

        <div style="width: 61px;height: 61px; position:relative; left:-8px;top:-248px;z-index:999;">
            <img src="http://m.ikaiwan.com/public/images/rank.png" style="width: 60px;height: 60px;"/>
        </div>

    </div>


    <div id="look_friend" style="width:90%;margin:0 auto;padding: 10px;text-align: center;color: #666;">
        -----------看看朋友们赚了多少-----------
    </div>

    <div class="reward" style="display: none;">
        <div class="reward_wrap">
            <div class="reward_img">
                <img src="public/images/avatar.jpeg"/>
            </div>
            <div class="reward_info">
                <strong>Heartless</strong>&nbsp;&nbsp;<label style="color:#CCC;">55秒前</label><br/>
                <strong>完成:限时推荐 《驴妈妈旅游》 赚了 <label style="font-weight:100;color:red;">1.5</label> 元</strong>
            </div>
            <div class="clear">
            </div>
        </div>
    </div>

    <div class="body_bottom">
    </div>


    <img id='safari' src="/public/images/safari.png"/>

    <div id="black_overlay"></div>

</div>

</body>

</html>
<script>
    $(document).ready(function () {
        $.post(
            "/son/share_ajax.php",
            "",
            function (res) {
                var html_str = '';
                for (var i = 0; i < res.length; i++) {
                    html_str += '<div class="reward">'
                    + '<div class="reward_wrap">'
                    + '<div class="reward_img">'
                    + '<img src="' + res[i].headimgurl + '" />'
                    + '</div>'
                    + '<div class="reward_info">'
                    + '<strong>' + res[i].nickname + '</strong>&nbsp;&nbsp;<label style="color:#CCC;">' + res[i].time + '</label><br />'
                    + '<strong>完成: 《 ' + res[i].appname + '》 赚了 <label style="font-weight:100;color:red;">' + res[i].money + '</label> 元</strong>'
                    + '</div>'
                    + '<div class="clear">'
                    + '</div>'
                    + '</div>'
                    + '</div>';
                }
                $(".reward").after(html_str);
            }, "json"
        );
    });
</script>
<script>
    function isWeiXin() {
        var ua = window.navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == 'micromessenger') {
            return true;
        } else {
            return false;
        }
    }
    function alterShow() {
        document.getElementById('black_overlay').style.top = 0;
        document.getElementById('black_overlay').style.display = "block";
        document.getElementById('safari').style.display = "block";
    }


    function jump() {
        if (isWeiXin() == true) {
            alterShow();
            return;
        }
        if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
            window.location.href = "http://fir.im/kaiwan";
        } else if (/(Android)/i.test(navigator.userAgent)) {
            window.location.href = "http://m.ikaiwan.com/kaiwan.apk";
        } else {
//            window.location.href ="pc.html";
        }
    }

</script>