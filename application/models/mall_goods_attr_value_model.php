<?php
class Mall_goods_attr_value_model extends CI_Model{

	private $table = 'mall_goods_attr_value';        
	
	/**
	 * 数组插入数据
	 * @param unknown $goods_id
	 * @param unknown $attrValue
	 */
	public function insertBatch($goods_id,$attrValue){
		
		$i = 0;
		$batch = array();
		foreach ($attrValue as $key=>$item){
			$result = $this->mall_attribute_group->findById($key);
			foreach ($item as $jj=>$val){
				$res = $this->mall_attribute_value->getWhere(array('attr_value_id'=>$jj));
				$batch[$i]['goods_id'] = $goods_id;
				$batch[$i]['attr_value_id'] = $jj;
				$batch[$i]['attr_name'] = $res->row(0)->attr_name;
				$batch[$i]['attr_value'] = is_array($val) ? implode(',',$val) : $val;
				$batch[$i]['group_id'] = $key;
				$batch[$i]['group_name'] = $result->row(0)->group_name;
				$i++;
			}
		}
		return $this->db->insert_batch($this->table,$batch);
	}
	
	public function findById($where=array()) {
	     return $this->db->get_where($this->table, $where);
	}
	
	/**
	 * 简单属性修改
	 * */
	public function updateAttrBatch($attrValue)
	{   
	    $i = 0;
	    foreach ($attrValue as $k=>$v) {
	        $data[$i]['goods_attr_id'] = $k;
	        $data[$i]['attr_value'] = is_array($v) ? implode(',',$v) : $v;
	        $i ++;
	    } 
	    $this->db->update_batch($this->table, $data, 'goods_attr_id');
	    return $this->db->affected_rows();
	}
	
	public function deleteAttr($goods_id)
	{
	    $this->db->delete($this->table, array('goods_id'=>$goods_id));
	    return $this->db->affected_rows();
	}
	
	
	
}


