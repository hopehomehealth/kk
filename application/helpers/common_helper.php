<?php
function is_weixin()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'MicroMessenger') === false) {
        return false;
    } else {
        return true;
    }
}

function formatTime($date)
{
    $str = '';
    $timer = strtotime($date);
    $diff = $_SERVER['REQUEST_TIME'] - $timer;
    $day = floor($diff / 86400);
    $free = $diff % 86400;
    if ($day > 0) {
        return $day . "天前";
    } else {
        if ($free > 0) {
            $hour = floor($free / 3600);
            $free = $free % 3600;
            if ($hour > 0) {
                return $hour . "小时前";
            } else {
                if ($free > 0) {
                    $min = floor($free / 60);
                    $free = $free % 60;
                    if ($min > 0) {
                        return $min . "分钟前";
                    } else {
                        if ($free > 0) {
                            return $free . "秒前";
                        } else {
                            return '刚刚';
                        }
                    }
                } else {
                    return '刚刚';
                }
            }
        } else {
            return '刚刚';
        }
    }
}

function get_curl($uri)
{
    $cu = curl_init();
    curl_setopt($cu, CURLOPT_URL, $uri);
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($cu);
    curl_close($cu);
    return $ret;
}

function post_curl($uri, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function check_params($select, $data)
{
    $res = array();
    //处理参数数据
    $array = explode(",", $select);
    foreach ($array as $k => $v) {
        if (array_key_exists($v, $data)) {
            $res["$v"] = $data["$v"];
        }
    }
    unset($data);
    return $res;
}


function verfiy_input($select,$data)
{
    //处理参数数据
    $array = explode(",",$select);
    $verfiy_param = array_keys($data);
    $verfiy_keys = array_values($array);
    asort($verfiy_keys);
    asort($verfiy_param);
    if(count(array_diff($verfiy_keys,$verfiy_param)) === 0){
        return true;
    }else{
        return false;
    }
}

function is_android()
{
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
        return true;
    }else{
        return false;
    }
}

function is_ios()
{
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
        return true;
    }else{
        return false;
    }
}