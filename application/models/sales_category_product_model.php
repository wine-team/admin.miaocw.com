<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/24
 * Time: 14:45
 */
class Sales_category_product_model extends CI_Model
{
    private $_table = 'sales_category_product';

    /**
     * 根据分类id来查找
     * @param $categoryId
     * @return mixed
     */
    public function findByCategoryId($categoryId)
    {
        $this->db->select('id, product_id, sort');
        $this->db->from($this->_table);
        $this->db->where('category_id', $categoryId);

        return $this->db->get();
    }

    /**
     * 批量添加
     * @param $postData
     * @return mixed
     */
    public function insertBatch($categoryId, $postData)
    {
        $data = array();
        foreach( $postData['product_id'] as $key=>$value ) {
            $data[$key]['product_id'] = $value;
            $data[$key]['sort'] = $postData['sort'][$key];
            $data[$key]['category_id'] = $categoryId;
            $data[$key]['created_at'] = date('Y-m-d H:i:s');
        }
        return $this->db->insert_batch($this->_table, $data);
    }

    /**
     * 批量更新
     * @param $postData
     * @return mixed
     */
    public function updateBatch($postData)
    {
        $data = array();
        foreach( $postData as $key=>$value ) {
            $data[$key]['id'] = $value['id'];
            $data[$key]['product_id'] = $value['product_id'];
            $data[$key]['sort'] = $value['sort'];
        }
        return $this->db->update_batch($this->_table, $data, 'id');
    }

    /**
     * 删除
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

    /**
     * 删除分类下所有关联的产品
     * @param $categoryId
     * @return mixed
     */
    public function deleteByCategoryId($categoryId)
    {
        $this->db->where_in('category_id', $categoryId);
        return $this->db->delete($this->_table);
    }

}