<?php 
class Mall_goods extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_goods_base_model', 'mall_goods_base');
        $this->load->model('mall_attribute_set_model','mall_attribute_set');
        $this->load->model('mall_brand_model','mall_brand');
        $this->load->model('mall_category_model', 'mall_category');
        $this->load->model('region_model', 'region');
        $this->load->model('mall_freight_tpl_model','mall_freight_tpl');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('mall_goods/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_goods/grid');
        $config['total_rows'] = $this->mall_goods_base->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['mall_goods'] = $this->mall_goods_base->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['is_on_sale'] = array('1' => '上架', '2' => '下架');
        $data['is_check'] = array('1' => '待审核', '2' => '审核通过', '3' => '审核拒绝');
        $data['pg_now'] = $pg;
        $this->load->view('mallgoods/grid', $data);
    }
    
     /**
     *添加的第一步
     */
    public function addstep1()
    {
    	$data['extension'] = array('simple'=>'简单产品','virtual'=>'虚拟产品','giftcard'=>'礼品卡');
    	$data['attribute'] = $this->mall_attribute_set->findByReason(array('enabled'=>1));
    	$this->load->view('mallgoods/addstep1',$data);
    }
    
    
    public function addstep2()
    {
    	$extension_code = $this->input->get('extension_code');
    	$attr_set_id = $this->input->get('attr_set_id');
    	if (empty($extension_code) || empty($attr_set_id)) {
    		$this->error('mall_goods/addstep1', '', '请选择完整商品的类别和类型');
    	}
    	$data['brand'] = $this->mall_brand->findById(array('is_show'=>1));//品牌信息
    	$data['extension'] = array('simple'=>'简单产品','virtual'=>'虚拟产品','giftcard'=>'礼品卡');
    	$this->load->view('mallgoods/addstep2', $data);
    }
    
    /**
     * 设置产品上下架
     * @param unknown $goods_id
     * @param unknown $status
     * @param unknown $pageNow
     */
    public function setIsOnSaleStatus($goods_id, $status, $pageNow)
    {
    	switch ($status) {
    		case '1': $isOnSale = '2'; break;
    		case '2': $isOnSale = '1'; break;
    		default : $isOnSale = '1'; break;
    	}
    	$param['is_on_sale'] = $isOnSale;
    	$this->db->trans_start();
    	$result = $this->mall_goods_base->updateByGoodsId($goods_id,$param);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === TRUE) {
    		$this->success('mall_goods/grid/'.$pageNow, $this->input->get(), '操作成功！');
    	} else {
    		$this->error('mall_goods/grid/'.$pageNow, $this->input->get(), '操作失败！');
    	}
    }
    
    /**
     * 设置产品审核状态
     * @param unknown $goods_attr_id
     * @param unknown $status
     * @param unknown $pageNow
     */
    public function setIsCheckStatus($goods_id, $status, $pageNow)
    {
    	switch ($status) {
    		case '1': $isCheck = '2'; break;
    		case '2': $isCheck = '3'; break;
    		default : $isCheck = '1'; break;
    	}
    	$param['is_check'] = $isCheck;
    	$this->db->trans_start();
    	$result = $this->mall_goods_base->updateByGoodsId($goods_id, $param);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === TRUE) {
    		$this->success('mall_goods/grid/'.$pageNow, $this->input->get(), '操作成功！');
    	} else {
    		$this->error('mall_goods/grid/'.$pageNow, $this->input->get(), '操作失败！');
    	}
    }
    
     /**
     * ajax的添加
     */
    public function ajaxValidate()
    {
    	$error = $this->validate();
    	if (!empty($error)) {
    		$this->jsen($error);
    	}
    	if ($this->input->post('goods_id')) {
    		$this->editPost();
    	} else {
    		$this->addPost();
    	}
    }
    /**
     * 添加
     */
    public function addPost()
    {
    	$this->db->trans_begin();
    	$goods_id = $this->mall_goods_base->insertMallGoods($this->input->post()); 
    	if (!$goods_id && $this->db->trans_status() === FALSE) {
    		$this->db->trans_rollback();
    		$this->jsen('保存失败！');
    	} else {
    		$this->db->trans_commit();
    		$this->session->set_flashdata('success', '保存成功!');
    		$this->jsen(base_url('mall_goods/grid'), TRUE);
    	}exit;
    }
    
     /**
     * 编辑
     * @param unknown $goods_id
     */
    public function edit($goods_id){
    	
    	$result = $this->mall_goods_base->getInfoByGoodsId($goods_id);
    	if ($result->num_rows() <= 0) {
    		$this->error('mall_goods/grid', '', '找不到产品相关信息！');
    	}
    	$data['mallgoods'] = $result->row();
    	$data['province_id'] = $data['mallgoods']->province_id;
    	$data['city_id'] = $data['mallgoods']->city_id;
    	$data['district_id'] = $data['mallgoods']->district_id;
    	$data['brand'] = $this->mall_brand->findById(array('is_show'=>1));//品牌信息
    	$data['extension'] = array('simple'=>'简单产品','virtual'=>'虚拟产品','giftcard'=>'礼品卡');
    	$data['attribute'] = $this->mall_attribute_set->findByReason(array('enabled'=>1));
    	$data['freight'] = $this->mall_freight_tpl->getTransport($data['mallgoods']->supplier_id);
    	$this->load->view('mallgoods/edit',$data);
    }
    
    public function editPost()
    {
    	$goods_id = $this->input->post('goods_id');
    	$this->db->trans_begin();
    	$updateGoods = $this->mall_goods_base->updateMallGoodsBase($this->input->post(),$goods_id);
    	if (!$updateGoods && $this->db->trans_status() === FALSE) {
    		$this->db->trans_rollback();
    		$this->jsen('保存失败！');
    	} else {
    		$this->db->trans_complete();
    		$this->session->set_flashdata('success', '保存成功!');
    		$this->jsen(base_url('mall_goods/grid'), TRUE);
    	}
    	exit;
    }
    
    
    
    private function jsen($error, $flag = false)
    {
    	echo json_encode(array(
    			'status'   => $flag,
    			'messages' => $error
    	));
    	exit;
    }
    
     /**
     * 
     * @return multitype:string
     */
    public function validate()
    {
    	$error = array();
    	if ($this->validateParam($this->input->post('goods_name'))) {
    		$error[] = '商品名称不可为空！';
    	}
    	if ($this->validateParam($this->input->post('goods_sku'))) {
    		$error[] = '商品编号不可为空！';
    	}
    	if ($this->validateParam($this->input->post('goods_brief'))) {
    		$error[] = '商品简介不可为空！';
    	}
    	if ($this->validateParam($this->input->post('goods_desc'))) {
    		$error[] = 'pc商品详情不可为空！';
    	}
    	if ($this->validateParam($this->input->post('wap_goods_desc'))) {
    		$error[] = 'wap商品详情不可为空！';
    	}
    	if ($this->validateParam($this->input->post('supplier_id'))) {
    		$error[] = '供应商必须填写';
    	}
    	if ($this->input->post('goods_weight') < 0) {
    		$error[] = '商品重量必须大于等于0';
    	}
    	if ($this->input->post('market_price') < 0) {
    		$error[] = '市场价格必须大于等于0。';
    	}
    	if ($this->input->post('shop_price') < 0) {
    		$error[] = '供应价格必须大于等于0.';
    	}
    	if ($this->input->post('promote_price') < 0) {
    		$error[] = '促销价必须大于等于0。';
    	}
    	if ($this->input->post('in_stock') <= 0) {
    		$error[] = '库存必须大于0.';
    	}
    	//验证运费模版
    	if ($this->input->post('transport_type') == 1) {
    		if (!$this->input->post('freight_id')) {
    			$error[] = '运费模版不可不填。';
    		}
    	}
    	//验证运费模版
    	if ($this->input->post('transport_type') == 2) {
    		if (!$this->input->post('freight_cost') || $this->input->post('freight_cost')<0) {
    			$error[] = '自定义运费不能小于0';
    		}
    	}
    	//地区
    	$regionids = array($this->input->post('province_id'), $this->input->post('city_id'), $this->input->post('district_id'));
    	$region = $this->region->getByRegionIds($regionids);
    	if ($region->num_rows() < 3) {
    		$error[] = '城市地区请填写完整。';
    	}
    	$regionNames = array();
    	foreach ($region->result() as $item) {
    		$regionNames[] = $item->region_name;
    	}
    	$_POST['address'] = $regionNames[0] .' '.$regionNames[1].' '.$regionNames[2].' '.($this->input->post('address') ? $this->input->post('address') : '　');
    	return $error;
    }
}