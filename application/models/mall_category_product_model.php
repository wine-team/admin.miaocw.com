<?php
class Mall_category_product_model extends CI_Model
{
    private $table = 'mall_category_product';
	private $table1 = 'mall_goods_base';

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
     * delete
     * @param unknown $goods_id
     */
    public function deleteByGoodsId($goods_id)
	{
    	$this->db->where('goods_id',$goods_id);
    	return $this->db->delete($this->table);
    }
    
    /**
     * 数组插入
     * @param unknown $goods_id
     * @param unknown $category_id
     */
    public function insertBatch($goods_id,$category_id=array())
	{
    	$insertArray= array();
    	foreach ($category_id as $key=>$item){
    		$insertArray[$key]['category_id'] = $item;
    		$insertArray[$key]['goods_id'] = $goods_id;
    		$insertArray[$key]['position'] = 50;
    	}
    	return $this->db->insert_batch($this->table,$insertArray);
    }

	public function findCategoryProduct($category_id)
	{
		$this->db->from($this->table);
		$this->db->join($this->table1, 'mall_goods_base.goods_id = mall_category_product.goods_id');
		$this->db->where('mall_category_product.category_id', $category_id);
		return $this->db->get();
	}
}