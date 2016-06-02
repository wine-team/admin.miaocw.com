<?php
class Admin_action_model extends CI_Model
{
    private $table = 'admin_action';

    public function get_modules()
    {
        $query = $this->db->get_where($this->table, array('parent_id' => 0));
        $rows = array();
        foreach ($query->result_array() as $row) {
            $rows[$row['id']] = $row;
        }
        return $rows;
    }
    
    function get_actions()
    {
        $query = $this->db->get_where($this->table, array('parent_id != ' => 0));
        $rows = array();
        foreach ($query->result_array() as $row) {
            $rows[$row['id']] = $row;
        }
        return $rows;
    }

    public function find()
    {
        return $this->db->get($this->table);
    }
    
    public function findLimit()
    {
        $this->db->where('parent_id', 0);
        return $this->db->get($this->table);
    }
    
    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }
    
    public function total($params=array())
    {
        $this->db->where(array('parent_id = ' => 0));
        if (!empty($params['actionname'])) {
            $this->db->where("(`action_code` LIKE '%{$params['actionname']}%') OR (`cn_name` = '{$params['actionname']}')");
        }
        return $this->db->count_all_results($this->table);
    }
    
    public function page_list($pageNum, $num, $params=array())
    {
        $this->db->where(array('parent_id = ' => 0)); 
        if (!empty($params['actionname'])) {
            $this->db->where("(`action_code` LIKE '%{$params['actionname']}%') OR (`cn_name` = '{$params['actionname']}')");
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($pageNum, $num);
        return $this->db->get($this->table);
    }
    
    public function childTotal($parent_id)
    {
        $this->db->where('parent_id', $parent_id);
        return $this->db->count_all_results($this->table);
    }
    
    public function childPageList($pageNum, $num, $parent_id)
    {
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($pageNum, $num);
        return $this->db->get($this->table);
    }
    
    public function insertAdminaction($postData)
    {
        $data = array(
            'action_code' => $postData['action_code'],
            'cn_name'     => $postData['cn_name'],
            'parent_id'   => $postData['parent_id']
        );
    
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateAdminaction($postData)
    {
        $data = array(
            'action_code' => $postData['action_code'],
            'cn_name'     => $postData['cn_name'],
            'parent_id'   => $postData['parent_id']
        );
    
        $this->db->where('id', $postData['id']);
        return $this->db->update($this->table, $data);
    }
    
    public function deleteById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    public function deleteChild($parent_id)
    {
        $this->db->where('parent_id', $parent_id);
        return $this->db->delete($this->table);
    }
    
    public function validateActionCode($actionCode)
    {
        $this->db->where('action_code', $actionCode);
        if ($this->db->count_all_results($this->table) > 0) {
            return true;
        }
        return false;
    }
}