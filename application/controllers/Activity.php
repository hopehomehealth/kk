<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->model("User_model", "u");
        $this->user_id = get_cookie("user_id");
        $this->load->model('Activity_model','ac');
    }

    /**
     *抽奖活动主页
     */
    public function index()
	{

        if($lottery_id = $this->check_chance())
        {
            $data['lottery_id'] = $lottery_id;
            $data['status']=1;
        }else{
            $data['status'] = 0;
            $data['lottery_id'] = 0;
        }
		$this->load->view('index/activity',$data);
//    	$this->load->view('index/activity');
	}

    /**
     * @return int
     */
    public function check_chance()
    {
        if($user_day = $this->u->user_day($this->user_id)){
            if($user_day->day_st_count < 1){
                return false;
            }else{
                //判断用户是否为首次抽奖
                $temp_lottery =  $this->temp_lottery();
                if($this->ac->first_lottery($this->user_id)){
                    if($this->big_lottery_reward() == 200){
                        return 4;
                    }
                    if($this->big_lottery_reward() == 400){
                        return 8;
                    }
                    $list = array(7,7,7,1,7,7,7,1,7,7,7,1,7,3,5,2);
                    return $list[array_rand($list,1)];
                }else{
                    $lottery_id = 5;
                    return $lottery_id;
                }
            }
        }else{
            return false;
        }
        return 0;
    }


    public function reward_lottery()
    {
        $user_id = $this->input->post('user_id');
        $lottery_id = $this->input->post('lottery_id');

        if($this->ac->add_lottery_click($this->user_id,date('Y-m-d')))
        {
            $array = array('code'=>300,'msg'=>"您的今日抽奖次数已达到上限! ");
        }else{
            $obj  = $this->check_lottery_money($lottery_id);
            $money = $obj->money;
            $this->ac->add_user_lottery($lottery_id,$this->user_id);
            $this->ac->add_user_fen($this->user_id,$money);
            $this->ac->set_money($this->user_id,$money);
            $this->ac->set_temp_lottery($obj->key,date('Y-m-d'));
            $array = array('code'=>200,'msg'=>"恭喜您获得 $money 奖励");
        }

        echo json_encode($array);
    }

    private function check_lottery_money($lottery_id)
    {
        switch($lottery_id){
            case 1:
                $money = 0.1;
                $key = "dot_one_rmb";
                break;
            case 2:
                $money = 1;
                $key = "one_rmb";
                break;
            case 3:
                $money = 0.5;
                $key = "dot_five_rmb";
                break;
            case 4:
                $money = 10;
                $key = "ten_rmb";
                break;
            case 5:
                $money = 0.5;
                $key = "dot_five_rmb";
                break;
            case 6:
                $money = 2;
                $key = "two_rmb";
                break;
            case 7:
                $money = 0.01;
                $key = "one_fen_rmb";
                break;
            case 8:
                $money = 20;
                $key = "twenty_rmb";
                break;
            default:
                $money = 0.01;
                $key = "one_fen_rmb";
                break;
        }
        $obj = new stdClass();
        $obj->money = $money;
        $obj->key = $key;
        return $obj;
    }

    private function big_lottery_reward()
    {
        return $this->ac->big_lottery_reward();
    }

    /**
     *今日抽奖数据统计
     */
    public function temp_lottery()
    {
        return $this->ac->check_temp_lottery();
    }







}
