<?php

class Mall_category_model extends CI_Model{
	private $table = 'mall_category';        
	
	public function findById($where)
	{
	    return $this->db->get_where($this->table, $where);
	}
	
	public function getWherein($item,$arr) 
	{
	    $this->db->where_in($item, $arr);
	    $res = $this->db->get($this->table);
	    return $res;
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

/* End of file Mall_category_model.php */
/* Location: ./application/models/Mall_category_model.php */