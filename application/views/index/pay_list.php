<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <script src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
    <title>提现记录</title>
    <style type="text/css">
        body {
            background: #ededf3;
            margin: 0px;
            padding: 0px;
            border: 0px;
        }

        .list {
            font-size: 90%;
            width: 100%;
            height: 55px;
            background: white;
            border-bottom: thin #ccc solid;
        }

        .list-time {
            width: 20%;
            float: left;
            text-align: center;
            margin-top: 20px;
            padding-left: 3px;
            color: #666;
        }

        .list-amount {
            width: 25%;
            float: left;
            text-align: center;
            margin-top: 20px;
            color: red;
        }

        .list-type {
            width: 35%;
            float: left;
            margin-top: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .list-type .list-name {
            text-align: center;
            color: #666;
        }

        .list-type .list-account {
            text-align: center;
            color: #666;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .list-status {
            width: 15%;
            float: left;
            text-align: center;
            margin-top: 20px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>
<body>
<div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;" ><img  onclick="window.history.back(-1);" style="width: 36px;height: 36px;" src="http://m.ikaiwan.com/public/images/back.png"></div>
<div id='body'>
    <?php if(empty($list)):?>
        <h4>您还没有兑换记录</h4>
    <?php else:?>
        <?php foreach($list as $k => $v):?>
        <div class='list'>
            <div class='list-time'><?=date('m-d',strtotime($v->time))?></div>
            <div class='list-amount'><?=$v->money?></div>
            <div class='list-type'>
                <?php if($v->type_id == 1):?>
                <div class='list-name'>(<?=$v->type?>)</div>
                <div class='list-account'><?=$account?></div>
                <?php else:?>
                <div class='list-name'>(<?=$v->type?>)</div>
                <div class='list-account'><?=get_cookie('user_name')?></div>
                <?php endif;?>
            </div>
            <?php if($v->status != 1):?>
            <div class='list-status'>待处理</div>
            <?php elseif($v->status == 1):?>
                <div class='list-status'>已完成</div>
            <?php endif;?>
            <div class='clear'></div>
        </div>
        <?php endforeach;?>

    <?php endif;?>
</div>
</body>
</html>
