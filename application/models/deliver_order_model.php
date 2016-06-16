<?php
class Deliver_order_model extends CI_Model
{
    private $table = 'deliver_order';
    public function findById($deliver_order_id)
    {
        $this->db->where('deliver_order_id', $deliver_order_id);
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
        $this->db->order_by('deliver_order_id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

    public function deleteById($deliver_order_id)
    {
        $this->db->where('deliver_order_id', $deliver_order_id);
        return $this->db->delete($this->table);
    }
}