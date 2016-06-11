<?php 
class Mall_goods_base extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_goods_base_model', 'mall_goods_base');
        $this->load->model('mall_attribute_set_model','mall_attribute_set');
        $this->load->model('mall_brand_model','mall_brand');
        $this->load->model('mall_category_model', 'mall_category');
        $this->load->model('mall_category_product_model','mall_category_product');
        $this->load->model('region_model', 'region');
        $this->load->model('mall_freight_tpl_model','mall_freight_tpl');
        $this->load->model('mall_attribute_group_model','mall_attribute_group');
        $this->load->model('mall_attribute_value_model','mall_attribute_value');
        $this->load->model('mall_goods_attr_value_model','mall_goods_attr_value');
        $this->load->model('mall_goods_attr_spec_model','mall_goods_attr_spec');
        $this->load->model('mall_goods_related_model','mall_goods_related');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('mall_goods_base/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_goods_base/grid');
        $config['total_rows'] = $this->mall_goods_base->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->mall_goods_base->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
		$data['pg_now'] = $pg;
		$data['page_num'] = $page_num;
		$data['attribute_set'] = $this->mall_attribute_set->find(true);
		$data['is_on_sale'] = array('1' => '上架', '2' => '下架');
        $data['is_check'] = array('1' => '待审核', '2' => '审核通过', '3' => '审核拒绝');
		$data['extension'] = array('simple'=>'简单产品', 'grouped'=>'组合产品', 'configurable'=>'可配置产品', 'virtual'=>'虚拟产品', 'bundle'=>'捆绑产品', 'giftcard'=>'礼品卡');
        $this->load->view('mall_goods_base/grid', $data);
    }
    
     /**
     *添加的第一步
     */
    public function addstep1()
    {
		$data['extension'] = array('simple'=>'简单产品', 'grouped'=>'组合产品', 'configurable'=>'可配置产品', 'virtual'=>'虚拟产品', 'bundle'=>'捆绑产品', 'giftcard'=>'礼品卡');
    	$data['attribute'] = $this->mall_attribute_set->findByReason(array('enabled'=>1));
    	$this->load->view('mall_goods_base/addstep1',$data);
    }
    
    
    public function addstep2()
    {
    	$extension_code = $this->input->get('extension_code');
    	$attr_set_id = $this->input->get('attr_set_id');
    	if (empty($extension_code) || empty($attr_set_id)) {
    		$this->error('mall_goods_base/addstep1', '', '请选择完整商品的类别和类型');
    	}
    	$data['attr_set_id'] = $attr_set_id;
    	$data['brand'] = $this->mall_brand->findById(array('is_show'=>1));//品牌信息
		$data['extension'] = array('simple'=>'简单产品', 'grouped'=>'组合产品', 'configurable'=>'可配置产品', 'virtual'=>'虚拟产品', 'bundle'=>'捆绑产品', 'giftcard'=>'礼品卡');
    	$data['attribute_group'] = $this->mall_attribute_group->findByAttrSetId($attr_set_id);
    	$this->load->view('mall_goods_base/addstep2', $data);
    }
    
    /**
     * 设置产品上下架
     * @param unknown $goods_id
     * @param unknown $status
     */
    public function setIsOnSaleStatus()
    {
		$goods_id = $this->input->post('goods_id');
		$status = $this->input->post('flag');
    	switch ($status) {
    		case '1': $isOnSale = '2'; break;
    		case '2': $isOnSale = '1'; break;
    		default : $isOnSale = '1'; break;
    	}
    	$this->db->trans_start();
		$isUpdate = $this->mall_goods_base->updateByGoodsId($goods_id, array('is_on_sale'=>$isOnSale));
    	$this->db->trans_complete();
<<<<<<< HEAD:application/controllers/mall_goods_base.php
    	if ($this->db->trans_status() === TRUE) {
    		$this->success('mall_goods_base/grid/'.$pageNow, $this->input->get(), '操作成功！');
    	} else {
    		$this->error('mall_goods_base/grid/'.$pageNow, $this->input->get(), '操作失败！');
    	}
=======
		if ($this->db->trans_status() === TRUE && $isUpdate) {
			echo json_encode(array(
				'flag' => $isOnSale,
			));
		} else {
			echo json_encode(array(
				'flag' => 3,
			));
		}
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c:application/controllers/mall_goods_base.php
    }
    
    /**
     * 设置产品审核状态
     * @param unknown $goods_id
     * @param unknown $status
     */
    public function setIsCheckStatus()
    {
		$goods_id = $this->input->post('goods_id');
		$status = $this->input->post('flag');
    	switch ($status) {
    		case '1': $isCheck = '2'; break;
    		case '2': $isCheck = '3'; break;
    		default : $isCheck = '1'; break;
    	}
    	$this->db->trans_start();
		$isUpdate = $this->mall_goods_base->updateByGoodsId($goods_id, array('is_check'=>$isCheck));
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === TRUE) {
<<<<<<< HEAD:application/controllers/mall_goods_base.php
    		$this->success('mall_goods_base/grid/'.$pageNow, $this->input->get(), '操作成功！');
    	} else {
    		$this->error('mall_goods_base/grid/'.$pageNow, $this->input->get(), '操作失败！');
=======
    		echo json_encode(array(
				'status' => true,
			));
    	} else {
			echo json_encode(array(
				'status' => false,
			));
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c:application/controllers/mall_goods_base.php
    	}
		exit;
    }
    
     /**
     * ajax的添加
     */
    public function ajaxValidate()
    {
    	$error = $this->validate();
    	if (!empty($error)) {
    		$this->jsonMessage($error);
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
    	$param = $this->input->post();
    	
    	$param['category_id'] = $this->getCategoryId($param);
    	$this->db->trans_begin();
    	$goods_id = $this->mall_goods_base->insertMallGoods($param);
    	$result = $this->mall_category_product->insert($goods_id,$param['category_id']);
    	$relatedResult = true;
    	if (!empty($param['related_goods_id'])) {
    		$relatedGoodsArray = array_filter(explode(',', str_replace('，',',',$param['related_goods_id'])));
    		$relatedResult = $this->mall_goods_related->insertBatch($relatedGoodsArray,$is_double=1,$goods_id);
    	}
    	if (isset($param['attr'][1])) {
    	    $goodsAttrResult = $this->mall_goods_attr_value->insertBatch($goods_id,$param['attr'][1]);
    	}
    	if (isset($param['attr'][2]) && isset($param['price'][2]) && isset($param['attrNum'][2]) && isset($param['attrStock'][2])) {
    	    $this->mall_goods_attr_spec->insertBatch($goods_id,$param['attr'][2], $param['price'][2], $param['attrNum'][2], $param['attrStock'][2]);
<<<<<<< HEAD:application/controllers/mall_goods_base.php
    	} 
=======
    	}
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c:application/controllers/mall_goods_base.php
    	if (!$goods_id && !$result && !$relatedResult && $this->db->trans_status() === FALSE) {
    		$this->db->trans_rollback();
    		$this->jsen('保存失败！');
    	} else {
    		$this->db->trans_commit();
    		$this->session->set_flashdata('success', '保存成功!');
    		$this->jsen(base_url('mall_goods_base/grid'), TRUE);
<<<<<<< HEAD:application/controllers/mall_goods_base.php
    	}exit;
=======
    	}
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c:application/controllers/mall_goods_base.php
    }
    
    
     /**
     * 分类名称
     * @param unknown $param
     */
    public function getCategoryId($param)
	{
    	if( !empty($param['category_id'])){
    		return $param['category_id'];
    	}
    	if( !empty($param['class_c']) ){
    		return $param['class_c'];
    	}
    	if( !empty($param['class_b']) && empty($param['class_c'])){
    		return $param['class_b'];
    	}
    	if( !empty($param['class_a']) && empty($param['class_b']) && empty($param['class_c'])){
    		return $param['class_a'];
    	}
    }
    
     /**
     * 编辑
     * @param unknown $goods_id
     */
    public function edit($goods_id)
	{
    	$result = $this->mall_goods_base->getInfoByGoodsId($goods_id);
    	if ($result->num_rows() <= 0) {
    		$this->error('mall_goods_base/grid', '', '找不到产品相关信息！');
    	}
    	$attr_set_id = $this->input->get('attr_set_id');
    	$data['mallgoods'] = $result->row();
    	$data['province_id'] = $data['mallgoods']->province_id;
    	$data['city_id'] = $data['mallgoods']->city_id;
    	$data['district_id'] = $data['mallgoods']->district_id;
    	$data['brand'] = $this->mall_brand->findById(array('is_show'=>1));//品牌信息
		$data['extension'] = array('simple'=>'简单产品', 'grouped'=>'组合产品', 'configurable'=>'可配置产品', 'virtual'=>'虚拟产品', 'bundle'=>'捆绑产品', 'giftcard'=>'礼品卡');
    	$data['attribute'] = $this->mall_attribute_set->findByReason(array('enabled'=>1));
    	$data['freight'] = $this->mall_freight_tpl->getTransport($data['mallgoods']->supplier_id);
    	$data['attribute_group'] = $this->mall_attribute_group->findByAttrSetId($attr_set_id);
    	
    	$data['attr_value'] = $this->mall_goods_attr_value->findById(array('goods_id'=>$goods_id))->result();
    	$data['attr_spec'] = $this->mall_goods_attr_spec->findById(array('goods_id'=>$goods_id))->result();
    	$attr_spec_ids = array();
    	foreach ($data['attr_spec'] as $spec) {
    	    $attr_spec_ids[] = $spec->attr_spec_id;
    	}
    	$attr_price = array();
    	if (!empty($attr_spec_ids)) {
    	    $attr_price = $this->mall_goods_attr_spec->getPriceWhereIn('attr_spec_id', $attr_spec_ids)->result();
    	}
<<<<<<< HEAD:application/controllers/mall_goods_base.php
    	$data['attr_price'] = $attr_price;    
=======
    	$data['attr_price'] = $attr_price;   
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c:application/controllers/mall_goods_base.php
    	$this->load->view('mall_goods_base/edit',$data);
    }
    
    public function editPost()
    {
    	$goods_id = $this->input->post('goods_id');
    	$param = $this->input->post();
    	$this->db->trans_begin();
    	$updateGoods = $this->mall_goods_base->updateMallGoodsBase($this->input->post(),$goods_id);

    	if (isset($param['attr'][1])) {
    	    $goodsAttrResult = $this->mall_goods_attr_value->updateAttrBatch($param['attr'][1]); 
    	}
    	if (isset($param['attr'][2]) && isset($param['price'][2]) && isset($param['attrNum'][2]) && isset($param['attrStock'][2])) {
    	    $this->mall_goods_attr_spec->updatePriceBatch($param['price'][2], $param['attrNum'][2], $param['attrStock'][2]);
    	}

    	if (!$updateGoods && $this->db->trans_status() === FALSE) {
    		$this->db->trans_rollback();
    		$this->jsonMessage('保存失败！');
    	} else {
    		$this->db->trans_complete();
    		$this->session->set_flashdata('success', '保存成功!');
<<<<<<< HEAD:application/controllers/mall_goods_base.php
    		$this->jsen(base_url('mall_goods_base/grid'), TRUE);
=======
    		$this->jsonMessage('', base_url('mall_goods_base/grid'));
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c:application/controllers/mall_goods_base.php
    	}
    	exit;
    }
    
     /**
     * 商品多图显示
     * author laona
     **/
    public function images($goods_id)
    {
    	$result = $this->mall_goods_base->getInfoByGoodsId($goods_id);
    	if ($result->num_rows() <= 0) {
    		$this->error('mall_goods_base/grid', '', '找不到产品相关信息！');
    	}
    	$mallgoods = $result->row();
    	$data['mallgoods'] = $mallgoods;
    	$pics = $mallgoods->goods_img;
    	if (!empty($pics)) {
    		$goods_img = array_filter(explode('|', $pics));
    	} else {
    		$goods_img = array();
    	}
    	$data['goods_img'] = $goods_img;
    	$data['goods_id'] = $goods_id;
    	$this->load->view('mall_goods_base/images', $data);
    }
    
    /**
     * 商品多图保存
     * author laona
     */
    public function saveImages()
    {
    	if (!$this->input->post('goods_id')) {
    		$this->error('mall_goods_base/grid', '', '内部错误！');
    	}
    	$goods_id = (int)$this->input->post('goods_id');
    	if (empty($_FILES['goods_img']['name'])) {
    		$this->error('mall_goods_base/images', $goods_id, '请选择图片上传！');
    	}
    	$imageData = $this->dealWithImages('goods_img', '', 'mall');
    	if ($imageData == false) {
    		$this->error('mall_goods_base/images', $goods_id, '图片上传失败！');
    	}
    	$ifResize = $this->dealWithImagesResize($imageData, '360', '360');
    	if ($ifResize == false) {
    		$this->error('mall_goods_base/images', $goods_id, '缩略图生成失败！');
    	}
    	$params['goods_id'] = $goods_id;
    	$params['goods_img'] = $this->input->post('pics').$imageData['file_name'].'|';
    	$this->db->trans_start();
    	$resultId = $this->mall_goods_base->insertImage($params);
    	$this->db->trans_complete();
    	if (!$resultId) {
    		$this->error('mall_goods_base/images', $goods_id, '数据保存失败！');
    	}
    	$this->success('mall_goods_base/images', $goods_id, '数据保存成功！');
    }
    
    public function deleteImage()
	{
    	$goods_id = $this->input->get('goods_id');
    	$image_name = $this->input->get('image_name');
    	if (empty($goods_id)) {
    		$this->error('mall_goods_base/grid', '', '内部错误！');
    	}
    	$result = $this->mall_goods_base->getInfoByGoodsId($goods_id);
    	if ($result->num_rows() <= 0) {
    		$this->error('mall_goods_base/grid', '', '找不到产品相关信息！');
    	}
    	$mallgoods = $result->row();
    	$pics = trim($mallgoods->goods_img, '|');
    	$params['goods_id'] = $goods_id;
    	$params['goods_img'] = str_replace($image_name.'|', '', $mallgoods->goods_img);
    	$resultId = $this->mall_goods_base->insertImage($params);
    	$this->deleteOldfileName($image_name, 'mall');
    	if (!$resultId) {
    		$this->error('mall_goods_base/images', $goods_id, '删除失败');
    	}
    	$this->success('mall_goods_base/images', $goods_id, '删除成功！');
    }
    
    /**
     * 设为主图
     * @param unknown $siid
     */
    public function mainImage()
    {
    	$goods_id = $this->input->get('goods_id');
    	$result = $this->mall_goods_base->getInfoByGoodsId($goods_id);
    	if ($result->num_rows() <= 0) {
    		$this->error('mall_goods_base/grid', '', '找不到产品相关信息！');
    	}
    	$mall_goods = $result->row();
    	$image_name = $this->input->get('image_name');
    	$pics = str_replace($image_name.'|', '', $mall_goods->goods_img);
    	$params['goods_img'] = $image_name.'|'.$pics;
    	$params['goods_id'] = $goods_id;
    	$resultId = $this->mall_goods_base->insertImage($params);
    	if (!$resultId) {
    		$this->error('mall_goods_base/images', $goods_id, '删除失败');
    	}
    	$this->success('mall_goods_base/images', $goods_id, '删除成功！');
    }
    
    /**
     * 
     * @param unknown $goods_id
     */
    public function copy($goods_id)
	{
    	$result = $this->mall_goods_base->getInfoByGoodsId($goods_id);
    	if ($result->num_rows() <= 0) {
    		$this->error('mall_goods_base/grid', '', '找不到产品相关信息！');
    	}
    	$data['mallgoods'] = $result->row();
    	$data['province_id'] = $data['mallgoods']->province_id;
    	$data['city_id'] = $data['mallgoods']->city_id;
    	$data['district_id'] = $data['mallgoods']->district_id;
    	$data['brand'] = $this->mall_brand->findById(array('is_show'=>1));//品牌信息
		$data['extension'] = array('simple'=>'简单产品', 'grouped'=>'组合产品', 'configurable'=>'可配置产品', 'virtual'=>'虚拟产品', 'bundle'=>'捆绑产品', 'giftcard'=>'礼品卡');
    	$data['attribute'] = $this->mall_attribute_set->findByReason(array('enabled'=>1));
    	$data['freight'] = $this->mall_freight_tpl->getTransport($data['mallgoods']->supplier_id);
    	$this->load->view('mall_goods_base/copy',$data);
    }
    
    public function delete($goods_id)
	{
    	$this->db->trans_begin();
    	$status = $this->mall_goods_base->deleteById($goods_id);
    	$result = $this->mall_category_product->deleteByGoodsId($goods_id);
    	if ($status && $result && ($this->db->trans_status() === TRUE)) {
    		$this->db->trans_complete();
    		$this->success('mall_goods_base/grid', '', '删除成功');
<<<<<<< HEAD:application/controllers/mall_goods_base.php
    	}else{
=======
    	} else {
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c:application/controllers/mall_goods_base.php
    		$this->db->trans_rollback();
    		$this->error('mall_goods_base/grid', '', '删除失败');
    	}
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
    	//验证属性
    	if (!$this->input->post('goods_id')) {
    	    $attr_value = $this->mall_attribute_value->findById(array('attr_set_id'=>$this->input->post('attribute_set_id'), 'values_required'=>1))->result();
    	    $post_attr = $this->input->post('attr');
    	    $require_ids = array();
    	    foreach ($post_attr as $k1=>$v1) {
    	        foreach ($v1 as $k2=>$v2) {
    	            foreach ($v2 as $k3=>$v3) {
    	                $require_ids[] = $k3;
    	            }
    	        }
    	    }
    	    foreach ($attr_value as $a) {
    	        if (!in_array($a->attr_value_id,$require_ids)) {
    	            $error[] = '请选择属性：'.$a->attr_name;
    	        }
    	    }
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
    
    /**
     * 获取
     * @param number $pg
     */
    public function ajaxGetMallGoods($pg=1)
	{
    	$page_num = 15;
    	$num = ($pg-1)*$page_num;
    	$config['per_page'] = 15;
    	$config['first_url'] = base_url('mall_goods_base/ajaxGetMallGoods').$this->pageGetParam($this->input->get());
    	$config['suffix'] = $this->pageGetParam($this->input->get());
    	$config['base_url'] = base_url('mall_goods_base/ajaxGetMallGoods');
    	$config['total_rows'] = $this->mall_goods_base->total($this->input->get());
    	$config['uri_segment'] = 3;
    	$this->pagination->initialize($config);
    	$data['pg_list']   = $this->pagination->create_links();
    	$data['page_list'] = $this->mall_goods_base->page_list($page_num, $num, $this->input->get());
    	$data['all_rows']  = $config['total_rows'];
    	$data['pg_now']    = $pg;
    	echo json_encode(array(
<<<<<<< HEAD:application/controllers/mall_goods_base.php
    			'status'=>true,
    			'html'  =>$this->load->view('mall_goods_base/addGoodBase/ajaxGoodsData', $data, true)
=======
			'status'=>true,
			'html'  =>$this->load->view('mall_goods_base/addGoodBase/ajaxGoodsData', $data, true)
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c:application/controllers/mall_goods_base.php
    	));exit;
    }
}