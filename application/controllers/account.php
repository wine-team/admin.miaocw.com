<?php 
class Account extends MJ_Controller
{
	public function _init()
    {
        $this->load->helper(array('email'));
        $this->load->model('admin_user_model', 'admin_user');
    }
    
     /**
     *登录
     */
    public function login()
    {
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'account/login') === false) {
            $data['backurl'] = $_SERVER['HTTP_REFERER'];
        } else {
            $data['backurl'] = base_url('home/dashboard');
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
        if ($result->num_rows() <= 0) {
            $this->error('account/login', '', '用户名或密码错误');
        }
        $adminUser = $result->row();
        if ($adminUser->flag != 1) {
            $this->error('account/login', '', '此帐号已被冻结，请与管理员联系');
        }
        set_cookie('adminUser', base64_encode(serialize($adminUser)), 86400);
        $this->memcache->setData('adminUser', base64_encode(serialize($adminUser)));
        if ($this->input->post('backurl')) {
            $directUrl = $this->input->post('backurl');
        } else {
            $directUrl = base_url('home/dashboard');
        }
        $this->redirect($directUrl);
    }
    
     /**
     * 退出
     */
    public function logout()
    {
        if (get_cookie('adminUser')) {//修改成功退出登录。
            delete_cookie('adminUser');
        }
        if (get_cookie('bz_session')) {
            delete_cookie('bz_session');
        }
        $this->memcache->deleteMemcache('adminUser');
        $this->redirect('account/login');
    }
    
     /**
     * 验证
     * @return multitype:string
     */
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
    
     /**
     * 自动补全
     */
    public function autocompleteUser()
    {
        $result = $this->user->findByAutocomplete();
        $uidArray = $result->result_array();
        echo json_encode($uidArray);exit;
    }
}