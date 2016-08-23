<?php
class Mall_category_product_model extends CI_Model
{
    private $table = 'mall_category_product';
	private $table1 = 'mall_goods_base';

	public function findByCategoryId($category_id, $isArray=false)
	{
		$this->db->where('category_id', (int)$category_id);
		$result = $this->db->get($this->table);
		if ($isArray) {
			$rows = array();
			foreach ($result->result() as $item) {
				$rows[$item->goods_id] = $item->position;
			}
			return $rows;
		}
		return $result;
	}

	public function findByGoodsId($goods_id, $isArray=false)
	{
		$this->db->where('goods_id', (int)$goods_id);
		$result = $this->db->get($this->table);
		if ($isArray) {
			$rows = array();
			foreach ($result->result() as $item) {
				$rows[$item->category_id] = $item->position;
			}
			return $rows;
		}
		return $result;
	}

	/**
     * 
     * @param unknown $param
     */
    public function insert($goods_id,$category_id)
	{
       $param = array(
       	    'category_id' => $category_id,
       		'goods_id'    => $goods_id
       );
       return $this->db->insert($this->table,$param);
    }
    
    /**
     * 通过产品ID进行删除
     * @param unknown $goods_id
     */
    public function deleteByGoodsId($goods_id)
	{
    	$this->db->where('goods_id', $goods_id);
    	return $this->db->delete($this->table);
    }

	/**
	 * 通过分类ID进行删除
	 * @param $category_id
	 * @return mixed
	 */
	public function deleteByCategoryId($category_id)
	{
		$this->db->where('category_id', $category_id);
		return $this->db->delete($this->table);
	}

	/**
	 * 分类页面批量插入操作
	 * @param       $category_id
	 * @param array $goodsArr
	 * @return mixed
	 */
	public function insertBatchByCategory($category_id, $goodsArr=array())
	{
		$data= array();
		foreach ($goodsArr as $goods_id=>$position) {
			$data[$goods_id]['category_id'] = $category_id;
			$data[$goods_id]['goods_id']    = $goods_id;
			$data[$goods_id]['position']    = $position;
		}
		return $this->db->insert_batch($this->table, $data);
	}
    
    /**
     * 添加产品时批量操作
     * @param unknown $goods_id
     * @param unknown $category_id
     */
    public function insertBatchByGoodsId($goods_id, $categoryArr=array())
	{
		$data= array();
    	foreach ($categoryArr as $key=>$category_id){
			$data[$key]['category_id'] = $category_id;
			$data[$key]['goods_id']    = $goods_id;
			$data[$key]['position']    = 50;
    	}
    	return $this->db->insert_batch($this->table, $data);
    }
}