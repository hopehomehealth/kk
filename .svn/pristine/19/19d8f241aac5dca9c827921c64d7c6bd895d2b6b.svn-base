<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    private $user_id = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
         $this->load->helper('url');
        $this->load->model("User_model", "u");
        $this->user_id = get_cookie("user_id");
    }


    /**
     *活动主页
     */
    public function index()
    {
        $user_id = $this->input->get("uid");
        $version = $this->input->get("ver");
        $c_id = get_cookie("user_id");
        if(!empty($user_id) || !empty($c_id) ){
        }else{
            exit("请从尝试客户端打开");
        }
        // $this->check_login($user_id);
        if ($user_info = $this->check_login($user_id)) {
            $data['user_id'] = $user_id;
            $data['user_ico'] = $user_info->headimgurl;
            $data['user_name'] = $user_info->nickname;
            if($version != '1.4'){
                $data['ver'] = false;
            }else{
                $data['ver'] = true;
            }
        } else {
            $data['user_id'] = get_cookie("user_id");
            $data['user_ico'] = get_cookie("user_ico");
            $data['user_name'] = get_cookie("user_name");
            $data['ver'] = true;
        }

        $this->load->view('index/index', $data);
    }

    /**
     *活动主页Ajax加载数据
     */
    public function index_ajax()
    {
        $user_id = get_cookie("user_id");
        $user_info = $this->u->user_info($user_id);
        $user_info->money = $this->confirm_money();
        if($user_day = $this->u->user_day($user_id)){
            $user_info->day_income = $user_day->day_income;
            $user_info->day_st_count = $user_day->day_st_count;
        }else{
            $user_info->day_income = 0.00;
            $user_info->day_st_count = 0;
        }
        echo json_encode($user_info);
    }


    /**
     *更多
     */
    public function more()
    {
        $this->load->view('index/more');
    }

    /**
     *下载开玩
     */
    public function down()
    {
        $this->load->view('index/down');
    }


    /**
     *收入明细
     */
    public function income()
    {
        $this->load->view('index/income');
    }

    /**
     *收入明细ajax请求数据
     */
    public function income_ajax()
    {
        $user_id = get_cookie("user_id");
        $history = $this->u->user_reward_history($user_id);
        echo json_encode($history);
    }

    /**
     *排行榜单
     */
    public function rank()
    {
        $this->load->view('index/rank');
    }

    /**
     *申请兑换
     */
    public function pay()
    {
        $user_id = get_cookie('user_id');
        $reg_time = get_cookie('user_reg');
        if( (time() - strtotime($reg_time)) < 86400){
            show_error("您还未过24小时",500,"提示信息","/welcome/pay_list");
        }
        $total_reward  = $this->u->total_reward($user_id);
        $total_pay = $this->u->total_pay($user_id);
        $balance = $total_reward - $total_pay;
        if(10 > $balance){
            show_error("您的余额不足以提现",500,"提示信息","/welcome/pay_list");
        }

        $user_info = $this->u->user_info($user_id);
        $data['balance'] = $balance;
        $data['account'] = $user_info->pay_account;
        $data['name'] = $user_info->pay_name;

        $this->load->view('index/pay',$data);
    }

    /**
     *申请微信付款
     */
    public function wx_pay()
    {
        $user_id = get_cookie('user_id');
        $reg_time = get_cookie('user_reg');
        if( (time() - strtotime($reg_time)) < 86400){
            show_error("您还未过24小时",500,"提示信息");
        }
        $total_reward  = $this->u->total_reward($user_id);
        $total_pay = $this->u->total_pay($user_id);
        $balance = $total_reward - $total_pay;
        if(10 > $balance){
            show_error("您的余额不足以提现",500,"提示信息");
        }
        $data['balance'] = $balance;
        $this->load->view('index/wx_pay',$data);

    }

    /**
     *微信支付提交
     */
    public function post_wx_pay()
    {
        $user_id = get_cookie("user_id");
        $money = (int)($this->input->post('money')*100);
        $total_reward  = (int)($this->u->total_reward($user_id)*100);
        $total_pay = ($this->u->total_pay($user_id)*100);
        $balance = (int)($total_reward - $total_pay);
        $compare_money = $balance-$money;
//        $compare_money = bcsub($balance,$money,2);
        if($compare_money === 0){
            $add_data['status'] = 0;
            $add_data['type_id'] = 2;
            $add_data['user_id'] = $user_id;
            $add_data['type'] = '微信';
            $add_data['money'] = $balance/100;
            $add_data['sub'] = -$balance/100;
            $add_data['time'] = date('Y-m-d H:i:s');
            $this->u->add_pay($add_data);
            $this->u->subtract_money($user_id,$money);
            //更新余额
            $result_array = array("code"=>200,"msg"=>"success");
        }else{
            $result_array = array("code"=>300,"msg"=>"Failed");
        }
        echo json_encode($result_array);

    }


    /**
     * @param string $user_id
     * @return bool
     * 验证用户是否登录
     */
    public function check_login($user_id = "")
    {
        if (get_cookie("user_id")) {
            return false;
        } else {
            $user_info = $this->u->user_info($user_id);
//            $active_time = 86400;
            $active_time = 60*60*3;
            set_cookie("user_id", $user_id, $active_time);
            set_cookie("user_name", $user_info->nickname, $active_time);
            set_cookie("user_openid", $user_info->openid, $active_time);
            set_cookie("user_ico", $user_info->headimgurl, $active_time);
            set_cookie("user_idfa", $user_info->idfa, $active_time);
            set_cookie("user_reg", $user_info->reg_time, $active_time);
            return $user_info;
        }
    }

    /**
     *申请兑换提交
     */
    public function post_pay()
    {
        $user_id = get_cookie("user_id");
        $money = ($this->input->post('money')*100)."";
        $total_reward  = ($this->u->total_reward($user_id)*100)."";
        $total_pay = ($this->u->total_pay($user_id)*100)."";
        $balance = ((int)$total_reward - (int)$total_pay);
        $compare_money = $balance-$money;
        /*$money = $this->input->post('money');
        $total_reward  = $this->u->total_reward($user_id);
        $total_pay = $this->u->total_pay($user_id);
        $balance = ($total_reward - $total_pay);
        $compare_money = ((int)$balance*100 - (int)$money*100);*/
//        $compare_money = bcsub($balance,$money,2);
        if($compare_money === 0){
            $data['pay_name'] = $this->input->post('name');
            $data['pay_account'] = $this->input->post('account');
            $this->u->set_pay($user_id,$data);

            $add_data['status'] = 0;
            $add_data['type_id'] = 1;
            $add_data['user_id'] = $user_id;
            $add_data['type'] = '支付宝';
            $add_data['money'] = $balance/100;
            $add_data['sub'] = -$balance/100;
            $add_data['time'] = date('Y-m-d H:i:s');
            $this->u->add_pay($add_data);
            $this->u->subtract_money($user_id,$money);
            //更新余额

            $result_array = array("code"=>200,"msg"=>"success");
        }else{
            $result_array = array("code"=>300,"msg"=>"Failed");
        }
        echo json_encode($result_array);
    }

    /**
     *提现列表
     */
    public function pay_list()
    {
        $data['list'] = $this->u->list_pay($this->user_id);
        $user_info = $this->u->user_info($this->user_id);
        $data['account'] = $user_info->pay_account;
        $data['name'] = $user_info->pay_name;
        $this->load->view('/index/pay_list',$data);
    }

    /**
     *二维码
     */
    public function qrcode()
    {
        $this->load->view('index/qrcode');
    }

    /**
     *生成二维码
     */
    public function qrcode_create()
    {
        $this->load->helper('qrcode');
        $value = base_url() ."son/invite?sid=".$this->user_id;
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 8;
        QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
    }


    /**
     * @return string
     * 确认余额
     */
    public function confirm_money()
    {
        $total_reward  = $this->u->total_reward($this->user_id);
        $total_pay = $this->u->total_pay($this->user_id);
        if(is_null($total_pay)){
            $total_pay = 0;
        }
        $balance = $total_reward - $total_pay;

        if($balance == 0){
            $balance = "0.00";
        }
            return $balance;
    }


    public function check_task()
    {

    }

}
