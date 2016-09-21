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
        if (!empty($params['coupon_name'])) {
            $this->db->where('coupon_name', $params['coupon_name']);
        }
        if (!empty($params['scope'])) {
            $this->db->where('scope', $params['scope']);
        }
        if (!empty($params['start_time'])) {
            $this->db->where('created_at >=', $params['start_time'].' 00:00:00');
        }
        if (!empty($params['end_time'])) {
            $this->db->where('created_at <=', $params['end_time'].' 23:59:59');
        }
        return $this->db->count_all_results();
    }   
			
    public function page_list($page_num, $num, $params=array())
    {
    	$this->db->from($this->table);
        if (!empty($params['coupon_name'])) {
            $this->db->where('coupon_name', $params['coupon_name']);
        }
        if (!empty($params['scope'])) {
            $this->db->where('scope', $params['scope']);
        }
        if (!empty($params['start_time'])) {
            $this->db->where('created_at >=', $params['start_time'].' 00:00:00');
        }
        if (!empty($params['end_time'])) {
            $this->db->where('created_at <=', $params['end_time'].' 23:59:59');
        }
        $this->db->order_by('coupon_set_id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

    public function insert($postData=array())
    {
        $data = array(
            'coupon_name'  => $postData['coupon_name'],
            'scope'        => $postData['scope'],
            'related_id'   => $postData['related_id'],
            'amount'       => $postData['amount'],
            'number'       => $postData['number'],
            'condition'    => !empty($postData['condition']) ? $postData['condition'] : 0,
            'note'         => !empty($postData['note']) ? $postData['note'] : '',
            'start_time'   => $postData['start_time'],
            'end_time'     => $postData['end_time'],
            'created_at'   => date('Y-m-d H:i:s'),
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($postData=array())
    {
        $data = array(
            'coupon_name' => $postData['coupon_name'],
            'scope'       => $postData['scope'],
            'related_id'  => $postData['related_id'],
            'amount'      => $postData['amount'],
            'number'      => $postData['number'],
            'condition'   => $postData['condition'],
            'start_time'   => $postData['start_time'],
            'end_time'     => $postData['end_time'],
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