<?php
class Admin_user_model extends CI_Model
{
    private $table   = 'admin_user';
    private $table_2 = 'admin_role';

    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    public function total($params=array()) 
    {
        $this->db->from($this->table);
        $this->db->join('admin_role','admin_user.role_id=admin_role.id','left');
        if (!empty($params['username'])) {
            $this->db->where("((`name` LIKE '%{$params['username']}%') OR (`realname` LIKE '%{$params['username']}%'))");
        }
        if (!empty($params['email'])) {
            $this->db->where('email', $params['email']);
        }
        if (!empty($params['role_id'])) {
            $this->db->where('role_id', $params['role_id']);
        }
        if (isset($params['flag']) && is_numeric($params['flag'])) {
            $this->db->where('flag', $params['flag']);
        }
        return $this->db->count_all_results();
    }   
			
    public function page_list($page_num, $num, $params=array())
    {
        
    	$this->db->select('admin_user.*,admin_role.name AS role_name');
    	$this->db->from($this->table);
    	$this->db->join('admin_role','admin_user.role_id=admin_role.id','left');
    	if (!empty($params['username'])) {
            $this->db->where("((`admin_user.name` LIKE '%{$params['username']}%') OR (`admin_user.realname` LIKE '%{$params['username']}%'))");
        }
        if (!empty($params['email'])) {
            $this->db->where('admin_user.email', $params['email']);
        }
        if (!empty($params['role_id'])) {
            $this->db->where('admin_user.role_id', $params['role_id']);
        }
        if (isset($params['flag']) && is_numeric($params['flag'])) {
            $this->db->where('admin_user.flag', $params['flag']);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

    public function insertAdminuser($postData)
    {
        $data = array(
            'name'       => $postData['name'],
            'email'      => trim($postData['email']),
            'password'   => md5($postData['password']),
            'role_id'    => trim($postData['role_id']),
            'created_at' => date('Y-m-d H:i:s', time())
        );
        if (!empty($postData['realname'])) {
            $data['realname'] = trim($postData['realname']);
        }
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateAdminuser($postData)
    {
        $data = array(
            'email'      => trim($postData['email']),
            'updated_at' => date('Y-m-d H:i:s', time())
        );
        if (!empty($postData['name'])) {
            $data['name'] = trim($postData['name']);
        }
        if (!empty($postData['role_id'])) {
            $data['role_id'] = trim($postData['role_id']);
        }
        if (!empty($postData['realname'])) {
            $data['realname'] = trim($postData['realname']);
        }
        if (!empty($postData['modify_password'])) {
            $data['password'] = md5($postData['password']);
        }
        $this->db->where('id', $postData['id']);
        return $this->db->update($this->table, $data);
    }
    
    public function deleteById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function validateAdminuser($postData)
    {
        $this->db->where('name', $postData['name']);
        $this->db->or_where('email', $postData['email']);
        return $this->db->count_all_results($this->table);
    }
    
     /**
     * 后台用户登录
     * @param unknown $postData
     * @return unknown|boolean
     */
    public function login($postData)
    {
        $this->db->where('name', $postData['username']);
        $this->db->where('password', md5($postData['password']));
        return $this->db->get($this->table);
    }
    
    function resetpwd($uid)
    {
        $this->db->where('id', $uid);
        $data = array('password'=>md5('123456'));
        return $this->db->update($this->table, $data);
    }
}