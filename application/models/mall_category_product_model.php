<?php
class Mall_category_product_model extends CI_Model
{
    private $table = 'mall_category_product';
    
     /**
     * 
     * @param unknown $param
     */
    public function insert($goods_id,$category_id){
    	 
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
    public function deleteByGoodsId($goods_id){
    	
    	$this->db->where('goods_id',$goods_id);
    	return $this->db->delete($this->table);
    }
}