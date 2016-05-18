<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help_center extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('help_center_model','help_center');
	}

	public function grid($pg = 1)
	{
	    $getData = $this->input->get();
	    $perpage = 10;
	    $search['item'] = $getData['item'];
	    $config['first_url']   = base_url('help_center/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('help_center/grid');
	    $config['total_rows']  = $this->help_center->help_center_list(null, null, $search)->num_rows();
	    $config['uri_segment'] = 3;
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->help_center->help_center_list($pg-1, $perpage, $search)->result();
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
	        $this->error('help_center/add', $this->input->post('id'), $error);
	    }
	    $postData = $this->input->post();
	    $data['title'] = $postData['title'];
	    $data['sub_title'] = $postData['sub_title'];
	    $data['author'] = $postData['author'];
	    $data['time'] = date('Y-m-d H:i:s');
	    $data['help_info'] = $postData['help_info'];
	    $res = $this->help_center->insert($data);
	    if ($res) {
	        $this->success('help_center/grid', '', '新增成功！');
	    } else {
	        $this->error('help_center/add', '', '新增失败！');
	    }
	}
	
	public function edit($id)
	{
	    $res = $this->help_center->findById(array('id'=>$id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('help_center/edit',$data);
	    } else {
	        $this->redirect('help_center/grid');
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('help_center/edit', $this->input->post('id'), $error);
        }
        $postData = $this->input->post();
        $data['title'] = $postData['title'];
        $data['sub_title'] = $postData['sub_title'];
        $data['author'] = $postData['author'];
        $data['help_info'] = $postData['help_info'];
        $res = $this->help_center->update(array('id'=>$postData['id']), $data);
        if ($res) {
            $this->success('help_center/grid', '', '修改成功！');
        } else {
            $this->error('help_center/edit', $this->input->post('id'), '修改失败！');
        }
	}
	
	public function delete($id)
	{
	    $is_delete = $this->help_center->delete(array('id'=>$id));
	    if ($is_delete) {
	        $this->success('help_center/grid', '', '删除成功！');
	    } else {
	        $this->error('help_center/grid', '', '删除失败！');
	    }
	}
	
	public function validate()
	{
	    $error = array();
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
/** End of file Help_center.php */
/** Location: ./application/controllers/Help_center.php */
