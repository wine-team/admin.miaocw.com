<?php

class Mall_goods_attr_spec_model extends CI_Model{
	private $table = 'mall_goods_attr_spec';      
	private $table1 = 'mall_goods_attr_price';
	
	/**
	 * 数组插入数据
	 * @param unknown $goods_id
	 * @param unknown $attrValue
	 */
	public function insertBatch($goods_id, $attrSpec, $attrPrice, $attrNum, $attrStock){
	    foreach ($attrSpec as $key=>$item){
	        foreach ($item as $jj=>$val){ 
	            $attr_name = $this->mall_attribute_value->findById(array('attr_value_id'=>$jj))->row()->attr_name;
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
	
	public function delete($where)  
	{
	    $this->db->delete($this->table, $where);
	    return $this->db->affected_rows();
	}
	
	public function findPriceById($where)
	{
	    return $this->db->get_where($this->table1, $where);
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