<?php
class Mall_attribute_value_model extends CI_Model{

	private $table = 'mall_attribute_value';        
	
	public function mall_attribute_list($page, $perpage, $search, $order='attr_value_id DESC')
	{
	    if (!empty($search['item'])) {
	        $this->db->like('attr_name', $search['item']);
	        $this->db->or_like('attr_values', $search['item']);
	    }
	    $this->db->order_by($order);
	    if ($perpage) {
			$this->db->limit($perpage, $perpage*$page);
		}
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
	
	public function getWherein($item, $arr ,$where=array())  //在$arr 内
	{
	    $this->db->where_in($item, $arr);
	    $this->db->where($where);
		return $this->db->get($this->table);
	}
	
	 /**
	 * 
	 * @param unknown $group_id
	 * @param unknown $attr_set_id
	 */
	public function getAttrbuteValue($group_id,$attr_set_id){
		
		$this->db->where('group_id',$group_id);
		$this->db->where('attr_set_id',$attr_set_id);
		$this->db->order_by('attr_spec','asc');
		return $this->db->get($this->table);
	}
	
}
/* End of file Mall_attribute_model.php */
/* Location: ./application/models/Mall_attribute_model.php */

