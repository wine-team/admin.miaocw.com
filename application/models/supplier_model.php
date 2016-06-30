<?php
class Supplier_model extends CI_Model
{
	private $table = 'supplier';

	public function findById($supplier_id)
	{
		$this->db->where('supplier_id', $supplier_id);
		return $this->db->get($this->table);
	}

	public function total($params=array())
	{
		if (!empty($params['supplier_id'])) {
			$this->db->where('supplier_id', $params['supplier_id']);
		}
		if (!empty($params['uid'])) {
			$this->db->where('uid', $params['uid']);
		}
		if (!empty($params['supplier_name'])) {
			$this->db->like('supplier_name', $params['supplier_name']);
		}
		return $this->db->count_all_results($this->table);
	}

	public function page_list($page_num, $num, $params=array())
	{
		if (!empty($params['supplier_id'])) {
			$this->db->where('supplier_id', $params['supplier_id']);
		}
		if (!empty($params['uid'])) {
			$this->db->where('uid', $params['uid']);
		}
	    if (!empty($params['supplier_name'])) {
	        $this->db->like('supplier_name', $params['supplier_name']);
	    }
	    $this->db->order_by('supplier_id', 'DESC');
	    $this->db->limit($page_num, $num);
	    return $this->db->get($this->table);
	}

	public function findByParams($where)
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

/* End of file Supplier_model.php */
/* Location: ./application/models/Supplier_model.php */