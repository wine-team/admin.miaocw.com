<?php
class Mall_order_product_model extends CI_Model
{
    private $table = 'mall_order_product';        
    
    public function findByOrderProductId($order_product_id)
    {
        $this->db->where('order_product_id', $order_product_id);
        return $this->db->get($this->table);
    }

    public function findByOrderId($order_id)
    {
        $this->db->where('order_id', $order_id);
        return $this->db->get($this->table);
    }

    public function findByParams($params=array())
    {
        if (!empty($params['order_product_id'])) {
            $this->db->where('order_product_id', $params['order_product_id']);
        }
        if (!empty($params['order_id'])) {
            $this->db->where('order_id', $params['order_id']);
        }
        return $this->db->get($this->table);
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
    
    /**
     * 获取全部商品数量
    **/
    public function getAllProduct($order_id)
    {
        $this->db->select_sum('p.number');
        $this->db->where('p.order_id', $order_id);
        $result = $this->db->get($this->table . ' as p');
        $row = $result->row();
        return isset($row->number) ? $row->number : 0;
    }
}