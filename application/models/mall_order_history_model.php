<?php
class Mall_order_history_model extends CI_Model
{
    private $table = 'mall_order_history';
    
    public function findByOrderId($order_id)
    {
        $this->db->where('order_id', $order_id);
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
        return $this->db->affected_rows();
    }
    
    public function delete($where)  
    {
        $this->db->delete($this->table, $where);
        return $this->db->affected_rows();
    }
}