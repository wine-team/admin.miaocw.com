<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/23
 * Time: 20:38
 */
class sales_topic_category_model extends CI_Model
{
    private $_table = 'sales_topic_category';

    /**
     * 总条数
     * @param $params
     * @return mixed
     */
    public function total($params)
    {
        $this->db->select('category_id');
        $this->db->from($this->_table);
        $this->db->where('sales_id', $params['sales_id']);
        if ( !empty($params['title']) ) {
            $this->db->like('title', $params['title']);
        }
        if ( !empty($params['status']) ) {
            $this->db->where('status', $params['status']);
        }

        return $this->db->count_all_results();
    }

    /**
     * 搜索列表
     * @param $params
     * @param $page_num
     * @param $num
     * @return mixed
     */
    public function page_list($params, $page_num, $num){
        $this->db->select('category_id, sales_id,status, type,link_url, title, note, created_at, updated_at');
        $this->db->from($this->_table);

        $this->db->where('sales_id', $params['sales_id']);
        if ( !empty($params['title']) ) {
            $this->db->like('title', $params['title']);
        }
        if ( !empty($params['status']) ) {
            $this->db->where('status', $params['status']);
        }
        $this->db->order_by('sort ASC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

    /**
     * 查找
     * @param $categoryId
     * @return mixed
     */
    public function findByCategoryId($categoryId)
    {
        $this->db->select('category_id, sales_id,status, type,link_url, title, note, sort, created_at, updated_at');
        $this->db->from($this->_table);
        $this->db->where('category_id', $categoryId);
        $this->db->limit(1);
        return $this->db->get();
    }

    /**
     *
     * @param $postData
     * @return mixed
     */
    public function insertSalesTopicCategory($postData)
    {
        $data = array(
            'title'         => $postData['title'],
            'note'          => $postData['note'],
            'status'        => $postData['status'],
            'type'          => $postData['type'],
        	'link_url'      => $postData['link_url'],
            'sales_id'      => $postData['sales_id'],
            'sort'          => $postData['topic_sort'],
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => '0000-00-00 00:00:00'
        );
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    /**
     * 更新
     * @param $postData
     * @return mixed
     */
    public function updateSalesTopicCategory($postData)
    {
        $data = array(
            'title'  => $postData['title'],
            'note'   => $postData['note'],
        	'link_url' => $postData['link_url'],
            'sort'   => $postData['topic_sort'],
            'status' => $postData['status']
        );
        $this->db->where('category_id', $postData['category_id']);
        return $this->db->update($this->_table, $data);
    }

    /**
     * 更新
     * @param $salesId
     * @param $data
     * @return mixed
     */
    public function updateInfo($categoryId, $data)
    {
        $this->db->where('category_id', $categoryId);
        return $this->db->update($this->_table, $data);
    }

    /**
     * 删除
     * @param $salesId
     * @return mixed
     */
    public function delete($categoryId)
    {
        $this->db->where('category_id', $categoryId);
        return $this->db->delete($this->_table);
    }

}