<?php
class Mall_order_barter extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_order_barter_model', 'mall_order_barter');
        $this->load->model('mall_order_base_model','mall_order_base'); 
        $this->load->model('mall_order_product_model','mall_order_product');
        $this->load->model('deliver_order_model','deliver_order');    
    }

    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg - 1) * $page_num;
        $config['first_url'] = base_url('mall_order_barter/grid') . $this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_order_barter/grid');
        $config['total_rows'] = $this->mall_order_barter->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_list'] = $this->pagination->create_links();
        $data['page_list'] = $this->mall_order_barter->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $data['barterStatus'] = array('1' => '申请换货', '2' => '同意换货', '3' => '否决换货');
        $data['barterFlag'] = array('1' => '未更换', '2' => '已更换');
        $this->load->view('mall_order_barter/grid', $data);
    }

    /**
     * 换货详情
     * @param unknown $barter_id
     */
    public function info($barter_id)
    {
        $result = $this->mall_order_barter->getBarter($barter_id);
        if ($result->num_rows() <= 0) {
            $this->error('mall_order_barter/grid', '', '换货详情有误');
        }
        $barter = $result->row();
        $order = $this->mall_order_base->findByOrderId($barter->order_id);
        $data['orderInfo'] = $order->row(0);
        $data['barter'] = $barter;
        $data['logistics'] = $this->deliver_order->findByNu($barter->logistics);// 物流单号
        $data['barterStatus'] = array('1' => '申请换货', '2' => '同意换货', '3' => '否决换货');
        $data['barterFlag'] = array('1' => '未更换', '2' => '已更换');
        $this->load->view('mall_order_barter/info', $data);
    }

    //换货审核操作
    public function verify()
    {
        $postData = $this->input->post();
        $this->db->trans_begin();
        if ($postData['status'] == 2) {//审核退款
            $status = $this->confirm($postData['barter_id']);
            if (!$status) {
                $this->db->trans_rollback();
                $this->error('mall_order_barter/grid', '', '审核失败！');
            }else{
                $postData['verify_time']= date('Y-m-d H:i:s');
            }
        }else{
            $postData['flag'] == 1;
        }
        //更改状态
        $this->mall_order_barter->updateBarter($postData);
        //返还商品
        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            $this->success('mall_order_barter/grid', '', '审核成功！');
        } else {
            $this->error('mall_order_barter/grid', '', '审核失败！');
        }
    }

    /**
     * 确认退款操作。
     * @param unknown $refundId
     * @param unknown $orderProductId
     * @param unknown $pg_now
     */
    public function confirm($barter_id)
    {
        //获取退货信息
        $refund_res = $this->mall_order_barter->getBarter($barter_id);

        if ($refund_res->num_rows() <= 0) {
            $this->error('mall_order_barter/grid', '', '当前换货记录有误！');
        }
        $mallBarter = $refund_res->row();

        //获取订单产品信息
        $result = $this->mall_order_product->findById(array('order_product_id'=>$mallBarter->order_product_id));
        if ($result->num_rows() <= 0) {
            $this->error('mall_order_barter/grid', '', '当前订单产品有误！');
        }
        $mallOrder = $result->row();
        //判断订单能否退款
        $order_res = $this->mall_order_base->findByOrderId($mallOrder->order_id);
        if ($order_res->num_rows() <= 0) {
            $this->error('mall_order_barter/grid', '', '当前订单有误！');
        }
        $orderInfo = $order_res->row();
        if (($orderInfo->state < 2) || ($orderInfo->status < 3)) {
            $this->error('mall_order_barter/grid', '', '当前订单未付，不可退款！');
        }
        if (($orderInfo->state >= 4) || ($orderInfo->status >= 6)) {
            $this->error('mall_order_barter/grid', '', '当前订单已评价或已退，不可退款！');
        }
        //验证退货数量是否大于0
        if ($mallBarter->number > $mallBarter->refund_num) {
            $this->error('mall_order_barter/grid', '', '可退数量不足');
        }
        return true;
    }
}