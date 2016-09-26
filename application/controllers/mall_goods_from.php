<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_goods_from extends CS_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_goods_from_model','mall_goods_from');
	}

    public function grid($pg = 1)
	{
	    $getData = $this->input->get();
	    $page_num = 20;
		$num = ($pg-1)*$page_num;
	    $config['first_url']   = base_url('mall_goods_from/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($this->input->get());
	    $config['base_url']    = base_url('mall_goods_from/grid');
	    $config['total_rows']  = $this->mall_goods_from->total($getData);
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_goods_from->page_list($page_num, $num, $getData);
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg;
		$data['page_num'] = $page_num;
	    $this->load->view('mall_goods_from/grid', $data);
	}
	
	public function add()
	{
	    $this->load->view('mall_goods_from/add');
	}
	
	public function addPost()
	{
		$from_name = $this->input->post('from_name');
		if ($this->validateParam($from_name)) {
			$this->error('mall_goods_from/add', '', '请输入来源名称');
		}
		$result = $this->mall_goods_from->findFromByRes(array('from_name'=>$from_name),$f='from_id');
	    if ($result->num_rows()>0) {
	    	$this->error('mall_goods_from/add', '', '来源名称已经存在');
	    }
	    $insert = array('from_name'=>$from_name,'creat_at'=>date('Y-m-d H:i:s',time()));
	    $res = $this->mall_goods_from->insert($insert);
	    if ($res) {
	        $this->success('mall_goods_from/grid', '', '新增成功！');
	    } else {
	        $this->error('mall_goods_from/add', '', '新增失败！');
	    }
	}
	
	public function edit($from_id)
	{
	    $res = $this->mall_goods_from->findFromByRes(array('from_id'=>$from_id));
	    if ($res->num_rows() <= 0){
	    	$this->error('mall_goods_from/grid', '', '无法找到该ID结果值');
	    } 
	    $data['res'] = $res->row();
	    $this->load->view('mall_goods_from/edit',$data);
	}
	
	public function editPost()
	{
		$from_name = $this->input->post('from_name');
		$from_id = $this->input->post('from_id');
		if ($this->validateParam($from_name)) {
			$this->error('mall_goods_from/add', '', '请输入来源名称');
		}	
		$result = $this->mall_goods_from->findFromByRes(array('from_name'=>$from_name),$f='from_id');
		if ( ($result->num_rows()>0) && ($result->row(0)->from_id !=$from_id)) {
			$this->error('mall_goods_from/edit',$from_id, '来源名称已经存在');
		}   
		$update = $this->mall_goods_from->update(array('from_id'=>$from_id),array('from_name'=>$from_name));
		if ($update) {
			$this->success('mall_goods_from/grid', '', '编辑成功！');
		} else {
			$this->error('mall_goods_from/edit',$from_id, '编辑失败！');
		}
	}
	
	public function delete($from_id)
	{
        $is_delete = $this->mall_goods_from->delete(array('from_id'=>$from_id));
        if ($is_delete) {
            $this->success('mall_goods_from/grid', '', '删除成功！');
        } else {
            $this->error('mall_goods_from/grid', '', '删除失败！');
        }
	}
}
