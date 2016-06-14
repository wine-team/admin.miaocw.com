<?php 
class Adminaction extends CS_Controller
{
    public function _init()
    {
        $this->load->helper(array('email'));
        $this->load->library('pagination');
        $this->load->model('admin_action_model', 'admin_action');
    }
    
    public function grid($pg = 1)
    {
        $pageNum = 20;
        $num = ($pg-1)*20;
        $config['first_url']   = base_url('adminaction/grid').$this->pageGetParam($this->input->get());
        $config['suffix']      = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('adminaction/grid');
        $config['total_rows'] = $this->admin_action->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->admin_action->page_list($pageNum, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['parent_id'] = 0; //过滤parent_id的显示条件
        $data['page_num'] = $pageNum;
        $this->load->view('adminaction/grid', $data);
    }
    
    public function child($pg = 1)
    {
        $parent_id = $this->input->get('parent_id');
        if (!$parent_id) {
            $this->error('adminaction/grid', '', 'parent_id不正确');
        }
        $pageNum = 20;
        $num = ($pg-1)*$pageNum;
        $config['first_url'] = base_url('adminaction/child').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('adminaction/child');
        $config['total_rows'] = $this->admin_action->childTotal($parent_id);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->admin_action->childPageList($pageNum, $num, $parent_id);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $pageNum;
        $this->load->view('adminaction/grid', $data);
    }
    
    public function add()
    {
        $data['belongs'] = $this->admin_action->findLimit();
        $this->load->view('adminaction/add', $data);
    }
    
    public function addPost()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('adminaction/add', '', $error);
        }

        $is_repeat = $this->admin_action->validateActionCode($this->input->post('action_code'));
        if ($is_repeat) {
            $this->error('adminaction/add', '', '权限字段不可重复！');
        }
        
        $this->db->trans_start();
        $resultId = $this->admin_action->insertAdminaction($this->input->post());
        $this->db->trans_complete();
        
        if ($resultId) {
            $this->success('adminaction/grid', '', '保存成功！');
        } else {
            $this->error('adminaction/add', '', '保存失败！');
        }
    }
    
    public function edit($id)
    {
        $result = $this->admin_action->findById($id);
        if($result->num_rows() <= 0) {
            $this->redirect('adminaction/grid');
        }
        $data['adminaction'] = $result->row();
        $data['belongs'] = $this->admin_action->findLimit();
        $this->load->view('adminaction/edit', $data);
    }
    
    public function editPost()
    {
        $adminaction_id = $this->input->post('id');
        $error = $this->validate();
        if ($this->input->post('modify_password')) {
            if ($this->input->post('password') != $this->input->post('confirm_password')) {
                $error[] = '密码填写不一致。';
            }
        }
        if (!empty($error)) {
            $this->error('adminaction/edit', $adminaction_id, $error);
        }

        $this->db->trans_start();
        $resultId = $this->admin_action->updateAdminaction($this->input->post());
        $this->db->trans_complete();
    
        if ($resultId) {
            $this->success('adminaction/grid', '', '保存成功！');
        } else {
            $this->error('adminaction/edit', $adminaction_id, '保存失败！');
        }
    }
    
    public function delete($id)
    {
        try {
            $is_delete = $this->admin_action->deleteById($id);
            $child_delete = $this->admin_action->deleteChild($id);
            
            if ($is_delete && $child_delete) {
                $this->success('adminaction/grid', '', '删除成功！');
            } else {
                $this->error('adminaction/grid', '', '删除失败！');
            }
        } catch (Exception $e) {
            $this->error('adminaction/grid', '', $e->getMessage());
        }
    }

    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('action_code'))) {
            $error[] = ' 权限字段不能为空。';
        }
        if ($this->validateParam($this->input->post('cn_name'))) {
            $error[] = '权限名不能为空。';
        }
        return $error;
    }
}