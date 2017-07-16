<?php
class User_type_model extends CI_Model
{
    private $table = 'user_type';

    public function find($status=false)
    {
        $this->db->order_by('type_id', 'ASC');
        $result = $this->db->get($this->table);
        if ($status) {
            $rows = array();
            foreach ($result->result_array() as $row) {
                $rows[$row['type_id']] = $row;
            }
            return $rows;
        }
        return $result;
    }
}