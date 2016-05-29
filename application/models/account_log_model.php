<?php
class Account_log_model extends CI_Model
{
    private $table = 'account_log';
    public function total($params=array()) 
    {
        if (!empty($params['uid'])) {
            $this->db->where('uid', $params['uid']);
        }
        return $this->db->count_all_results($this->table);
    }

    public function page_list($page_num, $num, $params=array())
    {
        $this->db->select('account_log.*,user.phone,user.email');
    	$this->db->from($this->table);
    	$this->db->join('user','user.uid=account_log.uid','inner');
    	if (!empty($params['uid'])) {
    		$this->db->where('account_log.uid', $params['uid']);
    	}
        $this->db->order_by('log_id','DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }
   
}