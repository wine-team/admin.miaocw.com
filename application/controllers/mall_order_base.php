<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_order_base extends CS_Controller
{
    private $extension   = array();
    private $orderState  = array();
    private $orderStatus = array();
    private $isForm      = array();

    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_order_base_model','mall_order_base');
        $this->load->model('deliver_order_model','deliver_order');
        $this->load->model('mall_order_product_model','mall_order_product');
        $this->load->model('mall_order_product_profit_model','mall_order_product_profit');
        $this->load->model('mall_order_history_model','mall_order_history');
        $this->extension = array(
            'simple'=>'简单产品',
            'grouped'=>'组合产品',
            'configurable'=>'可配置产品',
            'virtual'=>'虚拟产品',
            'bundle'=>'捆绑产品',
            'giftcard'=>'礼品卡'
        );
        $this->orderState = array('1'=>'未付款', '2'=>'已付款', '3'=>'已完成', '4'=>'评价', '5'=>'退款');
        $this->orderStatus = array('1'=>'取消订单', '2'=>'未付款', '3'=>'已付款', '4'=>'已发货', '5'=>'已收货', '6'=>'已评价');
        $this->isFrom = array(1=>'电脑PC', 2=>'手机Web', 3=>'手机Android', 4=>'手机IOS', 5=>'其他');
    }

    public function grid($pg = 1)
    {   
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('mall_order_base/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_order_base/grid');
        $config['total_rows']  = $this->mall_order_base->total($this->input->get());
        $config['uri_segment'] = 3; 
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->mall_order_base->mall_order_base_list($num, $page_num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $data['is_from'] = $this->isFrom;
        $data['orderState'] = $this->orderState;
        $data['orderStatus'] = $this->orderStatus;
        $this->load->view('mall_order_base/grid', $data);
    }
    
    public function info($order_id)
    {
        $result = $this->mall_order_base->findByOrderId($order_id);
        if ($result->num_rows() <= 0){
            $this->error('mall_order_base/grid', '', '无法找到该ID结果值');
        }
        $orderBase = $result->row();
        $data['orderBase'] = $orderBase;
        $orderProduct = $this->mall_order_product->findByOrderId($order_id);
        $orderProductIds =array();
        if ($orderProduct->num_rows() > 0) {
            foreach ($orderProduct->result() as $item) {
                $orderProductIds[$item->order_product_id] = $item;
            }
        }
        $data['orderProduct'] = $orderProduct;
        $data['orderProductProfit'] = $this->mall_order_product_profit->findByParams(array('order_product_ids'=>array_keys($orderProductIds)));
        $data['deliverOrder'] = $this->deliver_order->findBydeliverOrderId($orderBase->deliver_order_id);
        $data['orderHistory'] = $this->mall_order_history->findByOrderId($order_id);
        $data['operateType'] = array(1=>'下单', 2=>'支付', 3=>'发货', 4=>'确认收货', 5=>'评价', 6=>'取消订单', 7=>'申请退货', 8=>'其它');
        //$data['delivery_ischeck'] = array('0'=>'在途中','1'=>'揽件', '2'=>'疑难', '3'=>'签收');
        //$data['delivery_state'] = array('0'=>'在途中', '1'=>'已揽收', '2'=>'疑难', '3'=>'已签收', '4'=>'退签', '5'=>'同城派送中', '6'=>'退回', '7'=>'转单');
        $data['extension_code'] = $this->extension;
        $data['orderState'] = $this->orderState;
        $data['orderStatus'] = $this->orderStatus;
        $data['is_from'] = $this->isFrom;
        $this->load->view('mall_order_base/info', $data);
    }

    /**
     * 修改运费价格
     */
    public function modifyDeliverPrice()
    {
        $order_id = $this->input->post('order_id');
        $deliver_price = $this->input->post('deliver_price');
        $result = $this->mall_order_base->findByOrderId($order_id);
        if ($result->num_rows() <= 0) {
            $this->jsonMessage('网络错误，订单信息不对');
        }
        $orderInfo = $result->row();
        if ($deliver_price < 0) {
            $this->jsonMessage('修改价格必须要大于等于零');
        }
        if ((float)$orderInfo->deliver_price == (float)$deliver_price) {
            $this->jsonMessage('修改价格与当前价格相等');
        }
        $this->db->trans_start();
        $isUpdate = $this->mall_order_base->modifyDeliverPrice($order_id, $deliver_price);
        $isinsert = $this->mall_order_history->insert(array(
            'order_id'     => $order_id,
            'uid'          => $this->uid,
            'operate_type' => 8,
            'comment'      => '修改运费从('.$orderInfo->deliver_price.')到（'.$deliver_price.')',
        ));
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE && $isUpdate && $isinsert) {
            $this->jsonMessage('');
        } else {
            $this->jsonMessage('运费价格修改失败');
        }
    }
}
