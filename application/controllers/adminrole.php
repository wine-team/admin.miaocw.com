<?php 
class Adminrole extends MJ_Controller
{
    public function _init()
    {
        $this->load->helper(array('common', 'email'));
        $this->load->library('pagination');
        $this->load->model('admin_role_model', 'admin_role');
    }
    
    public function grid($pg = 1)
    {
        $num = ($pg-1)*20;
        $config['base_url'] = base_url('adminrole/grid');
        $config['total_rows'] = $this->admin_role->total();
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->admin_role->page_list($num);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $this->load->view('adminrole/grid', $data);
    }
    
    public function add()
    {
        $this->load->view('adminrole/add');
    }
    
    public function addPost()
    {
        $error = array();
        if ($this->validateParam($this->input->post('name'))) {
            $error[] = '用户名不能为空。';
        }
        if (!empty($error)) {
            $this->error('adminrole/add', '', $error);
        }
        
        $name = $this->input->post('name');
        
        $this->db->trans_start();
        $resultId = $this->admin_role->insertRole($name);
        $this->db->trans_complete();
        
        if ($resultId) {
            $this->success('adminrole/grid', '', '保存成功！');
        } else {
            $this->error('adminrole/add', '', '保存失败！');
        }
    }
    
    public function edit($id)
    {
        $result = $this->admin_role->findById($id);
        if ($result->num_rows() <= 0) {
            $this->error('adminrole/grid', '', '无效ID:'.$id);
        }
        $editing = $result->row_array();
        $data['editing'] = $editing;
        $this->load->view('adminrole/edit', $data);
    }
    
    public function editPost()
    {
        $error = array();
        if ($this->validateParam($this->input->post('name'))) {
            $error[] = '用户名不能为空。';
        }
        if (!empty($error)) {
            $this->error('adminrole/edit', $this->input->post('id'), $error);
        }
        
        $role_id = $this->input->post('id');
        $name = $this->input->post('name');
        
        $this->db->trans_start();
        $resultId = $this->admin_role->updateRole($role_id, $name);
        $this->db->trans_complete();
        
        //动态更新管理员的权限
        $adminUser = $this->session->userdata('adminUser');
        if ($adminUser->role_id == $role_id) {
            $adminUser->action_list = $action_list;
        }
        
        if ($resultId) {
            $this->success('adminrole/grid', '', '保存成功！');
        } else {
            $this->error('adminrole/edit', $role_id, '保存失败！');
        }
    }
    
    public function delete($id)
    {
        $is_delete = $this->admin_role->deleteById($id);
        if ($is_delete) {
            $this->success('adminrole/grid', '', '删除成功！');
        } else {
            $this->error('adminrole/grid', '', '删除失败！');
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