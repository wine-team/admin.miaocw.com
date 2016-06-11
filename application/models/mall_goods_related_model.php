<?php
class Mall_goods_related_model extends CI_Model{

	private $table = 'mall_goods_related';        
	
	public function total($param){
		
		if (!empty($param['goods_id'])) {
		   $this->db->where('goods_id',$param['goods_id']);
		}
		if (!empty($param['related_goods_id'])) {
			$this->db->where('related_goods_id',$param['related_goods_id']);
		}
		return $this->db->count_all_results($this->table);
	}
	
	public function page_list($page_num, $num, $param){
		
		if (!empty($param['goods_id'])) {
			$this->db->where('goods_id',$param['goods_id']);
		}
		if (!empty($param['related_goods_id'])) {
			$this->db->where('related_goods_id',$param['related_goods_id']);
		}
		$this->db->limit($page_num,$num);
		return $this->db->get($this->table);
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
	
	/**
	 * 
	 * @param unknown $relatedGoodsArray
	 * @param unknown $goods_id
	 */
	public function insertBatch($relatedGoodsArray,$is_double,$goods_id){
		
		$i = 0;
		$relatedGoods = array();
		foreach ($relatedGoodsArray as $item){
			$relatedGoods[$i]['goods_id'] = $goods_id;
			$relatedGoods[$i]['related_goods_id'] = $item;
			$relatedGoods[$i]['is_double'] = $is_double;
			$i++;
		}
		return $this->db->insert_batch($this->table,$relatedGoods);
	}
	
}
/* End of file Mall_goods_related_model.php */
/* Location: ./application/models/Mall_goods_related_model.php */

