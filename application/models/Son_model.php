<?php

class Son_model extends CI_Model
{


    public function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    public function total_son_reward($user_id)
    {
        $this->db->select_sum('money');
        $this->db->where('user_id', $user_id);
        $this->db->where('type_id', 2);
        $result = $this->db->get("user_fen")->row_object();
        if ($result) {
            return $result->money;
        } else {
            return 0.00;
        }
    }


    public function count_son_num($user_id)
    {
        $this->db->select('count_td,count_ts');
        $this->db->where('user_id', $user_id);
        return $this->db->get('user_shitu_count')->row_object();
    }


    public function add_wifi($data)
    {
//        $ip = $data['ip'];
        $ip = $this->input->ip_address();
        $query = $this->db->query("SELECT id FROM wifi WHERE ip='$ip'");
        if ($query->num_rows() === 0) {
            return $this->db->insert('wifi', $data);
        } else {
            return false;
        }
    }


    public function check_wifi($data)
    {
        $this->db->select('sid');
        $this->db->where('ip', $data['ip']);
        $result = $this->db->get('wifi')->row_object();
        if ($result) {
            return $result->sid;
        } else {
            return false;
        }
    }


    public function add_son($data)
    {
        if ($this->ip_user_number(IP_3_USER_MAX_NUM)) {
            return $this->db->insert('user_shitu', $data);
        } else {
            return false;
        }
    }

    private function ip3_number($number = 3)
    {
        $ip = $this->input->ip_address();
        $arr=explode(".",$ip);
        $ip3=$arr[0].".".$arr[1] . "." .$arr[2];
        $this->db->like('ip', $ip3);
        $this->db->from('wifi');
        $count = $this->db->count_all_results(); // Produces an integer, like 17
        if ($count < $number) {
            return true;
        } else {
            return false;
        }
    }

    private function ip_user_number($number = 2)
    {
        $ip = $this->input->ip_address();
        $arr=explode(".",$ip);
        $ip3=$arr[0].".".$arr[1] . "." .$arr[2];
        $this->db->like('ip', $ip3);
        $this->db->from('users');
        $count = $this->db->count_all_results(); // Produces an integer, like 17
        if ($count < $number) {
            return true;
        } else {
            return false;
        }
    }

    public function get_reward($id)
    {
        /*return 3.00;
        if ($id == 76276) {
            return 3.00;
        }
        if ($id == 154751) {
            return 1.00;
        }*/
        $this->db->select('count_td,new_rule');
        $this->db->where('user_id', $id);
        $result = $this->db->get('user_shitu_count')->row_object();
        if ($result) {
            $num = (int)$result->count_td - (int)$result->new_rule;
            return $this->reward_rule_son($num);
        } else {
            return 1;
        }
    }

    private function reward_rule_son($num)
    {
        if($num == 0){
            return 1.00;
        }

        if ($num < 30) {
            $reward = 1.00;
        }
        if ($num >= 30 && $num < 100) {
            $reward = 1.50;
        }
        if ($num >= 100 && $num < 500) {
            $reward = 2.00;
        }
        if ($num >= 500 && $num < 1000) {
            $reward = 2.50;
        }
        if ($num >= 1000) {
            $reward = 3.00;
        }
        return $reward;
    }

    public function add_son_reward($data)
    {
        $result = $this->db->insert('user_fen',$data);
        if($result){

            return true;
        }else{
            return false;
        }
    }

    public function add_son_balance($id,$data)
    {
        $money = $data['money'];
        $this->db->set('money', 'money+'.$money, FALSE);
        $this->db->where('id', $id);
        return $this->db->update('users');
    }

    public function add_son_day($id,$data)
    {
        $money = $data['money'];
        $day = date('Y-m-d');
        if($user_day = $this->check_day($id,$day))
        {
            $array = array(
                "day_income"=> (float)$user_day->day_income + $money ,
                "day_st_count" => (int)$user_day->day_st_count + 1
            );
            $this->db->where('id',$user_day->id);
            $this->db->where('user_id',$id);
            return $this->db->update('user_day',$array);
        }else{
            $array = array(
                "user_id"=>$id,
                "task_income"=>0.00,
                "day_income"=>$money,
                "day_st_count"=>1,
                "time"=>date('Y-m-d H:i:s')
            );
            return $this->db->insert('user_day',$array);
        }

    }

    private function check_day($id,$day)
    {
        $this->db->select('id, task_income, day_income, day_st_count');
        $this->db->where('user_id',$id);
        $this->db->where("DATE(time)",$day);
        $result = $this->db->get('user_day')->row_object();
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function add_son_count($id)
    {
        $query = $this->db->query("SELECT id FROM user_shitu_count WHERE user_id='$id'");
        if ($query->num_rows() === 0) {
            $this->db->set('user_id',$id);
            $this->db->set('count_td',1);
            $this->db->set('count_ts',0);
            $this->db->set('new_rule',0);
            $this->db->insert('user_shitu_count');
        } else {
            $this->db->set('count_td','count_td+1',FALSE);
            $this->db->where('user_id',$id);
            $this->db->update('user_shitu_count');
        }

        $this->add_son_son_count($id);
    }

    public function add_son_son_count($id)
    {
        $this->db->select('user_sid');
        $this->db->where('user_tid',$id);
        $result = $this->db->get('user_shitu')->row_object();
        if($result)
        {
            $user_sid = $result->user_sid;
            $this->db->set('count_ts','count_ts+1',FALSE);
            $this->db->where('user_id',$user_sid);
            return $this->db->update('user_shitu_count');
        }else{
            return false;
        }

    }



}