<?php
class Advert_model extends CI_Model
{
    private $table = 'advert';
    public function total($params=array()) 
    {
        if (!empty($params['title'])) {
            $this->db->like('title', $params['title']);
        }
        if (!empty($params['source_state'])) {
            $this->db->where('source_state', $params['source_state']);
        }
        if (!empty($params['flag'])) {
            $this->db->where('flag', $params['flag']);
        }
        return $this->db->count_all_results($this->table);
    }

    public function page_list($page_num, $num, $params=array())
    {
        if (!empty($params['title'])) {
            $this->db->like('title', $params['title']);
        }
        if (!empty($params['source_state'])) {
            $this->db->where('source_state', $params['source_state']);
        }
        if (!empty($params['flag'])) {
            $this->db->where('flag', $params['flag']);
        }
        $this->db->order_by('advert_id','DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get($this->table);
    }
    
    public function insertIntoAdvert($postData, $imageData)
    {
        $data = array(
            'source_state' => $postData['source_state'],
            'title'        => trim($postData['title']),
            'url'          => trim($postData['url'])
        );
        if (!empty($imageData['file_name'])) {
            $data['picture'] = $imageData['file_name'];
        }
        if (!empty($postData['sort'])) {
            $data['sort'] = $postData['sort'];
        }
        if (!empty($postData['description'])) {
            $data['description'] = $postData['description'];
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateInfoAdvert($postData, $imageData)
    {
        $data = array(
            'source_state' => $postData['source_state'],
            'title'        => trim($postData['title']),
            'url'          => trim($postData['url'])
        );
        if (!empty($imageData['file_name'])) {
            $data['picture'] = $imageData['file_name'];
        }
        if (!empty($postData['sort'])) {
            $data['sort'] = $postData['sort'];
        }
        if (!empty($postData['description'])) {
            $data['description'] = $postData['description'];
        }
        $this->db->where('advert_id', $postData['advert_id']);
        return $this->db->update($this->table, $data);
    }
    
    public function updateAdvert($params=array())
    {
        if (!empty($params['source_state'])) {
            $data['source_state'] = $params['source_state'];
        }
        if (!empty($params['url'])) {
            $data['url'] = $params['url'];
        }
        if (!empty($params['title'])) {
            $data['title'] = $params['title'];
        }
        if (!empty($params['flag'])) {
            $data['flag'] = $params['flag'];
        }
        if (!empty($params['sort'])) {
            $data['sort'] = $params['sort'];
        }
        if (!empty($params['description'])) {
            $data['description'] = $params['description'];
        }
        $this->db->where('advert_id', $params['advert_id']);
        return $this->db->update($this->table, $data);
    }
    
    public function deleteById($id)
    {
        $this->db->where('advert_id', $id);
        return $this->db->delete($this->table);
    }
    
    public function findById($id)
    {
        $this->db->where('advert_id', $id);
        return $this->db->get($this->table);
    }
}