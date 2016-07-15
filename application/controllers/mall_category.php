<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_category extends CS_Controller
{
	public function _init()
	{
		$this->load->helper(array('dictionary', 'common'));
	    $this->load->library('pagination');
	    $this->load->model('mall_category_model','mall_category');
	}

	public function grid()
	{
		$data['categorys'] = $this->mall_category->findByCategoryTree();
		$this->load->view('mall_category/grid',$data);
	}
	
	public function savePost()
	{
	    $error = $this->validate(); 
	    if (!empty($error)) {
	        $this->error('mall_category/add','', $error);
	    }
	    $postData = $this->input->post();
	    $data['cat_name'] = $postData['cat_name'];
	    $data['parent_id'] = $postData['parent_id'];
	    $data['cat_type'] = $postData['parent_id'] ? 2 : 1;
	    if ($postData['parent_id']) {
	        $data['cat_type'] = 2;
	        $first_cat = $this->mall_category->findByParams(array('cat_id'=>$postData['parent_id']))->row();
	        $data['full_name'] = $first_cat->cat_name.'>'.$postData['cat_name'];
	    } else {
	        $data['cat_type'] = 1;
	        $data['full_name'] = $postData['cat_name'];
	    }
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
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error)) {
            $this->error('mall_category/edit', $this->input->post('cat_id'), $error);
        }
        $postData = $this->input->post();
        $data['cat_name'] = $postData['cat_name'];
	    $data['is_show'] = $postData['is_show'];
	    $data['sort_order'] = $postData['sort_order'];
	    $data['filter_attr'] = toNumStr($postData['filter_attr']);
	    if ( !empty($postData['keyword']) ) {
	    	$data['keyword'] = $postData['keyword'];
	    }
        $res = $this->mall_category->update(array('cat_id'=>$postData['cat_id']), $data); 
        if ($res) {
            $this->success('mall_category/grid', '', '修改成功！');
        } else {
            $this->error('mall_category/edit', $this->input->post('cat_id'), '修改失败！');
        }
	}
	
	/**
	 * 根据ajax反馈的父id，返回所有子集 （json格式）
	 */
	public function select_children($parent_id=0)
	{
		$childrenData = array();
		if ($parent_id) {
			$childrenData = $this->mall_category->getCategoryLevel($parent_id);
		}
		echo json_encode($childrenData);exit;
	}
	
	public function delete($cat_id)
	{
	    $chlid_num = $this->mall_category->findByParams(array('parent_id'=>$cat_id))->num_rows();
	    if ($chlid_num > 0) {
	        $this->error('mall_category/grid', '', '此分类下还有子类，不能删除！');
	    } else {
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
        if ($this->validateParam($this->input->post('cat_name'))) {
            $error[] = '分类名称不能为空';
        }
	    return $error;
	}
}
