<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_order_refund extends CS_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_order_refund_model','mall_order_refund');
	    $this->load->model('mall_order_base_model','mall_order_base');
	    $this->load->model('mall_order_product_model','mall_order_product');
	    $this->load->model('deliver_order_model','deliver_order');
	    $this->load->model('account_log_model','account_log');
	    $this->load->model('user_model','user');
	}

    public function grid($pg = 1)
	{   
		$perpage = 20;
		$getData = $this->input->get();
	    $config['first_url']   = base_url('mall_order_refund/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('mall_order_refund/grid');
	    $config['total_rows']  = $this->mall_order_refund->total($getData);
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_order_refund->mall_order_refund_list($pg-1, $perpage, $getData)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg; 
	    $data['page_num']  = $perpage;
	    $data['status_arr'] = array('1'=>'申请退款', '2'=>'同意退款', '3'=>'拒绝退款');
	    $data['flag_arr'] = array('1'=>'未退款', '2'=>'已退款');
	    $this->load->view('mall_order_refund/grid', $data);
	}
	
	public function info($refund_id)
	{
	    $result = $this->mall_order_refund->getRefund($refund_id);
	    if ($result->num_rows() <= 0){
	        $this->error('mall_order_refund/grid', '', '无法找到该ID结果值');
	    }
	    $refund = $result->row(0);
	    $order = $this->mall_order_base->findById(array('order_id'=>$refund->order_id));
	    $data['orderInfo'] = $order->row(0);
	    $data['refund'] = $refund;
	    $data['status_arr'] = array('1'=>'申请退款', '2'=>'同意退款', '3'=>'拒绝退款');
	    $data['flag_arr'] = array('1'=>'未退款', '2'=>'已退款');
	    $data['delivery'] = $this->deliver_order->findById($refund->deliver_order_id);
	    $this->load->view('mall_order_refund/info', $data);
	}
	
	public function editPost()
	{
		$refund_id = $this->input->post('refund_id');
		$error = $this->validate();
		if (!empty($error)) {
			$this->error('mall_order_refund/info', $refund_id, $error);
		}
		$this->db->trans_start();
		$resultId = $this->mall_order_refund->updateTourismOrderRefund($this->input->post());
		$this->db->trans_complete();
		if ($resultId) {
			$this->success('mall_order_refund/grid', '', '保存成功！');
		} else {
			$this->error('mall_order_refund/edit', $refund_id, '保存失败！');
		}
	}
	
	/**
	 * 确认退款操作。
	 * @param unknown $refundId
	 * @param unknown $orderProductId
	 * @param unknown $pg_now
	 */
	public function confirm($refund_id, $pg_now=1)
	{
		$refund_res = $this->mall_order_refund->findById(array('refund_id'=>$refund_id));
		if ($refund_res->num_rows() <= 0) {
			$this->error('mall_order_refund/grid', $pg_now, '当前退款记录有误！');
		}
		$mallRefund = $refund_res->row();
	
		$result = $this->mall_order_product->findById(array('order_id'=>$mallRefund->order_id, 'order_product_id'=>$mallRefund->order_product_id));
		if ($result->num_rows() <= 0) {
			$this->error('mall_order_refund/grid', $pg_now, '当前订单产品有误！');
		}
		$orderProduct = $result->row(0);
	
		//获取订单信息
		$order_res = $this->mall_order_base->findById(array('order_id'=>$mallRefund->order_id));
		if ($order_res->num_rows() <= 0) {
			$this->error('mall_order_refund/grid', $pg_now, '当前订单有误！');
		}
		$orderInfo = $order_res->row();
	
		//订单是否退还运费 未发货时 并且无可退商品
		if (($orderInfo->state < 2) || ($orderInfo->status < 3)) {
			$this->error('mall_order_refund/grid', $pg_now, '当前订单未付，不可退款！');
		}
		if (($orderInfo->state >= 4) || ($orderInfo->status >= 6)) {
			$this->error('mall_order_refund/grid', $pg_now, '当前订单已评价或已退，不可退款！');
		}
		//验证退货数量是否大于0
		if ($mallRefund->number <= 0) {
			$this->error('mall_order_refund/grid', $pg_now, '退货数量必须大于0！');
		}
		//获取订单总商品数量 - 已退商品数量 - 获取本次退货数量 ==0 返还运费
		$number = $this->mall_order_product->getAllProduct($mallRefund->order_id);
		$refund_num = $this->mall_order_refund->getAllRefundNum($mallRefund->order_id);
		$num = $number - $refund_num - $mallRefund->number;
	
		$this->db->trans_start();
		$res_arr = $this->mall_order_refund->updateOrderInfo($orderProduct, $mallRefund, $mallRefund->counter_fee, $num, $orderInfo);
		if (0 != $res_arr['err_code']) {
			$this->error('mall_order_refund/grid', '', $res_arr['err_message']);
		}
		//获取用户账户信息
		$resultUser = $this->user->findById($mallRefund->uid);
		
		if ($resultUser->num_rows() <= 0) {
			$this->error('mall_order_refund/grid', $pg_now, '退款用户不存在。');
		}
		$userAccount = $resultUser->row(0);
	
		//退款到提现账户
		$account = $this->user->updateUserAcount($mallRefund->uid, array('amount_carry' => $res_arr['actual_return']));
		$account_log = $this->account_log->insertAccountLogRecord($mallRefund->uid,$orderProduct->order_id,$account_type=1,$flow=3,$trade_type=6,$res_arr['actual_return'],$note='退款-本经');
		if ($res_arr['isTransport']) { //退运费
			//返还运费 生成记录
			$this->user->updateUserAcount($mallRefund->uid, array('amount_carry' => $res_arr['transport_cost']));
			$account_log = $this->account_log->insertAccountLogRecord($mallRefund->uid,$orderProduct->order_id,$account_type=1,$flow=3,$trade_type=6,$res_arr['transport_cost'],$note='退款-运费');
		}
		$refundFlag = $this->mall_order_refund->updateRefundFlag(array('flag'=>2, 'refund_id'=>$refund_id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE &&  !$account_log || !$account || !$refundFlag) {
			$this->error('mall_order_refund/grid', '', '确认退款操作失败');
		}
		$this->success('mall_order_refund/grid', '', '确认退款操作成功');
	}
	
	public function validate()
	{
		$error = array();
		if ($this->validateParam($this->input->post('refund_content'))) {
			$error[] = '退货原因不能为空。';
		}
		if ($this->validateParam($this->input->post('status'))) {
			$error[] = '退款状态不能为空。';
		}
		return $error;
	}
	
	public function delete($refund_id)
	{
	    $is_delete = $this->mall_order_refund->delete(array('refund_id'=>$refund_id));
	    if ($is_delete) {
	        $this->success('mall_order_refund/grid', '', '删除成功！');
	    } else {
	        $this->error('mall_order_refund/grid', '', '删除失败！');
	    }
	}	
}