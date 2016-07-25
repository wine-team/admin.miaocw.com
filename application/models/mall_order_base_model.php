<?php

class Mall_order_base_model extends CI_Model{
	private $table = 'mall_order_base';
	private $table1 = 'mall_order_product';
	private $table2 = 'deliver_order';
	
	public function total($search)
	{
	    if(!empty($search['item'])) {
	        $this->db->where("((`user_name` LIKE '%{$search['item']}%') OR (`order_note`='{$search['item']}'))");
	    }
	    if (!empty($search['state'])) {
	        $this->db->where('state', $search['state']);
	    }
	    if (!empty($search['status'])) {
	        $this->db->where('status', $search['status']);
	    }
	    if (!empty($search['seller_uid'])) {
	        $this->db->where('seller_uid', $search['seller_uid']);
	    }
	    if (!empty($search['is_form'])) {
	        $this->db->where('is_form', $search['is_form']);
	    }
	    if (!empty($search['sta_time'])) {
	        $sta_time = $search['sta_time'] ? ($search['sta_time']<date('Y-m-d') ? $search['sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	        $this->db->where('created_at >', $sta_time);
	    }
	    if (!empty($search['end_time'])) {
	        
	        $end_time = $search['end_time'] ? ($search['end_time']>=$search['sta_time'] ? $search['end_time'].' 59:59:59' : '') : '';
	        $this->db->where('created_at <', $end_time);
	    }
	    return $this->db->count_all_results($this->table);
	}
	
	public function mall_order_base_list($num, $page_num, $search, $order='order_id DESC')
	{
	    if(!empty($search['item'])) {
	        $this->db->where("((`user_name` LIKE '%{$search['item']}%') OR (`order_note`='{$search['item']}'))");
	    }
	    if (!empty($search['state'])) {
	        $this->db->where('state', $search['state']);
	    }
	    if (!empty($search['status'])) {
	        $this->db->where('status', $search['status']);
	    }
	    if (!empty($search['seller_uid'])) {
	        $this->db->where('seller_uid', $search['seller_uid']);
	    }
	    if (!empty($search['is_form'])) {
	        $this->db->where('is_form', $search['is_form']);
	    }
	    if (!empty($search['sta_time'])) {
	        $sta_time = $search['sta_time'] ? ($search['sta_time']<date('Y-m-d') ? $search['sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	        $this->db->where('created_at >', $sta_time);
	    }
	    if (!empty($search['end_time'])) {
	        
	        $end_time = $search['end_time'] ? ($search['end_time']>=$search['sta_time'] ? $search['end_time'].' 59:59:59' : '') : '';
	        $this->db->where('created_at <', $end_time);
	    }
	    $this->db->order_by($order);
	    $this->db->limit($page_num, $num);
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

/* End of file Mall_order_base_model.php */
/* Location: ./application/models/Mall_order_base_model.php */