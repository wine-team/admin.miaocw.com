<?php 
class Account extends MJ_Controller
{
	public function _init()
    {
        $this->load->helper(array('common', 'email'));
        $this->load->model('admin_user_model', 'admin_user');
    }
    
     /**
     *登录
     */
    public function login()
    {
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'account/dashboard') === false) {
            $data['backurl'] = $_SERVER['HTTP_REFERER'];
        } else {
            $data['backurl'] = base_url('account/dashboard');
        }
        $this->load->view('account/login', $data);
    }
    
     /**
     **登录判断
     */
    public function loginPost()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('account/login', '', $error);
        }
        
        $result = $this->admin_user->login($this->input->post());
        if (!$result) {
            $this->error('account/login', '', '用户名或密码错误');
        }
        $adminUser = $result->row();
        if ($adminUser->flag != 1) {
            $this->error('account/login', '', '此帐号已被冻结，请与管理员联系');
        }
        $this->session->set_userdata('adminUser', $adminUser);
        if ($this->input->post('backurl')) {
            $directUrl = $this->input->post('backurl');
        } else {
            $directUrl = base_url('account/dashboard');
        }
        $this->redirect($directUrl);
    }
    
     /**
     *登录跳到首页
     */
    public function dashboard()
    {
    	$this->load->view('account/dashboard');
    }
    
    public function edit()
    {
        $data['adminuser'] = $this->session->userdata('adminUser');
        $this->load->view('account/edit', $data);
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
            $this->error('account/edit', '', $error);
        }
    
        $this->db->trans_start();
        $resultId = $this->admin_user->updateAdminuser($this->input->post());
        $this->db->trans_complete();
    
        if ($resultId) {
            if ($this->input->post('modify_password') != '') {
                $this->session->sess_destroy();; //修改成功退出登录。
            }
            $this->success('account/edit', '', '修改成功！');
        } else {
            $this->error('account/edit', '', '修改失败！');
        }
    }
    
     /**
     * 退出
     */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->redirect('account/login');
    }
    
    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('username'))) {
            $error[] = ' 用户名不能为空。';
        }
        if (strlen($this->input->post('password')) < 6) {
            $error[] = '密码长度必须大于等于6个字符。';
        }
        return $error;
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
    
    public function autocompleteUser()
    {
        $result = $this->user->findByAutocomplete();
        $uidArray = $result->result_array();
        echo json_encode($uidArray);exit;
    }
}