<?php 
class Notify extends CI_Controller
{
    public function alipayNotify()
    {
        $this->load->model('mall_order_refund_model', 'mall_order_refund');
        $this->load->library('refund/Alipaypc', null, 'alipaypc');
        $response = $this->alipaypc->responseAlipayNotify();
        if ($response) {
            $time = date('Y-m-d H:i:s');
            $res = explode('^', $_POST['result_details']);
            //支付宝订单号other_trade_no获取pay_id
            $pay_id = $this->mall_order_pay->findById(array('other_trade_no'=>$res[0]))->row()->pay_id;
            //pay_id获取订单信息
            $order = $this->mall_order_base->findByPayId($pay_id)->row();
            //order_id获取退款信息
            $refund = $this->mall_order_refund->findById(array('order_id'=>$order->order_id))->row();
            //获取退款产品信息
            $orderProduct = $this->mall_order_product->findByParams(array('order_id'=>$refund->order_id, 'order_product_id'=>$refund->order_product_id))->row();
            
            $number = $this->mall_order_product->getAllProduct($refund->order_id);
            $refund_num = $this->mall_order_refund->getAllRefundNum($refund->order_id);
            $num = $number - $refund_num - $refund->number;
            $this->db->trans_start();
            $res_arr = $this->mall_order_refund->updateOrderInfo($orderProduct, $refund, $refund->counter_fee, $num, $order);
            $refundFlag = $this->mall_order_refund->updateRefundFlag(array('flag'=>2, 'time'=>$time, 'refund_id'=>$refund->refund_id));
            $this->db->trans_complete();
        }
    
    }
    
}