<?php
class Mall_attribute_set_model extends CI_Model
{
	private $table = 'mall_attribute_set'; 
	private $table1 = 'mall_attribute_value';
	public function findById($attr_set_id)
	{
		$this->db->where('attr_set_id', $attr_set_id);
		return $this->db->get_where($this->table);
	}
	public function total($params=array())
	{
		$this->db->from($this->table);
		if (!empty($params['attr_set_name'])) {
			$this->db->where('attr_set_name', $params['attr_set_name']);
		}
		return $this->db->count_all_results();
	}
	public function page_list($page_num, $num, $params=array())
	{
		$this->db->from($this->table);
		if (!empty($params['attr_set_name'])) {
			$this->db->where('attr_set_name', $params['attr_set_name']);
		}
		$this->db->order_by('attr_set_id', 'DESC');
		$this->db->limit($page_num, $num);
		return $this->db->get();
	}
	
	public function insert($postData = array())
	{
		$data = array(
			'attr_set_name' => $postData['attr_set_name'],
			'enabled'        => $postData['enabled'],
		);
	    $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	} 
	
	public function updateAttributeSet($postData = array())
	{
		$data = array(
			'attr_set_name' => $postData['attr_set_name'],
			'enabled'        => $postData['enabled'],
		);
		$this->db->where('attr_set_id', $postData['attr_set_id']);
		return $this->db->update($this->table, $data);
	}
}