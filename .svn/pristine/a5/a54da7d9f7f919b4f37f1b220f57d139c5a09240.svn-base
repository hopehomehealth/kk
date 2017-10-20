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
    <title>收徒</title>
    <style>
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
<!--页面表单-->
<div class="main_fluid">
    <div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;"><img
            onclick="window.history.back(-1);" style="width: 36px;height: 36px;"
            src="http://m.ikaiwan.com//public/images/back.png"></div>
    <div class="info2">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" height="60" valign="middle" colspan="2"><span class="total_revenue">累计学徒奖励</span></td>
                <td align="right" valign="middle" colspan="2"><span class="total_revenue_value"><?= $money ?>元</span>
                </td>
            </tr>
            <tr>
                <td width="30%" height="45" valign="middle"><span class="total_revenue">徒弟个数</span></td>
                <td width="20%" align="center" valign="middle"><span class="total_revenue_value"><?= $son ?></span></td>
                <td width="30%" align="center" valign="middle"><span class="total_revenue">徒孙个数</span></td>
                <td width="20%" align="right" valign="middle"><span class="total_revenue_value"><?= $son_son ?></span>
                </td>
            </tr>
            <tr>
                <td width="30%" height="35" valign="middle"><span class="total_revenue">徒弟提成</span></td>
                <td width="20%" align="center" valign="middle"><span class="total_revenue_value">10%</span></td>
                <td width="30%" align="center" valign="middle"><span class="total_revenue">徒孙提成</span></td>
                <td width="20%" align="right" valign="middle"><span class="total_revenue_value">5%</span></td>
            </tr>
        </table>
    </div>


    <!--<div class="reward_info" style="padding-bottom: 15px;">
        <span class="label label-primary">一、收徒奖励</span>

        <p>
            收徒30人以下，每收徒1人奖励1元现金<br/>
            收徒30-99人，徒弟奖励升为1.5元1个<br/>
            收徒100-499人，徒弟奖励升为2元1个<br/>
            收徒500-999人，徒弟奖励升为2.5元1个<br/>
            收徒1000以上，徒弟奖励升为3元一个
        </p>
        <span class="label label-primary">二、任务奖励</span>

        <p>
            1，徒弟试玩首次任务成功后额外奖1元。<br/>
            2，徒弟每次完成任务，师傅将额外获得10%的奖励<br/>
            3，徒孙每次完成任务，师傅将额外获得5%的奖励
        </p>
    </div>-->

	<br />
   <div class="reward_info" style="padding-bottom: 15px;">
    <span class="label label-primary">一、收徒奖励</span>
    <p>
	<br/>
        收徒30人以下，&nbsp;&nbsp;&nbsp;&nbsp;每收徒1人奖励1元<br/>
        收徒30-99人，&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;每收徒1人奖励1.5元<br/>
        收徒100-499人，&nbsp;&nbsp;每收徒1人奖励2元<br/>
        收徒500-999人，&nbsp;&nbsp;每收徒1人奖励2.5元<br/>
        收徒1000以上，&nbsp;&nbsp;&nbsp;&nbsp;每收徒1人奖励3元
    </p>
    <span class="label label-primary">二、任务奖励</span>
    <p>
        <br/>
        1，徒弟每次完成任务，师傅将额外获得10%的奖励<br/>
        2，徒孙每次完成任务，师傅将额外获得5%的奖励
    </p>
</div>
 

    <div style="margin-bottom: 30px; padding: 20px;padding-top: 0px;">
        <p class="bg-danger" style="font-size:12px;border-radius: 5px;text-align: center;">
            <label style="padding-top:5px;color: red;">活动时间 2016年3月07日-2016年3月31日</label><br/>
            <!--label style="padding-top:5px;color: red;">活动时间 2015年12月1号 ~ 2015年12月31号</label><br /-->
            <label style="font-size: 10px;color: darkblue;">收徒要求：关注开玩微信公众号+下载并绑定开玩钥匙</label><br/>
            <label style="font-size: 9px;color: darkblue;">仅限IOS设备</label><br/>
            <label style="color: red;font-size: 9px;">（徒弟必须满足三个条件：唯一苹果帐号+唯一设备号+唯一微信号）</label>
        </p>
    </div>

    <!-- <div style="margin-bottom: 30px; padding: 20px;padding-top: 0px;">
         <p class="bg-danger" style="font-size:12px;border-radius: 5px;text-align: center;">
             <label style="padding-top:5px;color: red;">活动时间 2015年11月1号 ~ 2015年11月30号</label><br/>
             <label style="font-size: 10px;color: darkblue;">收徒要求：关注开玩微信公众号+下载并绑定开玩钥匙</label><br/>
             <label style="color: red;font-size: 9px;">（徒弟必须满足三个条件：唯一苹果帐号+唯一设备号+唯一微信号）</label>
         </p>
     </div>-->


</div>
<!--页面表单 over-->

<!--页面底部-->
<div class="foot_btn">
    <button onClick="window.open('/welcome/qrcode' ,'_self')">二维码收徒</button>
    <button onClick="window.open('kaiwan://share' ,'_self')">分享朋友圈</button>
</div>
<!--页面底部 over-->
<img id='safari' src="http://m.ikaiwan.com/public/images/friend.png"/>

<div id="black_overlay"></div>

</body>
</html>
