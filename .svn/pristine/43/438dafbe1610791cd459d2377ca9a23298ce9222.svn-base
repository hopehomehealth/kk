<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=4.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="http://m.ikaiwan.com/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://m.ikaiwan.com/public/css/style.css" rel="stylesheet" type="text/css">
    <title>关于</title>
    <script type="text/javascript" src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
    <script>

        $(document).ready(function(){

            $("button").click(function(){
                var data = {"user_id" : "<?=get_cookie('user_id')?>" , "wx_user_id" : $("input[name='verify']").val() };
                $.post(
                    "/user/confim_webchat",
                    data,
                    function(res){
                        if(res.code ==2000){
                            alert("绑定成功");
                            window.open('/task','_self');
                        }else if(res.code == 3200){
                            alert("您已经绑定成功了！");
                            window.open('/task','_self');
                            return;
                        }else{
                            alert("绑定不成功");
                            return;
                        }
                    },"json"
                );
            });

        });

    </script>
</head>
<div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;" ><img  onclick="window.history.back(-1);" style="width: 36px;height: 36px;" src="http://m.ikaiwan.com/public/images/back.png"></div>
<body style="background:#fff;">

<!--页面布局-->
<div class="two_dimensional_code">
    <p>为了您的账号安全，请先进行微信号绑定，完成绑定即可安心兑换。</p>
    <p>步骤一：长按并存储以下二维码图片，打开微信扫一扫识别该二维码，关注开玩服务号。</p>
    <div class="icon_two_dimensional_code"><img src="http://m.ikaiwan.com/public/images/bind.png"></div>
    <p>步骤二：关注完成后，在微信中点击"获取验证码"，并复制。</p>
    <p>步骤三：在下方输入从开玩微信公众号中获得的验证码。</p>
    <input type="text" name="verify" placeholder="请输入验证码" value="">
    <button>提交</button>
</div>
</div>
<!--页面布局 over-->

</body>
</html>
