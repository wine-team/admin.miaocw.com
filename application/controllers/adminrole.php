<?php
class Adminrole extends CS_Controller
{
    public function _init()
    {
        $this->load->helper(array('email'));
        $this->load->library('pagination');
        $this->load->model('admin_role_model', 'admin_role');
        $this->load->model('admin_action_model', 'admin_action');
    }

    public function grid($pg = 1)
    {
        $data['username'] = $this->input->get('username');
        $getData = $data;
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url']   = base_url('adminrole/gird').$this->pageGetParam($this->input->get());
        $config['suffix']      = $this->pageGetParam($this->input->get());
        $config['base_url']    = base_url('adminrole/gird');
        $config['total_rows']  = $this->admin_role->total($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['page_list'] = $this->admin_role->page_list($page_num, $num, $getData);
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $data['page_num'] = $page_num;
        $this->load->view('adminrole/grid', $data);
    }

    public function add()
    {
        $priv_arr = $this->admin_action->get_modules();
        $actions = $this->admin_action->get_actions();
        foreach($actions as $action) {
            $priv_arr[$action['parent_id']]['priv'][$action['action_code']] = $action;
        }
        // 按模块分好的操作权限
        $data['priv_arr'] = $priv_arr;
        $this->load->view('adminrole/add', $data);
    }

    public function addPost()
    {
        $error = array();
        if ($this->validateParam($this->input->post('name'))) {
            $error[] = '用户名不能为空。';
        }
        if (!$this->search_get_validate($this->input->post('action_code'))) {
            $error[] = '权限至少有一个不为空。';
        }
        if (!empty($error)) {
            $this->error('adminrole/add', '', $error);
        }

        $name = $this->input->post('name');
        $action_list = @implode(',', $this->input->post('action_code'));

        $this->db->trans_start();
        $resultId = $this->admin_role->insertRole($name, $action_list);
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

        $priv_arr = $this->admin_action->get_modules();
        $actions = $this->admin_action->get_actions();
        foreach($actions as $action) {
            $priv_arr[$action['parent_id']]['priv'][$action['action_code']] = $action;
        }
        // 将同一组的权限使用 "," 连接起来，供JS全选
        foreach ($priv_arr AS $action_id => $action_group) {
            $priv_arr[$action_id]['cando'] = (strpos($editing['action_list'], $action_group['action_code']) !== false || $editing['action_list'] == 'all') ? 1 : 0;
            if (!isset($action_group['priv'])) continue;
            $priv_arr[$action_id]['priv_list'] = $action_group['action_code'].','.join(',', @array_keys($action_group['priv']));
            foreach ($action_group['priv'] AS $key => $val) {
                $priv_arr[$action_id]['priv'][$key]['cando'] = (strpos($editing['action_list'], $val['action_code']) !== false || $editing['action_list'] == 'all') ? 1 : 0;
            }
        }
        // 按模块分好的操作权限
        $data['priv_arr'] = $priv_arr;
        $data['editing'] = $editing;
        $this->load->view('adminrole/edit', $data);
    }

    public function editPost()
    {
        $error = array();
        if ($this->validateParam($this->input->post('id'))) {
            $error[] = '角色id不能为空。';
        }
        if ($this->validateParam($this->input->post('name'))) {
            $error[] = '用户名不能为空。';
        }
        if (!$this->search_get_validate($this->input->post('action_code'))) {
            $error[] = '权限至少有一个不为空。';
        }
        if (!empty($error)) {
            $this->error('adminrole/edit', $this->input->post('id'), $error);
        }

        $role_id = $this->input->post('id');
        $name = $this->input->post('name');
        $action_list = @implode(',', $this->input->post('action_code'));

        $this->db->trans_start();
        $resultId = $this->admin_role->updateRole($role_id, $name, $action_list);
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