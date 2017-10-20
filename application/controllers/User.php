<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model("User_model", "u");
    }

    /**
     *微信绑定页面
     */
    public function webchat()
    {
        $this->load->view('index/webchat');
    }

    /**
     *提交绑定信息
     */
    public function confim_webchat()
    {
        $params = check_params('user_id,wx_user_id',$this->input->post());
        $user_id = $this->input->post('user_id');
        $wx_id = $this->input->post('wx_user_id');
        if(!$params){
            exit("参数不正确");
        }else{
            if(!$this->u->is_user_openid($user_id)){
                $msg = "您已经绑定过了";
                echo json_encode(array("code"=>3200,"message"=>$msg));exit;
            }
            if(get_cookie('user_id') != $user_id ){
                $msg = "您的ID有误";
                echo json_encode(array("code"=>3100,"message"=>$msg));exit;
            }
            if($openid = $this->u->get_openid($wx_id)){
                $this->u->set_user_openid($user_id,$openid);
                if(false == $this->u->is_bind_reward($user_id)){
                    $this->u->webchat_reward($user_id,0.1);
                }
                $msg = "Bind Success";
                echo json_encode(array("code"=>2000,"message"=>$msg));exit;
            }else{
                $msg = "参数不正确";
                echo json_encode(array("code"=>3100,"message"=>$msg));exit;
            }
        }
    }

    /**
     *第三方任务页面
     */
    public function hezuo()
    {
        if(is_android()){
            $this->load->view('android/hezuo');
        }else{
            $this->load->view('index/hezuo');
        }
    }

    /**
     *跳转借贷宝
     */
    public function jdb_jump_android()
    {
        $url ="kaiwan://daibao2003PU9";
        header("Location: $url");
    }


    /**
     *新用户注册
     */
    public function register()
    {
        $params = verfiy_input('idfa,app,name,pn,w,h,os,type,ver',$this->input->post());
        if(!$params){
            exit("参数错误");
        }else {
            $input = $this->input->post();
        }
        if ($check = $this->u->check_idfa($input)) {
            $data = array("id"=> $check);
            echo  json_encode($data);
        }else{
            $input['ip'] = $ip = $this->input->ip_address();
            if ($input['w'] >= 370) {
                $input['status']=2;
            }
            $input['time'] = $input['reg_time'] = date('Y-m-d H:i:s');
            $ip_result = json_decode(get_curl("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip));
            $input['address'] = $ip_result->data->region . $ip_result->data->city;
            $input['device'] = $input['type'];
            $input['money'] = 0.1;
            $input['status'] = 1;
            $input['headimgurl'] = "http://m.ikaiwan.com/public/images/smile.png";
            $add = check_params('idfa,money,reg_time,ip,status,address,headimgurl,device',$input);
            $user_id = $this->u->register_user($add);//注册
            $input['user_id'] = $input['uid'] = $user_id;
            if($user_id){
                /*1  附加信息   2 加分   3  添加当天数据   4 处理师徒关系*/
                $add_info = check_params("uid,name,pn,w,h,os,ver",$input);
                $this->u->add_info($add_info);//写入详情
                $input['appname'] = "注册";
                $input['appid'] = 0;
                $input['type'] = "zhuce";
                $input['day_income'] = $input['money'] = 0.1;
                $input['type'] = "zhuce";
                $input['typename'] = "注册";
                $add_fen =  check_params("user_id,appname,appid,type,money,time,typename",$input);
                $this->u->add_reward($add_fen);//添加得分
                $add_day = check_params("user_id,day_income,time",$input);
                $this->u->add_day($add_day);//添加当日奖励
                $this->load->model("Son_model", "s");
                if($user_sid =  $this->s->check_wifi($input))
                {
                    $input['user_sid'] = $user_sid;
                    $input['user_tid'] = $user_id;
                    /*1,添加师徒关系， 2,向师父添加奖励  3，修改师父余额 4,更新徒弟徒孙数*/
                    $add_son = check_params('user_sid,user_tid,time',$input);
                  if($this->s->add_son($add_son)){
                      //添加师徒关系
                      $add_son_reward = array(
                        'user_id'=>$user_sid,
                        'appname'=>'收徒奖励',
                        'type'=>'shoutu',
                        'money'=>$this->s->get_reward($user_sid),
                        'type_id'=>2,
                        'time'=>$input['time'],
                        'typename'=>'收徒'
                        );
                    $this->s->add_son_reward($add_son_reward);//向师父添加奖励
                    $this->s->add_son_balance($user_sid,$add_son_reward);//修改师父余额
                    $this->s->add_son_day($user_sid,$add_son_reward);//更新徒弟徒孙数
                    $this->s->add_son_count($user_sid);//师徒数量统计
                  }
                    $data = array("id"=> $user_id);
                    echo  json_encode($data);exit;
                }else{
                    $data = array("id"=> $user_id);
                    echo  json_encode($data);exit;
                }
            }else{
                $data= array('code'=>"500","message"=>"问题很严重，请向平台反馈。。。。");
                echo  json_encode($data);exit;
            }
        }

    }



}
