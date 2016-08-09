<?php
class Mall_brand_model extends CI_Model
{
	private $table = 'mall_brand';

	public function find($isArray=false)
	{
		$this->db->where('is_show', 1);
		$result = $this->db->get($this->table);
		if ($isArray) {
			$rows = array();
			foreach ($result->result_array() as $row) {
				$rows[$row['brand_id']] = $row;
			}
			return $rows;
		}
		return $result;
	}

	public function findById($brand_id)
	{
		$this->db->where('brand_id', $brand_id);
		return $this->db->get_where($this->table);
	}

	public function total($params=array())
	{
		if (!empty($params['brand_name'])) {
			$this->db->like('brand_name', $params['brand_name']);
		}
		if (!empty($params['is_show'])) {
			$this->db->where('is_show', $params['is_show']);
		}
		return $this->db->count_all_results($this->table);
	}

	public function page_list($page_num, $num, $params=array())
	{
		if (!empty($params['brand_name'])) {
			$this->db->like('brand_name', $params['brand_name']);
		}
		if (!empty($params['is_show'])) {
			$this->db->where('is_show', $params['is_show']);
		}
	    $this->db->order_by('brand_id', 'DESC');
	    $this->db->limit($page_num, $num);
	    return $this->db->get($this->table);
	}
	
	public function findByCondition($where)
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