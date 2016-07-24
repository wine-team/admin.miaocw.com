<?php
class Mall_order_barter_model extends CI_Model
{
    private $table   = 'mall_order_barter';
    private $table_2 = 'mall_order_product';
    private $table_3 = 'user';

    public function total($search_param = array())
    {
        $this->db->from($this->table . ' AS mall_order_barter');
        $this->db->join($this->table_2 . ' AS mall_order_product', 'mall_order_product.order_product_id = mall_order_barter.order_product_id');
        $this->db->join($this->table_3 . ' AS user', 'user.uid = mall_order_barter.seller_uid');
        if (!empty($search_param['order_id'])) {
            $this->db->where('mall_order_product.order_id', $search_param['order_id']);
        }
        if (!empty($search_param['goods_name'])) {
            $this->db->where("(`mall_order_product`.`goods_name` LIKE '%{$search_param['goods_name']}%') OR (`mall_order_barter`.`goods_attr_id`='{$search_param['goods_name']}')");
        }
        if (!empty($search_param['seller_name'])) {
            $this->db->where("(`user`.`phone` LIKE '%{$search_param['seller_name']}%') OR (`user`.`email` LIKE '%{$search_param['seller_name']}%')");
        }
        if (!empty($search_param['user_name'])) {
            $this->db->where("(`mall_order_barter`.`user_name` LIKE '%{$search_param['user_name']}%') OR (`mall_order_barter`.`uid`='{$search_param['user_name']}') OR (`mall_order_barter`.`cellphone`='{$search_param['user_name']}')");
        }
        if (!empty($search_param['status'])) {
            $this->db->where('mall_order_barter.status', $search_param['status']);
        }
        if (!empty($search_param['flag'])) {
            $this->db->where('mall_order_barter.flag', $search_param['flag']);
        }
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function page_list($page_num, $num, $search_param = array())
    {
        $this->db->select('mall_order_barter.*,mall_order_product.goods_name,user.alias_name');
        $this->db->from($this->table . ' AS mall_order_barter');
        $this->db->join($this->table_2 . ' AS mall_order_product', 'mall_order_product.order_product_id = mall_order_barter.order_product_id');
        $this->db->join($this->table_3 . ' AS user', 'user.uid = mall_order_barter.seller_uid');
        if (!empty($search_param['order_id'])) {
            $this->db->where('mall_order_product.order_id', $search_param['order_id']);
        }
        if (!empty($search_param['goods_name'])) {
            $this->db->where("(`mall_order_product`.`goods_name` LIKE '%{$search_param['goods_name']}%') OR (`mall_order_barter`.`goods_attr_id`='{$search_param['goods_name']}')");
        }
        if (!empty($search_param['seller_name'])) {
            $this->db->where("(`user`.`phone` LIKE '%{$search_param['seller_name']}%') OR (`user`.`email` LIKE '%{$search_param['seller_name']}%')");
        }
        if (!empty($search_param['user_name'])) {
            $this->db->where("(`mall_order_barter`.`cellphone` LIKE '%{$search_param['user_name']}%') OR (`mall_order_barter`.`uid`='{$search_param['user_name']}')");
        }
        if (!empty($search_param['status'])) {
            $this->db->where('mall_order_barter.status', $search_param['status']);
        }
        if (!empty($search_param['flag'])) {
            $this->db->where('mall_order_barter.flag', $search_param['flag']);
        }
        $this->db->group_by('mall_order_barter.barter_id');
        $this->db->order_by('mall_order_barter.barter_id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

     /**
     * 获取换货信息
     * @param unknown $barter_id
     */
    public function getBarter($barter_id)
    {
        $this->db->select('mall_order_product.goods_name,mall_order_product.refund_num, mall_order_barter.*, user.alias_name');
        $this->db->from($this->table . ' AS mall_order_barter');
        $this->db->join($this->table_2 . ' AS mall_order_product', 'mall_order_product.order_product_id = mall_order_barter.order_product_id');
        $this->db->join($this->table_3 . ' AS user', 'user.uid = mall_order_barter.seller_uid');
        $this->db->where('mall_order_barter.barter_id', $barter_id);
        return $this->db->get();
    }

    public function updateBarter($params)
    {
        $this->db->where('barter_id', $params['barter_id']);
        return $this->db->update($this->table, $params);
    }
}