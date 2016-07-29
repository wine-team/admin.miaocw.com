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
		$goods_json = $this->input->post('goods_json');
		$postData = $this->input->post();
		if ($this->validateParam($postData['cat_name'])) {
			$this->error('mall_category/grid', array('cat_id'=>$cat_id), '分类名称不能为空');
		}
		if ($this->validateParam($postData['full_name'])) {
			$this->error('mall_category/grid', array('cat_id'=>$cat_id), '分类导航不能为空');
		}

		if (!empty($_FILES['cat_img']['name'])) {
			$imageData = $this->dealWithImages('cat_img', $this->input->post('oldfilename'), 'mall');
			if ($imageData == false) {
				$this->error('mall_category/grid', array('cat_id'=>$cat_id), '图片上传失败！');
			}

			$ifResize = $this->dealWithImagesResize($imageData, 360, 360);
			if ($ifResize == false) {
				$this->error('mall_category/grid', array('cat_id'=>$cat_id), '360x360的缩略图生成失败！');
			}

			$ifResize = $this->dealWithImagesResize($imageData, 60, 60);
			if ($ifResize == false) {
				$this->error('mall_category/grid', array('cat_id'=>$cat_id), '60x60的缩略图生成失败！');
			}

			$postData['cat_img'] = $imageData['file_name'];
		}

		$this->db->trans_start();
		if ($cat_id) { //编辑
			$update = $this->mall_category->update($postData);
			$delete = $this->mall_category_product->deleteByCategoryId($cat_id);
		} else {
			$cat_id = $this->mall_category->insert($postData);
		}

		$goodsArr = json_decode($goods_json, TRUE);
		foreach ($goodsArr as $key=>$value) {
			if ($value === NULL) {
				unset($goodsArr[$key]);
			}
		}
		if (!empty($goodsArr)) {
			$insert = $this->mall_category_product->insertBatchByCategory($cat_id, $goodsArr);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE) {
	        $this->success('mall_category/grid', array('cat_id'=>$cat_id), '保存成功！');
	    } else {
	        $this->error('mall_category/grid', array('cat_id'=>$cat_id), '保存失败！');
	    }
	}
	
	public function delete($cat_id)
	{
	    $chlidCat = $this->mall_category->findByParams(array('parent_id'=>$cat_id));
	    if ($chlidCat->num_rows() > 0) {
	        $this->error('mall_category/grid', array('cat_id'=>$cat_id), '此分类下还有子类，不能删除！');
	    } else {
			$this->db->trans_start();
	        $is_delete = $this->mall_category->delete(array('cat_id'=>$cat_id));
			$delete = $this->mall_category_product->deleteByCategoryId($cat_id);
			$this->db->trans_complete();

			if ($this->db->trans_status() === TRUE && $is_delete) {
	            $this->success('mall_category/grid', '', '删除成功！');
	        } else {
	            $this->error('mall_category/grid', '', '删除失败！');
	        }
	    }
	}
}
