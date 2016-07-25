<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_order_reviews extends CS_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_order_reviews_model','mall_order_reviews');
	}

    public function grid($pg = 1)
	{   
	    $page_num = 20;
	    $num = ($pg-1)*$page_num;
	    $getData = $this->input->get();
	    $config['first_url']   = base_url('mall_order_reviews/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('mall_order_reviews/grid');
	    $config['total_rows']  = $this->mall_order_reviews->total($getData);
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_order_reviews->mall_order_reviews_list($num, $page_num, $getData);
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg; 
	    $data['page_num']  = $page_num;
	    $data['status_arr'] = array('1'=>'待审核', '2'=>'通过', '3'=>'未通过审核');
	    $this->load->view('mall_order_reviews/grid', $data);
	}
	
	public function edit($reviews_id)
	{
	    $res = $this->mall_order_reviews->findById(array('reviews_id'=>$reviews_id));
	    if ($res->num_rows() <= 0){
	        $this->error('mall_order_reviews/grid', '', '无法找到该ID结果值');
	    }
	    $data['reviews'] = $res->row();
	    $data['status_arr'] = array('1'=>'待审核', '2'=>'通过', '3'=>'未通过审核');
	    $this->load->view('mall_order_reviews/edit', $data);
	}
	
	public function editPost()
	{
	    $getData = $this->input->get(); 
	    $data['status'] = $getData['status'];
	    $res = $this->mall_order_reviews->update(array('reviews_id'=>$getData['reviews_id']), $data);
	    if ($res) {
	        $this->success('mall_order_reviews/grid', '', '修改成功！');
	    } 
	    $this->error('mall_order_reviews/edit', $this->input->post('reviews_id'), '修改失败！');
	    
	}
	
	public function delete($reviews_id)
	{   
	    $is_delete = $this->mall_order_reviews->delete(array('reviews_id'=>$reviews_id));
	    if ($is_delete) {
	        $this->success('mall_order_reviews/grid', '', '删除成功！');
	    }
	    $this->error('mall_order_reviews/grid', '', '删除失败！');
	    
	}
}