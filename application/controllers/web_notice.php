<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_notice extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('web_notice_model','web_notice');
	}

	public function grid($pg = 1)
	{
	    $getData = $this->input->get();
	    $perpage = 10;
	    $search['item'] = $getData['item'];
	    $config['first_url']   = base_url('web_notice/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('web_notice/grid');
	    $config['total_rows']  = $this->web_notice->web_notice_list(null, null, $search)->num_rows();
	    $config['uri_segment'] = 3;
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->web_notice->web_notice_list($pg-1, $perpage, $search)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg;
	    $this->load->view('web_notice/grid', $data);
	}
	
	public function add()
	{
	    $this->load->view('web_notice/add');
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('web_notice/add', $this->input->post('id'), $error);
	    }
	    $postData = $this->input->post();
	    $data['title'] = $postData['title'];
	    $data['author'] = $postData['author'];
	    $data['time'] = time();
	    $data['notice_info'] = $postData['notice_info'];
	    $res = $this->web_notice->insert($data);
	    if ($res) {
	        $this->success('web_notice/grid', '', '新增成功！');
	    } else {
	        $this->error('web_notice/add', $this->input->post('id'), '新增失败！');
	    }
	}
	
	public function edit($id)
	{
	    $res = $this->web_notice->findById(array('id'=>$id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('web_notice/edit',$data);
	    } else {
	        $this->redirect('web_notice/grid');
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('web_notice/edit', $this->input->post('id'), $error);
        }
        $postData = $this->input->post();
        $data['title'] = $postData['title'];
        $data['author'] = $postData['author'];
        $data['notice_info'] = $postData['notice_info'];
        $res = $this->web_notice->update(array('id'=>$postData['id']), $data);
        if ($res) {
            $this->success('web_notice/grid', '', '修改成功！');
        } else {
            $this->error('web_notice/edit', $this->input->post('id'), '修改失败！');
        }
	}
	
	public function delete($id)
	{
	    $is_delete = $this->web_notice->delete(array('id'=>$id));
	    if ($is_delete) {
	        $this->success('web_notice/grid', '', '删除成功！');
	    } else {
	        $this->error('web_notice/grid', '', '删除失败！');
	    }
	}
	
	public function validate()
	{
	    $error = array();
        if ($this->validateParam($this->input->post('title')))
        {
            $error[] = '标题不能为空';
        }
        if ($this->validateParam(strip_tags($this->input->post('notice_info'))))
        {
            $error[] = '内容不能为空';
        }
	    return $error;
	}
	
}
/** End of file Web_notice.php */
/** Location: ./application/controllers/Web_notice.php */
