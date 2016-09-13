<?php
class Mall_order_product_profit_model extends CI_Model
{
    private $table = 'mall_order_product_profit';

    public function findByOrderProductId($order_product_id)
    {
        $this->db->where('order_product_id', $order_product_id);
        return $this->db->get($this->table);
    }

    public function findByParams($params=array())
    {
        if (!empty($params['order_product_id'])) {
            $this->db->where('order_product_id', $params['order_product_id']);
        }
        if (!empty($params['order_product_ids'])) {
            $this->db->where_in('order_product_id', $params['order_product_ids']);
        }
        return $this->db->get($this->table);
    }
}