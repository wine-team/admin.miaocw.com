<?php

class Keyword_search_model extends CI_Model{
	private $table = 'keyword_search'; 
	
    public function keyword_search_list($page, $perpage, $search, $order='number DESC, id DESC')
	{
	    if(!empty($search['item']))
	    {
	        $this->db->like('key_word', $search['item']);
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

/* End of file Keyword_search_model.php */
/* Location: ./application/models/Keyword_search_model.php */