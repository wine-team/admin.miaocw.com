<?php
class Mall_attribute_model extends CI_Model{
	private $table = 'mall_attribute';

	public function mall_attribute_list($page, $perpage, $search, $order='attr_id DESC')
	{
		if(!empty($search['item']))
		{
			$this->db->like('attr_name', $search['item']);
			$this->db->or_like('attr_values', $search['item']);
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