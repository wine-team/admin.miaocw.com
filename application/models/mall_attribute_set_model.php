<?php

class Mall_attribute_set_model extends CI_Model{
	private $table = 'mall_attribute_set'; 
	private $table1 = 'mall_attribute_value';
	
	public function mall_attribute_set_list($page, $perpage, $search)
	{
	    $sql = "SELECT `mall_attribute_set`.*, IFNULL(a.`attr_num`,0) AS `attr_num`
                FROM (`mall_attribute_set`)
                LEFT JOIN (SELECT `mall_attribute_value`.`attr_set_id`, COUNT(`mall_attribute_value`.`attr_value_id`) AS `attr_num` FROM `mall_attribute_value` GROUP BY `attr_set_id` )a 
	            ON `mall_attribute_set`.`attr_set_id` = a.`attr_set_id` ";
        if(!empty($search['item']))
        {
            $sql .= "`type_set_name` LIKE '%".$search['item']."%' ";
        }
        if($perpage) $sql .= "ORDER BY `mall_attribute_set`.`attr_set_id` DESC LIMIT ".$perpage*$page.",".$perpage;
	    return $this->db->query($sql);
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

/* End of file Mall_attribute_set_model.php */
/* Location: ./application/models/Mall_attribute_set_model.php */