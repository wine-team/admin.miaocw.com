<?php
class Deliver_base_model extends CI_Model
{
    private $table = 'deliver_base';
    public function findById($deliver_id)
    {
        $this->db->where('deliver_id', $deliver_id);
        return $this->db->get($this->table);
    }

    public function total($params=array()) 
    {
        $this->db->from($this->table);
        if (!empty($params['deliver_name'])) {
            $this->db->where('deliver_name', $params['deliver_name']);
        }
        if (!empty($params['deliver_flag'])) {
            $this->db->where('deliver_flag', $params['deliver_flag']);
        }
        return $this->db->count_all_results();
    }   
			
    public function page_list($page_num, $num, $params=array())
    {
    	$this->db->from($this->table);
        if (!empty($params['deliver_name'])) {
            $this->db->where('deliver_name', $params['deliver_name']);
        }
        if (!empty($params['deliver_flag'])) {
            $this->db->where('deliver_flag', $params['deliver_flag']);
        }
        $this->db->order_by('deliver_id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

    public function insertDeliverBase($postData=array())
    {
        $data = array(
            'deliver_name' => $postData['deliver_name'],
            'deliver_flag' => trim($postData['deliver_flag']),
            'created_at'   => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateDeliverBase($postData=array())
    {
        $data = array(
            'deliver_name' => $postData['deliver_name'],
            'deliver_flag' => trim($postData['deliver_flag']),
        );
        $this->db->where('deliver_id', $postData['deliver_id']);
        return $this->db->update($this->table, $data);
    }
    
    public function deleteById($deliver_id)
    {
        $this->db->where('deliver_id', $deliver_id);
        return $this->db->delete($this->table);
    }
}