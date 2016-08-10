<?php
class User_feedback_model extends CI_Model
{
    private $table = 'user_feedback';
    
    /**
     * 符合搜索条件数据的总数量
     */
    public function total($search_param=array())
    {
        if (!empty($search_param['ms_type'])) {
            $this->db->where('ms_type', $search_param['ms_type']);
        }
        if (!empty($search_param['ms_tel'])) {
            $this->db->where('ms_tel', $search_param['ms_tel']);
        }
        if (!empty($search_param['ms_email'])) {
            $this->db->where('ms_email', $search_param['ms_email']);
        }
        if (!empty($search_param['start_date'])) {
            $this->db->where(array('created_at >=' => $search_param['start_date'].' 00:00:00'));
        }
        if (!empty($search_param['end_date'])) {
            $this->db->where(array('created_at <=' => $search_param['end_date'].' 23:59:59'));
        }
        return $this->db->count_all_results($this->table);
    }
    
    /**
     *符合搜索条件数据 默认取20条
     */
    public function page_list($page_num, $num, $search_param=array())
    {
        if (!empty($search_param['ms_type'])) {
            $this->db->where('ms_type', $search_param['ms_type']);
        }
        if (!empty($search_param['ms_tel'])) {
            $this->db->where('ms_tel', $search_param['ms_tel']);
        }
        if (!empty($search_param['ms_email'])) {
            $this->db->where('ms_email', $search_param['ms_email']);
        }
        if (!empty($search_param['start_date'])) {
            $this->db->where(array('created_at >=' => $search_param['start_date'].' 00:00:00'));
        }
        if (!empty($search_param['end_date'])) {
            $this->db->where(array('created_at <=' => $search_param['end_date'].' 23:59:59'));
        }
        $this->db->order_by('created_at','desc');
        $this->db->limit($page_num, $num);
        return $this->db->get($this->table);
    }
}