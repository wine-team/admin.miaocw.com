<?php
class Mall_goods_model extends CI_Model{
	
	private $table = 'mall_goods';        
	
	/**
	 * 所有
	 */
	public function total($param){
		
		if (!empty($param['goods_search'])) {
			$this->db->where("((`mall_goods`.`goods_name` LIKE '%{$param['goods_search']}%') OR (`mall_goods`.`goods_sku`='{$param['goods_search']}'))");
		}
		if (!empty($param['username'])) {
			$this->db->where("((`user`.`phone` LIKE '%{$param['username']}%') OR (`user`.`email` LIKE '%{$param['username']}%'))");
		}
		if (!empty($param['is_on_sale'])) {
			$this->db->where('mall_goods.is_on_sale', $param['is_on_sale']);
		}
		if (!empty($param['is_check'])) {
			$this->db->where('mall_goods.is_check', $param['is_check']);
		}
		if (!empty($param['start_date'])) {
			$this->db->where(array('mall_goods.created_at >' => $param['start_date']));
		}
		if (!empty($param['end_date'])) {
			$this->db->where(array('mall_goods.created_at <=' => $param['end_date']));
		}
		return $this->db->count_all_results($this->table);
	}
	
	public function page_list($page_num, $num, $param = array())
	{
		if (!empty($param['goods_search'])) {
			$this->db->where("((`mall_goods`.`goods_name` LIKE '%{$param['goods_search']}%') OR (`mall_goods`.`goods_sku`='{$param['goods_search']}'))");
		}
		if (!empty($param['username'])) {
			$this->db->where("((`user`.`phone` LIKE '%{$param['username']}%') OR (`user`.`email` LIKE '%{$param['username']}%'))");
		}
		if (!empty($param['is_on_sale'])) {
			$this->db->where('mall_goods.is_on_sale', $param['is_on_sale']);
		}
		if (!empty($param['is_check'])) {
			$this->db->where('mall_goods.is_check', $param['is_check']);
		}
		if (!empty($param['start_date'])) {
			$this->db->where(array('mall_goods.created_at >' => $param['start_date']));
		}
		if (!empty($param['end_date'])) {
			$this->db->where(array('mall_goods.created_at <=' => $param['end_date']));
		}
		$this->db->order_by('mall_goods.goods_id', 'DESC');
		$this->db->limit($page_num, $num);
		return $this->db->get($this->table);
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
	

}
