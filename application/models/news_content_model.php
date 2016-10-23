<?php
class News_content_model extends CI_Model
{
    private $table = 'news_content';
    private $table_2 = 'news_class';
    
    public function total()
    {
        $this->db->select('*');
        $this->db->from($this->table.' as news');
        $this->db->join($this->table_2.' as newsclass', 'news.class_id = newsclass.class_id');
        return $this->db->count_all_results();
    }
    
    public function page_list($num)
    {
        $this->db->select('*, news.status as nstatus');
        $this->db->from($this->table.' as news');
        $this->db->join($this->table_2.' as newsclass', 'news.class_id = newsclass.class_id');
        $this->db->order_by('id','desc');
        $this->db->limit(20, $num);
        return $this->db->get();
    }
    
    public function search_total($search_param)
    {
        $this->db->select('*');
        $this->db->from($this->table.' as news');
        $this->db->join($this->table_2.' as newsclass', 'news.class_id = newsclass.class_id');
        if (!empty($search_param['title'])) {
            $this->db->like('title', $search_param['title']);
        }
        if (!empty($search_param['class_id'])) {
            $this->db->where('news.class_id', $search_param['class_id']);
        }
        if (!empty($search_param['status'])) {
            $this->db->where('news.status', $search_param['status']);
        }
        return $this->db->count_all_results();
    }
    
    public function search_page_list($num, $search_param)
    {
        $this->db->select('*, news.status as nstatus');
        $this->db->from($this->table.' as news');
        $this->db->join($this->table_2.' as newsclass', 'news.class_id = newsclass.class_id');
            if (!empty($search_param['title'])) {
            $this->db->like('title', $search_param['title']);
        }
        if (!empty($search_param['class_id'])) {
            $this->db->where('news.class_id', $search_param['class_id']);
        }
        if (!empty($search_param['status'])) {
            $this->db->where('news.status', $search_param['status']);
        }
        $this->db->order_by('id','desc');
        $this->db->limit(20, $num);
        return $this->db->get();
    }
    
    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }
    
    public function insertNews($postData)
    {
        $data = array(
            'title'        => $postData['title'],
            'content'      => $postData['content'],
            'class_id'     => $postData['class_id'],
            'status'       => $postData['status'],
            'author'       => $postData['author'],
            'pv'           => rand(50, 300),
            'create_time'  => time(),
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function updateNews($postData)
    {
        $data = array(
            'title'        => $postData['title'],
            'content'      => $postData['content'],
            'class_id'     => $postData['class_id'],
            'status'       => $postData['status'],
            'author'       => $postData['author'],
            'edit_time'    => time(),
        );
        $this->db->where('id', $postData['id']);
        return $this->db->update($this->table, $data);
    }
    
    public function deleteById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * @descripte   修改图片
     * @Author xiumao
     * @date 2016/7/26 上午 10:15
     */
    public function updateImages($params=array())
    {
        if (!empty($params['image'])) {
            $data['image'] = $params['image'];
        }
        return $this->db->update($this->table, $data, array('id' => $params['id']));
    }
}