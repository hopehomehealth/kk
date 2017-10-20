<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller
{

    private $user_id;
    private $user_idfa;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model("Task_model", "t");
        $this->user_id = get_cookie("user_id");
        $this->user_idfa = get_cookie("user_idfa");

    }

    /**
     *官方任务首页
     */
    public function index()
    {

        $user_id = get_cookie("user_id");
        if (empty($user_id)) {
            exit("请从客户端打开！");
        }
        $this->load->model("User_model", "u");
        $data['bind'] = $this->u->is_user_openid($this->user_id);
        if (is_android()) {
            $this->load->view('android/task', $data);
            return;
        }
        $data['list'] = $this->t->task_list_online($user_id);
        $out = $this->t->task_list_out($user_id);
        $array = array();
        foreach( $out as $key => $value)
        {
            if( (time()- strtotime($value->timec)) <= 7200){
                $array[] = $value;
            }
        }
        $data['out'] = $array;
        $this->load->view('index/task', $data);
    }


    /**
     *在线任务
     */
    public function task_online_ajax()
    {
        $user_id = get_cookie("user_id");
        $online = $this->t->task_list_online($user_id);
        echo json_encode($online);
    }

    /**
     *离线任务
     */
    public function task_gray_ajax()
    {
        $online = $this->t->task_list_gray();
        echo json_encode($online);
    }

    /**
     *下架后提交审核
     */
    public function submit_out_ajax()
    {
        $params = verfiy_input('app_id', $this->input->post());
        if (!$params) {
            exit("参数错误");
        } else {
            $app_id = (int)$this->input->post('app_id');
            $user_id = get_cookie('user_id');
//            SELECT * FROM user_play WHERE user_id=177478 AND app_id=116 AND `status` = 0  AND (DATE_ADD(timec,INTERVAL 300 SECOND) < NOW());
            $this->load->database();

            if(!$this->db->select('id')->where('user_id',$user_id)->where('app_id',$app_id)->where('status',0)->where('DATE_ADD(timec,INTERVAL 300 SECOND) < NOW()')->get('user_play')->result_object())
            {
                echo json_encode(array('code' => 3000, 'msg' => '请再玩一会'));
                exit;
            }
            $this->db->select('id,pro');
            $this->db->where('id', $app_id);
            $this->db->from('app');
            $result = $this->db->get()->row_object();
            if ($result) {
                $result->code = 2000;
                $result->appid = $app_id;
                echo json_encode($result);
                exit;
            } else {
                echo json_encode(array('code' => 3000, 'msg' => 'not found'));
                exit;
            }
        }
    }

    /**
     *校验任务
     */
    public function check_task_ajax()
    {
        $params = verfiy_input('appname,app_id', $this->input->post());
        if (!$params) {
            exit("参数错误");
        } else {
            $appid = $this->input->post('app_id');
            $time = date('Y-m-d H:i:s');
            if ($this->t->check_task($this->user_id, $appid)) {
                echo json_encode(array(
                    "code" => 300,
                    "msg" => "您已经领奖了！感谢您的参与！"
                ));
                exit;
            } else {
                if ($app = $this->t->task_status($appid)) {
                    if(!empty($app->callbackUrl)){
                        $callback = urlencode('http://www.example.com');
                        $click_uri = $app->callbackUrl;
                        $click_uri = str_replace('{idfa}', $this->user_idfa,$click_uri);
                        $click_uri = str_replace('{callback}', $callback,$click_uri);
                        $click_uri = str_replace('{appid}', $app->appIdentifier,$click_uri);
                        $click_uri = str_replace('{ip}', $this->input->ip_address(),$click_uri);

                        $this->load->database();
                        $device = $this->db->select('pn,os')->where('uid',$this->user_id)->get('user_info')->row_object();
                        if($device){
                            $click_uri = str_replace('{model}', $device->pn,$click_uri);
                            $click_uri = str_replace('{version}', $device->os,$click_uri);
                        }
                        get_curl($click_uri);
                    }
                    if ($app->validation == 1) {
                        if ($this->t->verify_api($this->user_idfa, $app)) {
                            $this->t->mark_task($app, $this->user_id, $this->user_idfa, 0);
                            $this->t->add_task_click_number($appid);
                            $this->t->add_start_click($appid, $time);
                            $this->task_ajax_return($app->actionType, $app->appstoreUrl);
                        } else {
                            $this->t->mark_task($app, $this->user_id, $this->user_idfa, 3);
                            echo json_encode(array(
                                "code" => 301,
                                "msg" => "您已经安装过！感谢您的参与！"
                            ));
                            exit;
                        }
                    } else {
                        $this->t->mark_task($app, $this->user_id, $this->user_idfa, 0);
                        $this->t->add_task_click_number($appid);
                        $this->t->add_start_click($appid, $time);
                        $this->task_ajax_return($app->actionType, $app->appstoreUrl);
                    }
                } else {
                    echo json_encode(array(
                        "code" => 300,
                        "msg" => "任务已下架！感谢您的参与！"
                    ));
                    exit;
                }
            }
        }

    }


    /**
     * @param $type
     * @param string $appurl
     * 校验任务返回值
     */
    private function task_ajax_return($type, $appurl = "http://itunes.apple.com/WebObjects/MZStore.woa/wa/search?clientApplication=Software&e=true&media=software&term=")
    {
        if ($type == 3) {
            $array['url'] = $appurl;
            $array['code'] = 200;
            echo json_encode($array);
            exit;
        } else {
            $array['url'] = "http://itunes.apple.com/WebObjects/MZStore.woa/wa/search?clientApplication=Software&e=true&media=software&term=";
            $array['code'] = 200;
            echo json_encode($array);
            exit;
        }
    }

    /**
     *验证奖励
     */
    public function check_reward()
    {
        $params = verfiy_input('app_id', $this->input->post());
        if (!$params) {
            exit("参数错误");
        } else {
            $appid = $this->input->post('app_id');
            if ($app = $this->t->check_task_click($appid, $this->user_id, $this->user_idfa)) {
                $return = array("code" => 2000, "message" => "已完成", "pro" => $app->pro, "appid" => $appid);
                echo json_encode($return);
                exit;
            } else {
                $return = array("code" => 4100, "message" => "请再玩一会");
                echo json_encode($return);
                exit;
            }
        }
    }

    /**
     *IOS设备任务列表
     */
    public function api_list()
    {
        if ($data = $this->t->api_list($this->user_id)) {
            $array['item'] = $data;
            echo json_encode($array);
            exit;
        }
    }

    /**
     * @return bool
     * 任务奖励
     */
    public function task_reward()
    {

        if($this->input->get('uid') == '224144' || $this->input->get('uid') == '144721'){
            $json = json_encode($this->input->get());
            $sql ="INSERT INTO test (content) VALUES ('$json')";
            $this->load->database();
            $status = $this->db->query($sql);
        }
        $params = verfiy_input('uid,appid,process', $this->input->get());
//        $params = verfiy_input('uid,appid,process',$this->input->post());
        if (!$params) {
            exit("参数不正确");
        } else {
            $input = $this->input->get();
            $userid = $input["uid"];
            $appid = $input["appid"];
            $process = $input["process"];
            $play = $this->t->play_info($userid, $appid);
            if (!$play) {
//                return false;
                $array = array('code' => 4, 'msg' => 'not found');
                echo json_encode($array);return;
            }
            switch ($play->status) {
                case 0:
                    $status = $this->get_reward($userid, $appid, $play);
                    break;
                case 2:
                    $status = $this->morrow_reward($userid, $appid, $play);
                    break;
                case 3:
                    $status = 0;
                    break;
            }
            if (true === $status) {
                $array = array('code' => 0, 'msg' => 'success');
            } else {
                $array = array('code' => 3, 'msg' => 'failed');
            }
            echo json_encode($array);
            exit;
//            1,查询当前APPID
//            2,判断状态   0   予以奖励    2 验证是否存在次日奖励
//            3,不存在  自己加 给师父  师祖 加  (user_fen,user.money,user_day)
//            4,存在   判断时间   予以奖励  给自己加(user_fen,user.money,user_day)

        }

    }


    /**
     * @param $userid
     * @param $appid
     * @param $play
     * @return bool
     * 获取奖励金额
     */
    private function get_reward($userid, $appid, $play)
    {
        if (time() > (strtotime($play->timec) + 7200)) {
            return false;
        } else {
            if($this->up_reward_callback($userid,$appid)){
                $this->t->set_play($userid, $appid, 2);
                $this->t->task_reward($userid, $appid, $play);
                return true;
            }else{
                return false;
            }

//            $this->up_reward_callback($userid,$appid);

        }

    }

    /**
     * 上传激活
     * @param $user_id
     * @param $appid
     * @return bool
     */
    private function up_reward_callback($userid,$appid)
    {
        $this->load->database();
        $app = $this->db->select('appIdentifier,remark,remarkParams')->where('id',$appid)->get('app')->row_object();
        $up_uri = $app->remark;
        if(!$up_uri){
            return true;
        }
        $this->db->select('pn');
        $this->db->where('uid',$userid);
        if($user_info  = $this->db->get('user_info')->row_object()){$osversion = $user_info->pn; }else{$osversion = '9.2';}
        if($user_array = $this->db->select('idfa')->where('id',$userid)->get('users')->row_object()){
            $idfa = $user_array->idfa;
        }else{
            return false;
        }
        $callback= urlencode("http://m.ikaiwan.com/callbackuri.php");
        $up_uri = str_replace('{idfa}', $idfa,$up_uri);
        $up_uri = str_replace('{osversion}', $osversion,$up_uri);
        $up_uri = str_replace('{callback}', $callback,$up_uri);
        $up_uri = str_replace('{appid}', $app->appIdentifier,$up_uri);
        $return_json = get_curl($up_uri);
        if(empty($app->remarkParams)){
            return true;
        }else{
            if (trim($return_json) === trim($app->remarkParams)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @param $userid
     * @param $appid
     * @param $play
     * @return bool
     * 次日奖励
     */
    private function morrow_reward($userid, $appid, $play)
    {
        if ($money = $this->t->check_morrow_reward($appid, $play)) {
            $this->t->add_morrow_reward($userid, $appid, $money, $play);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $number
     * 测试模块
     */
    public function  test_model($number)
    {
        $this->load->helper('url');
        $config['image_library'] = 'gd2';
        $config['source_image'] = '/www/app/app_' . $number . '.png';
//        echo $config['source_image'];exit;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 66;
        $config['height'] = 66;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        echo $this->image_lib->display_errors();
    }

    public function yayaya()
    {
        $num = $this->input->get('num');
        $this->test_model($num);
    }

    /**
     *设置缩略图
     */
    public function set_imgurl()
    {
        $this->load->database();
        $this->db->select('id,name');
        $result = $this->db->get('app')->result_object();
        foreach ($result as $k => $v) {
            $imgurl = "http://ci.ikaiwan.com/public/app/app_" . $v->id . "_thumb.png";
            $this->db->set('imgUrl', $imgurl);
            $this->db->where('id', $v->id);
            $a = $this->db->update('app');
            var_dump($a);
            echo "<br />";
            echo "完成了第" . $v->id . "个";
            echo "<br />";
        }
    }


}
