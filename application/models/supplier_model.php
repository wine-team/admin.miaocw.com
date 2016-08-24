<?php
class Supplier_model extends CI_Model
{
	private $table = 'supplier';
	private $table1 = 'user';

	public function findById($supplier_id)
	{
		$this->db->where('supplier_id', $supplier_id);
		return $this->db->get($this->table);
	}

	public function total($params=array())
	{
		$this->db->from($this->table1);
		$this->db->join($this->table, 'user.uid=supplier.uid', 'INNER');
		if (!empty($params['supplier_id'])) {
			$this->db->where('supplier_id', $params['supplier_id']);
		}
		if (!empty($params['phone'])) {
			$this->db->where('user.phone', $params['phone']);
		}
		if (!empty($params['uid'])) {
			$this->db->where('user.uid', $params['uid']);
		}
		if (!empty($params['supplier_name'])) {
			$this->db->like('supplier.supplier_name', $params['supplier_name']);
		}
		if (!empty($params['is_check'])) {
			$this->db->like('supplier.is_check', $params['is_check']);
		}
		return $this->db->count_all_results();
	}

	public function page_list($page_num, $num, $params=array())
	{
		$this->db->select('user.*, supplier.supplier_id, supplier.supplier_name, supplier.is_check, supplier.apply_time');
		$this->db->from($this->table1);
		$this->db->join($this->table, 'user.uid=supplier.uid', 'INNER');
		if (!empty($params['supplier_id'])) {
			$this->db->where('supplier_id', $params['supplier_id']);
		}
		if (!empty($params['phone'])) {
			$this->db->where('user.phone', $params['phone']);
		}
		if (!empty($params['uid'])) {
			$this->db->where('user.uid', $params['uid']);
		}
	    if (!empty($params['supplier_name'])) {
	        $this->db->like('supplier.supplier_name', $params['supplier_name']);
	    }
		if (!empty($params['is_check'])) {
			$this->db->like('supplier.is_check', $params['is_check']);
		}
	    $this->db->order_by('user.uid', 'DESC');
	    $this->db->limit($page_num, $num);
	    return $this->db->get();
	}

	public function findByUid($uid)
	{
	    return $this->db->get_where($this->table, array('uid'=>$uid));
	}
	
	public function insertSupplier($postData) 
	{
	    $data = array(
	        'supplier_name' => $postData['supplier_name'],
	        'supplier_desc' => $postData['supplier_desc'],
	        'uid'           => $postData['uid'],
	        'is_check'      => $postData['is_check'],
	        'created_at'    => date('Y-m-d H:i:s'),
	    );
	    $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	} 
	
	public function updateSupplier($postData)  
	{
	    $data = array(
	        'supplier_name' => $postData['supplier_name'],
	        'supplier_desc' => $postData['supplier_desc'],
	        'uid'           => $postData['uid'],
	        'is_check'      => $postData['is_check'],
	    );
	    $this->db->update($this->table, $data, array('supplier_id'=>$postData['supplier_id']));
	    return $this->db->affected_rows();
	}
	
	public function delete($where)  
	{
	    $this->db->delete($this->table, $where);
	    return $this->db->affected_rows();
	}
	
}

/* End of file Supplier_model.php */
/* Location: ./application/models/Supplier_model.php */