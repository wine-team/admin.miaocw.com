<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_order_base extends CS_Controller
{
    private $extension = array();
    private $state_arr = array();
    private $status_arr = array();

    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_order_base_model','mall_order_base');
        $this->load->model('deliver_order_model','deliver_order');
        $this->load->model('mall_order_product_model','mall_order_product');
        $this->load->model('mall_order_status_history_model','mall_order_status_history');
        $this->extension = array(
            'simple'=>'简单产品',
            'grouped'=>'组合产品',
            'configurable'=>'可配置产品',
            'virtual'=>'虚拟产品',
            'bundle'=>'捆绑产品',
            'giftcard'=>'礼品卡'
        );
        $this->state_arr = array('1'=>'未付款', '2'=>'已付款', '3'=>'已完成', '4'=>'评价', '5'=>'退款');
        $this->status_arr = array('1'=>'取消订单', '2'=>'未付款', '3'=>'已付款', '4'=>'已发货', '5'=>'已收货', '6'=>'已评价');
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
        $data['is_form_arr'] = array('1'=>'电脑端', '2'=>'手机端', '3'=>'其他');
        $data['state_arr'] = $this->state_arr;
        $data['status_arr'] = $this->status_arr;
        $this->load->view('mall_order_base/grid', $data);
    }
    
    public function infor($order_id)
    {
        $result = $this->mall_order_base->findByOrderId($order_id);
        if ($result->num_rows() <= 0){
            $this->error('mall_order_base/grid', '', '无法找到该ID结果值');
        }
        $data['order'] = $result->row();
        $data['product'] = $this->mall_order_product->findById(array('order_id'=>$order_id))->result();
        $data['delivery'] = $this->deliver_order->findById($result->row()->deliver_order_id);
        $data['status_history'] = $this->mall_order_status_history->findById(array('order_id'=>$order_id))->result();
        $data['state_arr'] = $this->state_arr;
        $data['status_arr'] = $this->status_arr;
        $data['is_form_arr'] = array('1'=>'电脑端', '2'=>'手机端', '3'=>'其他');
        $data['delivery_ischeck_arr'] = array('0'=>'在途中','1'=>'揽件', '2'=>'疑难', '3'=>'签收');
        $data['delivery_state_arr'] = array('0'=>'在途中', '1'=>'已揽收', '2'=>'疑难', '3'=>'已签收', '4'=>'退签', '5'=>'同城派送中', '6'=>'退回', '7'=>'转单');
        $data['extension_code_arr'] = $this->extension;
        $this->load->view('mall_order_base/edit', $data);
    }
    
    public function delete($order_id)
    {
        $order = $this->mall_order_base->findByOrderId($order_id)->row();
        $this->db->trans_start();
        $this->mall_order_product->delete(array('order_id'=>$order_id));
        if ($order->deliver_order_id) {
            $this->deliver_order->deleteById($order->deliver_order_id);
        }
        $is_delete = $this->mall_order_base->delete(array('order_id'=>$order_id));
        $this->db->trans_complete();
        if ($is_delete && $this->db->trans_status()===TRUE) {
            $this->success('mall_order_base/grid', '', '删除成功！');
        } else {
            $this->error('mall_order_base/grid', '', '删除失败！');
        }
    }
}
