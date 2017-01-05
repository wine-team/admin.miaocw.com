<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/23
 * Time: 19:44
 */
class Salestopiccategory extends MJ_Controller
{
	private $types;
	private $status;
    public function _init()
    {
    	$this->types = array(1=>'两性用品');
    	$this->status = array(1=>'上架', 2=>'下架');
        $this->load->library('pagination');
        $this->load->model('sales_topic_model', 'sales_topic');
        $this->load->model('sales_topic_category_model', 'sales_topic_category');
        $this->load->model('sales_category_product_model', 'sales_category_product');
    }

    public function index($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url']   = base_url('salestopiccategory/index').$this->pageGetParam($this->input->get());
        $config['suffix']      = $this->pageGetParam($this->input->get());
        $config['base_url']    = base_url('salestopiccategory/index');
        $config['total_rows']  = $this->sales_topic_category->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_list']   = $this->pagination->create_links();
        $data['page_list'] = $this->sales_topic_category->page_list($this->input->get(), $page_num, $num);
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $data['status'] = $this->status; //状态
        $data['types'] = $this->types;//类型
        $this->load->view('salestopiccategory/index', $data);
    }

    public function add()
    {
        $data['status'] = $this->status; //状态
        $data['types'] = $this->types;//类型
        $this->load->view('salestopiccategory/add', $data);
    }

    public function addPost()
    {
        $postData = $this->input->post();
        $categoryId = $this->sales_topic_category->insertSalesTopicCategory($postData);
        if ( $categoryId ) {
            $this->success('salestopiccategory/edit/'.$categoryId, array('sales_id'=>$this->input->post('sales_id')), '操作成功');
        } else {
            $this->error('salestopiccategory/index', array('sales_id'=>$this->input->post('sales_id')), '添加失败');
        }
    }

    public function edit($salesId)
    {
        $data['status'] = $this->status; //状态
        $data['types'] = $this->types;//类型
        $result = $this->sales_topic_category->findByCategoryId($salesId);
        if ( $result->num_rows() == 0 ) {
            $this->error('salestopiccategory/index', array('sales_id'=>$this->input->get('sales_id')), '操作失败');
        }
        $data['detail'] = $result->row();
        $data['salesCategoryProduct'] = $this->sales_category_product->findByCategoryId($salesId);
        $this->load->view('salestopiccategory/edit', $data);
    }

    public function editPost()
    {
        $postData = $this->input->post();
        $this->db->trans_start();
        $updateState = $this->sales_topic_category->updateSalesTopicCategory($this->input->post());
        if ( !empty($postData['product_id']) ) {
            $this->sales_category_product->insertBatch($postData['category_id'], $postData);
        }

        if ( !empty($postData['list']) ) {
            $this->sales_category_product->updateBatch($postData['list']);
        }
        $this->db->trans_complete();

        if ( $this->db->trans_status() === TRUE ) {
            $this->success('salestopiccategory/index', array('sales_id'=>$this->input->post('sales_id')), '更新成功');
        } else {
            $this->error('salestopiccategory/index', array('sales_id'=>$this->input->post('sales_id')), '更新失败');
        }
    }

    /**
     * 删除
     * @param $salesId
     */
    public function delete($salesId)
    {
        $this->db->trans_start();
        $result = $this->sales_topic_category->delete($salesId);
        $this->sales_category_product->deleteByCategoryId($salesId);
        $this->db->trans_complete();
        if ( $this->db->trans_status() === FALSE ) {
            $this->error('salestopiccategory/index', array('sales_id'=>$this->input->get('sales_id')), '删除失败');
        } else {
            $this->success('salestopiccategory/index', array('sales_id'=>$this->input->get('sales_id')), '删除成功');
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
        $update = $this->sales_topic_category->updateInfo($id, array('status' => $status));
        if ($update) {
            echo json_encode(array('status' => $status));
            exit;
        }
    }

    public function ajaxDeleteProduct()
    {
        $id = $this->input->post('id');

        $delete = $this->sales_category_product->delete($id);
        if ( $delete ) {
            $this->jsonMessage('');
        } else {
            $this->jsonMessage('删除失败');
        }
    }

}