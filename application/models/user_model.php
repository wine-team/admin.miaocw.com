<?php
class User_model extends CI_Model
{
    private $table   = 'user';
  
    public function findById($uid)
    {
        $this->db->where('uid', $uid);
        return $this->db->get($this->table);
    }
    
    public function total($params=array())
    {
        $this->db->from($this->table);
        if (!empty($params['phone'])) {
            $this->db->where('phone', $params['phone']);
        }
        if (!empty($params['email'])) {
            $this->db->where('email', $params['email']);
        }
        if (!empty($params['flag'])) {
        	$this->db->where('flag', $params['flag']);
        }
        if (!empty($params['start_time'])) {
        	$this->db->where('created_at >=', $params['start_time']);
        }
        if(!empty($params['end_time'])){
        	$this->db->where('created_at <=', $params['end_time']);
        }
        return $this->db->count_all_results();
    }
    
    public function page_list($page_num, $num, $params=array())
    {
        $this->db->select('user.*');
        $this->db->from($this->table.' as user');
        if (!empty($params['phone'])) {
            $this->db->where('phone', $params['phone']);
        }
        if (!empty($params['email'])) {
            $this->db->where('email', $params['email']);
        }
        if (!empty($params['flag'])) {
        	$this->db->where('flag',$params['flag']);
        }
        if(!empty($params['start_time'])){
        	$this->db->where('created_at >=',$params['start_time']);
        }
        if(!empty($params['end_time'])){
        	$this->db->where('created_at <=',$params['end_time']);
        }
        $this->db->order_by('user.uid', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }
    
    public function insert($postData)
    {
        $data = array(
            'phone'        => $postData['phone'],
            'email'        => $postData['email'],
            'parent_id'   => !empty($postData['parent_id']) ? $postData['parent_id'] : 0,
            'password'    => md5(sha1($postData['password'])),
            'flag'         => 1,
            'sms'          => !empty($postData['sms']) ? $postData['sms'] : 1,
            'created_at'  => date('Y-m-d H:i:s')
        );
        if (!empty($postData['photo'])) {
        	$data['photo'] = $postData['photo'];
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($postData)
    {
        $data = array(
            'user_name'    => $postData['user_name'],
            'phone'        => $postData['phone'],
        	'cellphone'    => $postData['cellphone'],
            'user_type'    => $postData['user_type'],
            'parent_id'    => ttrim($postData,'parent_id',1),
            'flag'         => $postData['flag'],
            'sms_flag'     => ttrim($postData,'sms_flag',1)
        );
        return $this->db->update($this->table, $data, array('uid'=>$postData['uid']));
    }
    
    /**
     * 更新用户表信息
     * @param unknown $postData
     */
    public function updateUserInfo($postData = array())
    {
        if (!empty($postData['flag'])) {
            $data['flag'] = $postData['flag'];
        }
        return $this->db->update($this->table, $data, array('uid'=>$postData['uid']));
    }
    
    public function findByUserName($postData)
    {
        if (!empty($postData['user_name'])) {
            $this->db->where('user_name', $postData['user_name']);
            if (!empty($postData['alias_name'])) {
                $this->db->or_where('alias_name', $postData['alias_name']);
            }
        }
        return $this->db->get($this->table);
    }
    
    /**
     * 验证用户名
     * @param unknown $userName
     */
    public function validateName($userName)
    {
        $this->db->where('user_name', $userName);
        return $this->db->get($this->table);
    }
    
    /**
     * 验证手机号码
     * @param unknown $userName
     */
    public function validatePhone($phone)
    {
        $this->db->where('phone', $phone);
        return $this->db->get($this->table);
    }
    
    /**
     * 根据条件搜索
     * @param unknown $param
     */
    public function findByIds($param=array())
    {
    	if (!empty($param['parent_id'])) {
    		$this->db->where('uid',$param['parent_id']);
    	}
    	return $this->db->get($this->table);
    }
}