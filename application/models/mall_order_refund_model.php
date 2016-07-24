<?php
class Mall_order_refund_model extends CI_Model{
	
	private $table   = 'mall_order_refund';
	private $table_2 = 'mall_order_product';
	private $table_3 = 'user';
	private $table_4 = 'mall_order_base';
	
	public function total($search)
	{
		$this->db->from($this->table . ' AS mall_order_refund');
		$this->db->join($this->table_2 . ' AS mall_order_product', 'mall_order_product.order_product_id = mall_order_refund.order_product_id');
		$this->db->join($this->table_3 . ' AS user', 'user.uid = mall_order_refund.seller_uid');
		if (!empty($search['order_id'])) {
			$this->db->where('mall_order_product.order_id', $search['order_id']);
		}
		if (!empty($search['goods_name'])) {
			$this->db->where("(`mall_order_product`.`goods_name` LIKE '%{$search['goods_name']}%')");
		}
		if (!empty($search['seller_name'])) {
			$this->db->where("( (`user`.`alias_name` LIKE '%{$search['seller_name']}%')");
		}
		if (!empty($search['user_name'])) {
			$this->db->where("(`mall_order_refund`.`user_name` LIKE '%{$search['user_name']}%') OR (`mall_order_refund`.`uid`='{$search['user_name']}') OR (`mall_order_refund`.`cellphone`='{$search['user_name']}')");
		}
		if (!empty($search['status'])) {
			$this->db->where('mall_order_refund.status', $search['status']);
		}
		if (!empty($search['flag'])) {
			$this->db->where('mall_order_refund.flag', $search['flag']);
		}
	    return $this->db->count_all_results();
	}
	
	public function mall_order_refund_list($page, $perpage, $search, $order='order_id DESC')
	{
		$this->db->select('mall_order_refund.*,mall_order_product.goods_name,user.alias_name');
		$this->db->from($this->table . ' AS mall_order_refund');
		$this->db->join($this->table_2 . ' AS mall_order_product', 'mall_order_product.order_product_id = mall_order_refund.order_product_id');
		$this->db->join($this->table_3 . ' AS user', 'user.uid = mall_order_refund.seller_uid');
		if (!empty($search['order_id'])) {
			$this->db->where('mall_order_product.order_id', $search['order_id']);
		}
		if (!empty($search['goods_name'])) {
			$this->db->where("(`mall_order_product`.`goods_name` LIKE '%{$search['goods_name']}%')");
		}
		if (!empty($search['seller_name'])) {
			$this->db->where("( (`user`.`alias_name` LIKE '%{$search['seller_name']}%')");
		}
		if (!empty($search['user_name'])) {
			$this->db->where("(`mall_order_refund`.`user_name` LIKE '%{$search['user_name']}%') OR (`mall_order_refund`.`uid`='{$search['user_name']}') OR (`mall_order_refund`.`cellphone`='{$search['user_name']}')");
		}
		if (!empty($search['status'])) {
			$this->db->where('mall_order_refund.status', $search['status']);
		}
		if (!empty($search['flag'])) {
			$this->db->where('mall_order_refund.flag', $search['flag']);
		}
	    $this->db->order_by($order);
	    if($perpage) $this->db->limit($perpage, $perpage*$page);
	    return $this->db->get();
	}
	
	
	/**
	 * 获取退款详情
	 * @param unknown $id
	 */
	public function getRefund($refund_id)
	{
		$this->db->select('mall_order_refund.*,mall_order_product.goods_name,user.alias_name');
		$this->db->from($this->table . ' AS mall_order_refund');
		$this->db->join($this->table_2 . ' AS mall_order_product', 'mall_order_product.order_product_id = mall_order_refund.order_product_id');
		$this->db->join($this->table_3 . ' AS user', 'user.uid = mall_order_refund.seller_uid');
		$this->db->where('mall_order_refund.refund_id', $refund_id);
		return $this->db->get();
	}
	
	public function updateTourismOrderRefund($postData)
	{
		$data = array(
				'counter_fee'    => !empty($postData['counter_fee']) ? $postData['counter_fee'] : 0,
				'refund_content' => $postData['refund_content'],
				'reject_content' => !empty($postData['reject_content']) ? $postData['reject_content'] : '',
				'status'         => $postData['status'],
		);
		$this->db->where('refund_id', $postData['refund_id']);
		return $this->db->update($this->table, $data);
	}
	
	
	//更改订单信息
	public function updateOrderInfo($orderProduct, $mallRefund, $poundage, $num, $order_res)
	{
		$err_code = 0;
		$err_msg = "";
	
		//计算退货商品的价格 退货数*单价-手续费
		$o_num = $mallRefund->number;//退货数
		$isTransport = 0;
		//如果$num=0 商品全退
		if (($order_res->status == 3) && $num <= 0) {
			$transport_cost = $order_res->deliver_price;
			$isTransport = 1;
		}
		$amount_return = bcmul($orderProduct->pay_amount, $o_num, 3) ; //实际支付多少钱
		$actual_return = bcsub($amount_return, $poundage, 3); //相减
	
		if ($actual_return < $poundage) {
			$err_code = 1;
			$err_msg = "别逗了，手续费（".$poundage."）比退款金额（".$actual_return."）还多,还能玩耍不！";
			return array('err_code' => $err_code, 'err_message' => $err_msg);
		}
	
		if ($num <= 0) {
			$this->db->set('status', '1');
		}
		$this->db->set('order_pay_price', "actual_price - $amount_return", FALSE);  // 订单余额
		if (isset($transport_cost)) {
			$this->db->set('deliver_price', 0);
		}
		$this->db->where('order_id', $orderProduct->order_id);
		$this->db->update($this->table_4);
		$data['amount_refund'] = $amount_return;
		$data['err_code'] = $err_code;
		$data['err_message'] = $err_msg;
		$data['actual_return'] = $actual_return;
		$data['isTransport'] = $isTransport;
		$data['transport_cost'] = $order_res->deliver_price;
		return $data;
	}
	
	/**
	 * 获取全部已退商品数量
	 * @param unknown $order_id
	 * @return number
	 */
	public function getAllRefundNum($order_id)
	{
		$this->db->select_sum('number');
		$this->db->where('flag', 2); //已经退款了的
		$this->db->where('order_id', $order_id);
		$result = $this->db->get($this->table);
		$row = $result->row();
		return isset($row->number) ? $row->number : 0;
	}
	
	 /**
	 * 更新是否退款
	 * @param unknown $postData
	 */
	public function updateRefundFlag($postData)
	{
		$data = array('flag' => $postData['flag']);
		$this->db->where('refund_id', $postData['refund_id']);
		return $this->db->update($this->table, $data);
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