<?php
class Link_model extends CI_Model
{
    private $table = 'link';
    
    public function find()
    {
        return $this->db->get($this->table);
    }
    
    public function total()
    {
        return $this->db->count_all_results($this->table);
    }
    
    public function page_list($num)
    {
        $this->db->order_by('id','desc');
        $this->db->limit(20, $num);
        return $this->db->get($this->table);
    }
    
    public function insertLink($postData)
    {
        $data = array(
            'name' => $postData['name'],
            'url' => $postData['url'],
            'sort'=> $postData['sort']
        );
    
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateLink($postData)
    {
        $data = array(
            'name' => $postData['name'],
            'url' => $postData['url'],
            'sort'=> $postData['sort']
        );
        $this->db->where('id', $postData['id']);
        return $this->db->update($this->table, $data);
    }
    
    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }
    
    public function deleteById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}