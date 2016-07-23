<?php 
class Link extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('link_model', 'link');
    }
    
    public function grid($pg = 1)
    {
        $num = ($pg-1)*20;
        $config['base_url'] = base_url('link/grid');
        $config['total_rows'] = $this->link->total();
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->link->page_list($num);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = 20;
        $this->load->view('link/grid', $data);
    }
    
    public function add()
    {
        $this->load->view('link/add');
    }
    
    public function addPost()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('link/add', '', $error);
        }

        $this->db->trans_start();
        $resultId = $this->link->insertLink($this->input->post());
        $this->db->trans_complete();
        
        if ($resultId) {
            $this->success('link/grid', '', '保存成功！');
        } else {
            $this->error('link/add', '', '保存失败！');
        }
    }
    
    public function edit($id)
    {
        $result = $this->link->findById($id);
        if($result->num_rows() <= 0) {
            $this->redirect('link/grid');
        }
        $data['link'] = $result->row();
        $this->load->view('link/edit', $data);
    }
    
    public function editPost()
    {
        $link_id = $this->input->post('id');
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('link/edit', $link_id, $error);
            return ;
        }

        $this->db->trans_start();
        $resultId = $this->link->updateLink($this->input->post());
        $this->db->trans_complete();
    
        if ($resultId) {
            $this->success('link/grid', '', '保存成功！');
        } else {
            $this->error('link/edit', $link_id, '保存失败！');
        }
    }
    
    public function delete($id)
    {
        $is_delete = $this->link->deleteById($id);
        if ($is_delete) {
            $this->success('link/grid', '', '删除成功！');
        } else {
            $this->error('link/grid', '', '删除失败！');
        }
    }

    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('name'))) {
            $error[] = ' 用户名不能为空。';
        }
        if ($this->validateParam($this->input->post('url'))) {
            $error[] = 'url地址不能为空。';
        }
        
        return $error;
    }
}