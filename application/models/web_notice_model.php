<?php

class Web_notice_model extends CI_Model{
	private $table = 'Web_notice';        
	
	public function web_notice_list($page, $perpage, $search, $order='id DESC')
	{
	    if(!empty($search['item'])) 
	    {
	        $this->db->like('title', $search['item']);
	        $this->db->or_like('notice_info', $search['item']);
	    }
	    $this->db->order_by($order);
	    if($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get($this->table);
	}
	
	public function findById($where, $order='id ASC', $limit=0)
	{
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
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

/* End of file Help_center_model.php */
/* Location: ./application/models/Help_center_model.php */