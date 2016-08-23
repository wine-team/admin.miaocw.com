<?php 
class Mall_goods_base extends CS_Controller
{
	private $extension = array();

    public function _init()
    {
		$this->load->helper(array('common'));
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
        $this->load->model('mall_goods_related_model','mall_goods_related');
		$this->extension = array(
			'simple'=>'简单产品',
			'grouped'=>'组合产品',
			'configurable'=>'可配置产品',
			'virtual'=>'虚拟产品',
			'bundle'=>'捆绑产品',
			'giftcard'=>'礼品卡'
		);
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
		$data['extension'] = $this->extension;
        $this->load->view('mall_goods_base/grid', $data);
    }

    public function addstep1()
    {
		$data['extension'] = $this->extension;
    	$data['attributeSet'] = $this->mall_attribute_set->find();
    	$this->load->view('mall_goods_base/addstep1', $data);
    }
    
    public function addstep2()
    {
    	$extension_code = $this->input->get('extension_code');
    	$attr_set_id = $this->input->get('attr_set_id');
    	if (empty($extension_code) || empty($attr_set_id)) {
    		$this->error('mall_goods_base/addstep1', '', '请选择完整商品的类别和类型');
    	}
    	$data['attr_set_id'] = $attr_set_id;
    	$data['brand'] = $this->mall_brand->find();//品牌信息

		$attrValues = array();
		$result = $this->mall_attribute_group->getAttrValuesByAttrSetId($attr_set_id);
		if ($result->num_rows() > 0) {
			foreach ($result->result() as $item) {
				$attrValues[$item->group_id]['attr_set_id']  = $item->attr_set_id;
				$attrValues[$item->group_id]['group_id']     = $item->group_id;
				$attrValues[$item->group_id]['group_name']   = $item->group_name;
				$attrValues[$item->group_id]['attr_value'][] = $item;
			}
		}
		$data['categorys'] = $this->mall_category->findByCategoryTree();
		$data['attrValues'] = $attrValues;
		$data['attributeSet'] = $this->mall_attribute_set->find();
		$data['extension'] = $this->extension;
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
		if ($this->db->trans_status() === TRUE && $isUpdate) {
			echo json_encode(array(
				'flag' => $isOnSale,
			));
		} else {
			echo json_encode(array(
				'flag' => 3,
			));
		}
		exit;
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
			case '1': $isCheck = '1'; break;
			case '2': $isCheck = '2'; break;
			case '3': $isCheck = '3'; break;
			default : $isCheck = '1'; break;
		}
		$this->db->trans_start();
		$isUpdate = $this->mall_goods_base->updateByGoodsId($goods_id, array('is_check'=>$isCheck));
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo json_encode(array(
				'status' => true,
			));
		} else {
			echo json_encode(array(
				'status' => false,
			));
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
    	if ($this->input->post('current_goods_id')) {
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
    	$postData = $this->input->post();
		$this->db->trans_start();
    	$goods_id = $this->mall_goods_base->insert($postData);
		if (!empty($postData['cate_ids_array'])) {
			$isInsert = $this->mall_category_product->insertBatchByGoodsId($goods_id, $postData['cate_ids_array']);
		}

		//商品关联
		$goods_json = $this->input->post('goods_json');
		$goodsArr = json_decode($goods_json, TRUE);
		foreach ($goodsArr as $key=>$value) {
			if ($value === NULL) {
				unset($goodsArr[$key]);
			}
		}
		if (!empty($goodsArr)) {
			$insert = $this->mall_goods_related->insertBatchByGoodsId($goods_id, $goodsArr);
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE) {
			$this->session->set_flashdata('success', '保存成功!');
			$this->jsonMessage('', base_url('mall_goods_base/grid'));
    	} else {
			$this->jsonMessage('保存失败！');
    	}
    }
    
     /**
     * 编辑
     * @param unknown $goods_id
     */
    public function edit($goods_id)
	{
		$result = $this->mall_goods_base->findByGoodsId($goods_id);
		if ($result->num_rows() <= 0) {
			$this->error('mall_goods_base/grid', '', '找不到产品相关信息！');
		}
		$mallGoodsBase = $result->row(0);

		$attrValues = array();
		$result1 = $this->mall_attribute_group->getAttrValuesByAttrSetId($mallGoodsBase->attr_set_id);
		if ($result1->num_rows() > 0) {
			foreach ($result1->result() as $item) {
				$attrValues[$item->group_id]['attr_set_id']  = $item->attr_set_id;
				$attrValues[$item->group_id]['group_id']     = $item->group_id;
				$attrValues[$item->group_id]['group_name']   = $item->group_name;
				$attrValues[$item->group_id]['attr_value'][] = $item;
			}
		}
		$data['categoryinfo']  = $this->mall_category_product->findByGoodsId($goods_id, true);
		$data['freightTpl']    = $this->mall_freight_tpl->getTransport($mallGoodsBase->supplier_id);
		$data['mallGoodsBase'] = $mallGoodsBase;
		$data['attrValues']    = $attrValues;
		$data['categorys']     = $this->mall_category->findByCategoryTree();
		$data['attributeSet']  = $this->mall_attribute_set->find();
		$data['brand']         = $this->mall_brand->find();//品牌信息
		$data['extension']     = $this->extension;
		$data['province_id']   = $mallGoodsBase->province_id;
		$data['city_id']       = $mallGoodsBase->city_id;
		$data['district_id']   = $mallGoodsBase->district_id;
		$this->load->view('mall_goods_base/edit', $data);
    }
    
    public function editPost()
    {
    	$goods_id = $this->input->post('current_goods_id');
    	$postData = $this->input->post();

		$this->db->trans_start();
    	$updateGoods = $this->mall_goods_base->update($postData);
		if (!empty($postData['cate_ids_array'])) {
			$isdelete = $this->mall_category_product->deleteByGoodsId($goods_id);
			$isInsert = $this->mall_category_product->insertBatchByGoodsId($goods_id, $postData['cate_ids_array']);
		}

		//商品关联
		$goods_json = $this->input->post('goods_json');
		$goodsArr = json_decode($goods_json, TRUE);
		foreach ($goodsArr as $key=>$value) {
			if ($value === NULL) {
				unset($goodsArr[$key]);
			}
		}
		if (!empty($goodsArr)) {
			$delete = $this->mall_goods_related->deleteByGoodsId($goods_id);
			$insert = $this->mall_goods_related->insertBatchByGoodsId($goods_id, $goodsArr);
		}
		$this->db->trans_complete();

    	if ($this->db->trans_status() === TRUE) {
			$this->session->set_flashdata('success', '编辑成功!');
			$this->jsonMessage('', base_url('mall_goods_base/grid'));
    	} else {
			$this->jsonMessage('编辑失败！');
    	}
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
    	$ifResize = $this->dealWithImagesResize($imageData, '400', '400');
    	if ($ifResize == false) {
    		$this->error('mall_goods_base/images', $goods_id, '400*400缩略图生成失败！');
    	}
    	$ifResize = $this->dealWithImagesResize($imageData, '60', '60');
    	if ($ifResize == false) {
    		$this->error('mall_goods_base/images', $goods_id, '60*60缩略图生成失败！');
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
     * @return multitype:string
     */
    public function validate()
    {
    	$error = array();
    	if ($this->validateParam($this->input->post('goods_name'))) {
    		$error[] = '商品名称不可为空！';
    	}
		if (!$this->input->post('current_goods_id')) {//验证商品sku
			$mallGoodsBase = $this->mall_goods_base->findByGoodsSku($this->input->post('goods_sku'));
			if ($mallGoodsBase->num_rows() > 0){
				$error[] = '商品sku已存在。';
			}
		} else {
			$result = $this->mall_goods_base->findByGoodsId($this->input->post('current_goods_id'));
			if ($result->num_rows() <= 0) {
				$error[] = '修改错误，请重新进入重试';
			}
			$mallGoodsBase = $result->row(0);
			if ($mallGoodsBase->goods_sku != $this->input->post('goods_sku')) {
				$result = $this->mall_goods_base->findByGoodsSku($this->input->post('goods_sku'));
				if ($result->num_rows() > 0) {
					$error[] = '商品sku已存在。';
				}
			}
		}
		$supplier_id = $this->input->post('supplier_id');
		if (!empty($supplier_id)) {//为零时不判断，默认自营产品
			$userQuery = $this->user->findBySupplierId($supplier_id);
			if ($userQuery->num_rows() <= 0) {
				$error[] = '供应商必须填写';
			}
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
    	if ($this->input->post('goods_weight') < 0) {
    		$error[] = '商品重量必须大于等于0';
    	}
    	if ($this->input->post('shop_price') < 0) {
    		$error[] = '销售价格必须大于等于0.';
    	}
		if ($this->input->post('provide_price') < 0) {
			$error[] = '供应价格必须大于等于0.';
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
    		if ($this->input->post('freight_cost') < 0) {
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
    	$_POST['address'] = $regionNames[0] .' '.$regionNames[1].' '.$regionNames[2].' '.($this->input->post('address') ? $this->input->post('address') : ' ');
    	return $error;
    }
    
    /**
     * 获取
     * @param number $pg
     */
    public function ajaxGoodsBase($pg=1)
	{
    	$page_num = 10;
    	$num = ($pg-1)*$page_num;
    	$config['per_page'] = $page_num;
    	$config['first_url'] = base_url('mall_goods_base/ajaxGetMallGoods').$this->pageGetParam($this->input->get());
    	$config['suffix'] = $this->pageGetParam($this->input->get());
    	$config['base_url'] = base_url('mall_goods_base/ajaxGetMallGoods');
    	$config['total_rows'] = $this->mall_goods_base->total($this->input->get());
    	$config['uri_segment'] = 3;
    	$this->pagination->initialize($config);
    	$data['pg_link']   = $this->pagination->create_links();
    	$data['page_list'] = $this->mall_goods_base->page_list($page_num, $num, $this->input->get());
    	$data['all_rows']  = $config['total_rows'];
    	$data['pg_now']    = $pg;
    	$data['page_num']  = $page_num;
    	echo json_encode(array(
			'status'=>true,
			'html'  =>$this->load->view('mall_goods_base/ajaxGoodsBase/ajaxData', $data, true)
    	));exit;
    }
}