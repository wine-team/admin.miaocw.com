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
			$result = $this->mall_attribute_group->findById(array('group_id'=>$key));
			foreach ($item as $jj=>$val){
				$res = $this->mall_attribute_value->findById(array('attr_value_id'=>$jj));
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
	
}


