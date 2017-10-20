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
    <title>排行榜</title>
    <style type="text/css">
        body {
            font-size: 75%;
            background: #ededf3;
            margin: 0px;
            padding: 0px;
            border: 0px;
            padding-top: 15px;
        }

        ul {
            margin: 0px;
            padding: 0px;
            border: 0px;
        }

        li {
            margin: 0px;
            padding: 0px;
            border: 0px;
            list-style-type: none;
        }

        .list {
            height: 50px;
            overflow: hidden;
        }

        .list-all {
            float: left;
            font-size: 80%;
        }

        #list-ranking {
            width: 15%;
        }

        #list-ranking .ranking {
            width: 15px;
            height: 15px;
            background: #888888;
            color: white;
            text-align: center;
            border-radius: 3px;
            font-size: 90%;
            position: relative;
            top: 12px;
            left: 15px;
            line-height: 15px;
        }

        #list-head {
            width: 25%;
        }

        #list-head img {
            border-radius: 40px;
            height: 40px;
            width: 40px;
        }

        #list-name {
            width: 40%;
        }

        #list-name .user_name {
            position: relative;
            top: 13px;
            font-size: 120%;
        }

        #list-income {
            width: 20%;
        }

        #list-income .amount {
            position: relative;
            top: 13px;
            font-size: 120%;
            font-weight: 700;
        }

        #box {
            font-family: sans-serif;
        }
    </style>
    <script type="text/javascript">

        function zz() {
            alert(1)

            setTimeout(function () {
                var down_url = 'http://itunes.apple.com';
//                var down_url = 'baidu.com';

                var link = document.createElement('a');
                link.rel = 'noreferrer';
//                down_url += '?_='+new Date().getTime();
                link.href = down_url;
                document.body.appendChild(link);
                link.click();
            }, 500);
        }

    </script>
</head>

<body>
<div class="title" style="background-color: #0292f5;text-align: left;line-height: 40px;"><img
        onclick="window.history.back(-1);" style="width: 36px;height: 36px;"
        src="http://m.ikaiwan.com/public/images/back.png"></div>
<div id="box">

    <ul>

        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>1</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/1QFGp5p0ib9w7L2p89DNqQkZuEN8XMdhUqWLOib0SEEetWNnyVDO6x1VCazpPQsyiaL4VTt0EO61rViaicdzAU7qhaAxbPCHKkdWN/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>单欢&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>26280.24元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>2</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/qc4W9KYQsnENTJhKgLLygd1gdZoSNXI5LpFVhL7qe1dMOsSY3lZNGPeTHREY3CIvBTgyGQQM8PgZZ1WDUibXichHjnaJu0Pdl0/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>第二&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>21033.13元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>3</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/tOzbdAyVRGJp5rzEemVZlqRp9or2oAHDHI8SJ2qL2WcHW3NTIFUxAKkvDVNxKUGpkE5NU7oJB6z7G0GMDcQyV1OxZFvES4uu/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>星魂大人&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>17655.49元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>4</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/1QFGp5p0ib9x28S76slsVPw020icSAS8XficopO6ozcgAMvLSibK3FGpWxjMgT7zAZwYZEY7Q6y4p2sskIA8ZNPMhcGejZwxdajV/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>Bin、 &nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>10953.43元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>5</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/tOzbdAyVRGKIQhia4nt7iaQNMTHIglmcibfNAvenW8FopkZpGDaDlMVEdPoXrAhl6rmUxwEwC0FKUtficvpFySzbZVdnxgILDcdZ/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>试玩软件&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>10622.75元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>6</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/ajNVdqHZLLBjgGrVcTyNInascow8l46pLGZYbHKuW4Q1fp3vArWicqCY95FwqtVumB5K8WZwXALSKDpZom26CFJEM94Zicic2fsPia9LEsriaxmM/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>Cher&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>8855.49元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>7</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/ajNVdqHZLLBjgGrVcTyNInascow8l46pvMHZ3VtKmTpicE8TP83bGmQNwHnmCACAOSialkIZHXwx3ibmER8dTp6QoHnQ6jtkv3KemYsIricZ7wU/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>惠&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>7869.30元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>8</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/qc4W9KYQsnHP83szY2jUx1X9kLgtXS74IOe7rYQmr96cjmFXODTzoTy2ib0k3dIo5YaV7R2KfibdyQcqzdxMMdZsrRniadVyQpf/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>Zhendong&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>6631.03元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>9</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/tOzbdAyVRGI7Y7sxCJa3XrqhDJYbEOaRHg8rY3WDZqgpp6UxkKJGF3hmEabhBa0NpI2vSQyBFVhT8veeNzBJ97ZhSbxiaSg8K/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>万鑫&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>6108.42元</div>
                </li>
            </ul>
        </li>
        <li class='list'>
            <ul>
                <li class='list-all' id='list-ranking'>
                    <div class='ranking'>10</div>
                </li>
                <li class='list-all' id='list-head'>
                    <img
                        src='http://wx.qlogo.cn/mmopen/1QFGp5p0ib9w7L2p89DNqQmWhZ01xGsUmyY2I3KSia3NHThHoAeeEbPryz21CCuaBIibaYS1TDJljVibPULekfAM5iaPWpNXZyl7t/0'/>&nbsp
                </li>
                <li class='list-all' id='list-name'>
                    <div class='user_name'>Beautiful&nbsp</div>
                </li>
                <li class='list-all' id='list-income'>
                    <div class='amount'>4585.40元</div>
                </li>
            </ul>
        </li>
    </ul>
</div>

</body>
</html>
