<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Son extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->model("Son_model", "s");
    }

    /**
     *收徒首页
     */
    public function index()
    {
        $user_id = get_cookie("user_id");
        $data['money'] = $this->s->total_son_reward($user_id);
        if (is_null($data['money'])) {
            $data['money'] = "0.00";
        }
        if ($count_sum = $this->s->count_son_num($user_id)) {
            $data['son'] = $count_sum->count_td;
            $data['son_son'] = $count_sum->count_ts;
        } else {
            $data['son'] = "0";
            $data['son_son'] = "0";
        }
        $this->load->view('index/son', $data);
    }

    /**
     *邀请好友
     */
    public function invite()
    {
        $data['ip'] = $this->input->ip_address();
        $data['sid'] = $this->input->get('sid');
        $data['time'] = date('Y-m-d H:i:s');
        $this->s->add_wifi($data);
        $this->load->view('index/invite');
    }

    /**
     *邀请好友。。。。。
     */
    public function invite_ajax()
    {
        $this->load->database();
        $sql = "SELECT u.headimgurl AS headimgurl ,u.nickname AS nickname ,f.appname AS appname,f.time AS time ,f.money AS money FROM user_fen AS f RIGHT JOIN users AS u ON u.id=f.user_id WHERE type IN  ('juzhang','wanpu','renwu','shoutu','dianle') ORDER BY f.time DESC LIMIT 0,8";
        $result = $this->db->query($sql)->result_object();
        foreach ($result as $k => $v) {
            $result[$k]->time = formatTime($v->time);
        }
        echo json_encode($result);
    }

    /**
     *分享好友
     */
    public function share()
    {
        $params = verfiy_input('sid', $this->input->get());
        if (!$params) {
            exit("参数错误");
        } else {
            $sid = $this->input->get('sid');
            $this->s->add_wifi($sid);
        }
        $this->load->view('index/share');
    }


    /**
     *IOS9 注意
     */
    public function notice()
    {
        $this->load->view('index/notice');
    }


}
