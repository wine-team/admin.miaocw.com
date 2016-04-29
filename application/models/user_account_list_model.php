<?php
class User_account_list_model extends CI_Model
{
    private $table = 'user_account_list';

    public function total($search_param=array())
    {
        if (!empty($search_param['name'])) {
            $this->db->where('name', $search_param['name']);
        }
        if (!empty($search_param['contact'])) {
            $this->db->where('contact', $search_param['contact']);
        }
        if (!empty($search_param['uid'])) {
            $this->db->where('uid', $search_param['uid']);
        }
        if (!empty($search_param['flag'])) {
            $this->db->where('flag', $search_param['flag']);
        }
        return $this->db->count_all_results($this->table);
    }
    
    public function page_list($page_num, $num, $search_param=array())
    {
        if (!empty($search_param['name'])) {
            $this->db->where('name', $search_param['name']);
        }
        if (!empty($search_param['contact'])) {
            $this->db->where('contact', $search_param['contact']);
        }
        if (!empty($search_param['uid'])) {
            $this->db->where('uid', $search_param['uid']);
        }
        if (!empty($search_param['flag'])) {
            $this->db->where('flag', $search_param['flag']);
        }
        $this->db->order_by('id','desc');
        $this->db->limit($page_num, $num);
        return $this->db->get($this->table);
    }
    
    public function updateAuditStatus($id, $status)
    {
        $data = array(
            'flag' => $status,
        );
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }
    
    public function deleteById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}