<?php

class Mhelp_center_model extends CI_Model{
	private $table = 'help_center';        
	
	public function help_center_list($page,$perpage,$search,$order='id DESC')
	{
	    if(!empty($search['item'])) 
	    {
	        $this->db->like('title', $search['item']);
	        $this->db->or_like('sub_title', $search['item']);
	        $this->db->or_like('help_info', $search['item']);
	    }
	    $this->db->order_by($order);
	    if($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get($this->table);
	}
	
}

/* End of file mcompanyarea.php */
/* Location: ./application/models/mcompanyarea.php */