<?php
class Mall_order_reviews_model extends CI_Model{
	
	private $table = 'mall_order_reviews';
	
	public function total($search)
	{
	    if(!empty($search['item'])) {
	        $this->db->where("((`goods_name` LIKE '%{$search['item']}%') OR (`user_name`='{$search['item']}') OR (`content`='{$search['item']}'))");
	    }
	    if (!empty($search['order_id'])) {
	        $this->db->where('order_id', $search['order_id']);
	    }
	    if (!empty($search['goods_id'])) {
	        $this->db->where('goods_id', $search['goods_id']);
	    }
	    if (!empty($search['score'])) {
	        $this->db->where('score', $search['score']);
	    }
	    if (!empty($search['status'])) {
	        $this->db->where('status', $search['status']);
	    }
	    if (!empty($search['sta_time'])) {
	        $sta_time = $search['sta_time'] ? ($search['sta_time']<date('Y-m-d') ? $search['sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	        $this->db->where('created_at >', $sta_time);
	    }
	    if (!empty($search['end_time'])) {
	        $end_time = $search['end_time'] ? ($search['end_time']>=$search['sta_time'] ? $search['end_time'].' 59:59:59' : '') : '';
	        $this->db->where('created_at <', $end_time);
	    }
	    return $this->db->count_all_results($this->table);
	}
	
	public function mall_order_reviews_list($num, $page_num, $search, $order='order_id DESC')
	{
	    if(!empty($search['item'])) {
	        $this->db->where("((`goods_name` LIKE '%{$search['item']}%') OR (`user_name`='{$search['item']}') OR (`content`='{$search['item']}'))");
	    }
	    if (!empty($search['order_id'])) {
	        $this->db->where('order_id', $search['order_id']);
	    }
	    if (!empty($search['score'])) {
	        $this->db->where('score', $search['score']);
	    }
	    if (!empty($search['status'])) {
	        $this->db->where('status', $search['status']);
	    }
	    if (!empty($search['sta_time'])) {
	        $sta_time = $search['sta_time'] ? ($search['sta_time']<date('Y-m-d') ? $search['sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	        $this->db->where('created_at >', $sta_time);
	    }
	    if (!empty($search['end_time'])) {
	        $end_time = $search['end_time'] ? ($search['end_time']>=$search['sta_time'] ? $search['end_time'].' 59:59:59' : '') : '';
	        $this->db->where('created_at <', $end_time);
	    }
	    $this->db->order_by($order);
	    $this->db->limit($page_num,$num);
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
	
}

/* End of file mall_order_reviews_model.php */
/* Location: ./application/models/mall_order_reviews_model.php */