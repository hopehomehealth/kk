<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>抽奖</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/css/style.css">
    <style>
        body{
            background-image:url(<?=base_url()?>public/img/bj.png);
            background-repeat: no-repeat;
            background-size:cover;
        }
        #lottery{
            position:absolute; top:38%; left:14%;
        }
        td img{
            margin:5px;
        }
        .rule{
            text-align: left;
            padding-left: 20px;
            color: #fff015;
        }
        .rule p{
            font-size: 18px;
        }

    </style>
</head>
<body class="keBody">
<div class="kePublic">
    <!--效果html开始-->
    <div id="lottery">
        <table border="0" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <td class="lottery-unit lottery-unit-0"><img src="<?=base_url()?>/public/img/20.png"></td>
                <td class="lottery-unit lottery-unit-1"><img src="<?=base_url()?>/public/img/ij1.png"></td>
                <td class="lottery-unit lottery-unit-2"><img src="<?=base_url()?>/public/img/1y.png"></td>
            </tr>
            <tr>
                <td class="lottery-unit lottery-unit-7"><img src="<?=base_url()?>/public/img/1f1.png"></td>
                <td><a href="javascript:void(0)"><img src="<?=base_url()?>/public/img/kscj.png" /></a></td>
                <td class="lottery-unit lottery-unit-3"><img src="<?=base_url()?>/public/img/5j.png"></td>
            </tr>
            <tr>
                <td class="lottery-unit lottery-unit-6"><img src="<?=base_url()?>/public/img/2y.png"></td>
                <td class="lottery-unit lottery-unit-5"><img src="<?=base_url()?>/public/img/5j1.png"></td>
                <td class="lottery-unit lottery-unit-4"><img src="<?=base_url()?>/public/img/10.png"></td>
            </tr>
            </tbody></table>

        <div class="rule">
            <h1>活动规则</h1>
            <p>1、成功收徒1人，即可拥有1次抽奖机会</p>
            <p>2、抽奖所得金额将自动计入个人账户余额</p>
            <p>3、每人每天仅有10次抽奖机会</p>
        </div>
    </div>

    <script type="text/javascript" src="<?=base_url()?>/public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        var lottery={
            index:-1,	//当前转动到哪个位置，起点位置
            count:0,	//总共有多少个位置
            timer:0,	//setTimeout的ID，用clearTimeout清除
            speed:20,	//初始转动速度
            times:0,	//转动次数
            cycle:50,	//转动基本次数：即至少需要转动多少次再进入抽奖环节
            prize:-1,	//中奖位置
            init:function(id){
                if ($("#"+id).find(".lottery-unit").length>0) {
                    $lottery = $("#"+id);
                    $units = $lottery.find(".lottery-unit");
                    this.obj = $lottery;
                    this.count = $units.length;
                    $lottery.find(".lottery-unit-"+this.index).addClass("active");
                };
            },
            roll:function(){
                var index = this.index;
                var count = this.count;
                console.log(count);
                var lottery = this.obj;
                $(lottery).find(".lottery-unit-"+index).removeClass("active");
                index += 1;
                if (index>count-1) {
                    index = 0;
                };
                $(lottery).find(".lottery-unit-"+index).addClass("active");
                this.index=index;
                return false;
            },
            stop:function(index){
                this.prize=index;
                return false;
            }
        };

        function roll(){
            lottery.times += 1;
            lottery.roll();
            if (lottery.times > lottery.cycle+10 && lottery.prize==lottery.index) {
                clearTimeout(lottery.timer);
                lottery.prize=-1;
                lottery.times=0;
                click=false
                $.post(
                    "/activity/reward_lottery",
                    {"user_id":"<?=get_cookie('user_id')?>","lottery_id":"<?=$lottery_id?>"},
                    function (res) {
                        if(res.code == 200){
                            alert(res.msg);
                        }else{
                            alert(res.msg);
                        }
                    },
                    "json"
                );
            }else{
                if (lottery.times<lottery.cycle) {
                    lottery.speed -= 10;
                }else if(lottery.times==lottery.cycle) {
                    //var index = Math.random()*(lottery.count)|0;
                    var index = num();
                    lottery.prize = index;
                }else{
                    if (lottery.times > lottery.cycle+10 && ((lottery.prize==0 && lottery.index==7) || lottery.prize==lottery.index+1)) {
                        lottery.speed += 110;
                    }else{
                        lottery.speed += 20;
                    }
                }
                if (lottery.speed<40) {
                    lottery.speed=40;
                };
                lottery.timer = setTimeout(roll,lottery.speed);
            }
            return false;
        }

        function num()
        {
            <?php if($status == 1):?>

            <?php if($lottery_id == 8):?>
                return 0;
            <?php else:?>
                return <?=$lottery_id?>;
            <?php endif;?>

            <?php else:?>
            return -1;
            <?php endif;?>
        }

        var click=false;
        var click_num = 0;
        window.onload=function(){
            lottery.init('lottery');
            $("#lottery a").click(function(){
                <?php if($status != 1) :?>
                alert('您没有抽奖资格！');
                return false;
                <?php endif;?>
                if(click_num >=1){
                    history.go(0);
                    click = true;
                }
                if (click) {
                    return false;
                }else{
                    click_num++;
                    lottery.speed=100;
                    roll();
                    click=true;
                    return false;
                }
            });
        };
    </script>
    <!--效果html结束-->
    <div class="clear"></div>


</div>
</body></html>
<script>
    $(document).ready(function(){
        var chance;
        <?php if($status === 0 ):?>
        chance = 0;
        <?php endif;?>

        if(chance===0){
//            alert("抱歉，您现在还木有机会，快去收徒吧！！！");
        }

    });
</script>