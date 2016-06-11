<?php
class Mall_attribute_set_model extends CI_Model
{
	private $table = 'mall_attribute_set'; 
	private $table1 = 'mall_attribute_value';
<<<<<<< HEAD
	
	public function find($isArray=fasle)
	{
	    $this->db->where('enabled', 1);
	    $result = $this->db->get($this->table);
	    if ($isArray) {
	        $rows = array();
	        foreach ($result->result_array() as $row) {
	            $rows[$row['attr_set_id']] = $row;
	        }
	        return $rows;
	    }
	    return $result;
	}
=======

	public function find($isArray=fasle)
	{

		$this->db->where('enabled', 1);
		$result = $this->db->get($this->table);
		if ($isArray) {
			$rows = array();
			foreach ($result->result_array() as $row) {
				$rows[$row['attr_set_id']] = $row;
			}
			return $rows;
		}
		return $result;
	}

>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c
	public function findById($attr_set_id)
	{
		$this->db->where('attr_set_id', $attr_set_id);
		return $this->db->get_where($this->table);
	}

	public function total($params=array())
	{
		$this->db->from($this->table);
		if (!empty($params['attr_set_name'])) {
			$this->db->where('attr_set_name', $params['attr_set_name']);
		}
		return $this->db->count_all_results();
	}

	public function page_list($page_num, $num, $params=array())
	{
		$this->db->from($this->table);
		if (!empty($params['attr_set_name'])) {
			$this->db->where('attr_set_name', $params['attr_set_name']);
		}
		$this->db->order_by('attr_set_id', 'DESC');
		$this->db->limit($page_num, $num);
		return $this->db->get();
	}
	
	public function insert($postData = array())
	{
		$data = array(
			'attr_set_name' => $postData['attr_set_name'],
			'enabled'        => $postData['enabled'],
		);
	    $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	} 
	
	public function updateAttributeSet($postData = array())
	{
		$data = array(
			'attr_set_name' => $postData['attr_set_name'],
			'enabled'        => $postData['enabled'],
		);
		$this->db->where('attr_set_id', $postData['attr_set_id']);
		return $this->db->update($this->table, $data);
	}

	 /**
	 * 
	 * @param unknown $param
	 */
	public function findByReason($param)
	{
		if(!empty($param['enabled'])){
			$this->db->where('enabled',$param['enabled']);
		}
		return $this->db->get($this->table);
	}
}