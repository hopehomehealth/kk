<?php

class Task_model extends CI_Model
{


    public function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    /**
     * @param $user_id
     * @return mixed
     * 在线任务列表
     */
    public function task_list_online($user_id)
    {
        $sql = "SELECT id,location,imgUrl,keywords,amountP,amountA,endTime,guide,reward FROM app WHERE invisible=1 AND `status`=1 AND id NOT IN (SELECT app_id FROM user_play WHERE (`status`=2  OR `status`=3) AND user_id=$user_id) ORDER BY orderWeight DESC ";
        return $this->db->query($sql)->result_object();
    }

    /**
     * @return mixed
     * 任务灰色列表
     */
    public function task_list_gray()
    {
        $this->db->select("id,name,price,reward,imgUrl,guide,keywords");
        $this->db->where("invisible", 1);
        $this->db->where("status", 0);
        $this->db->order_by('id', 'DESC');
        return $this->db->get("app")->result_object();
    }

    public function task_list_out($user_id)
    {
        $this->db->select('app.id,location,imgUrl,keywords,amountP,amountA,endTime,guide,reward,user_play.timec');
        $this->db->from('app');
        $this->db->join('user_play', 'user_play.app_id = app.id', 'inner');
        $this->db->where('app.status', 0);
        $this->db->where('user_play.status', 0);
        $this->db->where('user_play.user_id', $user_id);
        return $this->db->get()->result_object();
    }

    public function user_info($user_id)
    {
        $this->db->select('id,openid,idfa,money,reg_time,ip,sex,status,nickname,headimgurl,pay_account,pay_name');
        $this->db->where('id', $user_id);
        return $this->db->get($this->table)->row_object();
    }

    public function check_task($user_id, $appid)
    {
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $this->db->where('app_id', $appid);
        $this->db->where('status', 2);
        return $this->db->get('user_play')->row_object();
    }

    public function task_status($appid)
    {
        $this->db->select('id,name,appstoreUrl,way,actionType,validation,validUrl,validReturn,validType,validParams,callbackUrl,appIdentifier');
        $this->db->where('id', $appid);
        $this->db->where('status', 1);
        return $this->db->get('app')->row_object();
    }

    public function verify_api($idfa, $app)
    {
        $app->validReturn = str_replace('{idfa}', $idfa, $app->validReturn);
        switch ($app->validType) {
            case 1:
                $app->validUrl = str_replace('{idfa}', $idfa, $app->validUrl);
                $app->validUrl = str_replace('{appid}', $app->appIdentifier, $app->validUrl);
                $return_json = get_curl($app->validUrl);
                break;
            case 2:
                $app->validParams = str_replace('{idfa}', $idfa, $app->validParams);
                $app->validUrl = str_replace('{appid}', $app->appIdentifier, $app->validUrl);
                $data = json_decode($app->validParams, true);
                $return_json = post_curl($app->validUrl, $data);
                break;
            case 3:
                $app->validParams = str_replace('{idfa}', $idfa, $app->validParams);
                $app->validUrl = str_replace('{appid}', $app->appIdentifier, $app->validUrl);
                $return_json = post_curl($app->validUrl, $app->validParams);
                break;
        }
        if (trim($return_json) === trim($app->validReturn)) {
            return true;
        } else {
            return false;
        }
    }

    public function mark_task($app, $user_id, $idfa, $status)
    {
        $this->db->select('id');
        $this->db->where('app_id', $app->id);
        $this->db->where('user_id', $user_id);
        $result = $this->db->get('user_play')->row_object();
        if ($result) {
            $this->db->set('status', $status);
            $this->db->where('app_id', $app->id);
            $this->db->where('user_id', $user_id);
            $this->db->update('user_play');
            return false;
        } else {
            $this->db->set('user_id', $user_id);
            $this->db->set('idfa', $idfa);
            $this->db->set('app_id', $app->id);
            $this->db->set('app_name', $app->name);
            $this->db->set('timec', date('Y-m-d H:i:s'));
            $this->db->set('ipc', $this->input->ip_address());
            $this->db->set('status', $status);
            return $this->db->insert('user_play');
        }
    }

    public function add_task_click_number($appid)
    {
        $this->db->set('click_num', 'click_num+1', FALSE);
        if (!$this->sold_out_task($appid)) {
            $this->db->set('status', 0, FALSE);
        }
        $this->db->where('id', $appid);
        return $this->db->update('app');
    }

    private function sold_out_task($appid)
    {
        $this->db->select('amountP,amountA,click_num,add_click');
        $this->db->where('id', $appid);
        $app = $this->db->get('app')->row_object();
        $total = (int)$app->amountP + (int)$app->add_click;
        $click = (int)$app->click_num + 1;
        if ($click < $total) {
            return true;
        } else {
            return false;
        }
    }

    public function add_start_click($appid, $time)
    {
        $this->db->set('app_id', $appid);
        $this->db->set('time', $time);
        return $this->db->insert("start_task");
    }


    public function check_task_click($appid, $user_id, $idfa)
    {
        $this->db->select('timec');
        $this->db->where('app_id', $appid);
        $this->db->where('user_id',$user_id);
        $this->db->where('status', 0);
        if ($result = $this->db->get('user_play')->row_object()) {
            $app = $this->check_post_click($appid);
            $timec = strtotime($result->timec) + (int)$app->actionTime;
            if ($timec > time()) {
                return false;
            } else {
                return $app;
            }
        } else {
            return false;
        }
    }

