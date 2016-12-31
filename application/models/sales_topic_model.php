<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/23
 * Time: 19:49
 */
class Sales_topic_model extends CI_Model
{
    private $_table = 'sales_topic';

    /**
     * 总条数
     * @param $params
     * @return mixed
     */
    public function total($params)
    {
        $this->db->select('sales_id');
        $this->db->from($this->_table);

        if ( !empty($params['sales_name']) ) {
            $this->db->like('sales_name', $params['sales_name']);
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
    public function page_list($params, $page_num, $num)
    {
        $this->db->select('sales_id,status, sales_name, category, union_id, created_at, updated_at');
        $this->db->from($this->_table);

        if ( !empty($params['sales_name']) ) {
            $this->db->like('sales_name', $params['sales_name']);
        }
        if ( !empty($params['status']) ) {
            $this->db->where('status', $params['status']);
        }
        
        $this->db->order_by('created_at','desc');
        $this->db->limit($page_num, $num);

        return $this->db->get();
    }

    /**
     *
     * @param $postData
     * @return mixed
     */
    public function insertSalesTopic($postData, $imageData)
    {
        $data = array(
            'sales_name' => $postData['sales_name'],
            'status'     => $postData['status'],
            'category'   => $postData['category'],
            'union_id'   => $postData['union_id'],
            'image'      => $imageData['file_name'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => '0000-00-00 00:00:00',
        );

        return $this->db->insert($this->_table, $data);
    }

    /**
     * 更新
     * @param $postData
     * @return mixed
     */
    public function updateSalesTopic($postData, $imageData)
    {
        $data = array(
            'sales_name' => $postData['sales_name'],
            'status'     => $postData['status'],
            'category'   => $postData['category'],
            'union_id'   => $postData['union_id'],
        );
        if ( !empty($imageData['file_name']) ) {
            $data['image'] = $imageData['file_name'];
        }
        $this->db->where('sales_id', $postData['sales_id']);

        return $this->db->update($this->_table, $data);
    }

    /**
     * 更新
     * @param $salesId
     * @param $data
     * @return mixed
     */
    public function updateInfo($salesId, $data)
    {
        $this->db->where('sales_id', $salesId);

        return $this->db->update($this->_table, $data);
    }

    /**
     * 删除
     * @param $salesId
     * @return mixed
     */
    public function delete($salesId)
    {
        $this->db->where('sales_id', $salesId);

        return $this->db->delete($this->_table);
    }

    /**
     * 根据ID查找活动
     * @param $salesId
     * @return mixed
     */
    public function findSalesTopicById($salesId)
    {
        $this->db->select('sales_id,status, sales_name, category, union_id, image, created_at, updated_at');
        $this->db->from($this->_table);
        $this->db->where('sales_id', $salesId);
        $this->db->limit(1);

        return $this->db->get();
    }

    /**
     * @descripte      更新图片 管理
     * @Author xiumao
     * @date 2016/5/18 0018 下午 8:55
     */
    public function updateImages($params = array())
    {
        if ( !empty($params['image']) ) {
            $data['image'] = $params['image'];
        }else{
            $data['image'] = "";
        }

        return $this->db->update($this->_table, $data, array('sales_id' => $params['salesId']));
    }


}