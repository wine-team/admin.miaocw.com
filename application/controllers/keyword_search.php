<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keyword_search extends MJ_Controller {
	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('keyword_search_model','keyword_search');
	}

    public function grid($pg = 1)
	{ 
	    $getData = $this->input->get();
	    $perpage = 20;
	    $search['item'] = $getData['item'];
	    $config['first_url']   = base_url('keyword_search/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('keyword_search/grid');
	    $config['total_rows']  = $this->keyword_search->keyword_search_list(null, null, $search)->num_rows();
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->keyword_search->keyword_search_list($pg-1, $perpage, $search)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg; 
	    $this->load->view('keyword_search/grid', $data);
	}
	
	public function edit($id)
	{
	    $res = $this->keyword_search->findById(array('id'=>$id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('keyword_search/edit',$data);
	    } else {
	        $this->redirect('keyword_search/grid');
	    }
	}
	
	public function editPost()
	{
        $postData = $this->input->post(); 
        $data['sort'] = $postData['sort']; 
        $res = $this->keyword_search->update(array('id'=>$postData['id']), $data);
        if ($res) {
            $this->success('keyword_search/grid', '', '修改成功！');
        } else {
            $this->error('keyword_search/edit', $this->input->post('id'), '修改失败！');
        }
	}
	
	public function delete($id)
	{ 
	    $is_delete = $this->keyword_search->delete(array('id'=>$id));
	    if ($is_delete) {
	        $this->success('keyword_search/grid', '', '删除成功！');
	    } else {
	        $this->error('keyword_search/grid', '', '删除失败！');
	    }
	}
	
}

/** End of file Keyword_search.php */
/** Location: ./application/controllers/Keyword_search.php */
