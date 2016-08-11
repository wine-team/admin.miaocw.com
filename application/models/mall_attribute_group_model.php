<?php
class Mall_attribute_group_model extends CI_Model
{
	private $table = 'mall_attribute_group';
	private $table1 = 'mall_attribute_value';

	public function findByid($group_id)
	{
	    return $this->db->get_where($this->table, array('group_id'=>$group_id));
	}
	
	public function getWhere($where)
	{
	    return $this->db->get_where($this->table, $where);
	}

	public function findByAttrSetId($attr_set_id, $isArray=false)
	{
		$this->db->where('attr_set_id', (int)$attr_set_id);
		$result = $this->db->get($this->table);
		if ($isArray) {
			$rows = array();
			foreach ($result->result() as $item) {
				$rows[$item->group_id] = $item;
			}
			return $rows;
		}
		return $result;
	}
	
	public function insertAttributeGroup($postData) 
	{
	    $data = array(
	        'attr_set_id' => $postData['attr_set_id'],
	        'group_name' => $postData['group_name'],
	        'sort' => $postData['sort'],
	    );
	    $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	} 
	
	public function update($where, $data)  
	{
		return $this->db->update($this->table, $data, $where);
	}
	
	public function delete($where)  
	{
		return $this->db->delete($this->table, $where);
	}

	public function getAttrValuesByAttrSetId($attr_set_id)
	{
		$this->db->select('mall_attribute_group.attr_set_id, mall_attribute_group.group_name, mall_attribute_value.*');
		$this->db->from($this->table);
		$this->db->join($this->table1, 'mall_attribute_group.group_id = mall_attribute_value.group_id');
		$this->db->where('mall_attribute_group.attr_set_id', $attr_set_id, 'INNER');
		return $this->db->get();
	}
}