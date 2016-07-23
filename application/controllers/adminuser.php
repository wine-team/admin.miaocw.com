<?php 
class Adminuser extends CS_Controller
{
    public function _init()
    {
        $this->load->helper(array('email'));
        $this->load->library('pagination');
        $this->load->model('admin_user_model', 'admin_user');
        $this->load->model('admin_role_model', 'admin_role');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('adminuser/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('adminuser/grid');
        $config['total_rows'] = $this->admin_user->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->admin_user->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $data['role'] = $this->admin_role->find();
        $this->load->view('adminuser/grid', $data);
    }
    
    public function resetpwd($uid)
    {
        $is_update = $this->admin_user->findById($uid);
        if (!$is_update) {
            $this->error('adminuser/grid', '', '用户不存在！');
        }
    
        $result = $this->admin_user->resetpwd($uid);
        if ($result) {
            $this->success('adminuser/grid', '', '密码重置成功！');
        } else {
            $this->error('adminuser/grid', '', '密码重置失败！');
        }
    }
    
    public function add()
    {
        $data['roles'] = $this->admin_role->find();
        $this->load->view('adminuser/add', $data);
    }
    
    public function addPost()
    {
        $error = $this->validate();
        if ($this->input->post('password') != $this->input->post('confirm_password')) {
            $error[] = '密码填写不一致。';
        }
        
        $exist = $this->admin_user->validateAdminuser($this->input->post());
        if ($exist) {
            $error[] = '用户名或邮箱已经存在。';
        }
        
        if (!empty($error)) {
            $this->error('adminuser/add', '', $error);
        }

        $this->db->trans_start();
        $resultId = $this->admin_user->insertAdminuser($this->input->post());
        $this->db->trans_complete();
        
        if ($resultId) {
            $this->success('adminuser/grid', '', '保存成功！');
        } else {
            $this->error('adminuser/add', '', '保存失败！');
        }
    }
    
    public function edit($id)
    {
        $result = $this->admin_user->findById($id);
        if($result->num_rows() <= 0) {
            $this->redirect('adminuser/grid');
        }
        $data['adminuser'] = $result->row();
        $data['roles'] = $this->admin_role->find();
        $this->load->view('adminuser/edit', $data);
    }
    
    public function editPost()
    {
        $adminuser_id = $this->input->post('id');
        $error = $this->validate();
        if ($this->input->post('modify_password')) {
            if ($this->input->post('password') != $this->input->post('confirm_password')) {
                $error[] = '密码填写不一致。';
            }
        }
        if (!empty($error)) {
            $this->error('adminuser/edit', $adminuser_id, $error);
            return ;
        }

        $this->db->trans_start();
        $resultId = $this->admin_user->updateAdminuser($this->input->post());
        $this->db->trans_complete();
    
        if ($resultId) {
            $this->success('adminuser/grid', '', '保存成功！');
        } else {
            $this->error('adminuser/edit', $adminuser_id, '保存失败！');
        }
    }
    
    public function delete($id)
    {
        $is_delete = $this->admin_user->deleteById($id);
        if ($is_delete) {
            $this->success('adminuser/grid', '', '删除成功！');
        } else {
            $this->error('adminuser/grid', '', '删除失败！');
        }
    }

    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('name'))) {
            $error[] = ' 用户名不能为空。';
        }
        if (!valid_email($this->input->post('email'))) {
            $error[] = ' 邮箱地址不正确。';
        }
        if ($this->validateParam($this->input->post('role_id'))) {
            $error[] = '角色不能为空。';
        }
        return $error;
    }
}