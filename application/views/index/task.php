<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=4.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="http://m.ikaiwan.com/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://m.ikaiwan.com/public/css/list.css" rel="stylesheet" type="text/css">
    <style>
        #black_overlay {
            display: none;
            position: absolute;
            top: 82px;
            left: 0%;
            width: 100%;
            height: 100%;
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

        .task_img img {
            border-radius: 5px;
        }

        #copy {
            display: inline-block;
            /*margin-top: 20px;*/
            text-align: center;
        }

        #copy_name {
            margin: 10px 0px 10px 0px;
            border: 2px #999 dotted;
            display: inline-block;
        }

        #copy_name p {
            font-size: 140%;
            padding: 3px 10px 3px 10px;
            margin: 0px;
        }

        #copy_guide {
            margin-top: 4px;
            width: 100%;
            font-size: 90%;
        }

        #t_head {
            position: absolute;
            top: -30px;
            left: 20px;
        }

        #t_head img {
            border-radius: 10px;
            width: 60px;
            height: 60px;
        }
    </style>
    <script type="text/javascript">
        function alterShow() {
            document.getElementById('black_overlay').style.top = 0;
            document.getElementById('black_overlay').style.display = "block";
            document.getElementById('safari').style.display = "block";
        }
    </script>
    <script type="text/javascript" src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
    <title>任务列表</title>
</head>
<body>
<div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;"><img
        onclick="window.history.back(-1);" style="width: 36px;height: 36px;"
        src="http://m.ikaiwan.com/public/images/back.png"></div>

<div id="tc_box_jdb" style="display:none;">
    <div class="tc_opacity_bg"></div>
    <div class="tc_box">
        <div class="tc_cont">
            <div><img style="width: 60px;height:60px;"
                      src="http://ci.ikaiwan.com/public/app/app_jdb_thumb.png"/>
            </div>
            <p style="margin: 0;color: #ff040f;text-align: left;overflow: hidden;">
                <strong>任务步骤：</strong><br/>
                1.填写邀请码：2003PU9<br/>
                2.绑卡或肖像认证,送借贷宝内300分钟话费。<br/>
                3.邀请好友绑卡成功后即可获得奖励.<br/>
            </p>

            <div>
                <div><p>借贷宝</p></div>
                <div style="clear:both"></div>
            </div>
            <br/>
            <a class="task_active jdb_task" href="kaiwan://daibao2003PU9" style="font-size: 14px;">开始任务</a><br>
            <a class="task_gray" style="font-size: 14px;">放弃此次任务给别人</a>
        </div>
    </div>
</div>


<div id="tc_box" style="display:none;">
    <div class="tc_opacity_bg"></div>
    <div class="tc_box">
        <div class="tc_cont">
            <div id="t_head"><img src=""/></div>
            <p style="margin: 0;color: #ff040f;text-align: left;overflow: hidden;">
                <strong>任务步骤：</strong><br/>
                1.长按虚线拷贝关键字。<br/>
                2.点击开始任务，粘帖并搜索。<br/>
                3.下载任务并激活试玩5分钟<br/>
                4.请在30分钟内完成，提交审核<br/>
                5.<label id="location"></label>
            </p>

            <div id="copy">
                <div id="copy_name" oncopy="javascript:void(0);"><p>APP</p></div>
                <div style="clear:both"></div>
            </div>
            <br/>
            <a id="task_active" href="javascript:void(0);" class="task_active" style="font-size: 14px;">开始任务</a><br>
            <a id="post_submit" href="javascript:void(0);" class="task_submit" style="font-size: 14px;">提交审核</a><br>
            <a id="task_gray" href="javascript:void(0);" class="task_gray" style="font-size: 14px;">放弃此次任务给别人</a>
        </div>
    </div>
</div>

