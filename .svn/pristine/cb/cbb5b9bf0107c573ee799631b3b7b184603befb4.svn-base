<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="http://m.ikaiwan.com/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://m.ikaiwan.com/public/css/style.css" rel="stylesheet" type="text/css">
    <title>主界面</title>
    <style>
        .info {
            height: 240px;
            width: 100%;
            background-color: #178ac1;
        }

        .person {
            height: 150px;
            width: 90%;
            background-color: #097cb3;
            margin-left: auto;
            margin-right: auto;
            border-radius: 6px;
            position: absolute;
            top: 10px;
            left: 5%;
        }

        .person_other {
            height: 50px;
            width: 90%;
            position: relative;
            top: 175px;
            left: 5%;
        }

        .float_left {
            float: left;
        }

        .float_right {
            float: right;
        }

        .person_other_left {
            display: inline-block;
            width: 48%;
            height: 49px;
            background-color: #097cb3;
            border-radius: 6px;
            text-align: center;
            line-height: 49px;
        }

        .person_other_right {
            display: inline-block;
            width: 48%;
            height: 49px;
            background-color: #097cb3;
            border-radius: 6px;
            text-align: center;
            line-height: 49px;
        }

        .person_img {
            display: inline-block;
            width: 48%;
            height: 149px;
            text-align: center;
            line-height: 60px;
        }

        .person_img img {
            height: 80px;
            width: 80px;
            border-radius: 50%;
            margin-top: 20px;
        }

        .person_img label {
            height: 30px;
            text-align: center;
            display: block;
        }

        .person_info {
            display: inline-block;
            width: 48%;
            height: 149px;
            text-align: center;
            line-height: 120px;
        }

        .person_info span {
            display: block;
            width: auto;
            height: 20px;
            margin-bottom: 10px;
            font-size: 18px;
            text-align: center;
        }

        .person_info label {
            display: block;
            width: auto;
            height: 100px;
            font-size: 32px;
            text-align: center;
        }

        .task_active, .task_gray {
            margin: 2px auto;
        }

        .tc_cont {
            padding: 16px 30px 15px 30px;
        }

        .tc_cont p strong {
            color: #B92324;
        }

        p {
            color: #666666;
        }
    </style>
    <script type="text/javascript" src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

            $.post(
                "/welcome/index_ajax",
                "",
                function (res) {
                    $(".person_img img").attr("src", res.headimgurl);
                    $(".person_info label").text(res.money.toFixed(2));
                    $(".person_img label").text("ID:" + res.id);
                    $(".person_other_left").text("今日收入" + res.day_income + "元");
                    $(".person_other_right").text("今日收徒" + res.day_st_count + "个");

                },
                "json"
            );

            $("#update").click(function () {
                location.href = '/welcome/down';
            });
            $("#give_up_update").click(function () {
                $("#tc_box").hide();
            });


        });
    </script>
</head>

<body>

<div id="tc_box" <?php if(true == $ver): ?>style="display:none" <?php endif;?> >
    <div class="tc_box">
        <div class="tc_cont">
            <p style="margin: 0;text-align: left;overflow: hidden;">
                <strong>更新版本：</strong><br/>
                1、优化送分流程。<br/>
                2、解决网络卡的问题。<br/>
            </p>
            <a id="update" class="task_active" style="font-size: 12px;">更新新版本</a><br>
            <a id="give_up_update" class="task_gray" style="font-size: 12px;">放弃更新</a>
        </div>
    </div>
</div>


<!--页面表单-->

<div class="main_fluid">

    <div class="info">
        <div class="person">
            <div class="person_img float_left">
                <img src="<?= $user_ico ?>">
                <label>ID:<?= $user_id ?></label>
            </div>
            <div class="person_info float_right">
                <span>我的余额（元）</span>
                <label>0.00</label>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="person_other">
            <div class="person_other_left float_left">
                今日收入0.00元
            </div>
            <div class="person_other_right float_right">
                今日收徒0个
            </div>
            <div style="clear: both;"></div>
        </div>

    </div>


    <div class="menu">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="menu_table">
            <tr>
                <td onClick="window.open('/welcome/income','_self')">
                    <button class="btn"
                        >
                        明细
                    </button>
                </td>
                <td onClick="window.open('/welcome/down','_self')">
                    <button class="btn"
                        >
                        下载开玩钥匙
                    </button>

                </td>
               <!-- <td onclick="window.open('/activity','_self')">
                    <button class="btn">每日抽奖</button>
                </td>-->
                <td style="border-left:none;" onClick="window.open('/welcome/more','_self')">
                    <button class="btn">
                        更多
                    </button>
                </td>
            </tr>
        </table>
    </div>
    <div class="list_box">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">

            <tr onClick="window.open('/task','_self')">
                <td width="10%" align="center" class="img_scan"><img
                        src="http://m.ikaiwan.com/public/images/guanfang.png"></td>
                <td>开玩官方任务</td>
                <td align="right"><span class="text-muted">100%返现</span> <span class="arror"><img
                            src="http://m.ikaiwan.com/public/images/arror.png"></span></td>
            </tr>

            <tr onClick="window.open('/user/hezuo','_self')">
                <td align="center" class="img_scan"><img src="http://m.ikaiwan.com/public/images/hezuo.png"></td>
                <td>开玩合作任务</td>
                <td align="right"><span class="text-muted">第三方平台</span> <span class="arror"><img
                            src="http://m.ikaiwan.com/public/images/arror.png"></span></td>
            </tr>

            <tr onClick="window.open('/son','_self')">
                <td align="center" class="img_scan"><img src="http://m.ikaiwan.com/public/images/shoutu.png"></td>
                <td>收徒立奖<label style="color: #CC0000;">三</label>元</td>
                <td align="right"><span class="text-muted">奖励+提成</span> <span class="arror"><img
                            src="http://m.ikaiwan.com/public/images/arror.png"></span></td>
            </tr>
            <tr onClick="window.open('/activity','_self')">
                <td align="center" class="img_scan"><img src="<?=base_url()?>/public/img/jiang.png"></td>
                <td>天天喜抽大奖</td>
                <td align="right"><span class="text-muted">收徒即可抽奖</span> <span class="arror"><img
                            src="http://m.ikaiwan.com/public/images/arror.png"></span></td>
            </tr>
            <tr onClick="window.open('/welcome/pay','_self')">
                <td align="center" class="img_scan"><img src="http://m.ikaiwan.com/public/images/tixian.png"></td>
                <td>提现收入囊中</td>
                <td align="right"><span class="text-muted">支付宝提现</span> <span class="arror"><img
                            src="http://m.ikaiwan.com/public/images/arror.png"></span></td>
            </tr>

            <!-- <?php if(is_null(get_cookie('user_openid'))):?> -->
            <!-- <tr onClick="window.open('/user/webchat','_self')">
                <td align="center" class="img_scan"><img src="http://m.ikaiwan.com/public/images/weixin.png"></td>
                <td>微信</td>
                <td align="right"><span class="text-muted">微信绑定</span> <span class="arror"><img
                            src="http://m.ikaiwan.com/public/images/arror.png"></span></td>
            </tr> -->
            <!-- <?php endif;?> -->
            <tr onClick="window.open('/welcome/rank','_self')">
                <td align="center" class="img_scan"><img src="http://m.ikaiwan.com/public/images/fubusi.png"></td>
                <td>福布斯排行榜</td>
                <td align="right"><span class="text-muted">收入排行</span> <span
                        class="arror"><img src="http://m.ikaiwan.com/public/images/arror.png"></span></td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
