<?php 
class Cms_block extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('cms_block_model', 'cms_block');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('cms_block/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('cms_block/grid');
        $config['total_rows'] = $this->cms_block->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->cms_block->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $this->load->view('cms_block/grid', $data);
    }
    
    public function add()
    {
        $this->load->view('cms_block/add');
    }
    
    public function addPost()
    {
        $error = $this->validate();
        $blockId = $this->input->post('block_id');
        $result = $this->cms_block->findByBlockId($blockId);
        if ($result->num_rows() > 0) {
            $error[] = $blockId.'区块已经存在';
        }
        if (!empty($error)) {
            $this->error('cms_block/add', '', $error);
        }
        
        $this->db->trans_start();
        $resultId = $this->cms_block->insert($this->input->post());
        $this->db->trans_complete();
        
        if ($resultId) {
            $this->success('cms_block/grid', '', '保存成功！');
        } else {
            $this->error('cms_block/add', '', '保存失败！');
        }
    }
    
    public function edit($id)
    {
        $result = $this->cms_block->findById($id);
        if($result->num_rows() <= 0) {
            $this->redirect('cms_block/grid');
        }
        $data['cmsBlock'] = $result->row();
        $this->load->view('cms_block/edit', $data);
    }
    
    public function editPost()
    {
        $id = $this->input->post('id');
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('cms_block/edit', $id, $error);
            return ;
        }
        
        $this->db->trans_start();
        $resultId = $this->cms_block->update($this->input->post());
        $this->db->trans_complete();
    
        if ($resultId) {
            $this->success('cms_block/grid', '', '保存成功！');
        } else {
            $this->error('cms_block/edit', $id, '保存失败！');
        }
    }

    public function delete($id)
    {
        $is_delete = $this->cms_block->deleteById($id);

        if ($is_delete) {
            $this->success('cms_block/grid', '', '删除成功！');
        } else {
            $this->error('cms_block/grid', '', '删除失败！');
        }
    }
    
    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('name'))) {
            $error[] = '名称不能为空';
        }
        if ($this->validateParam($this->input->post('block_id'))) {
            $error[] = '区块Id不能为空';
        }
        if ($this->validateParam($this->input->post('description'))) {
            $error[] = '描述不能为空';
        }
        return $error;
    }
}