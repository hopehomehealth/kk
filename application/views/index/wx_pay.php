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
    <script src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var click = 1;

            $("#send").click(function () {
                click = click+1;
                if(click >2){
                    alert("您已经申请提现");
                    return false;
                }
                var jump_url = "/welcome/pay_list";
                var data = {};
                data.money = $(".glyphicon").text();
                data.money = $("#money").text();
                if (data.money < 10) {
                    $("#check").text('对不起，您提现的金额小于10元').css('display', 'block');
                    return;
                }
                $.ajax({
                    url: '/welcome/post_wx_pay',// 跳转到 action
                    data: data,
                    type: 'post',
                    dataType: 'json',
                    success: function (res) {
                        console.log(res);
                        if (res.code == 200) {
                            alert("您申请的兑换，已提交给系统。");
                            window.open(jump_url, '_self');
                        } else {
                            alert("您已经申请提现");
                            window.open(jump_url, '_self');
                            return false;
                        }
                    }
                });
            });

        });
    </script>
    <title>支付宝提现</title>
    <style>
        .submit {
            background-color: #0065A3;
            width: 100%;
            text-align: center;
        }

        .alert {
            display: none;
        }

        .panel {
            margin-bottom: 0px;
        }
    </style>
</head>

<body>
<div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;"><img
        onclick="window.history.back(-1);" style="width: 36px;height: 36px;"
        src="http://m.ikaiwan.com/public/images/back.png"></div>
<div class="container-fluid">


    <div class="panel panel-default" style="margin-top: 20px;">
        <div class="panel-heading">支付宝提现</div>
        <div class="panel-body clear">
            <div class="alert alert-danger" role="alert" id="check"></div>

            <div style="text-align: center;margin-bottom: 10px;">
                <h4><?=get_cookie('user_name')?></h4>
                <img style="border-radius: 10px;width: 120px;height: auto;" src="<?=get_cookie('user_ico')?>" />
            </div>

            <div class="form-group" style="text-align: center;">
                <label for="exampleInputEmail2">可提现金额</label>
                <span id="money" style="margin-left: 20px;margin-right:20px;color: #B92324;font-size: 18px;"
                      class="glyphicon glyphicon-jpy" aria-hidden="true"><?=$balance?></span>
                <label for="exampleInputEmail2">（元）</label>
            </div>
            <div class="form-group" id="send">
                <button class="btn btn-primary submit" >申请提现</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary submit" href="/welcome/pay_list">提现记录</a>
            </div>
        </div>
    </div>

    <div class="alert-danger" role="alert" style="text-align: center;padding: 5px;border-radius: 5px;">
        申请提现成功后，将在24小时之内到账，提现过程中将会收取1元作为手续费。
    </div>
</div>


</body>
</html>