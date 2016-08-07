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
	public function insert($postData=array())
	{
		$data = array(
			'cat_name'          => $postData['cat_name'],
			'parent_id'         => !empty($postData['parent_id']) ? $postData['parent_id'] : 0,
			'is_show'           => $postData['is_show'],
			'block_id'          => !empty($postData['block_id']) ? $postData['block_id'] : '',
			'cat_img'           => !empty($postData['cat_img']) ? $postData['cat_img'] : '',
			'special_name'     => !empty($postData['special_name']) ? $postData['special_name'] : '',
			'full_name'         => $postData['full_name'],
			'page_title'        => !empty($postData['page_title']) ? $postData['page_title'] : '',
			'meta_keywords'     => !empty($postData['meta_keywords']) ? $postData['meta_keywords'] : '',
			'meta_description' => !empty($postData['meta_description']) ? $postData['meta_description'] : '',
			'sort_order'        => !empty($postData['sort_order']) ? $postData['sort_order'] : 50,
			'created_at'        => date('Y-m-d H:i:s'),
		);
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function update($postData=array())
	{
		$data = array(
			'cat_name'          => $postData['cat_name'],
			'is_show'           => $postData['is_show'],
			'block_id'          => !empty($postData['block_id']) ? $postData['block_id'] : '',
			'cat_img'           => !empty($postData['cat_img']) ? $postData['cat_img'] : '',
			'special_name'     => !empty($postData['special_name']) ? $postData['special_name'] : '',
			'full_name'         => $postData['full_name'],
			'page_title'        => !empty($postData['page_title']) ? $postData['page_title'] : '',
			'meta_keywords'     => !empty($postData['meta_keywords']) ? $postData['meta_keywords'] : '',
			'meta_description' => !empty($postData['meta_description']) ? $postData['meta_description'] : '',
			'sort_order'        => !empty($postData['sort_order']) ? $postData['sort_order'] : 50,
		);
		$this->db->where('cat_id', $postData['cat_id']);
		$this->db->update($this->table, $data);
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