    private function check_post_click($appid)
    {
        $this->db->select('actionTime,validation,validType,validUrl,validParams,validReturn,pro');
        $this->db->where('id', $appid);
        return $this->db->get('app')->row_object();
    }

    public function api_list($user_id)
    {
        $this->db->select('a.imgUrl AS headimgurl, a.keywords AS keywords ,a.reward AS reward,a.pro AS processname');
        $this->db->from('user_play AS p');
        $this->db->join('app AS a', 'a.id=p.app_id', 'left');
        $this->db->where("p.`status`=0 AND p.user_id=$user_id AND p.timec >'2015-09-18 12:11:37'");
        return $this->db->get()->result_object();
    }

    public function play_info($user_id, $app_id)
    {
        $this->db->select('user_id,app_id,app_name,idfa,timec,timea,status');
        $this->db->where('user_id', $user_id);
        $this->db->where('app_id', $app_id);
        $this->db->where('status',0);
        $result = $this->db->get('user_play')->row_object();
        if(!$result){
            return false;
        }
        if(strtotime($result->timec)+300 > time() ){
            return false;
        }else{
            //二次排重
            /*if($app = $this->task_status($app_id)){
                if($this->verify_api($result->idfa,$app)){
                    return false;
                }
            }*/
            return $result;    
        }
    }

    public function set_play($user_id, $app_id, $status = 2)
    {
        $this->db->set('status', $status);
        $this->db->set('timea', date('Y-m-d H:i:s'));
        $this->db->set('ipa', $this->input->ip_address());
        $this->db->where('user_id', $user_id);
        $this->db->where('app_id', $app_id);
        return $this->db->update('user_play');
    }


    public function add_task_reward($user_id, $money)
    {
        $this->db->set('money', 'money+' . $money, FALSE);
        $this->db->where('id', $user_id);
        return $this->db->update('users');
    }

    public function app_money($appid)
    {
        $this->db->select('reward');
        $this->db->where('id', $appid);
        $result = $this->db->get('app')->row_object();
        if ($result) {
            return $result->reward;
        } else {
            return 0.00;
        }
    }

    public function check_parent($user_id)
    {
        $this->db->select('user_sid');
        $this->db->where('user_tid', $user_id);
        $result = $this->db->get('user_shitu')->row_object();
        if ($result) {
            return $result->user_sid;
        } else {
            return false;
        }
    }

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
     *添加任务奖励
     */
    public function task_reward($userid, $appid, $play)
    {
        $data = new stdClass();
        $data->user_id = $play->user_id;
        $data->appname = $play->app_name;
        $data->appid = $play->app_id;
        $data->type = "renwu";
        $data->money = $this->app_money($appid);
        $data->time = date('Y-m-d H:i:s');
        $data->typename = "任务";
        $this->db->insert('user_fen', $data);
        $this->append_task_active_number($appid);
        $this->add_task_reward($data->user_id, $data->money);
        $this->set_user_day($userid, $data);
        $this->task_parent_reward($data);
        return true;
    }

    public function append_task_active_number($appid)
    {
        $this->db->set('amountA', 'amountA+1', FALSE);
        if (!$this->sold_out_task($appid)) {
            $this->db->set('status', 0, FALSE);
        }
        $this->db->where('id', $appid);
        return $this->db->update('app');
    }

    public function task_parent_reward($data)
    {
        $data->user_id = $pid = $this->check_parent($data->user_id);
        if ($pid) {
            $data->money = ($data->money * 10) / 100;
            $data->type = "tudijiangli";
            $data->typename = "徒弟任务奖励";
            $this->add_task_reward($data->user_id, $data->money);
            $status = $this->db->insert('user_fen', $data);
            $this->set_user_day($data->user_id, $data);
            if ($status) {
                $this->task_parent_parent_reward($data);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function task_parent_parent_reward($data)
    {
        $data->user_id = $pid = $this->check_parent($data->user_id);
        if ($pid) {
            $data->money = ($data->money * 5) / 100;
            $data->type = "tusunjiangli";
            $data->typename = "徒孙任务奖励";
            $this->add_task_reward($data->user_id, $data->money);
            $this->db->insert('user_fen', $data);
            $this->set_user_day($data->user_id, $data);
        } else {
            return false;
        }
    }


    public function check_morrow_reward($appid, $play)
    {
        $timea = $play->timea;
        $time_day = date('Y-m-d', strtotime($timea));
        $now_day = date('Y-m-d');

        if ($time_day === $now_day) {
            return false;
        }
        $this->db->select('money');
        $this->db->where("app_id=$appid AND DATEDIFF(NOW(),'$timea') < days");
        $result = $this->db->get('keep_app')->row_object();
        if ($result) {
            return $result->money;
        } else {
            return false;
        }
    }


    public function add_morrow_reward($userid, $appid, $money, $play)
    {
        $day = date('Y-m-d');
        $this->db->select('id');
        $this->db->where('type', 'ciri');
        $this->db->where("DATE(time)", $day);
        $this->db->where('user_id', $userid);
        $this->db->where('appid', $appid);
        if ($this->db->get('user_fen')->row_object()) {
            return false;
        }
        $data = new stdClass();
        $data->user_id = $play->user_id;
        $data->appname = $play->app_name;
        $data->appid = $play->app_id;
        $data->type = "ciri";
        $data->money = $money;
        $data->time = date('Y-m-d H:i:s');
        $data->typename = "次日任务";
        $this->db->insert('user_fen', $data);
        $this->add_task_reward($data->user_id, $data->money);
        $this->set_user_day($userid, $data);
        $this->task_parent_reward($data);
        return true;
    }


}