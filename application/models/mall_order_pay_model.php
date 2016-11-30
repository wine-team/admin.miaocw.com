<?php
class Mall_order_pay_model extends CI_Model
{
    private $table   = 'mall_order_pay';
    private $table1   = 'mall_order_base';
    
    public function get_mallPay($order_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->table1, 'mall_order_pay.pay_id = mall_order_base.pay_id', 'left');
        $this->db->where('order_id', $order_id);
        return $this->db->get();
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