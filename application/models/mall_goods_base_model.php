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
        $this->checkWhereParam($param);
        return $this->db->count_all_results($this->table);
    }
    
    public function page_list($page_num, $num, $param = array())
    {
        $this->checkWhereParam($param);
        $this->db->order_by('mall_goods_base.goods_id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get($this->table);
    }

    public function excelExport($param = array())
    {
        $this->db->select('goods_id, goods_name, goods_sku, from_id, brand_id, goods_weight, market_price, shop_price, provide_price, freight_id, freight_cost, attr_set_id, extension_code, supplier_id, in_stock, address, created_at, updated_at');
        $this->checkWhereParam($param);
        $this->db->order_by('mall_goods_base.goods_id', 'DESC');
        return $this->db->get($this->table);
    }

    private function checkWhereParam($param = array())
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
        if (!empty($param['attr_set_id'])) {
            $this->db->where('mall_goods_base.attr_set_id', $param['attr_set_id']);
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
    }

    public function insert($params=array())
    {
        $data = array(
            'goods_name'         => $params['goods_name'],
            'goods_sku'          => $params['goods_sku'],
            'from_id'            => $params['from_id'],
            'brand_id'           => !empty($params['brand_id']) ? $params['brand_id'] : 0,
            'goods_weight'       => $params['goods_weight'],
            'goods_brief'        => $params['goods_brief'],
            'supplier_id'        => $params['supplier_id'],
            'is_check'           => $params['is_check'],
            'is_on_sale'         => $params['is_on_sale'],
            'goods_desc'         => $params['goods_desc'],
            'wap_goods_desc'     => $params['wap_goods_desc'],
            'goods_note'         => $params['goods_note'],
            'attr_spec'          => $this->deleteEmptyValue(1, $params['attr_spec']),
            'attr_value'         => $this->deleteEmptyValue(2, $params['attr_value']),
            'goods_img'          => '',
            'market_price'       => $params['market_price'],
            'shop_price'         => $params['shop_price'],
            'provide_price'      => $params['provide_price'],
            'promote_price'      => !empty($params['promote_price']) ? $params['promote_price'] : 0,
            'promote_start_date' => !empty($params['promote_start_date']) ? strtotime($params['promote_start_date']) : 0,
            'promote_end_date'   => !empty($params['promote_end_date']) ? strtotime($params['promote_end_date']) : 0,
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
            'auto_cancel'        => !empty($params['auto_cancel']) ? $params['auto_cancel'] : 720,
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
            'from_id'            => $params['from_id'],
            'brand_id'           => !empty($params['brand_id']) ? $params['brand_id'] : 0,
            'goods_weight'       => $params['goods_weight'],
            'goods_brief'        => $params['goods_brief'],
            'supplier_id'        => $params['supplier_id'],
            'is_check'           => $params['is_check'],
            'is_on_sale'         => $params['is_on_sale'],
            'goods_desc'         => $params['goods_desc'],
            'wap_goods_desc'     => $params['wap_goods_desc'],
        	'goods_note'         => $params['goods_note'],
            'attr_spec'          => $this->deleteEmptyValue(1, $params['attr_spec']),
            'attr_value'         => $this->deleteEmptyValue(2, $params['attr_value']),
            'market_price'       => $params['market_price'],
            'shop_price'         => $params['shop_price'],
            'provide_price'      => $params['provide_price'],
            'promote_price'      => !empty($params['promote_price']) ? $params['promote_price'] : 0,
            'promote_start_date' => !empty($params['promote_start_date']) ? strtotime($params['promote_start_date']) : 0,
            'promote_end_date'   => !empty($params['promote_end_date']) ? strtotime($params['promote_end_date']) : 0,
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
            'auto_cancel'        => !empty($params['auto_cancel']) ? $params['auto_cancel'] : 720,
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

    private function deleteEmptyValue($attrType, $attrArrayValue)
    {
        if (empty($attrArrayValue)) {
            return '';
        }
        switch ($attrType) {
            case '1' : {//attr_spec，规格属性值
                foreach ($attrArrayValue as $key=>$item) {
                    if (empty($item['spec_value'])) {
                        unset($attrArrayValue[$key]);
                    }
                }
                break;
            }
            case '2' : {
                foreach ($attrArrayValue as $key=>$item) {
                    if (!empty($item['group_value'])) {
                        foreach ($item['group_value'] as $k=>$v) {
                            if (empty($v['attr_value'])) {
                                unset($attrArrayValue[$key]['group_value'][$k]);
                            }
                        }
                        if (empty($item['group_value'])) {
                            unset($attrArrayValue[$key]);
                        }
                    }
                }
                break;
            }
            default : {
                $attrArrayValue = array();
                break;
            }
        }

        if (empty($attrArrayValue)) {
            return '';
        }
        return json_encode($attrArrayValue);
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
     * @descripte  插入图片
     * @Author xiumao
     * @date 2016/6/15 0015 下午 5:34
     */
    public function insertImage($params)
    {
    	$data['goods_img'] = $params['goods_img'];
    	$this->db->where('goods_id',$params['goods_id']);
    	return $this->db->update($this->table,$data);
    }
    
    
     /**
     * @descripte   批量插入图片
     * @Author xiumao
     * @date 2016/6/15 0015 下午 5:34
     */
    public function insertImageBatch($goods_id, $imageData,$pics)
    {
    	
    	$this->db->where('goods_id',$goods_id);
    	foreach ( $imageData as $key=>$val) {
    		$pics .= $val.'|';
    	}
    	$data['goods_img'] = $pics;
    	$this->db->where('goods_id',$goods_id);
    	return $this->db->update($this->table,$data);
    }

}
