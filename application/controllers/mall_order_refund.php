<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_order_refund extends CS_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_order_refund_model','mall_order_refund');
	    $this->load->model('mall_order_base_model','mall_order_base');
	    $this->load->model('deliver_order_model','deliver_order');
	}

    public function grid($pg = 1)
	{   
	    $getData = $this->input->get();
	    $perpage = 20;
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
	
	public function edit($refund_id)
	{
	    $res = $this->mall_order_refund->findById(array('refund_id'=>$refund_id));
	    if ($res->num_rows() <= 0){
	        $this->error('mall_order_refund/grid', '', '无法找到该ID结果值');
	    }
	    $data['refund'] = $res->row();
	    $data['status_arr'] = array('1'=>'申请退款', '2'=>'同意退款', '3'=>'拒绝退款');
	    $data['flag_arr'] = array('1'=>'未退款', '2'=>'已退款');
	    $data['delivery'] = $this->deliver_order->findById($res->row()->deliver_order_id);
	    $data['delivery_ischeck_arr'] = array('0'=>'在途中','1'=>'揽件', '2'=>'疑难', '3'=>'签收');
	    $data['delivery_state_arr'] = array('0'=>'在途中', '1'=>'已揽收', '2'=>'疑难', '3'=>'已签收', '4'=>'退签', '5'=>'同城派送中', '6'=>'退回', '7'=>'转单');
	    $this->load->view('mall_order_refund/edit', $data);
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
/** End of file Mall_order_refund.php */
/** Location: ./application/controllers/Mall_order_refund.php */
