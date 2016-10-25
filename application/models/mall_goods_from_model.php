<?php
class Mall_goods_from_model extends CI_Model
{
    private $table = 'mall_goods_from';

    public function find($isArray=FALSE)
    {
        $result = $this->db->get($this->table);
        if ($isArray) {
            $rows = array();
            foreach ($result->result() as $item) {
                $rows[$item->from_id] = $item;
            }
            return $rows;
        }
        return $result;
    }

    public function total($params=array())
    {
        if (!empty($params['from_name'])) {
            $this->db->like('from_name', $params['from_name']);
        }
        return $this->db->count_all_results($this->table);
    }

    public function page_list($page_num, $num, $params=array())
    {
    	if (!empty($params['from_name'])) {
            $this->db->like('from_name', $params['from_name']);
        }
        $this->db->order_by('from_id', 'desc');
        $this->db->limit($page_num, $num);
        return $this->db->get($this->table);
    }
    
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    } 
    
    public function update($where, $data)  
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    
    public function delete($where)  
    {
        $this->db->delete($this->table, $where);
        return $this->db->affected_rows();
    }
    
     /**
     * 获取来源
     * @param unknown $param
     * @param unknown $f
     */
    public function findFromByRes($param=array(), $f='*')
    {

        $this->db->select($f);
    	if (!empty($param['from_name'])) {
    		$this->db->where('from_name',$param['from_name']);
    	}
    	if (!empty($param['from_id'])) {
    		$this->db->where('from_id',$param['from_id']);
    	}
        return $this->db->get($this->table);
    }
}