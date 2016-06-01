<?php
class Mall_goods_base_model extends CI_Model{
	
	private $table = 'mall_goods_base';        
	
	/**
	 * 所有
	 */
	public function total($param){
		
		if (!empty($param['goods_search'])) {
			$this->db->where("((`mall_goods_base`.`goods_name` LIKE '%{$param['goods_search']}%') OR (`mall_goods_base`.`goods_sku`='{$param['goods_search']}'))");
		}
		if (!empty($param['username'])) {
			$this->db->where("((`user`.`phone` LIKE '%{$param['username']}%') OR (`user`.`email` LIKE '%{$param['username']}%'))");
		}
		if (!empty($param['is_on_sale'])) {
			$this->db->where('mall_goods_base.is_on_sale', $param['is_on_sale']);
		}
		if (!empty($param['is_check'])) {
			$this->db->where('mall_goods_base.is_check', $param['is_check']);
		}
		if (!empty($param['start_date'])) {
			$this->db->where(array('mall_goods_base.created_at >' => $param['start_date']));
		}
		if (!empty($param['end_date'])) {
			$this->db->where(array('mall_goods_base.created_at <=' => $param['end_date']));
		}
		return $this->db->count_all_results($this->table);
	}
	
	public function page_list($page_num, $num, $param = array())
	{
		if (!empty($param['goods_search'])) {
			$this->db->where("((`mall_goods_base`.`goods_name` LIKE '%{$param['goods_search']}%') OR (`mall_goods_base`.`goods_sku`='{$param['goods_search']}'))");
		}
		if (!empty($param['username'])) {
			$this->db->where("((`user`.`phone` LIKE '%{$param['username']}%') OR (`user`.`email` LIKE '%{$param['username']}%'))");
		}
		if (!empty($param['is_on_sale'])) {
			$this->db->where('mall_goods_base.is_on_sale', $param['is_on_sale']);
		}
		if (!empty($param['is_check'])) {
			$this->db->where('mall_goods_base.is_check', $param['is_check']);
		}
		if (!empty($param['start_date'])) {
			$this->db->where(array('mall_goods_base.created_at >' => $param['start_date']));
		}
		if (!empty($param['end_date'])) {
			$this->db->where(array('mall_goods_base.created_at <=' => $param['end_date']));
		}
		$this->db->order_by('mall_goods_base.goods_id', 'DESC');
		$this->db->limit($page_num, $num);
		return $this->db->get($this->table);
	}
	
	 /**
	 * 插入 
	 * @param unknown $param
	 */
	 public function insertMallGoods($param){
	 	
	 	$data = array(
	 		'category_id'  => $this->getCategoryId($param),
	 	    'goods_name'   => $param['goods_name'],
	 	    'goods_sku'    => $param['goods_sku'],
	 	    'brand_id'     => $param['brand_id'],
	 		'goods_weight' => $param['goods_weight'],
	 		'goods_brief'  => $param['goods_brief'],
	 		'supplier_id'  => $param['supplier_id'],
	 		'is_check'     => $param['is_check'],
	 		'is_on_sale'   => $param['is_on_sale'],
	 		'goods_desc'   => $param['goods_desc'],
	 		'wap_goods_desc'=> $param['wap_goods_desc'],
	 		'market_price'  => $param['market_price'],
	 		'shop_price'    => $param['shop_price'],
	 		'promote_price' => $param['promote_price'],
	 		'promote_start_date' => $param['promote_start_date'],
	 		'promote_end_date'   => $param['promote_end_date'],
	 		'attribute_set_id'   => $param['attribute_set_id'],
	 	    'extension_code'     => $param['extensionCode'],
	 		'tour_count'         => $param['tour_count'],
	 		'sale_count'         => $param['sale_count'],
	 		'in_stock'           => $param['in_stock'],
	 	    'limit_num'          => $param['limit_num'],
	 	    'minus_stock'        => $param['minus_stock'],
	 		'integral'      => empty($param['integral']) ? '0' : $param['integral'],
	 		'sort_order'    => empty($param['sort_order']) ? '1' : $param['sort_order'],
	 		'created_at'    => date('Y-m-d H:i:s'),
	 	);
	 	//运费模版
	 	if ($param['transport_type'] == 1) {
	 		$data['freight_id'] = $param['freight_id'];
	 	} else {
	 		$data['freight_cost'] = $param['freight_cost'];
	 	}
	 	$this->db->insert($this->table,$data);
	 	return $this->db->insert_id();
	 }
	 
	 /**
	  * 
	  * @param unknown $param
	  * @param unknown $goods_id
	  */
	 public function updateMallGoodsBase($param,$goods_id){
	 	
	 	$data = array(
	 			'goods_name'   => $param['goods_name'],
	 			'goods_sku'    => $param['goods_sku'],
	 			'brand_id'     => $param['brand_id'],
	 			'goods_weight' => $param['goods_weight'],
	 			'goods_brief'  => $param['goods_brief'],
	 			'supplier_id'  => $param['supplier_id'],
	 			'is_check'     => $param['is_check'],
	 			'is_on_sale'   => $param['is_on_sale'],
	 			'goods_desc'   => $param['goods_desc'],
	 			'wap_goods_desc'=> $param['wap_goods_desc'],
	 			'market_price'  => $param['market_price'],
	 			'shop_price'    => $param['shop_price'],
	 			'promote_price' => $param['promote_price'],
	 			'promote_start_date' => $param['promote_start_date'],
	 			'promote_end_date'   => $param['promote_end_date'],
	 			'tour_count'         => $param['tour_count'],
	 			'sale_count'         => $param['sale_count'],
	 			'in_stock'           => $param['in_stock'],
	 			'limit_num'          => $param['limit_num'],
	 			'minus_stock'        => $param['minus_stock'],
	 			'integral'      => empty($param['integral']) ? '0' : $param['integral'],
	 			'sort_order'    => empty($param['sort_order']) ? '1' : $param['sort_order'],
	 			'created_at'    => date('Y-m-d H:i:s'),
	 	);
	 	//运费模版
	 	if ($param['transport_type'] == 1) {
	 		$data['freight_id'] = $param['freight_id'];
	 	} else {
	 		$data['freight_cost'] = $param['freight_cost'];
	 	}
	 	return $this->db->update($this->table,$data);
	 }
	 
	 /**
	 * 更新
	 * @param unknown $goods_id
	 * @param unknown $param
	 */
	public function updateByGoodsId($goods_id,$param)
	{
		$this->db->where('goods_id', $goods_id);
		return $this->db->update($this->table, $param);
	}
	
	 /**
	 * 
	 * @param unknown $goods_id
	 */
	public function getInfoByGoodsId($goods_id){
		
		$this->db->select('mall_goods_base.*,mall_category.full_name');
		$this->db->from($this->table);
		$this->db->join('mall_category','mall_category.cat_id=mall_goods_base.category_id');
		$this->db->where('mall_goods_base.goods_id', $goods_id);
		return $this->db->get();
	}
	
	
	 /**
	 * 分类名称
	 * @param unknown $param
	 */
	public function getCategoryId($param){
		
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

}
