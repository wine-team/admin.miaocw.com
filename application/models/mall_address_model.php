<?php
class Mall_address_model extends CI_Model{
	private $table = 'mall_address';
	
	public function findById($where)
	{
	    return $this->db->get_where($this->table, $where);
	}
	
	public function insert($params=array())
	{
        $data = array(
            'uid'            => $params['uid'],
            'province_id'   => $params['province_id'],
            'province_name' => $params['province_name'],
            'city_id'        => $params['city_id'],
            'city_name'      => $params['city_name'],
            'district_id'   => $params['district_id'],
            'district_name' => $params['district_name'],
            'detailed'       => $params['detailed'],
            'code'            => $params['code'],
            'receiver_name' => $params['receiver_name'],
            'tel'             => $params['code'],
            'is_default'     => $params['is_default'],
        );
	    $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	} 
	
	public function update($where, $data)  
	{
        if (!empty($params['province_id'])) {
            $data['province_id'] = $params['province_id'];
        }
        if (!empty($params['province_name'])) {
            $data['province_name'] = $params['province_name'];
        }
        if (!empty($params['city_id'])) {
            $data['city_id'] = $params['city_id'];
        }
        if (!empty($params['city_name'])) {
            $data['city_name'] = $params['city_name'];
        }
        if (!empty($params['district_id'])) {
            $data['district_id'] = $params['district_id'];
        }
        if (!empty($params['district_name'])) {
            $data['district_name'] = $params['district_name'];
        }
        if (!empty($params['detailed'])) {
            $data['detailed'] = $params['detailed'];
        }
        if (!empty($params['code'])) {
            $data['code'] = $params['code'];
        }
        if (!empty($params['receiver_name'])) {
            $data['receiver_name'] = $params['receiver_name'];
        }
        if (!empty($params['tel'])) {
            $data['tel'] = $params['tel'];
        }
        if (!empty($params['is_default'])) {
            $data['is_default'] = $params['is_default'];
        }
        $this->db->where('address_id', $params['address_id']);
        return $this->db->update($this->table, $data);
	}
	
	public function delete($where)  
	{
	    $this->db->delete($this->table, $where);
	    return $this->db->affected_rows();
	}
}

/* End of file Help_center_model.php */
/* Location: ./application/models/Help_center_model.php */