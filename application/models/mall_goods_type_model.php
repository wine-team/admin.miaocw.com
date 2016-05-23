<?php

class Mall_goods_type_model extends CI_Model{
	private $table = 'mall_goods_type'; 
	private $table1 = 'mall_attribute';
	
	public function mall_goods_type_list($page, $perpage, $search)
	{
	    $sql = "SELECT `mall_goods_type`.*, IFNULL(a.`attr_num`,0) AS `attr_num`
                FROM (`mall_goods_type`)
                LEFT JOIN (SELECT `mall_attribute`.`type_id`, COUNT(`mall_attribute`.`attr_id`) AS `attr_num` FROM `mall_attribute` GROUP BY `type_id` )a 
	            ON `mall_goods_type`.`type_id` = a.`type_id` ";
        if(!empty($search['item']))
        {
            $sql .= "`type_name` LIKE '%".$search['item']."%' ";
        }
        if($perpage) $sql .= "ORDER BY `mall_goods_type`.`type_id` DESC LIMIT ".$perpage*$page.",".$perpage;
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

/* End of file Mall_goods_type_model.php */
/* Location: ./application/models/Mall_goods_type_model.php */