<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/23
 * Time: 19:44
 */
class Salestopic extends MJ_Controller
{
    public function _init()
    {   
        $this->load->library('pagination');
        $this->load->model('sales_topic_model', 'sales_topic');
    }

    public function index($pg = 1)
    {   
        $page_num = 20;
        $num = ($pg - 1) * $page_num;
        $config['first_url'] = base_url('salestopic/index') . $this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('salestopic/index');
        $config['total_rows'] = $this->sales_topic->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_list'] = $this->pagination->create_links();
        $data['page_list'] = $this->sales_topic->page_list($this->input->get(), $page_num, $num);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['status'] = array(1 => '上架', 2 => '下架'); //状态
        $this->load->view('salestopic/index', $data);
    }

    public function add()
    {
        $data['status'] = array(1 => '上架', 2 => '下架'); //状态
        $data['categories'] = $this->_getcategories();
        $this->load->view('salestopic/add', $data);
    }

    public function addPost()
    {
        $imageData = array('file_name' => '');
        if ( !empty($_FILES['image']['name']) ) {
            $imageData = $this->dealWithImages('image', '', 'mall');
            if ( $imageData == false ) {
                $this->error('salestopic/index', '', '图片上传失败！');
            }
        }
        $imageData['file_name'] = $imageData['file_name'] . '|';
        $insertSate = $this->sales_topic->insertSalesTopic($this->input->post(), $imageData);
        if ( $insertSate ) {
            $this->success('salestopic/index', null, '活动添加成功');
        } else {
            $this->error('salestopic/index', null, '活动添加失败');
        }
    }

    public function edit($salesId)
    {
        $data['status'] = array(1 => '上架', 2 => '下架'); //状态
        $data['categories'] = $this->_getcategories();
        $data['detail'] = $this->existSales($salesId);
        $this->load->view('salestopic/edit', $data);
    }

    public function editPost()
    {
        $imageData = '';
        if ( !empty($_FILES['image']['name']) ) {
            $imageData = $this->dealWithImages('image', $this->input->post('oldfilename'), 'mall');
            if ( $imageData == false ) {
                $this->error('salestopic/index', null, '图片上传失败！');
            }
        }
        $this->existSales($this->input->post('sales_id'));
        $updateState = $this->sales_topic->updateSalesTopic($this->input->post(), $imageData);
        if ( $updateState ) {
            $this->success('salestopic/index', null, '活动更新成功');
        } else {
            $this->error('salestopic/index', null, '活动更新失败');
        }
    }

    public function delete($salesId)
    {
        $this->existSales($salesId);

        $result = $this->sales_topic->delete($salesId);
        if ( !$result ) {
            $this->error('salestopic/index', null, '活动删除失败');
        } else {
            $this->success('salestopic/index', null, '活动删除成功');
        }
    }

    /**
     * 上下架
     */
    public function toggle()
    {
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        if ( $status == 1 ) {
            $status = 2;
        } elseif ( $status == 2 ) {
            $status = 1;
        } else {
            echo json_encode(array('status' => 0));
            exit;
        }
        $update = $this->sales_topic->updateInfo($id, array('status' => $status));
        if ( $update ) {
            echo json_encode(array('status' => $status));
            exit;
        }
    }

    /**
     * 判断活动是否存在
     * @param $salesId
     * @return mixed
     */
    private function existSales($salesId)
    {
        $result = $this->sales_topic->findSalesTopicById($salesId);
        if ( $result->num_rows() == 0 ) {
            $this->error('salestopic/index', null, '活动不存在');
        }

        return $result->row();
    }

    /**
     * 活动专区分类
     */
    private function _getcategories()
    {
        return array(
            1 => '专区活动',
        );
    }

    /**
     * @descripte   活动 图片管理
     * @Author xiumao
     * @date 2016/5/19 0019 上午 9:16
     */
    public function images($salesId)
    {
        $result = $this->sales_topic->findSalesTopicById($salesId);
        if ( $result->num_rows() <= 0 ) {
            $this->error('salestopic/index', '', '找不到产品相关信息！');
        }

        $data['salestopic'] = $result->row();
        $data['images'] = $result->row()->image;

        $this->load->view('salestopic/images', $data);
    }

    /**
     * @descripte   保存图像方法
     * @Author xiumao
     * @date 2016/5/19 0019 上午 9:16
     */
    public function saveImages()
    {
        $salesId = $this->input->post('sales_id');
        $params = $this->input->post();

        $result = $this->sales_topic->findSalesTopicById($salesId);
        if ( $result->num_rows() <= 0 ) {
            $this->error('salestopic/images', $salesId, '找不到产品相关信息！');
        }

        /*验证 不能为空*/
        if ( $this->validateParam($params['url']) ) {
            $this->error('salestopic/images', $salesId, '链接地址不能为空');
        }
        if ( empty($_FILES['images']['name']) ) {
            $this->error('salestopic/images', $salesId, '图片不能为空');
        }

        /*图片上传*/
        $imageData = $this->dealWithImages('images', '', 'mall');
        if ( $imageData == false ) {
            $this->error('salestopic/images', $salesId, '图片上传失败！');
        }

        /*url和image json编码*/
        $pics = $this->input->post('pics') ? trim($this->input->post('pics')) : '[]';
        if ( !strpos($pics, "url") ) {
            $pics = '[]';
        }
        $data['url'] = $params['url'];
        $data['image'] = $imageData['file_name'];
        $data['desc'] = $params['desc'];
        $data_original = json_decode($pics);
        array_push($data_original, $data);

        /*保存需要的参数*/
        $params['salesId'] = $salesId;
        $params['image'] = json_encode($data_original);

        $this->db->trans_start();
        $isupdate = $this->sales_topic->updateImages($params);
        $this->db->trans_complete();
        if ( $this->db->trans_status() === TRUE ) {
            $this->success('salestopic/images', $salesId, '图片保存成功！');
        } else {
            $this->error('salestopic/images', $salesId, '图片保存失败！');
        }
    }

    /**
     * @descripte   删除图片
     * @Author xiumao
     * @date 2016/5/19 0019 上午 9:16
     */
    public function deleteImage($salesId)
    {
        $result = $this->sales_topic->findSalesTopicById($salesId);
        if ( $result->num_rows() <= 0 ) {
            $this->error('salestopic/images', $salesId, '找不到产品相关信息！');
        }

        /*删除的图片名和键值*/
        $image_name = $this->input->get('image_name');
        $key = $this->input->get('key');

        /*json 解码*/
        $image_original = $result->row()->image;
        $image_original_array = json_decode($image_original);

        /*验证删除的图片 删除指定元素 重新键值排列*/
        if ( $image_original_array[ $key ]->image == $image_name ) {
            unset($image_original_array[ $key ]);
            $image_original_array = array_values($image_original_array);
        }

        /*删除必须参数*/
        $params['salesId'] = $salesId;
        $params['image'] = json_encode($image_original_array);

        $isupdate = $this->sales_topic->updateImages($params);
        $this->deleteOldfileName($image_name, 'mall');
        if ( $isupdate ) {
            $this->success('salestopic/images', $salesId, '图片删除成功');
        } else {
            $this->error('salestopic/images', $salesId, '图片删除失败');
        }
    }

}