<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_goods_related extends CS_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_goods_related_model','mall_goods_related');
		$this->load->model('mall_goods_base_model','mall_goods_base');
	}
	
	
	public function grid($pg=1)
	{
		$page_num = 20;
		$num = ($pg-1)*$page_num;
		$config['first_url'] = base_url('mall_goods_related/grid').$this->pageGetParam($this->input->get());
		$config['suffix'] = $this->pageGetParam($this->input->get());
		$config['base_url'] = base_url('account_log/grid');
		$config['total_rows'] = $this->mall_goods_related->total($this->input->get());
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['pg_link'] = $this->pagination->create_links();
		$data['goods_related'] = $this->mall_goods_related->page_list($page_num, $num, $this->input->get());
		$data['all_rows'] = $config['total_rows'];
		$data['pg_now'] = $pg;
	    $this->load->view('mall_goods_related/grid', $data);
	}

	public function add()  //暂未完成
	{
	    $this->load->view('mall_goods_related/add');
	}
	
	
	
	public function addPost()
	{
	    $postData = $this->input->post(); 
	    $error = $this->validate($postData);
	    if(!empty($error)){
	    	$this->error('mall_goods_related/add','', '必填的项目加值');
	    }
	    $goods_id = $postData['goods_id'];
	    $relatedGoodsArray = array_filter(explode(',', str_replace('，',',',$postData['related_goods_id'])));
	    $is_double = $postData['is_double'];
	    $res = $this->mall_goods_related->insertBatch($relatedGoodsArray,$is_double,$goods_id);
	    if ($res) {
	        $this->success('mall_goods_related/grid', $this->input->post('goods_id'), '新增成功！');
	    } else {
	        $this->error('mall_goods_related/add', $this->input->post('goods_id'), '新增失败！');
	    }
	}
	
	public function edit($related_id){
		
		$result = $this->mall_goods_related->findById(array('related_id'=>$related_id));
		if ($result->num_rows()<=0) {
			$this->error('mall_goods_related/grid','', '没有找到该Id值');
		}
		$data['goods_related'] = $result->row(0);
		$this->load->view('mall_goods_related/edit',$data);
	}
	
	public function editPost()
	{
		$postData = $this->input->post();
		$param['goods_id'] = $postData['goods_id'];
		$param['related_goods_id'] = $postData['related_goods_id'];
		$param['is_double'] = $postData['is_double'];
		$res = $this->mall_goods_related->update(array('related_id'=>$postData['related_id']),$param);
		if ($res) {
			$this->success('mall_goods_related/grid',array('goods_id'=>$param['goods_id']),'编辑成功！');
		} else {
			$this->error('mall_goods_related/edit/'.$postData['related_id'],'', '编辑失败！');
		}
	}
	
	public function delete($related_id)
	{
        $is_delete = $this->mall_goods_related->delete(array('related_id'=>$related_id));
        if ($is_delete) {
            $this->success('mall_goods_related/grid', array('goods_id'=>$this->input->get('goods_id')), '删除成功！');
        } else {
            $this->error('mall_goods_related/grid', array('goods_id'=>$this->input->get('goods_id')), '删除失败！');
        }
	}
	
	 /**
	 * 产品的验证
	 * @param unknown $param
	 */
	public function validate($param){
		
		$error = array();
		if($this->validateParam($param['goods_id'])){
			$error[] = 'goods_id必填';
		}
		if($this->validateParam($param['related_goods_id'])){
			$error[] = 'related_goods_id必填';
		}
		return $error;
	}


	/**
	 * ajax 翻页函数部分。
	 * @param number $pg
	 */
	public function ajaxGet($pg = 1)
	{
		$getData = $this->input->get();
		$page_num = 20;
		$num = ($pg-1)*$page_num;
		$config['first_url'] = base_url('mall_goods_related/ajaxGet').$this->pageGetParam($this->input->get());
		$config['suffix'] = $this->pageGetParam($this->input->get());
		$config['base_url'] = base_url('mall_goods_related/ajaxGet');
		$goodsInfo = $this->mall_goods_related->findByGoodsId($this->input->get('current_goods_id'), true);
		if (!empty($goodsInfo) && $this->input->get('join') != '') {
			$getData['goods_ids'] = array_keys($goodsInfo);
		}
		$config['total_rows'] = $this->mall_goods_base->total($getData);
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['pg_link']   = $this->pagination->create_links();
		$data['page_list'] = $this->mall_goods_base->page_list($page_num, $num, $getData);
		$data['all_rows']  = $config['total_rows'];
		$data['pg_now']    = $pg;
		$data['page_num']  = $page_num;
		$data['goodsInfo'] = $goodsInfo;

		echo json_encode(array(
			'status' => true,
			'html'   => $this->load->view('mall_goods_related/ajaxGoodsRelated/ajaxData', $data, true),
			'json'   => json_encode($goodsInfo),
		));exit;
	}
}
