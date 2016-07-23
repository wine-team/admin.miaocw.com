<?php 
class Cmsblock extends CS_Controller
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
        $config['first_url'] = base_url('cmsblock/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('cmsblock/grid');
        $config['total_rows'] = $this->cms_block->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->cms_block->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $this->load->view('cmsblock/grid', $data);
    }
    
    public function add()
    {
        $this->load->view('cmsblock/add');
    }
    
    public function addPost()
    {
        $error = $this->validate();
        $blockId = $this->input->post('block_id');
        if ($this->cms_block->validateBlockId($blockId)) {
            $error[] = '区块Id必须唯一。';
        }
        if (!empty($error)) {
            $this->error('cmsblock/add', '', $error);
        }
        
        $this->db->trans_start();
        $resultId = $this->cms_block->insertCmsBlock($this->input->post());
        $this->db->trans_complete();
        
        if ($resultId) {
            $this->success('cmsblock/grid', '', '保存成功！');
        } else {
            $this->error('cmsblock/add', '', '保存失败！');
        }
    }
    
    public function edit($id)
    {
        $result = $this->cms_block->findById($id);
        if($result->num_rows() <= 0) {
            $this->redirect('cmsblock/grid');
        }
        $data['cmsblock'] = $result->row();
        $this->load->view('cmsblock/edit', $data);
    }
    
    public function editPost()
    {
        $id = $this->input->post('id');
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('cmsblock/edit', $id, $error);
            return ;
        }
        
        $this->db->trans_start();
        $resultId = $this->cms_block->updateCmsBlock($this->input->post());
        $this->db->trans_complete();
    
        if ($resultId) {
            $this->success('cmsblock/grid', '', '保存成功！');
        } else {
            $this->error('cmsblock/edit', $id, '保存失败！');
        }
    }

    public function delete($id)
    {
        $is_delete = $this->cms_block->deleteById($id);

        if ($is_delete) {
            $this->success('cmsblock/grid', '', '删除成功！');
        } else {
            $this->error('cmsblock/grid', '', '删除失败！');
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