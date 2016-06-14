<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_order_base extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_order_base_model','mall_order_base');
	}

    public function grid($pg = 1)
	{   
	    $getData = $this->input->get();
	    $perpage = 20;
	    $search['item'] = $getData['item'];
	    $search['state'] = $getData['state'];
	    $search['status'] = $getData['status'];
	    $search['seller_uid'] = $getData['seller_uid'];
	    $search['is_form'] = $getData['is_form'];
	    $search['sta_time'] = $getData['sta_time'] ? ($getData['sta_time']<date('Y-m-d') ? $getData['sta_time'].' 00:00:00' : date('Y-m-d H:i:s')) : '';
	    $search['end_time'] = $getData['end_time'] ? ($getData['end_time']>=$getData['sta_time'] ? $getData['end_time'].' 59:59:59' : '') : '';
	    $config['first_url']   = base_url('mall_order_base/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('mall_order_base/grid');
	    $config['total_rows']  = $this->mall_order_base->total($search);
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_order_base->mall_order_base_list($pg-1, $perpage, $search)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg; 
	    $this->load->view('mall_order_base/grid', $data);
	}
	
	public function edit($order_id)
	{
	    $res = $this->mall_order_base->findById(array('order_id'=>$order_id));
	    if ($res->num_rows() <= 0){
	        $this->error('mall_order_base/grid', '', '无法找到该ID结果值');
	    }
	    $data['order'] = $res->row();
	    $data['product'] = $this->mall_order_base->findOrderProduct(array('order_id'=>$order_id))->result();
	    $data['delivery'] = $this->mall_order_base->findOrderDeliver(array('order_id'=>$order_id));
	    $this->load->view('mall_order_base/edit', $data);
	}
	
	public function ajaxGetDelivery()
	{
	    $data['delivery'] = $this->mall_order_base->findOrderDeliver(array('deliver_order_id'=>$this->input->get('deliver_order_id')));
	    $res['html'] = $this->load->view('mall_order_base/delivery/ajaxDeliveryData', $data, true);
	    $res['status'] = true;
	    echo json_encode($res);
	}
	
	public function delete($brand_id)
	{
	    $brand = $this->mall_order_base->findById(array('brand_id'=>$brand_id));
	    $logo = $brand->num_rows()>0 ? $brand->row()->brand_logo : '';
	    if (!empty($logo) && file_exists($this->config->upload_image_path('brand', $logo)))
	    {
	        @unlink($this->config->upload_image_path('brand', $logo));
	    }
        $is_delete = $this->mall_order_base->delete(array('brand_id'=>$brand_id));
        if ($is_delete) {
            $this->success('mall_order_base/grid', '', '删除成功！');
        } else {
            $this->error('mall_order_base/grid', '', '删除失败！');
        }
	    
	}
	
}
/** End of file Mall_order_base.php */
/** Location: ./application/controllers/Mall_order_base.php */
