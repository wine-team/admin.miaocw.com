<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_goods_related extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_goods_related_model','mall_goods_related');
	    $this->load->model('mall_goods_type_model','mall_goods_type');
	}
	
	public function grid($goods_id = 0)
	{
	    $res = $this->mall_goods_related->findOrWhere($goods_id);
	    $data['goods_id'] = $goods_id;
	    $data['res'] = $res;
	    $this->load->view('mall_goods_related/grid', $data);
	}

	public function add($goods_id)  //暂未完成
	{
	    $data['goods_id'] = $goods_id;
	    $this->load->view('mall_goods_related/add', $data);
	}
	
	public function addPost()
	{
	    $postData = $this->input->post(); 
	    $data['goods_id'] = $postData['goods_id'];
	    $data['related_goods_id'] = $postData['related_goods_id'];
	    $data['is_double'] = $postData['is_double'];
	    $res = $this->mall_goods_related->insert($data);
	    if ($res) {
	        $this->success('mall_goods_related/grid', $this->input->post('goods_id'), '新增成功！');
	    } else {
	        $this->error('mall_goods_related/add', $this->input->post('goods_id'), '新增失败！');
	    }
	}
	
	public function delete($related_id)
	{
        $is_delete = $this->mall_goods_related->delete(array('related_id'=>$related_id));
        if ($is_delete) {
            $this->success('mall_goods_related/grid', $this->input->get('goods_id'), '删除成功！');
        } else {
            $this->error('mall_goods_related/grid', $this->input->get('goods_id'), '删除失败！');
        }
	    
	}
	
	
}
/** End of file Mall_goods_related.php */
/** Location: ./application/controllers/Mall_goods_related.php */
