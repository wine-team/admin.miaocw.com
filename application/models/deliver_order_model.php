<?php
class Deliver_order_model extends CI_Model
{
    private $table = 'deliver_order';

    public function findById($deliver_order_id)
    {
        $this->db->where('deliver_order_id', $deliver_order_id);
        return $this->db->get($this->table);
    }
    
    /**
     * 通过物流单号
     * @param unknown $deliver_number
     */
    public function findByNu($deliver_number)
    {
    	$this->db->where('deliver_number',$deliver_number);
    	return $this->db->get($this->table);
    }

    public function total($params=array()) 
    {
        $this->db->from($this->table);
        if (!empty($params['order_search'])) {
            $this->db->where(("order_id = '{$params['order_search']}' OR uid = '{$params['order_search']}'"));
        }
        if (!empty($params['deliver_search'])) {
            $this->db->where(("deliver_name = '{$params['deliver_search']}' OR deliver_number = '{$params['deliver_search']}'"));
        }
        if (!empty($params['ischeck'])) {
            $this->db->where('ischeck', $params['ischeck']);
        }
        return $this->db->count_all_results();
    }

    public function page_list($page_num, $num, $params=array())
    {
    	$this->db->from($this->table);
        if (!empty($params['order_search'])) {
            $this->db->where(("order_id = '{$params['order_search']}' OR uid = '{$params['order_search']}'"));
        }
        if (!empty($params['deliver_search'])) {
            $this->db->where(("deliver_name = '{$params['deliver_search']}' OR deliver_number = '{$params['deliver_search']}'"));
        }
        if (!empty($params['ischeck'])) {
            $this->db->where('ischeck', $params['ischeck']);
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