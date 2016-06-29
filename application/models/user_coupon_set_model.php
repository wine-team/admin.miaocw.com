<?php
class User_coupon_set_model extends CI_Model
{
    private $table = 'user_coupon_set';

    public function findById($coupon_set_id)
    {
        $this->db->where('coupon_set_id', $coupon_set_id);
        return $this->db->get($this->table);
    }

    public function total($params=array()) 
    {
        $this->db->from($this->table);
        if (!empty($params['scope'])) {
            $this->db->where('scope', $params['scope']);
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
    	$this->db->from($this->table);
        if (!empty($params['scope'])) {
            $this->db->where('scope', $params['scope']);
        }
        if (!empty($params['start_time'])) {
            $this->db->where('created_at >=',$params['start_time']);
        }
        if (!empty($params['end_time'])) {
            $this->db->where('created_at <=',$params['end_time']);
        }
        $this->db->order_by('coupon_set_id', 'DESC');
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
        $this->db->where('coupon_set_id', $postData['coupon_set_id']);
        return $this->db->update($this->table, $data);
    }
    
    public function deleteById($coupon_set_id)
    {
        $this->db->where('coupon_set_id', $coupon_set_id);
        return $this->db->delete($this->table);
    }
}