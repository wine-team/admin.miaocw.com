<?php

class Mall_order_refund_model extends CI_Model{
	private $table = 'mall_order_refund';
	
	public function total($search)
	{
	    if(!empty($search['item'])) {
	        $this->db->like('user_name', $search['item']);
	        $this->db->or_like('cellphone', $search['item']);
	        $this->db->or_like('refund_content', $search['item']);
	        $this->db->or_like('reject_content', $search['item']);
	    }
	    if (!empty($search['seller_uid'])) {
	        $this->db->where('seller_uid', $search['seller_uid']);
	    }
	    if (!empty($search['status'])) {
	        $this->db->where('status', $search['status']);
	    }
	    if (!empty($search['flag'])) {
	        $this->db->where('flag', $search['flag']);
	    }
	    if (!empty($search['sta_time'])) {
	        $sta_time = $search['sta_time'] ? ($search['sta_time']<date('Y-m-d') ? $search['sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	        $this->db->where('created_at >', $sta_time);
	    }
	    if (!empty($search['end_time'])) {
	        $end_time = $search['end_time'] ? ($search['end_time']>=$search['sta_time'] ? $search['end_time'].' 59:59:59' : '') : '';
	        $this->db->where('created_at <', $end_time);
	    }
	    if (!empty($search['verify_sta_time'])) {
	        $verify_sta_time = $search['verify_sta_time'] ? ($search['verify_sta_time']<date('Y-m-d') ? $search['verify_sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	        $this->db->where('verify_time >', $verify_sta_time);
	    }
	    if (!empty($search['verify_end_time'])) {
	        $verify_end_time = $search['verify_end_time'] ? ($search['verify_end_time']>=$search['verify_sta_time'] ? $search['verify_end_time'].' 59:59:59' : '') : '';
	        $this->db->where('verify_time <', $verify_end_time);
	    }
	    return $this->db->count_all_results($this->table);
	}
	
	public function mall_order_refund_list($page, $perpage, $search, $order='order_id DESC')
	{
	    if(!empty($search['item'])) {
	        $this->db->like('user_name', $search['item']);
	        $this->db->or_like('cellphone', $search['item']);
	        $this->db->or_like('refund_content', $search['item']);
	        $this->db->or_like('reject_content', $search['item']);
	    }
	    if (!empty($search['seller_uid'])) {
	        $this->db->where('seller_uid', $search['seller_uid']);
	    }
	    if (!empty($search['status'])) {
	        $this->db->where('status', $search['status']);
	    }
	    if (!empty($search['flag'])) {
	        $this->db->where('flag', $search['flag']);
	    }
	    if (!empty($search['sta_time'])) {
	        $sta_time = $search['sta_time'] ? ($search['sta_time']<date('Y-m-d') ? $search['sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	        $this->db->where('created_at >', $sta_time);
	    }
	    if (!empty($search['end_time'])) {
	        $end_time = $search['end_time'] ? ($search['end_time']>=$search['sta_time'] ? $search['end_time'].' 59:59:59' : '') : '';
	        $this->db->where('created_at <', $end_time);
	    }
	    if (!empty($search['verify_sta_time'])) {
	        $verify_sta_time = $search['verify_sta_time'] ? ($search['verify_sta_time']<date('Y-m-d') ? $search['verify_sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	        $this->db->where('verify_time >', $verify_sta_time);
	    }
	    if (!empty($search['verify_end_time'])) {
	        $verify_end_time = $search['verify_end_time'] ? ($search['verify_end_time']>=$search['verify_sta_time'] ? $search['verify_end_time'].' 59:59:59' : '') : '';
	        $this->db->where('verify_time <', $verify_end_time);
	    }
	    $this->db->order_by($order);
	    if($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get($this->table);
	}
	
	public function findById($where)
	{
	    return $this->db->get_where($this->table, $where);
	}
	
	public function insert($data) 
	{
	    $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	} 
	
	public function update($where, $data)  
	{
	    $this->db->update($this->table, $data, $where);
	    return $this->db->affected_rows();
	}
	
	public function delete($where)  
	{
	    $this->db->delete($this->table, $where);
	    return $this->db->affected_rows();
	}
	
}

/* End of file Mall_order_refund_model.php */
/* Location: ./application/models/Mall_order_refund_model.php */