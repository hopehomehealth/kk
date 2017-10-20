<?php

class User_model extends CI_Model
{

    protected $table = 'users';

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    /**
     * @param $user_id
     * @return mixed
     * 查询用户信息
     */
    public function user_info($user_id)
    {
        $this->db->select('id,openid,idfa,money,reg_time,ip,sex,status,nickname,headimgurl,pay_account,pay_name');
        $this->db->where('id', $user_id);
        return $this->db->get($this->table)->row_object();
    }

    /**
     * @param $user_id
     * @return mixed
     * 查询当天收入情况
     */
    public function user_day($user_id)
    {
        $this->db->select('task_income, day_income, day_st_count');
        $this->db->where('user_id', $user_id);
//        $this->db->order_by('time','DESC');
        $this->db->where('DATEDIFF(time,NOW())', 0);
        return $this->db->get('user_day')->row_object();

    }

    /**
     * @param $user_id
     * @return mixed
     * 用户得分记录
     */
    public function user_reward_history($user_id)
    {
        $this->db->select('appname,time,typename,money');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('time', 'DESC');
        return $this->db->get('user_fen')->result_object();
    }

    /**
     * @param $user_id
     * @return int
     *总收入
     */
    public function total_reward($user_id)
    {
        $this->db->select_sum('money');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get('user_fen')->row_object();
        if ($result) {
            return $result->money;
        } else {
            return 0;
        }
    }

    /**
     * @param $user_id
     * @return int
     * 总兑换金额
     */
    public function total_pay($user_id)
    {
        $this->db->select_sum('money');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get('user_duihuan')->row_object();

        if (!is_null($result)) {
            return $result->money;
        } else {
            return 0;
        }
    }

    /**
     * @param $user_id
     * @param $data
     * @return CI_DB_active_record
     *修改用户信息
     */
    public function set_pay($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    /**
     * @param $data
     * @return CI_DB_active_record
     * 新增 兑换记录
     */
    public function add_pay($data)
    {
        return $this->db->insert('user_duihuan', $data);
    }

    /**
     * @param $user_id
     * @return mixed
     * 兑换列表
     */
    public function list_pay($user_id)
    {
        $this->db->select('time,money,status,type_id,type');
        $this->db->where('user_id', $user_id);
        return $this->db->get('user_duihuan')->result_object();
    }


    /**
     * @param $data
     * @return mixed
     * 注册用户
     */
    public function register_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    /**
     * @param $data
     * @return bool
     * 校验用户IDFA是否已存在
     */
    public function check_idfa($data)
    {

        $this->db->select('id');
        $this->db->where('idfa', $data['idfa']);
        $result = $this->db->get('users')->row_object();
        if ($result) {
            return $result->id;
        } else {
            return false;
        }
        /*$query  = $this->db->query("SELECT id FROM users WHERE idfa='$idfa'");
        if($query->num_rows() === 0){
            return true;
        }else{
            return false;
        }*/
    }

    /**
     * @param $data
     * @return CI_DB_active_record
     * 添加用户详细信息
     */
    public function add_info($data)
    {
        return $this->db->insert('user_info', $data);
    }

    /**
     * @param $data
     * @return CI_DB_active_record
     * 添加得分奖励
     */
    public function add_reward($data)
    {
        return $this->db->insert('user_fen', $data);
    }

    /**
     * @param $data
     * @return CI_DB_active_record
     * 新增今日
     */
    public function add_day($data)
    {
        return $this->db->insert('user_day', $data);
    }

    public function user_balance($user_id)
    {

    }

    /**
     * @param $user_id
     * @param $money
     * @return CI_DB_active_record
     * 扣钱
     */
    public function subtract_money($user_id, $money)
    {
        $this->db->set('money', 'money - ' . $money, FALSE);
        $this->db->where('id', $user_id);
        return $this->db->update('users');
    }

    public function confirm_money($user_id)
    {
        $this->db->select_sum('money');
        $this->db->where('id', $user_id);
        $total = $this->db->get('users')->row_object();
        var_dump($total);
        $this->db->select_sum('money');
        $this->db->where('user_id', $user_id);
        $pay = $this->db->get('user_duihuan')->row_object();
        var_dump($pay);
        exit;
        $m = $total - $pay;
        $this->db->set('money', $m);
        $this->db->where('id', $user_id);
        $this->db->update('users');
    }

    /**
     * @param $wx_id
     * @return mixed
     * 通过wx_user 的id 获取用户基本信息
     */
    public function get_openid($wx_id)
    {
        $this->db->select('nickname,headimgurl,sex,openid');
        $this->db->where('id', $wx_id);
        return $this->db->get('wx_users')->row_object();
    }

    /**
     * @param $user_id
     * @param $data
     * @return CI_DB_active_record
     * 在User中设置用户的openid
     */
    public function set_user_openid($user_id, $data)
    {
        if (!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/", $data->nickname)) {
            $this->db->set('nickname', $data->nickname);
        }
        $this->db->set('openid', $data->openid);
        $this->db->set('headimgurl', $data->headimgurl);
        $this->db->where('id', $user_id);
        return $this->db->update('users');
    }

    /**
     * @param $user_id
     * @param $money
     * @return bool
     * 绑定微信获取奖励
     */
    public function webchat_reward($user_id, $money)
    {
        $data = new stdClass();
        $data->user_id = $user_id;
        $data->appname = "绑定微信";
        $data->appid = 0;
        $data->type = "bind";
        $data->money = $money;
        $data->time = date('Y-m-d H:i:s');
        $data->typename = "绑定";
        $this->db->insert('user_fen', $data);
        $this->add_bind_reward($data->user_id, $data->money);
        $this->set_user_day($user_id, $data);
        return true;
    }

    /**
     * @param $user_id
     * @param $money
     * @return CI_DB_active_record
     * 绑定余额修改
     */
    public function add_bind_reward($user_id, $money)
    {
        $this->db->set('money', 'money+' . $money, FALSE);
        $this->db->where('id', $user_id);
        return $this->db->update('users');
    }

    /**
     * @param $id
     * @param $data
     * @return CI_DB_active_record
     * 设置当日数据
     */
    public function set_user_day($id, $data)
    {
        $money = $data->money;
        $day = date('Y-m-d');
        if ($user_day = $this->check_day($id, $day)) {
            $array = array(
                "day_income" => (float)$user_day->day_income + $money,
                "task_income" => (float)$user_day->task_income + $money
            );
            $this->db->where('id', $user_day->id);
            $this->db->where('user_id', $id);
            return $this->db->update('user_day', $array);
        } else {
            $array = array(
                "user_id" => $id,
                "task_income" => $money,
                "day_income" => $money,
                "time" => date('Y-m-d H:i:s')
            );
            return $this->db->insert('user_day', $array);
        }
    }

    /**
     * @param $id
     * @param $day
     * @return bool
     * 验证当日是否存在记录
     */
    private function check_day($id, $day)
    {
        $this->db->select('id, task_income, day_income, day_st_count');
        $this->db->where('user_id', $id);
        $this->db->where("DATE(time)", $day);
        $result = $this->db->get('user_day')->row_object();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param $user_id
     * @return bool
     * 校验用户的openid
     */
    public function is_user_openid($user_id)
    {
        $this->db->select('openid');
        $this->db->where('id', $user_id);
        $res = $this->db->get('users')->row_object();
        if ($res) {
            if (empty($res->openid) || is_null($res->openid)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $user_id
     * @return bool
     * 校验用户是否活得绑定奖励
     */
    public function is_bind_reward($user_id)
    {
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', 'bind');
        $result = $this->db->get('user_fen')->row_object();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


}