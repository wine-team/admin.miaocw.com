<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chelp_center extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('Base_model');
	    $this->load->model('Mhelp_center_model','Mhelp_center');
	}

	public function grid($pg = 1)
	{
	    $getData = $this->input->get();
	    $perpage = 20;
	    $search['item'] = $getData['item'];
	    $config['first_url']   = base_url('Chelp_center/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('Chelp_center/grid');
	    $config['total_rows']  = $this->Mhelp_center->help_center_list(null,null,$search)->num_rows();
	    $config['uri_segment'] = 3;
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->Mhelp_center->help_center_list($pg-1,$perpage,$search)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg;
	    $this->load->view('help_center/grid', $data);
	}
	
	public function add()
	{
	    $this->load->view('help_center/add');
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('Chelp_center/add', $this->input->post('id'), $error);
	    }
	    $postData = $this->input->post();
	    $data['title'] = $postData['title'];
	    $data['sub_title'] = $postData['sub_title'];
	    $data['author'] = $postData['author'];
	    $data['time'] = time();
	    $data['help_info'] = $postData['help_info'];
	    $res = $this->Base_model->insert('help_center',$data);
	    if ($res) {
	        $this->success('Chelp_center/grid', '', '新增成功！');
	    } else {
	        $this->error('Chelp_center/add', $this->input->post('id'), '新增失败！');
	    }
	}
	
	public function edit($id)
	{
	    $res = $this->Base_model->getWhere('help_center',array('id'=>$id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('help_center/edit',$data);
	    } else {
	        $this->redirect('Chelp_center/grid');
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('Chelp_center/edit', $this->input->post('id'), $error);
        }
        $postData = $this->input->post();
        $data['title'] = $postData['title'];
        $data['sub_title'] = $postData['sub_title'];
        $data['author'] = $postData['author'];
        $data['help_info'] = $postData['help_info'];
        $res = $this->Base_model->update('help_center',array('id'=>$postData['id']),$data);
        if ($res) {
            $this->success('Chelp_center/grid', '', '修改成功！');
        } else {
            $this->error('Chelp_center/edit', $this->input->post('id'), '修改失败！');
        }
	}
	
	public function delete($id)
	{
	    $is_delete = $this->Base_model->delete('help_center',array('id'=>$id));
	    if ($is_delete) {
	        $this->success('Chelp_center/grid', '', '删除成功！');
	    } else {
	        $this->error('Chelp_center/grid', '', '删除失败！');
	    }
	}
	
	public function validate()
	{
	    $error = array();
	    if ($this->validateParam($this->input->post('title'))) 
	    {
            $error[] = '分类不能为空';
        }
        if ($this->validateParam($this->input->post('sub_title')))
        {
            $error[] = '标题不能为空';
        }
        if ($this->validateParam(strip_tags($this->input->post('help_info'))))
        {
            $error[] = '内容不能为空';
        }
	    return $error;
	}
	
}
/** End of file Chelp_center.php */
/** Location: ./application/controllers/Chelp_center.php */
