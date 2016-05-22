<?php
class User_account_model extends CI_Model
{
    private $table = 'user_account';
    
    public function total($params=array()) 
    {
        if (!empty($params['uid'])) {
            $this->db->where('uid', $params['uid']);
        }
        return $this->db->count_all_results($this->table);
    }

    public function page_list($page_num, $num, $params=array())
    {
        $this->db->select('user_account.*,user.phone,user.email');
    	$this->db->from($this->table);
    	$this->db->join('user','user.uid=user_account.uid','inner');
    	if (!empty($params['uid'])) {
    		$this->db->where('user_account.uid', $params['uid']);
    	}
        $this->db->order_by('account_id','DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }
   
}