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
	
     /**
     *  分类的添加
     * @param number $parent_id
     * @return multitype:
     */
	public function getCategoryLevel($parent_id=0)
	{
		$this->db->where('parent_id', $parent_id);
		$result = $this->db->get($this->table);
		if ($result->num_rows() > 0){
			return $result->result_array();
		}
		return array();
	}
}

/* End of file Mall_category_model.php */
/* Location: ./application/models/Mall_category_model.php */