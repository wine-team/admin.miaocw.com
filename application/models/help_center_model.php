<?php
class Help_center_model extends CI_Model{
	
	private $table = 'help_center';
	
	 /**
	 *  
	 * @param unknown $getData
	 */
	public function total($getData){
		
		if(!empty($getData['sub_title'])){
			$this->db->like('sub_title',$getData['sub_title']);
		}
		if(!empty($getData['category_id'])){
			$this->db->where('help_category_id',$getData['category_id']);
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
		
	    $this->db->select('help_center.*,help_category.help_category_name');
	    $this->db->from($this->table);
	    $this->db->join('help_category','help_category.category_id=help_center.help_category_id');
		if(!empty($getData['sub_title'])){
			$this->db->like('sub_title',$getData['sub_title']);
		}
		if(!empty($getData['category_id'])){
			$this->db->where('help_category_id',$getData['category_id']);
		}
		$this->db->order_by('sort','desc');
		$this->db->limit($page_num,$num);
		return $this->db->get();
	}
	
	/**
	 * 添加
	 * @param unknown $param
	 */
	public function insert($param){
		
		$data = array(
			'help_category_id'  => $param['category_id'],
			'sub_title'         => $param['sub_title'],
		    'author'            => $param['author'],
		    'sort'            => $param['sort'],
			'flag'            => $param['flag'],
			'time'            => date('Y-m-d H:i:s'),
			'help_info'       => $param['help_info'],
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
		
		$this->db->where('id',$id);
		return $this->db->delete($this->table);
	}
	
	public function findById($id){
	
		$this->db->where('id',$id);
		return $this->db->get($this->table);
	}
	
	 /**
	 * 
	 * @param unknown $param
	 */
	public function edit($param){
		
		$data = array(
				
				'sub_title'       => $param['sub_title'],
				'author'          => $param['author'],
				'sort'            => $param['sort'],
				'flag'            => $param['flag'],
				'time'            => date('Y-m-d H:i:s'),
				'help_info'       => $param['help_info'],
		);
		$this->db->where('id',$param['id']);
		return $this->db->update($this->table,$data);
	}
	
	/**
	 * 
	 * @param unknown $id
	 * @param unknown $status
	 */
	public function upFlagById($id,$status){
		
		$data = array(
			'flag'  => $status
		);
		$this->db->where('id',$id);
		return $this->db->update($this->table,$data);
	}
}
