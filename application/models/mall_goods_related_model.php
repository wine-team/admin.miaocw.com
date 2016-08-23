<?php
class Mall_goods_related_model extends CI_Model
{
	private $table = 'mall_goods_related';

	public function findByGoodsId($goods_id, $isArray=false)
	{
		$this->db->where('goods_id', (int)$goods_id);
		$result = $this->db->get($this->table);
		if ($isArray) {
			$rows = array();
			foreach ($result->result() as $item) {
				$rows[$item->related_goods_id] = $item->position;
			}
			return $rows;
		}
		return $result;
	}

	public function total($param)
	{
		if (!empty($param['goods_id'])) {
		   $this->db->where('goods_id',$param['goods_id']);
		}
		if (!empty($param['related_goods_id'])) {
			$this->db->where('related_goods_id',$param['related_goods_id']);
		}
		return $this->db->count_all_results($this->table);
	}
	
	public function page_list($page_num, $num, $param)
	{
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
	 * 添加产品时批量操作
	 * @param unknown $goods_id
	 * @param unknown $category_id
	 */
	public function insertBatchByGoodsId($goods_id, $goodsArr=array())
	{
		$data= array();
		foreach ($goodsArr as $related_goods_id=>$position) {
			$data[$related_goods_id]['goods_id']         = $goods_id;
			$data[$related_goods_id]['related_goods_id'] = $related_goods_id;
			$data[$related_goods_id]['position']         = $position;
		}
		return $this->db->insert_batch($this->table, $data);
	}

	/**
	 * delete
	 * @param unknown $goods_id
	 */
	public function deleteByGoodsId($goods_id)
	{
		$this->db->where('goods_id', $goods_id);
		return $this->db->delete($this->table);
	}
	
	public function findRealtedByGoodsId($goods_id)
	{
		$this->db->where('goods_id',$goods_id);
		$result = $this->db->get($this->table);
		$returnArray = array();
		if ($result->num_rows()>0) {
			foreach ($result->result() as $key=>$item) {
				$returnArray[] = $item->related_goods_id;
			}
		}
		return $returnArray;
	}
}

