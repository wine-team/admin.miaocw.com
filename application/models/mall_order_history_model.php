<?php
class Mall_order_history_model extends CI_Model
{
    private $table = 'mall_order_history';
    
    public function findByOrderId($order_id)
    {
        $this->db->where('order_id', $order_id);
        return $this->db->get($this->table);
    }
    
    public function insert($params=array())
    {
        $data = array(
            'order_id'     => $params['order_id'],
            'operate_time' => date('Y-m-d H:i:s'),
            'uid'          => $params['uid'],
            'operate_type' => $params['operate_type'],
            'comment'      => !empty($params['comment']) ? $params['comment'] : '',
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    } 
    
    public function update($where, $data)  
    {
        return $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}