<?php
class Region_model extends CI_Model
{
    private $table = 'region';
    public function findById($id)
    {
        $this->db->where('region_id', $id);
        return $this->db->get($this->table);
    }
    
    public function findByAutocomplete($region_type)
    {
        $this->db->select('region_name, region_pinyin, region_abbr');
        $this->db->where('region_type', $region_type);
        return $this->db->get($this->table);
    }
    
    public function total($parent_id, $region_type)
    {
        $this->db->where('parent_id', $parent_id);
        $this->db->where('region_type', $region_type);
        return $this->db->count_all_results($this->table);
    }
    
    public function page_list($num, $parent_id, $region_type)
    {
        $this->db->where('parent_id', $parent_id);
        $this->db->where('region_type', $region_type);
        $this->db->order_by('region_id','desc');
        $this->db->limit(20, $num);
        return $this->db->get($this->table);
    }
    
    public function insertRegion($postData)
    {
        $data = array(
            'parent_id'     => $postData['parent_id'],
            'region_name'   => $postData['region_name'],
            'region_pinyin' => $postData['region_pinyin'],
            'region_abbr'   => $postData['region_abbr'],
            'region_type'   => $postData['region_type'],
        );
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateRegion($postData)
    {
        $data = array(
            'region_name'   => $postData['region_name'],
            'region_pinyin' => $postData['region_pinyin'],
            'region_abbr'   => $postData['region_abbr']
        );
    
        $this->db->where('region_id', $postData['region_id']);
        return $this->db->update($this->table, $data);
    }
    
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
     * 获取所有国家的省市区
     * @return multitype:unknown
     */
    public function getNewRegion()
    {
        $result = $this->db->get($this->table);
        $rows = array();
        foreach ($result->result_array() as $row) {
            $rows[$row['region_id']] = $row;
        }
        return $rows;
    }
    
    /**
     * 只获取中国的省市区
     * @return multitype:unknown
     */
    public function getChinaRegion($isArray=false)
    {
        $this->db->where('region_id <', 3634); //只取中国的省市区
        $result = $this->db->get($this->table);
        if ($isArray) {
            $rows = array();
            foreach ($result->result_array() as $row) {
                $rows[$row['region_id']] = $row;
            }
            return $rows;
        }
        return $result;
    }
    
    public function getByRegionIds($regionids=array())
    {
        $this->db->where_in('region_id', $regionids);
        $this->db->order_by('region_id', 'ASC');
        return $this->db->get($this->table);
    }
    
    public function getRegionParams($params)
    {
        if (!empty($params['parent_id'])) {
            $this->db->where('parent_id', $params['parent_id']);
        }
        if (!empty($params['region_type'])) {
            $this->db->where('region_type', $params['region_type']);
        }
        return $this->db->get($this->table);
    }
    
    public function totalByArray($getData)
    {
        if (!empty($getData['region_name'])) {
            $this->db->like('region_name', $getData['region_name']);
        }
        if (!empty($getData['region_type'])) {
            $this->db->where('region_type', $getData['region_type']);
        }
        return $this->db->count_all_results($this->table);
    }
    
    public function findByArray($num,$getData)
    {
        if (!empty($getData['region_name'])) {
            $this->db->like('region_name', $getData['region_name']);
        }
        if (!empty($getData['region_type'])) {
            $this->db->where('region_type', $getData['region_type']);
        }
        $this->db->limit(20, $num);
        return $this->db->get($this->table);
    }
    
}