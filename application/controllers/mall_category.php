<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_category extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_category_model','mall_category');
	}

	public function grid()
	{ 
	    $data['res'] = $this->mall_category->findById(array())->result();
	    $this->load->view('mall_category/grid', $data);
	}
	
	public function add()
	{
	    $data['res'] = $this->mall_category->findById(array())->result();
	    $this->load->view('mall_category/add', $data);
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('mall_category/add', $this->input->post('id'), $error);
	    }
	    $postData = $this->input->post();
	    $data['parent_id'] = $postData['parent_id'];
	    $data['cat_name'] = $postData['cat_name'];
	    $data['is_show'] = $postData['is_show'];
	    $data['sort_order'] = $postData['sort_order'];
	    $data['filter_attr'] = toNumStr($postData['filter_attr']);
	    if( !empty($postData['keyword']) ){
	       $data['keyword'] = $postData['keyword'];
	    }
	    $res = $this->mall_category->insert($data);
	    if ($res) {
	        $this->success('mall_category/grid', '', '新增成功！');
	    } else {
	        $this->error('mall_category/add', '', '新增失败！');
	    }
	}
	
	public function edit($cat_id)
	{
	    $res = $this->mall_category->findById(array('cat_id'=>$cat_id));
	    if ($res->num_rows() <= 0){
	    	$this->error('mall_category/grid', '', '没找到对应分类值');
	    }
        $data['res'] = $res->row();
        $this->load->view('mall_category/edit',$data);
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('mall_category/edit', $this->input->post('cat_id'), $error);
        }
        $postData = $this->input->post();
        $data['cat_name'] = $postData['cat_name'];
	    $data['is_show'] = $postData['is_show'];
	    $data['sort_order'] = $postData['sort_order'];
	    $data['filter_attr'] = toNumStr($postData['filter_attr']);
	    if( !empty($postData['keyword']) ){
	    	$data['keyword'] = $postData['keyword'];
	    }
        $res = $this->mall_category->update(array('cat_id'=>$postData['cat_id']), $data); 
        if ($res) {
            $this->success('mall_category/grid', '', '修改成功！');
        } else {
            $this->error('mall_category/edit', $this->input->post('cat_id'), '修改失败！');
        }
	}
	
	public function delete($cat_id)
	{
	    $chlid_num = $this->mall_category->findById(array('parent_id'=>$cat_id))->num_rows();
	    if ($chlid_num > 0)
	    {
	        $this->error('mall_category/grid', '', '此分类下还有子类，不能删除！');
	    }else{
	        $is_delete = $this->mall_category->delete(array('cat_id'=>$cat_id));
	        if ($is_delete) {
	            $this->success('mall_category/grid', '', '删除成功！');
	        } else {
	            $this->error('mall_category/grid', '', '删除失败！');
	        }
	    }
	}
	
	public function validate()
	{
	    $error = array();
        if ($this->validateParam($this->input->post('cat_name')))
        {
            $error[] = '分类名称不能为空';
        }
	    return $error;
	}
}
