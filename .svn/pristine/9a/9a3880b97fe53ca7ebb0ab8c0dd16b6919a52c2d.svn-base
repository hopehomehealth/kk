<?php

class Activity_model extends CI_Model{



	public function __construct(){
		
		parent::__construct();
        $this->load->database();
	}


    public function check_temp_lottery()
    {
        $days = date('Y-m-d');
        $this->db->select('*');
        $this->db->where('days',$days);
        $result = $this->db->get('temp_lottery')->row_object();
        if($result){
            return $result;
        }else{
            $this->db->set('time',date('Y-m-d H:i:s'));
            $this->db->set('days',$days);
            $this->db->insert('temp_lottery');
            return false;
        }
    }

    public function first_lottery($user_id)
    {
        $days = date('Y-m-d');
        $this->db->select('id');
        $this->db->where('user_id',$user_id);
        return $this->db->get('user_lottery')->row_object();
    }

    public function add_user_lottery($lottery_id,$user_id)
    {
        $this->db->set('lottery_id',$lottery_id);
        $this->db->set('days',date('Y-m-d'));
        $this->db->set('time',date('Y-m-d H:i:s'));
        $this->db->set('user_id',$user_id);
        $this->db->insert('user_lottery');
    }

    public function set_money($user_id,$money)
    {
        $this->db->set('money','money + '. $money ,FALSE);
        $this->db->where('id',$user_id);
        return $this->db->update('users');

    }

    public function add_user_fen($user_id,$money)
    {
        $data['user_id'] = $user_id;
        $data['appname'] = '抽奖';
        $data['type'] = 'choujiang';
        $data['money'] = $money;
        $data['time'] = date('Y-m-d H:i:s');
        $data['type_id'] = 5;
        $data['typename'] = '抽奖';
        $this->db->insert('user_fen',$data);
    }

    public function add_lottery_click($user_id,$days)
    {
        $this->db->select('id,click');
        $this->db->where('user_id',$user_id);
        $this->db->where('days',$days);
        $result = $this->db->get('user_lottery_click')->row_object();
        if($result){

            if($user_day = $this->user_day($user_id)){
                if($user_day->day_st_count <= $result->click){
                    return true;
                }
            }else{
                return true;
            }
            if($result->click < 10){
                $this->db->set('click','click+1',FALSE);
                $this->db->where('user_id',$user_id);
                $this->db->where('days',$days);
                $this->db->update('user_lottery_click');
                return false;
            }else{
                return true;
            }
        }else{
            $this->db->set('user_id',$user_id);
            $this->db->set('days',$days);
            $this->db->set('click',1);
            $this->db->insert('user_lottery_click');
            return false;
        }

    }

    public function user_day($user_id)
    {
        $this->db->select('task_income, day_income, day_st_count');
        $this->db->where('user_id',$user_id);
        $this->db->where('DATEDIFF(time,NOW())',0);
        return $this->db->get('user_day')->row_object();
    }

    public function set_temp_lottery($key,$days)
    {
        $this->db->set($key,$key.'+1',FALSE);
        $this->db->where('days',$days);
        $this->db->update('temp_lottery');
    }

    public function big_lottery_reward()
    {
        $this->db->where('days',date('Y-m-d'));
        $this->db->from('user_lottery');
        return $this->db->count_all_results();
    }

















	
}