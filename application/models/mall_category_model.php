<?php
class Mall_category_model extends CI_Model
{
	private $table = 'mall_category';        
	private $categorys;

	public function findById($cat_id)
	{
		$this->db->where('cat_id', $cat_id);
	    return $this->db->get($this->table);
	}

	public function findByParams($params = array())
	{
		if (!empty($params['cat_id'])) {
			$this->db->where('cat_id', $params['cat_id']);
		}
		if (!empty($params['parent_id'])) {
			$this->db->where('parent_id', $params['parent_id']);
		}
		if (!empty($params['cat_name'])) {
			$this->db->like('cat_name', $params['cat_name']);
		}
		if (!empty($params['is_show'])) {
			$this->db->where('is_show', $params['is_show']);
		}
		$this->db->order_by('parent_id', 'ASC');
		return $this->db->get($this->table);
	}

	/**
	 * 获取所有category分类别表
	 * @return array|null
	 */
	public function findByCategoryTree()
	{
		if (!empty($params['cat_id'])) {
			$this->db->where('cat_id', $params['cat_id']);
		}
		if (!empty($params['parent_id'])) {
			$this->db->where('parent_id', $params['parent_id']);
		}
		if (!empty($params['cat_name'])) {
			$this->db->like('cat_name', $params['cat_name']);
		}
		if (!empty($params['is_show'])) {
			$this->db->where('is_show', $params['is_show']);
		}
		$this->db->order_by('parent_id', 'ASC');
		$result = $this->db->get($this->table);
		$this->categorys = $result->result();
		return $this->getBuildTree();
	}

	private function getBuildTree($cat_id=0)
	{
		$childs = $this->findChildCategory($this->categorys, $cat_id);
		if (empty($childs)) {
			return null;
		}
		foreach ($childs as $k => $v) {
			$rescurTree = $this->getBuildTree($v->cat_id);
			if ( null != $rescurTree) {
				$childs[$k]->childs = $rescurTree;
			}
		}
		return $childs;
	}

	private function findChildCategory(&$categorys, $cat_id)
	{
		$childs = array();
		foreach ($categorys as $k => $v) {
			if ($v->parent_id == $cat_id) {
				$childs[] = $v;
			}
		}
		return $childs;
	}

	public function getWherein($item,$arr) 
	{
	    $this->db->where_in($item, $arr);
		return $this->db->get($this->table);
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
     *  分类的添加
     * @param number $parent_id
     * @return multitype:
     */
	public function getCategoryLevel($parent_id=0)
	{
		$this->db->where('parent_id', $parent_id);
		$result = $this->db->get($this->table);
		if ($result->num_rows() > 0){
			return $result->result_array();
		}
		return array();
	}
	
	 /**
	 *获取所有的分类
	 */
	public function getAllCategory(){
		
		$this->db->where('is_show',1);
		$category = $this->db->get($this->table);
		$firstCat = array();
		foreach ($category->result() as $key=>$val) {
			if (($val->cat_type==1) && ($val->parent_id==0) ) {
				$firstCat[$key]['cat_id'] = $val->cat_id;
				$firstCat[$key]['cat_name'] = $val->cat_name;
				$firstCat[$key]['childCat'][0]['cat_id'] = $val->cat_id;
				$firstCat[$key]['childCat'][0]['cat_name'] = $val->cat_name;
			}
		}
		foreach ($firstCat as $key=>$item){
			foreach ($category->result() as $ikey=>$jitem) {
					if( $jitem->parent_id == $item['cat_id'] ){
						$firstCat[$key]['childCat'][$ikey+1]['cat_id'] = $jitem->cat_id;
						$firstCat[$key]['childCat'][$ikey+1]['cat_name'] = $jitem->cat_name;
					}
			}
		}
		return $firstCat;
	}
	
	/**
	 * 根据cat_id
	 * @param unknown $param
	 */
	public function getCategoryByCatId($param = array())
	{
		if (!empty($param['category_id'])){
			$category_id = array_filter(explode(',',$param['category_id']));
			$this->db->where_in('cat_id',$category_id);
		}
		$result = $this->db->get($this->table);
		$cat_name = array();
		if ( $result->num_rows()>0 ) {
			foreach ($result->result() as $key=>$item){
				$cat_name[] = $item->cat_name;
			}
		}
		return $cat_name;
	}
}

/* End of file Mall_category_model.php */
/* Location: ./application/models/Mall_category_model.php */