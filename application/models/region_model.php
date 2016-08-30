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
    
    /**
     * 通过数组IDs获取多个地区
     * @param unknown $regionids
     */
    public function getByRegionIds($regionids=array())
    {
        $this->db->where_in('region_id', $regionids);
        $this->db->order_by('region_id', 'ASC');
        return $this->db->get($this->table);
    }
}