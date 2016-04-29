<?php
class User_type_model extends CI_Model
{
    private $table = 'user_type';

    public function get_list()
    {
        $this->db->from($this->table);
        $this->db->order_by('user_type_id','ASC');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        return false;
    }

    public function find()
    {
        $this->db->order_by('user_type_id','asc');
        return $this->db->get($this->table);
    }
}