<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_keyword extends MJ_Controller
{
	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_keyword_model', 'mall_keyword');
	}

    public function grid($pg = 1)
	{
		$page_num = 20;
		$num = ($pg-1)*$page_num;
	    $config['first_url']   = base_url('mall_keyword/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($this->input->get());
	    $config['base_url']    = base_url('mall_keyword/grid');
	    $config['total_rows']  = $this->mall_keyword->total($this->input->get());
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_keyword->page_list($page_num, $num, $this->input->get());
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg;
		$data['page_num'] = $page_num;
	    $this->load->view('mall_keyword/grid', $data);
	}
	
	public function edit($id)
	{
	    $res = $this->mall_keyword->findById($id);
	    if ($res->num_rows() > 0) {
	        $data['res'] = $res->row();
	        $this->load->view('mall_keyword/edit',$data);
	    } else {
	        $this->redirect('mall_keyword/grid');
	    }
	}
	
	public function editPost()
	{
        $postData = $this->input->post(); 
        $data['sort'] = $postData['sort']; 
        $res = $this->mall_keyword->update(array('id'=>$postData['id']), $data);
        if ($res) {
            $this->success('mall_keyword/grid', '', '修改成功！');
        } else {
            $this->error('mall_keyword/edit', $this->input->post('id'), '修改失败！');
        }
	}
	
	public function delete($id)
	{ 
	    $is_delete = $this->mall_keyword->delete($id);
	    if ($is_delete) {
	        $this->success('mall_keyword/grid', '', '删除成功！');
	    } else {
	        $this->error('mall_keyword/grid', '', '删除失败！');
	    }
	}
}