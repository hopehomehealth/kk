<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=4.0, user-scalable=no" />
    <style>
        *{margin: 0;padding: 0;}
        body{background-color: #ededf3;}
        .wrap{ width: 90%; height: 420px; margin: 15px auto 0px auto; background-color: #f6f6f6;box-shadow: 1px 1px 3px #292929;border-radius: 5px;
            position:absolute;
            top:5%;
            left:5%;}
        .box_head{width: 80%;margin: 20px auto 0px auto;  vertical-align: top;text-align: center;padding-top: 10px;}
        .box_head img{ width: 60px;height: 60px;border-radius: 50%;}
        .box_head span{font-weight: bold;line-height: 100%;}
        .box_guide{margin:10px auto 0 auto;text-align: center;color: #6888e7;}
        .box_medium{width: 160px;margin: 10px auto 0 auto; border:2px dotted #ac2925;padding: 10px;}
        .box_medium img{ width: 155px; height: 155px;  }
        .box_foot{width: 80%; margin: 10px auto 20px; auto;text-align: center;line-height: 20px;font-weight: bold; padding-bottom:20px; color: #666666;}
    </style>
</head>
<body>
<div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;" ><img  onclick="window.history.back(-1);" style="width: 36px;height: 36px;" src="http://m.ikaiwan.com/public/images/back.png"></div>
<div class="wrap">
    <div class="box">
        <div class="box_head">
            <img src="<?=get_cookie('user_ico')?>"><span><?=get_cookie('user_name')?></span>

        </div>
        <div class="box_guide" >
            <h3>长按识别图中二维码</h3>
        </div>
        <div class="box_medium">
            <img src="/welcome/qrcode_create">
        </div>

    </div>
</div>

</body>
</html>
