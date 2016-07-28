<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_category extends CS_Controller
{
	public function _init()
	{
		$this->load->helper(array('dictionary', 'common'));
	    $this->load->library('pagination');
	    $this->load->model('mall_category_model','mall_category');
		$this->load->model('cms_block_model','cms_block');
		$this->load->model('mall_category_product_model','mall_category_product');
	}

	public function grid()
	{
		$cat_id = $this->input->get('cat_id');
		$data['categorys'] = $this->mall_category->findByCategoryTree();
		if ($cat_id) {
			$result = $this->mall_category->findById($cat_id);
			if ($result->num_rows() > 0) {
				$data['mallCategory'] = $result->row(0);
			}
		}
		$data['cmsBlock'] = $this->cms_block->findByParams();
		$this->load->view('mall_category/grid', $data);
	}
	
	public function savePost()
	{
		$cat_id = $this->input->post('cat_id');
		$postData = $this->input->post();
		if ($this->validateParam($postData['cat_name'])) {
			$this->error('mall_category/grid', $cat_id, '分类名称不能为空');
		}
		if ($this->validateParam($postData['full_name'])) {
			$this->error('mall_category/grid', $cat_id, '类名全名不能为空');
		}
		$this->db->trans_start();
		if ($cat_id) { //编辑
			$new_cat_id = $this->mall_category->insert($postData);
		} else {
			$update = $this->mall_category->update($postData);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
	        $this->success('mall_category/grid', $new_cat_id, '新增成功！');
	    } else {
	        $this->error('mall_category/grid', $cat_id, '新增失败！');
	    }
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
