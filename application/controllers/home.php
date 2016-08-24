<?php
class Home extends CS_Controller
{
    public function _init()
    {
        $this->load->helper(array('email'));
        $this->load->model('admin_user_model', 'admin_user');
    }

    /**
     *登录跳到首页
     */
    public function dashboard()
    {
        $this->load->view('home/dashboard');
    }

    public function edit()
    {
        $this->load->view('home/edit');
    }

    public function editPost()
    {
        $adminuser_id = $this->input->post('id');
        $error = $this->validateEdit();
        if ($this->input->post('modify_password')) {
            if ($this->input->post('password') != $this->input->post('confirm_password')) {
                $error[] = '密码填写不一致。';
            }
        }
        if (!empty($error)) {
            $this->error('home/edit', '', $error);
        }

        $this->db->trans_start();
        $resultId = $this->admin_user->updateAdminuser($this->input->post());
        $this->db->trans_complete();

        if ($resultId) {
            if ($this->input->post('modify_password') != '') {
                $this->session->sess_destroy();; //修改成功退出登录。
            }
            $this->success('home/edit', '', '修改成功！');
        } else {
            $this->error('home/edit', '', '修改失败！');
        }
    }
    
    public function validateEdit()
    {
        $error = array();
        if ($this->validateParam($this->input->post('name'))) {
            $error[] = ' 用户名不能为空。';
        }
        if (!valid_email($this->input->post('email'))) {
            $error[] = ' 邮箱地址不正确。';
        }

        return $error;
    }

}