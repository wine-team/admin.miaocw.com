<?php

class Mall_order_base_model extends CI_Model{
	private $table = 'mall_order_base';
	private $table1 = 'mall_order_product';
	private $table2 = 'deliver_order';
	
	public function mall_order_base_list($page, $perpage, $search, $order='order_id DESC')
	{
	    if(!empty($search['item']))
	    {
	        $this->db->like('user_name', $search['item']);
	        $this->db->or_like('order_note', $search['item']);
	    }
	    if (!empty($search['state'])) $this->db->where('state', $search['state']);
	    if (!empty($search['status'])) $this->db->where('status', $search['status']);
	    if (!empty($search['seller_uid'])) $this->db->where('seller_uid', $search['seller_uid']);
	    if (!empty($search['is_form'])) $this->db->where('is_form', $search['is_form']);
	    if (!empty($search['sta_time'])) $this->db->where('created_at >', $search['sta_time']);
	    if (!empty($search['end_time'])) $this->db->where('created_at <', $search['end_time']);
	    $this->db->order_by($order);
	    if($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get($this->table);
	}
	
	public function findById($where)
	{
	    return $this->db->get_where($this->table, $where);
	}
	
	public function findOrderProduct($where)
	{
	    return $this->db->get_where($this->table1, $where);
	}
	
	public function findOrderDeliver($where)
	{
	    return $this->db->get_where($this->table2, $where);
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