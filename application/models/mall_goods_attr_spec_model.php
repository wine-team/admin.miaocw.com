<?php
class Mall_goods_attr_spec_model extends CI_Model{
	
	private $table = 'mall_goods_attr_spec';      
	private $table1 = 'mall_goods_attr_price';
	
	/**
	 * 数组插入数据（spec.bak.php）
	 * @param unknown $goods_id
	 * @param unknown $attrValue
	 
	public function insertBatch($goods_id, $attrSpec, $attrPrice, $attrNum, $attrStock){
	    foreach ($attrSpec as $key=>$item){
	        foreach ($item as $jj=>$val){ 
	            $attr_name = $this->mall_attribute_value->findById($jj)->row()->attr_name;
	            $spec['goods_id'] = $goods_id;
	            $spec['attr_value_id'] = $jj;
	            $spec['attr_name'] = $attr_name;
	            $this->db->insert($this->table, $spec);
	            $attr_spec_id = $this->db->insert_id();
	            if(is_array($val)){
	                $i = 0;
	                foreach($val as $k=>$v)
	                {
	                    $price1[$i]['attr_spec_id'] = $attr_spec_id;
	                    $price1[$i]['attr_value_id'] = $jj;
	                    $price1[$i]['attr_value'] = $v;
	                    $price1[$i]['attr_price'] = $attrPrice[$key][$jj][$k];
	                    $price1[$i]['attr_num'] = $attrNum[$key][$jj][$k];
	                    $price1[$i]['attr_stock'] = $attrStock[$key][$jj][$k];
	                    $i ++; 
	                }
	                $this->db->insert_batch($this->table1,$price1);
	            }else{
	                $price2['attr_spec_id'] = $attr_spec_id;
	                $price2['attr_value_id'] = $jj;
	                $price2['attr_value'] = $val;
	                $price2['attr_price'] = $attrPrice[$key][$jj];
	                $price2['attr_num'] = $attrNum[$key][$jj] ? $attrNum[$key][$jj] : 1000;
	                $price2['attr_stock'] = $attrStock[$key][$jj] ? $attrStock[$key][$jj] : 1000;
	                $this->db->insert($this->table1, $price2);
	            }
	        }
	    } 
	}
	*/
	
	/**
	 * @param unknown $goods_id
	 * @param unknown $attrPrice，$attrNum，$attrStock
	 * */
	public function insertBatch($goods_id, $attr, $attrPrice, $attrNum, $attrStock)
	{
	    $attr_set_id = 0;
	    foreach ($attr as $k=>$v) {
	        foreach ($v as $k1=>$v1)
	        {
	            $attr_value_id[] = $k1;
	        }
	    }
	    $attr_value_id = array_pad($attr_value_id, 3, 0);
	    $i = 0;
	    foreach ($attrPrice as $key0=>$item0) {
	        foreach ($item0 as $key1=>$item1) {
	            foreach ($item1 as $key2=>$item2) {
                    $price[$i]['attr_value_id'] = implode(',', $attr_value_id);
                    $price[$i]['attr_value'] = $key0.','.$key1.','.$key2;
                    $price[$i]['attr_price'] = $attrPrice[$key0][$key1][$key2];
                    $price[$i]['attr_num'] = $attrNum[$key0][$key1][$key2];
                    $price[$i]['attr_stock'] = $attrStock[$key0][$key1][$key2];
                    $i ++; 
	            }
	        }
	    }
	    $this->db->insert_batch($this->table1,$price);
	}
	
	public function findById($where)
	{
	    return $this->db->get_where($this->table, $where);
	}
	
	public function insert($data) 
	{
	    $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	} 
	
	public function update($where, $data)  
	{
	    $this->db->update($this->table, $data, $where);
	    return $this->db->affected_rows();
	}
	
	public function deletePrice($goods_id)  
	{
	    $spec = $this->findById(array('goods_id'=>$goods_id))->result();
	    $spec_ids = array();
	    foreach ($spec as $s) {
	        $spec_ids[] = $s->attr_spec_id;
	    }
	    if (!empty($spec_ids)) {
	        $price = $this->getPriceWhereIn('attr_spec_id', $spec_ids)->result();
	        $price_ids = array();
	        foreach ($price as $p) {
	            $price_ids[] = $p->attr_price_id;
	        }
	        if (!empty($price_ids)) {
	            $this->db->where_in('attr_price_id', $price_ids);
	            $this->db->delete($this->table1);
	        }
	        $this->db->where_in('attr_spec_id', $spec_ids);
	        $this->db->delete($this->table);
	    }
	    return $this->db->affected_rows();
	}
	
	public function getPriceWhereIn($field, $arr)
	{
	    $this->db->where_in($field, $arr);
	    return $this->db->get($this->table1);
	}
	
	/**
	 * 价格属性修改
	 * */
	public function updatePriceBatch($attrPrice, $attrNum, $attrStock)
	{
	    $i = 0;
	    foreach ($attrPrice as $k=>$v) {	
	        $data[$i]['attr_price_id'] = $k; 
	        $data[$i]['attr_price'] = $v;
	        $data[$i]['attr_num'] = $attrNum[$k];
	        $data[$i]['attr_stock'] = $attrStock[$k];
	        $i ++;
	    }
	    $this->db->update_batch($this->table1, $data, 'attr_price_id');
	    return $this->db->affected_rows();
	}
	
}

/* End of file Mall_goods_attr_spec_model.php */
/* Location: ./application/models/Mall_goods_attr_spec_model.php */