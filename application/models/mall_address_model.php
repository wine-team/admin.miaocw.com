<?php

class Mall_address_model extends CI_Model{
    
	private $table = 'mall_address';
	
	public function _init()
	{
	    $this->load->model('region_model', 'region');
	}
	
	public function findById($address_id)
	{
	    return $this->db->get_where($this->table, array('address_id'=>$address_id));
	}
	
	public function findByUid($uid)
	{
	    return $this->db->get_where($this->table, array('uid'=>$uid));
	}
	
	public function insertMallAddress($postData) 
	{
	    $this->load->model('region_model', 'region');
	    $region = $this->region->getByRegionIds(array($postData['province_id'], $postData['city_id'], $postData['district_id']))->result();
	    $data = array(
	        'uid'              => $postData['uid'],
	        'province_id'      => $postData['province_id'],
	        'province_name'    => $region[0]->region_name,
	        'city_id'          => $postData['city_id'],
	        'city_name'        => $region[1]->region_name,
	        'district_id'      => $postData['district_id'],
	        'district_name'    => $region[2]->region_name,
	        'detailed'         => $postData['detailed'],
	        'code'             => $postData['code'],
	        'receiver_name'    => $postData['receiver_name'],
	        'tel'              => $postData['tel'],
	        'code'             => $postData['code'],
	        'is_default'       => $postData['is_default'],
	    );
	    $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}
	
	/**
	 * 更新为非默认
	 * */
	public function setNoDefault($uid)
	{
	    $this->db->update($this->table, array('is_default'=>1), array('uid'=>$uid));
	    return $this->db->affected_rows();
	}
	
	public function updateMallAddress($postData)  
	{
	    $region = $this->region->getByRegionIds(array($postData['province_id'], $postData['city_id'], $postData['district_id']))->result();
	    $data = array(
	        'province_id'      => $postData['province_id'],
	        'province_name'    => $region[0]->region_name,
	        'city_id'          => $postData['city_id'],
	        'city_name'        => $region[1]->region_name,
	        'district_id'      => $postData['district_id'],
	        'district_name'    => $region[2]->region_name,
	        'detailed'         => $postData['detailed'],
	        'code'             => $postData['code'],
	        'receiver_name'    => $postData['receiver_name'],
	        'tel'              => $postData['tel'],
	        'code'             => $postData['code'],
	        'is_default'       => $postData['is_default'],
	    );
	    $this->db->update($this->table, $data, array('address_id'=>$postData['address_id']));
	    return $this->db->affected_rows();
	}
	
	public function delete($where)  
	{
	    $this->db->delete($this->table, $where);
	    return $this->db->affected_rows();
	}
	
}


/* End of file Mall_address_model.php */
/* Location: ./application/models/Mall_address_model.php */