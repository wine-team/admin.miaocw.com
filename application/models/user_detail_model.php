<?php
class user_detail_model extends CI_Model
{
    private $table = 'user_detail';
    
    public function add($postData, $uid)
    {
        $data = array(
            'uid'            => $uid,
            'pay_method'     => 0,
            'bank_account'   => 0,
            'company'        => $postData['company'],
            'business_licen' => $postData['business_licen'],
            'address'        => $postData['address'],
            'telephone'      => $postData['telephone'],
            'fax'            => $postData['fax'],
            'contacter'      => $postData['contacter'],
            'sfz'            => $postData['sfz'],
            'cellphone'      => $postData['cellphone'],
            'email'          => $postData['email'],
            'regtime'        => time(),
            'cellphone'      => $postData['cellphone'],
            'url'            => $postData['url'],
            'area_id'        => 0,
            'order_url'      => $postData['order_url']
        );
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($postData)
    {
        $data = array(
            'company'        => $postData['company'],
            'business_licen' => $postData['business_licen'],
            'address'        => $postData['address'],
            'telephone'      => $postData['telephone'],
            'fax'            => $postData['fax'],
            'contacter'      => $postData['contacter'],
            'sfz'            => $postData['sfz'],
            'cellphone'      => $postData['cellphone'],
            'email'          => $postData['email'],
            'cellphone'      => $postData['cellphone'],
            'url'            => $postData['url'],
            'order_url'      => $postData['order_url']
        );
        $this->db->where('uid', $postData['uid']);
        return $this->db->update($this->table, $data);
    }
    
    public function delete($uid)
    {
        $this->db->where('uid', $uid);
        return $this->db->delete($this->table);
    }
}