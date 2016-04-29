<?php
class Admin_user_model extends CI_Model
{
    private $table   = 'admin_user';
    private $table_2 = 'role';

    public function total($params=array()) 
    {
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
         $this->db->join('role','admin_user.role_id=role.id','left');
        return $this->db->count_all_results($this->table);
    }   
			
    public function page_list($page_num, $num, $params=array())
    {
        
    	$this->db->select('admin_user.*,role.name AS role_name');
    	$this->db->from($this->table);
    	$this->db->join('role','admin_user.role_id=role.id','left');
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
    
    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }
    
    public function validateAdminuser($postData)
    {
        $this->db->where('name', $postData['name']);
        $this->db->or_where('email', $postData['email']);
        if ($this->db->count_all_results($this->table) > 0) {
            return true;
        }
        return false;
    }
    
     /**
     * 后台用户登录
     * @param unknown $postData
     * @return unknown|boolean
     */
    public function login($postData)
    {
        $this->db->select('admin_user.*, role.name as role_name');
        $this->db->from($this->table.' as admin_user');
        $this->db->join($this->table_2.' as role', 'admin_user.role_id = role.id');
        $this->db->where('admin_user.name', $postData['username']);
        $this->db->where('admin_user.password', md5($postData['password']));
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result;
        }
        return false;
    }
    
    function resetpwd($uid)
    {
        $this->db->where('id', $uid);
        $data = array('password'=>md5('123456'));
        return $this->db->update($this->table, $data);
    }
}