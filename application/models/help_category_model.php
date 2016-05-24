<?php
class Help_category_model extends CI_Model{
	
	private $table = 'help_category';
	
	 /**
	 *  
	 * @param unknown $getData
	 */
	public function total($getData){
		
		if(!empty($getData['category_name'])){
			$this->db->where('help_category_name',$getData['category_name']);
		}
		return $this->db->count_all_results($this->table);
	}
	
	 /**
	 * 
	 * @param unknown $num
	 * @param unknown $page_num
	 * @param unknown $getData
	 */
	public function pg_list($num, $page_num, $getData){
		
		if( !empty($getData['category_name']) ){
			$this->db->where('help_category_name',$getData['category_name']);
		}
		$this->db->order_by('sort','desc');
		$this->db->limit($page_num,$num);
		return $this->db->get($this->table);
	}
	
	/**
	 * 添加
	 * @param unknown $param
	 */
	public function insert($param){
		
		$data = array(
			'help_category_name'  => $param['help_category_name'],
		    'flag'                => $param['flag'],
			'sort'                => $param['sort'],
		    'creat_at'            => date('Y-m-d H:i:s')
		);
		return $this->db->insert($this->table,$data);
	}
	
	/**
	 * 获取值
	 * @param unknown $id
	 */
	public function findResultById($id){
		
		$this->db->where('category_id',$id);
		return $this->db->get($this->table);
	}
	
	 /**
	 * 
	 * @param unknown $param
	 */
	public function update($param){
		
		$data = array(
			'help_category_name' => $param['help_category_name'],
			'flag'               => $param['flag'],
		    'sort'               => $param['sort']
		);
		$this->db->where('category_id',$param['category_id']);
		return $this->db->update($this->table,$data);
	}
	
	 /**
	 * 删除
	 * @param unknown $id
	 */
	public function deleteById($id){
		
		$this->db->where('category_id',$id);
		return $this->db->delete($this->table);
	}
}
