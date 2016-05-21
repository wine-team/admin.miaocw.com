<?php

class Mall_brand_model extends CI_Model{
	private $table = 'mall_brand';        
	
	public function mall_brand_list($page, $perpage, $search, $order='brand_id DESC')
	{
	    if(!empty($search['item']))
	    {
	        $this->db->like('brand_name', $search['item']);
	        $this->db->or_like('brand_desc', $search['item']);
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

/* End of file Mall_brand_model.php */
/* Location: ./application/models/Mall_brand_model.php */