<?php
class Mall_order_base_model extends CI_Model
{
    private $table = 'mall_order_base';
    private $table1 = 'mall_order_product';
    private $table2 = 'deliver_order';
    
    public function findByOrderId($order_id)
    {
        $this->db->where('order_id', $order_id);
        return $this->db->get($this->table, $order_id);
    }

    public function total($params=array())
    {
        if(!empty($params['item'])) {
            $this->db->where("((`user_name` LIKE '%{$params['item']}%') OR (`order_note`='{$params['item']}'))");
        }
        if (!empty($params['order_id'])) {
        	$this->db->where('order_id', $params['order_id']);
        }
        if (!empty($params['pay_id'])) {
        	$this->db->where('pay_id', $params['pay_id']);
        }
        if (!empty($params['state'])) {
            $this->db->where('state', $params['state']);
        }
        if (!empty($params['status'])) {
            $this->db->where('status', $params['status']);
        }
        if (!empty($params['seller_uid'])) {
            $this->db->where('seller_uid', $params['seller_uid']);
        }
        if (!empty($params['is_form'])) {
            $this->db->where('is_form', $params['is_form']);
        }
        if (!empty($param['start_date'])) {
            $this->db->where(array('created_at >' => $param['start_date'].' 00:00:00'));
        }
        if (!empty($param['end_date'])) {
            $this->db->where(array('created_at <=' => $param['end_date'].' 59:59:59'));
        }
        return $this->db->count_all_results($this->table);
    }
    
    public function mall_order_base_list($num, $page_num, $params=array())
    {
    	if (!empty($params['order_id'])) {
    		$this->db->where('order_id', $params['order_id']);
    	}
    	if (!empty($params['pay_id'])) {
    		$this->db->where('pay_id', $params['pay_id']);
    	}
        if(!empty($params['item'])) {
            $this->db->where("((`user_name` LIKE '%{$params['item']}%') OR (`order_note`='{$params['item']}'))");
        }
        if (!empty($params['state'])) {
            $this->db->where('state', $params['state']);
        }
        if (!empty($params['status'])) {
            $this->db->where('status', $params['status']);
        }
        if (!empty($params['seller_uid'])) {
            $this->db->where('seller_uid', $params['seller_uid']);
        }
        if (!empty($params['is_form'])) {
            $this->db->where('is_form', $params['is_form']);
        }
        if (!empty($param['start_date'])) {
            $this->db->where(array('created_at >' => $param['start_date'].' 00:00:00'));
        }
        if (!empty($param['end_date'])) {
            $this->db->where(array('created_at <=' => $param['end_date'].' 59:59:59'));
        }
        $this->db->order_by('order_id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get($this->table);
    }
    
    public function insert($data) 
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    } 
    
    public function update($where, $data)  
    {
        return $this->db->update($this->table, $data, $where);
    }

    public function modifyDeliverPrice($order_id, $deliver_price)
    {
        $data = array(
            'deliver_price' => $deliver_price
        );
        $this->db->where('order_id', $order_id);
        return $this->db->update($this->table, $data);
    }
}