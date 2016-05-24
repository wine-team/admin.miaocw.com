<?php
class Mall_enshrine_model extends CI_Model
{
    private $table = 'mall_enshrine';
    public function total($params=array()) 
    {
        if (!empty($params['uid'])) {
            $this->db->where('uid', $params['uid']);
        }
        return $this->db->count_all_results($this->table);
    }

    public function page_list($page_num, $num, $params=array())
    {
        $this->db->select('mall_enshrine.*,user.phone,user.email');
    	$this->db->from($this->table);
    	$this->db->join('user','user.uid=mall_enshrine.uid','inner');
    	if (!empty($params['uid'])) {
    		$this->db->where('mall_enshrine.uid', $params['uid']);
    	}
        $this->db->order_by('id','DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }
   
}