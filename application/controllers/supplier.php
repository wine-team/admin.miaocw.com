<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supplier extends MJ_Controller
{
	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('supplier_model','supplier');
	}

    public function grid($pg = 1)
	{
	    $getData = $this->input->get();
	    $page_num = 20;
		$num = ($pg-1)*$page_num;
	    $config['first_url']   = base_url('supplier/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($this->input->get());
	    $config['base_url']    = base_url('supplier/grid');
	    $config['total_rows']  = $this->supplier->total($getData);
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->supplier->supplier_list($page_num, $num, $getData);
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg;
		$data['page_num'] = $page_num;
	    $this->load->view('supplier/grid', $data);
	}
	
	public function add()
	{
	    $this->load->view('supplier/add');
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error)) {
	        $this->jsonMessage($error);
	    }
	    $postData = $this->input->post();
        $data['supplier_name'] = $postData['supplier_name'];
        $data['supplier_desc'] = $postData['supplier_desc'];
        $data['uid'] = $postData['uid'];
        $data['is_check'] = $postData['is_check'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $res = $this->supplier->insert($data);
	    if ($res) {
            $this->session->set_flashdata('success', '添加成功！');
            $this->jsonMessage('', base_url('supplier/grid'));
        } else {
            $this->session->set_flashdata('error', '保存失败！');
            $this->jsonMessage('', base_url('supplier/add'));
        }
	}
	
	public function edit($supplier_id)
	{
	    $res = $this->supplier->findById($supplier_id);
	    if ($res->num_rows() > 0) {
	        $data['res'] = $res->row();
	        $this->load->view('supplier/edit',$data);
	    } else {
	        $this->redirect('supplier/grid');
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error)) {
	        $this->jsonMessage($error);
	    }
	    $postData = $this->input->post();
        $data['supplier_name'] = $postData['supplier_name'];
        $data['supplier_desc'] = $postData['supplier_desc'];
        $data['uid'] = $postData['uid'];
        $data['is_check'] = $postData['is_check'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $res = $this->supplier->update(array('supplier_id'=>$postData['supplier_id']), $data);
	   if ($res) {
            $this->session->set_flashdata('success', '修改成功！');
            $this->jsonMessage('', base_url('supplier/grid'));
        } else {
            $this->session->set_flashdata('error', '修改失败！');
            $this->jsonMessage('', base_url('supplier/edit/'.$postData['supplier_id']));
        }
	}
	
	public function delete($supplier_id)
	{ 
	    $is_delete = $this->supplier->delete($supplier_id);
	    if ($is_delete) {
	        $this->success('supplier/grid', '', '删除成功！');
	    } else {
	        $this->error('supplier/grid', '', '删除失败！');
	    }
	}
	
	public function validateUser()
	{
	    if ($this->input->post('supplier_id')) {
	        $supplier = $this->supplier->findByParams(array('uid'=>$this->input->post('uid')));
	        if ($supplier->num_rows() > 0) {
	            if ($supplier->row()->supplier_id == $this->input->post('supplier_id')) {
	                echo 'true';
	            } else {
	                echo 'false';
	            }
	        } else {
	            echo 'true';
	        }
	    } else {
	        $user_num = $this->supplier->findByParams(array('uid'=>$this->input->post('uid')))->num_rows();
	        if ($user_num > 0) {
	            echo 'false';
	        } else {
	            echo 'true';
	        }
	    }
	    exit;
	}
	
	public function validate()
	{   
	   $error = array();
        if ($this->validateParam($this->input->post('supplier_name'))) {
            $error[] = '供应商名称不能为空';
        }
	    return $error;
	}
}
