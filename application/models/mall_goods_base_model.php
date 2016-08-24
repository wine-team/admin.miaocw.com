<?php
class Mall_goods_base_model extends CI_Model
{
	private $table = 'mall_goods_base';        

	public function findByGoodsId($goods_id)
	{
		$this->db->where('goods_id', $goods_id);
		return $this->db->get($this->table);
	}

	public function findByGoodsSku($goods_sku)
	{
		$this->db->where('goods_sku', $goods_sku);
		return $this->db->get($this->table);
	}

	public function total($param)
	{
		if (!empty($param['goods_id'])) {
			$this->db->where('mall_goods_base.goods_id', $param['goods_id']);
		}
		if (!empty($param['goods_ids'])) {
			$this->db->where_in('mall_goods_base.goods_id', $param['goods_ids']);
		}
		if (!empty($param['goods_name'])) {
			$this->db->like('mall_goods_base.goods_name', $param['goods_name']);
		}
		if (!empty($param['goods_search'])) {
			$this->db->where("((`mall_goods_base`.`goods_name` LIKE '%{$param['goods_search']}%') OR (`mall_goods_base`.`goods_sku`='{$param['goods_search']}'))");
		}
		if (!empty($param['supplier_id'])) {
			$this->db->where('mall_goods_base.supplier_id', $param['supplier_id']);
		}
		if (!empty($param['is_on_sale'])) {
			$this->db->where('mall_goods_base.is_on_sale', $param['is_on_sale']);
		}
		if (!empty($param['is_check'])) {
			$this->db->where('mall_goods_base.is_check', $param['is_check']);
		}
		if (!empty($param['extension_code'])) {
			$this->db->where('mall_goods_base.extension_code', $param['extension_code']);
		}
		if (!empty($param['attribute_set_id'])) {
			$this->db->where('mall_goods_base.attribute_set_id', $param['attribute_set_id']);
		}
		if (!empty($param['province_id'])) {
			$this->db->where('mall_goods_base.province_id', $param['province_id']);
		}
		if (!empty($param['city_id'])) {
			$this->db->where('mall_goods_base.city_id', $param['city_id']);
		}
		if (!empty($param['district_id'])) {
			$this->db->where('mall_goods_base.district_id', $param['district_id']);
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
		if (!empty($param['goods_id'])) {
			$this->db->where('mall_goods_base.goods_id', $param['goods_id']);
		}
		if (!empty($param['goods_ids'])) {
			$this->db->where_in('mall_goods_base.goods_id', $param['goods_ids']);
		}
		if (!empty($param['goods_name'])) {
			$this->db->like('mall_goods_base.goods_name', $param['goods_name']);
		}
		if (!empty($param['goods_search'])) {
			$this->db->where("((`mall_goods_base`.`goods_name` LIKE '%{$param['goods_search']}%') OR (`mall_goods_base`.`goods_sku`='{$param['goods_search']}'))");
		}
		if (!empty($param['supplier_id'])) {
			$this->db->where('mall_goods_base.supplier_id', $param['supplier_id']);
		}
		if (!empty($param['is_on_sale'])) {
			$this->db->where('mall_goods_base.is_on_sale', $param['is_on_sale']);
		}
		if (!empty($param['is_check'])) {
			$this->db->where('mall_goods_base.is_check', $param['is_check']);
		}
		if (!empty($param['extension_code'])) {
			$this->db->where('mall_goods_base.extension_code', $param['extension_code']);
		}
		if (!empty($param['attribute_set_id'])) {
			$this->db->where('mall_goods_base.attribute_set_id', $param['attribute_set_id']);
		}
		if (!empty($param['province_id'])) {
			$this->db->where('mall_goods_base.province_id', $param['province_id']);
		}
		if (!empty($param['city_id'])) {
			$this->db->where('mall_goods_base.city_id', $param['city_id']);
		}
		if (!empty($param['district_id'])) {
			$this->db->where('mall_goods_base.district_id', $param['district_id']);
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

	public function insert($params=array())
	{
		$data = array(
	 	    'goods_name'         => $params['goods_name'],
	 	    'goods_sku'          => $params['goods_sku'],
	 	    'brand_id'           => !empty($params['brand_id']) ? $params['brand_id'] : 0,
	 		'goods_weight'       => $params['goods_weight'],
	 		'goods_brief'        => $params['goods_brief'],
	 		'supplier_id'        => $params['supplier_id'],
	 		'is_check'           => $params['is_check'],
	 		'is_on_sale'         => $params['is_on_sale'],
	 		'goods_desc'         => $params['goods_desc'],
	 		'wap_goods_desc'     => $params['wap_goods_desc'],
			'attr_spec'          => !empty($params['attr_spec']) ? json_encode($params['attr_spec']) : '',
			'attr_value'         => !empty($params['attr_value']) ? json_encode($params['attr_value']) : '',
	 		'market_price'       => $params['market_price'],
	 		'shop_price'         => $params['shop_price'],
	 		'provide_price'      => $params['provide_price'],
			'promote_price'      => !empty($params['promote_price']) ? $params['promote_price'] : 0,
			'promote_start_date' => !empty($params['promote_start_date']) ? $params['promote_start_date'] : '',
			'promote_end_date'   => !empty($params['promote_end_date']) ? $params['promote_end_date'] : '',
	 		'attr_set_id'        => $params['attr_set_id'],
	 	    'extension_code'     => $params['extension_code'],
			'tour_count'         => !empty($params['tour_count']) ? $params['tour_count'] : 0,
			'sale_count'         => !empty($params['sale_count']) ? $params['sale_count'] : 0,
	 		'in_stock'           => $params['in_stock'],
	 	    'limit_num'          => $params['limit_num'],
	 	    'minus_stock'        => $params['minus_stock'],
	 		'province_id'        => $params['province_id'],
	 		'city_id'            => $params['city_id'],
	 		'district_id'        => $params['district_id'],
	 		'address'            => $params['address'],
	 		'goods_img'          => '',
	 		'integral'           => !empty($params['integral']) ?  $params['integral'] : '0',
	 		'sort_order'         => !empty($params['sort_order']) ? $params['sort_order'] : '1',
			'updated_at'         => date('Y-m-d H:i:s'),
			'created_at'         => date('Y-m-d H:i:s'),
	 	);
	 	//运费模版
	 	if ($params['freight_type'] == 1) {
	 		$data['freight_id'] = $params['freight_id'];
	 	} else {
	 		$data['freight_cost'] = $params['freight_cost'];
	 	}
	 	$this->db->insert($this->table,$data);
	 	return $this->db->insert_id();
	 }
	 
	 /**
	  * 
	  * @param unknown $param
	  * @param unknown $goods_id
	  */
	 public function update($params=array())
	 {
		 $data = array(
			 'goods_name'         => $params['goods_name'],
			 'goods_sku'          => $params['goods_sku'],
			 'brand_id'           => !empty($params['brand_id']) ? $params['brand_id'] : 0,
			 'goods_weight'       => $params['goods_weight'],
			 'goods_brief'        => $params['goods_brief'],
			 'supplier_id'        => $params['supplier_id'],
			 'is_check'           => $params['is_check'],
			 'is_on_sale'         => $params['is_on_sale'],
			 'goods_desc'         => $params['goods_desc'],
			 'wap_goods_desc'     => $params['wap_goods_desc'],
			 'attr_spec'          => !empty($params['attr_spec']) ? json_encode($params['attr_spec']) : '',
			 'attr_value'         => !empty($params['attr_value']) ? json_encode($params['attr_value']) : '',
			 'market_price'       => $params['market_price'],
			 'shop_price'         => $params['shop_price'],
			 'provide_price'      => $params['provide_price'],
			 'promote_price'      => !empty($params['promote_price']) ? $params['promote_price'] : 0,
			 'promote_start_date' => !empty($params['promote_start_date']) ? $params['promote_start_date'] : '',
			 'promote_end_date'   => !empty($params['promote_end_date']) ? $params['promote_end_date'] : '',
			 'attr_set_id'        => $params['attr_set_id'],
			 'extension_code'     => $params['extension_code'],
			 'tour_count'         => !empty($params['tour_count']) ? $params['tour_count'] : 0,
			 'sale_count'         => !empty($params['sale_count']) ? $params['sale_count'] : 0,
			 'in_stock'           => $params['in_stock'],
			 'limit_num'          => $params['limit_num'],
			 'minus_stock'        => $params['minus_stock'],
			 'province_id'        => $params['province_id'],
			 'city_id'            => $params['city_id'],
			 'district_id'        => $params['district_id'],
			 'address'            => $params['address'],
			 'integral'           => !empty($params['integral']) ?  $params['integral'] : 0,
			 'sort_order'         => !empty($params['sort_order']) ? $params['sort_order'] : 50,
			 'updated_at'         => date('Y-m-d H:i:s'),
			 'created_at'         => date('Y-m-d H:i:s'),
		 );

	 	if ($params['freight_type'] == 1) {//运费模版
	 		$data['freight_id'] = $params['freight_id'];
	 		$data['freight_cost'] = 0;
	 	} else {
	 		$data['freight_id'] = 0;
	 		$data['freight_cost'] = $params['freight_cost'];
	 	}
	 	
	 	$this->db->where('goods_id', $params['edit_goods_id']);
	 	return $this->db->update($this->table, $data);
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
	 * 删除
	 * @param unknown $goods_id
	 */
	public function deleteById($goods_id)
	{
		$this->db->where('goods_id', $goods_id);
		return $this->db->delete($this->table);
	}
	
	 /**
	 * 
	 * @param unknown $goods_id
	 */
	public function getInfoByGoodsId($goods_id)
	{
		$this->db->select('mall_goods_base.*,mall_category.full_name');
		$this->db->from($this->table);
		$this->db->join('mall_category','mall_category.cat_id=mall_goods_base.category_id');
		$this->db->where('mall_goods_base.goods_id', $goods_id);
		return $this->db->get();
	}
	
	 /**
	 * 
	 * @param unknown $params
	 */
	public function insertImage($params)
	{
		$data['goods_img'] = $params['goods_img'];
		$this->db->where('goods_id',$params['goods_id']);
		return $this->db->update($this->table,$data);
	}

}
