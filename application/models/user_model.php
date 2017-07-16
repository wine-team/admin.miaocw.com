<?php
class User_model extends CI_Model
{
    private $table = 'user';

    public function findById($uid)
    {
        $this->db->where('uid', $uid);
        return $this->db->get($this->table);
    }

    /**
     * 根据条件搜索
     * @param unknown $param
     */
    public function findByParams($param=array())
    {
        if (!empty($param['parent_id'])) {
            $this->db->where('uid', $param['parent_id']);
        }
        return $this->db->get($this->table);
    }

    public function total($params=array())
    {
        $this->db->from($this->table);
        if (!empty($params['username'])) {
            $this->db->where("((`user`.`uid`='{$params['username']}') OR (`user`.`alias_name` LIKE '%{$params['username']}%'))");
        }
        if (!empty($params['phoneEmail'])) {
            $this->db->where("((`user`.`phone`='{$params['phoneEmail']}') OR (`user`.`email` LIKE '%{$params['phoneEmail']}%'))");
        }
        if (!empty($params['user_type'])) {
            $this->db->where('user.user_type & '.$params['user_type'].'=', $params['user_type']);
        }
        if (!empty($params['parent_id'])) {
            $this->db->where('parent_id', $params['parent_id']);
        }
        if (!empty($params['flag'])) {
            $this->db->where('flag', $params['flag']);
        }
        if (!empty($params['start_time'])) {
            $this->db->where('created_at >=',$params['start_time']);
        }
        if (!empty($params['end_time'])) {
            $this->db->where('created_at <=',$params['end_time']);
        }
        return $this->db->count_all_results();
    }

    public function page_list($page_num, $num, $params=array())
    {
        $this->db->from($this->table.' as user');
        if (!empty($params['username'])) {
            $this->db->where("((`user`.`uid`='{$params['username']}') OR (`user`.`alias_name` LIKE '%{$params['username']}%'))");
        }
        if (!empty($params['phoneEmail'])) {
            $this->db->where("((`user`.`phone`='{$params['phoneEmail']}') OR (`user`.`email` LIKE '%{$params['phoneEmail']}%'))");
        }
        if (!empty($params['user_type'])) {
            $this->db->where('user.user_type & '.$params['user_type'].'=', $params['user_type']);
        }
        if (!empty($params['parent_id'])) {
            $this->db->where('parent_id', $params['parent_id']);
        }
        if (!empty($params['flag'])) {
            $this->db->where('flag',$params['flag']);
        }
        if (!empty($params['start_time'])) {
            $this->db->where('created_at >=',$params['start_time']);
        }
        if (!empty($params['end_time'])) {
            $this->db->where('created_at <=',$params['end_time']);
        }
        $this->db->order_by('user.uid', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

    public function insert($postData)
    {
        $data = array(
            'alias_name'   => !empty($postData['alias_name']) ? $postData['alias_name'] : '',
            'phone'         => $postData['phone'],
            'email'         => !empty($postData['email']) ? $postData['email'] : '',
            'user_type'    => array_sum($postData['userType']),
            'parent_id'    => !empty($postData['parent_id']) ? $postData['parent_id'] : 0,
            'password'     => md5(sha1($postData['password'])),
            'sex'           => $postData['sex'],
            'user_money'   => !empty($postData['user_money']) ? $postData['user_money'] : 0,
            'frozen_money' => !empty($postData['frozen_money']) ? $postData['frozen_money'] : 0,
            'pay_points'   => !empty($postData['pay_points']) ? $postData['pay_points'] : 0,
            'flag'          => $postData['flag'],
            'sms'           => !empty($postData['sms']) ? $postData['sms'] : 1,
            'created_at'   => date('Y-m-d H:i:s')
        );
        if (!empty($params['birthday'])) {
            $data['birthday'] = $params['birthday'];
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($postData)
    {
        $data = array(
            'alias_name'   => !empty($postData['alias_name']) ? $postData['alias_name'] : '',
            'phone'         => $postData['phone'],
            'email'         => !empty($postData['email']) ? $postData['email'] : '',
            'user_type'    => array_sum($postData['userType']),
            'parent_id'    => !empty($postData['parent_id']) ? $postData['parent_id'] : 0,
            'sex'           => $postData['sex'],
            'user_money'   => !empty($postData['user_money']) ? $postData['user_money'] : 0,
            'frozen_money' => !empty($postData['frozen_money']) ? $postData['frozen_money'] : 0,
            'pay_points'   => !empty($postData['pay_points']) ? $postData['pay_points'] : 0,
            'flag'          => $postData['flag'],
            'sms'           => !empty($postData['sms']) ? $postData['sms'] : 1,
        );
        if (!empty($params['password'])) {
            $data['password'] = md5(sha1($postData['password']));
        }
        if (!empty($params['birthday'])) {
            $data['birthday'] = $params['birthday'];
        }
        return $this->db->update($this->table, $data, array('uid'=>$postData['uid']));
    }

    /**
     * 更新用户表信息
     * @param unknown $postData
     */
    public function updateUser($postData = array())
    {
        if (!empty($postData['flag'])) {
            $data['flag'] = $postData['flag'];
        }
        return $this->db->update($this->table, $data, array('uid'=>$postData['uid']));
    }
    
     /**
     * 更新用户表  退钱到账户
     * @param unknown $uid
     * @param unknown $account
     */
    public function updateUserAcount($uid, $account=array())
    {
        $data = array();
        if (!empty($account['amount_carry'])) {
            $this->db->set('user_money', 'user_money+'.$account['amount_carry'], FALSE);
        }
        $this->db->where('uid', $uid);
        return $this->db->update($this->table, $data);
    }
     
    /**
     * 验证手机号码
     * @param unknown $phone
     */
    public function validatePhone($phone)
    {
        $this->db->where('phone', $phone);
        return $this->db->get($this->table);
    }

    /**
     * 验证用户邮箱
     * @param unknown $email
     */
    public function validateEmail($email)
    {
        $this->db->where('email', $email);
        return $this->db->get($this->table);
    }
}