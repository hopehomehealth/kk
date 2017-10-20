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
        #safari{
            position:fixed;
            top:0%;
            right:5%;
            z-index:100;
            display:none;
            width:50%;
        }
        .task_img img{
            border-radius: 5px;
        }
    </style>
    <script type="text/javascript">
        window.onload = function () {
            var d_height = document.body.scrollHeight;
            document.getElementById("black_overlay").style.height = (d_height - 80) + 'px';
            if (<?=$vild?> == 1) {
                document.getElementById("black_overlay").style.display = 'block';
            }
        }

        function alterShow(){
            document.getElementById('black_overlay').style.top =0;
            document.getElementById('black_overlay').style.display = "block";
            document.getElementById('safari').style.display = "block";
        }
    </script>
    <script type="text/javascript" src="http://m.ikaiwan.com/public/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var jumpurl = "";
            $(".online").click(function () {
                $("#appname").val($(this).children(".task_info").children(".task_title").text());
                $("#app_id").val($(this).children("input").val());
                $(".tc_opacity_bg").css("height", $(document).height());
                $("#task_active").text("开始任务");
                $("#tc_box").show();
            });
            $("#task_gray").click(function () {
                $("#tc_box").hide();
            });

            $(".task_active").click(function () {
                $("#task_active").text("正在疯狂抢夺任务，请稍候！");
                var data = {"uid": $("#uid").val(), "appname": $("#appname").val(), "app_id": $("#app_id").val()}
                $.post(
                    "/task/check_task_ajax",
                    data,
                    function (res) {
                        console.log(res);
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


            $("#post_submit").click(function(){
                var data = {"uid" : $("#uid").val() , "app_id" : $("#app_id").val() };
                $.post(
                    "/task/check_reward",
                    data,
                    function(res){
                        console.log();
                        if(res.code == 200){
                            alterShow();
                        }else{
                            alert(res.msg);
                        }
                    },"json"
                );
            });


            $(".agent").click(function(){
                $("#appname").val($(this).children(".task_info").children(".task_title").text());
                $("#tc_box").show();
                var str = "1.填写邀请码：2003PU9<br />" +
                    "2.绑卡或肖像认证,送借贷宝内300分钟话费<br/>" +
                $(".tc_cont p").html(str);
                $("#post_submit").next().remove();
                $("#post_submit").remove();
                $("#task_active").attr('id','agent');
                //$("#agent").attr("href","agent.php");
            });


        });
    </script>
    <title>任务列表</title>
</head>

<body>


<div id="tc_box" style="display:none;">
    <div class="tc_opacity_bg"></div>
    <div class="tc_box">
        <div class="tc_cont">
            <p style="margin: 0;color: #ff040f;text-align: left;overflow: hidden;">

                1.领取任务前请确保‘开玩钥匙’一直处于打开状态。<br/>
                2.复制关键词、去AppStore搜索栏粘贴关键词。<br/>
                3.下载任务并激活试玩5分钟<br/>
                4.返回’开玩官方任务‘列表，进行任务‘提交审核’ 或 重新打开 ‘开玩钥匙’ <br/>
                5.请在30分钟内完成，提交审核
            </p>
            <a href="/user/jdb_jump_android" id="task_active" class="task_active" style="font-size: 14px;">开始任务</a><br>
            <a id="post_submit" class="task_submit"   style="font-size: 14px;">提交审核</a><br>
            <a id="task_gray" class="task_gray" style="font-size: 14px;">放弃此次任务给别人</a>
        </div>
    </div>
</div>

<!--页面表单-->
<div class="main_fluid">
    <div class="task_box agent">
        <div class="task_img"><img src="http://a4.mzstatic.com/us/r30/Purple1/v4/21/4e/49/214e49e4-c809-5945-8e9d-072843f4cebc/icon175x175.png"/></div>
        <div class="task_info"><span class="task_title">借贷宝</span><br>
            <span class="green">&nbsp;&nbsp;</span><br>
            <span class="red2">绑卡或肖像认证,送借贷宝内300分钟话费</span></div>
        <div class="task_rewards task_rewards_active">+300分钟</div>
        <div class="clearfix"></div>
    </div>

    <?php if(true === $bind): ?>
        <div class="task_box" onClick="window.open('/user/webchat?id=<?=get_cookie('user_id')?>','_self')">
            <div class="task_img"><img src="http://m.ikaiwan.com/public/images/weixin.png"></div>
            <div class="task_info"><span class="task_title">绑定微信</span><br>
                <span class="green">应用</span><br>
                <span class="red2">绑定帐号</span></div>
            <div class="task_rewards task_rewards_active">+0.3元</div>
            <div class="clearfix"></div>
        </div>
    <?php endif;?>

</div>
<!--页面表单 over-->

<!--页面底部-->
<img id='safari' src="http://m.ikaiwan.com/public/images/safari.png" />
<div id="black_overlay"></div>
<!--页面底部 over-->
</body>
</html>