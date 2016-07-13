<?php
class Mall_attribute_group_model extends CI_Model{

	private $table = 'mall_attribute_group';     
	
	public function findByid($group_id)
	{
	    return $this->db->get_where($this->table, array('group_id'=>$group_id));
	}
	
	public function getWhere($where)
	{
	    return $this->db->get_where($this->table, $where);
	}

    public function findByAttrSetId($attr_set_id)
	{
		return $this->db->get_where($this->table, array('attr_set_id'=>$attr_set_id));
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
	    $this->db->update($this->table, $data, $where);
	    return $this->db->affected_rows();
	}
	
	public function delete($where)  
	{
	    $this->db->delete($this->table, $where);
	    return $this->db->affected_rows();
	}
	
}