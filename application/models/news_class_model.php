<?php
class News_class_model extends CI_Model
{
    private $table = 'news_class';
    
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
        $this->db->order_by('sort','desc');
        $this->db->limit(20, $num);
        return $this->db->get($this->table);
    }
    
    public function insertNewsclass($postData)
    {
        $data = array(
            'class_name' => $postData['class_name'],
            'sort' => $postData['sort'],
            'status'  => $postData['status'],
        );
    
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateNewsclass($postData)
    {
        $data = array(
            'class_name'     => $postData['class_name'],
            'sort' => $postData['sort'],
            'status'  => $postData['status'],
        );
        $this->db->where('class_id', $postData['class_id']);
        return $this->db->update($this->table, $data);
    }
    
    public function findById($id)
    {
        $this->db->where('class_id', $id);
        return $this->db->get($this->table);
    }
    
    public function deleteById($id)
    {
        $this->db->where('newsClassId', $id);
        return $this->db->delete($this->table);
    }
}