<!--页面表单-->
<div class="main_fluid">

    <input type="hidden" id="appname" value=""/>
    <input type="hidden" id="app_id" value=""/>

    <div class="task_box agent">
        <div class="task_img"><img
                src="http://ci.ikaiwan.com/public/app/app_jdb_thumb.png"/>
        </div>
        <div class="task_info"><span class="task_title">借贷宝</span><br>
            <span class="green">&nbsp;&nbsp;</span><br>
            <span class="red2" style="font-size:12px;">绑卡或肖像认证,送借贷宝内300分钟话费</span></div>
        <div class="task_rewards task_rewards_active">+300分钟</div>
        <div class="clearfix"></div>
    </div>

    <?php if (true === $bind): ?>
        <div class="task_box" onClick="window.open('/user/webchat?id=<?= get_cookie('user_id') ?>','_self')">
            <div class="task_img"><img src="http://m.ikaiwan.com/public/images/weixin.png"></div>
            <div class="task_info"><span class="task_title">绑定微信</span><br>
                <span class="green">应用</span><br>
                <span class="red2">绑定帐号</span></div>
            <div class="task_rewards task_rewards_active">+0.1元</div>
            <div class="clearfix"></div>
        </div>
    <?php endif; ?>

    <?php foreach ($list as $k => $v): ?>
        <div class="task_box online">
            <input type="hidden" name="id" value="<?= $v->id ?>"/>
            <input type="hidden" name="location" value="<?= $v->location ?>"/>

            <div class="task_img"><img
                    src="<?= $v->imgUrl ?>"/>
            </div>
            <div class="task_info"><span class="task_title"><?= $v->keywords ?></span><br>
                <img src="http://m.ikaiwan.com/public/images/icon_record.png" width="8" height="8"> 剩<span
                    class="green"><?= ($v->amountP - $v->amountA) ?></span>份
                <img src="http://m.ikaiwan.com/public/images/icon_time.png" width="8" height="8"> 剩<span
                    class="green"><?= round((strtotime($v->endTime) - time()) / 3600, 1) ?></span>时<br>
                <span class="red2"><?= $v->guide ?></span></div>
            <div class="task_rewards task_rewards_active">+<?= $v->reward ?>元</div>
            <div class="clearfix"></div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($out as $k => $v): ?>
        <div class="task_box sub_post">
            <input type="hidden" value="<?= $v->id ?>"/>

            <div class="task_img"><img src="<?= $v->imgUrl ?>"></div>
            <div class="task_info"><span class="task_title"><?=mb_substr($v->keywords,0,15)  ?></span><br>
                剩<span class="green">0</span>份<br>
                <span class="red2"><?= $v->guide ?></span></div>
            <div class="task_rewards" style="background-color: #009900;">提交审核</div>
            <div class="clearfix"></div>
        </div>
    <?php endforeach; ?>

</div>
<!--页面表单 over-->

<!--页面底部-->
<img id='safari' src="http://m.ikaiwan.com/public/images/safari.png"/>

<div id="black_overlay"></div>
<!--页面底部 over-->
</body>
</html>
<script>
    $(document).ready(function () {
        var jumpurl = "";
        $(".online").click(function () {
            $("#appname").val($(this).children(".task_info").children(".task_title").text());
            $("#app_id").val($(this).children("input[name='id']").val());
            $("#location").html("该图标,第" + $(this).children("input[name='location']").val() + "个左右");

            $(".tc_opacity_bg").css("height", $(document).height());
            $("#task_active").text("开始任务");
            $("#tc_box").show();

            var adname = $(this).find(".task_title").text();
            $("#copy_name").find("p").text(adname);
            var t_head = $(this).find(".task_img img").attr("src");
            $("#t_head").find("img").attr("src", t_head);

        });
        $("#task_gray").click(function () {
            $("#tc_box").hide();
        });

        $(".task_active").click(function () {
            $("#task_active").text("正在疯狂抢夺任务，请稍候！");
            var data = {"appname": $("#appname").val(), "app_id": $("#app_id").val()}
            $.post(
                "/task/check_task_ajax",
                data,
                function (res) {
                    if (res.code == 200) {
                        $("#task_active").text("请在30分钟内完成任务");
                        window.open(res.url, '_self');
                    } else {
                        $("#task_active").text(res.msg);
                        setTimeout("$('#tc_box').hide();", 3000);

                    }
                },
                "json"
            );
        });


        $("#post_submit").click(function () {
            var data = {"app_id": $("#app_id").val()};
            $.post(
                "/task/check_reward",
                data,
                function (res) {
                    if (res.code == 2000) {
                        location.href = "kaiwan://" + res.pro + "zzq" + res.appid;
                    } else {
                        alert(res.message);
                    }
                }, "json"
            );
        });

        $(".sub_post").click(function () {
            var app_id = $(this).children("input").val();
            var data = {"app_id": app_id};
            $.post(
                "/task/submit_out_ajax",
                data,
                function (res) {
                    console.log();
                    if (res.code == 2000) {
                        location.href = "kaiwan://" + res.pro + "zzq" + res.appid;
                    } else {
                        alert(res.msg);
                    }
                }, "json"
            );
        });


        $(".agent").click(function () {
            $("#tc_box_jdb").css('display', 'block');
        });


    });
</script>
<script>
    $(document).ready(function () {
        <?php if(!empty($out)): ?>
        var out = [];
        <?php foreach ($out as $k => $v): ?>
        out.push('<?=$v->id?>');
        <?php endforeach;?>
        <?php else : ?>
        var out = null;
        <?php endif;?>
        var html = "";
        $.post(
            "/task/task_gray_ajax",
            "",
            function (res) {
                for (var i = 0; i < res.length; i++) {
                    html = "";
                    html += '<div class="task_box">' +
                    ' <div class="task_img">' +
                    '<img src="' +
                    res[i].imgUrl +
                    '">' +
                    ' </div> ' +
                    '<div class="task_info">' +
                    '<span class="task_title">' +
                    res[i].keywords.substring(0,15) +
                    '</span><br>剩<span class="green">' +
                    '0' +
                    '</span>份<br> <span class="red2">' +
                    res[i].guide +
                    '</span></div> <div class="task_rewards">+' +
                    res[i].reward +
                    '元</div> <div class="clearfix"></div> </div>';

                    if(out == null){$(".task_box").last().after(html);}else {
                        for(var m in out){
                            if(out[m] == res[i].id){}else{
                                $(".task_box").last().after(html);
                            }
                        }
                    }


                }

            }, "json"
        );
    });
</script>