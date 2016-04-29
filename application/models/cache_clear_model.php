<?php
class Cache_clear_model extends CI_Model
{
    private $table = 'cache_clear';
    public function total($getData)
    {   
        if (!empty($getData['cache_name'])) {
           $this->db->like('cache_name', $getData['cache_name']);
        }
        if (!empty($getData['cache_id'])) {
            $this->db->like('cache_id', $getData['cache_id']);
        }
        return $this->db->count_all_results($this->table);
    }
    
    public function searchList($pageNum, $num, $getData)
    {
        if (!empty($getData['cache_name'])) {
           $this->db->like('cache_name', $getData['cache_name']);
        }
        if (!empty($getData['cache_id'])) {
            $this->db->like('cache_id', $getData['cache_id']);
        }
        $this->db->order_by('id','asc');
        $this->db->limit($pageNum, $num);
        return $this->db->get($this->table);
    }
    
    public function insertCacheClear($postData)
    {
        $data = array(
            'cache_name' => $postData['cache_name'],
            'cache_id'   => $postData['cache_id'],
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function findById($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }
    
    public function deleteById($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
}