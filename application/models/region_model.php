<?php
class Region_model extends CI_Model
{
    private $table = 'region';
 
    function children_of($parent_id)
    {
        $this->db->where('parent_id', (int)$parent_id);
        $result = $this->db->get($this->table);
        if ($result->num_rows() > 0){
            return $result->result_array();
        }
        return array();
    }
}