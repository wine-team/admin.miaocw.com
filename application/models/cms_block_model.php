<?php
class Cms_block_model extends CI_Model
{
    private $table = 'cms_block';

    public function findByParams($params=array())
    {
        return $this->db->get($this->table);
    }

    public function total($params=array())
    {
        if (!empty($params['blockname'])) {
            $this->db->like('name', $params['blockname']);
            $this->db->or_like('block_id', $params['blockname']);
        }
        return $this->db->count_all_results($this->table);
    }
    
    public function page_list($page_num, $num, $params=array())
    {
        if (!empty($params['blockname'])) {
            $this->db->like('name', $params['blockname']);
            $this->db->or_like('block_id', $params['blockname']);
        }
        $this->db->order_by('id','DESC');
        $this->db->limit(20, $num);
        return $this->db->get($this->table);
    }
    
    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }
    
    public function insertCmsBlock($postData)
    {
        $data = array(
            'name'        => trim($postData['name']),
            'block_id'    => trim($postData['block_id']),
            'description' => $postData['description']
        );
    
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateCmsBlock($postData)
    {
        $data = array(
            'name'        => trim($postData['name']),
            'description' => $postData['description'],
            'updated_at'  => date('Y-m-d H:i:s', time())
        );
    
        $this->db->where('id', $postData['id']);
        return $this->db->update($this->table, $data);
    }
    
    public function validateBlockId($blockId)
    {
        $this->db->where('block_id', $blockId);
        if ($this->db->count_all_results($this->table) > 0) {
            return true;
        }
        return false;
    }
    
    public function deleteById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    public function findByBlockId($blockId)
    {
        $this->db->where('block_id', $blockId);
        $result = $this->db->get($this->table);
        if($result->num_rows() > 0) {
            return $result;
        }
        return false;
    }
}