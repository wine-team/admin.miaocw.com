<?php

class Supply_sales_join_model extends CI_Model{
	private $table = 'supply_sales_join';        
	
	public function supply_sales_join_list($page, $perpage, $search, $order='id DESC')
	{
	    if(!empty($search['item']))
	    {
	        $this->db->like('user_name', $search['item']);
	        $this->db->or_like('company', $search['item']);
	        $this->db->or_like('address', $search['item']);
	        $this->db->or_like('phone', $search['item']);
	    }
	    if(!empty($search['type'])) $this->db->where('type', $search['type']);
	    if(!empty($search['flag'])) $this->db->where('flag', $search['flag']);
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

/* End of file Supply_sales_join_model.php */
/* Location: ./application/models/Supply_sales_join_model.php */