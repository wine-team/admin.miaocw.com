<?php
class Mall_keyword_model extends CI_Model
{
	private $table = 'mall_keyword';

	public function findById($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}

	public function total($getData=array())
	{
		if (!empty($getData['key_word'])) {
			$this->db->like('key_word', $getData['key_word']);
		}
		return $this->db->count_all_results($this->table);
	}

	public function page_list($page_num, $num, $getData=array())
	{
	    if (!empty($getData['key_word'])) {
	        $this->db->like('key_word', $getData['key_word']);
	    }
	    $this->db->order_by('sort', 'DESC');
		$this->db->limit($page_num, $num);
	    return $this->db->get($this->table);
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