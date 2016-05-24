<?php

class Mall_freight_price_model extends CI_Model
{

    private $table = 'mall_freight_price';

    public function getFreight($tid, $is_default = 1)
    {
        $this->db->where('freight_id', $tid);
        $this->db->where('is_default', $is_default);
        return $this->db->get($this->table);
    }
}