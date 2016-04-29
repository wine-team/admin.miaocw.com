<?php
class Login extends CI_Controller 
{
	
    public function check_login() 
    {
        //判断后台进入 已登录
        $uriString = uri_string();
        if (
            $uriString != 'account/logout' && 
            $uriString != 'account/login' && 
            $uriString != 'account/loginPost'
        ) {
            $adminUser = $this->session->userdata('adminUser');
            if (!$adminUser) {
                redirect('account/login');
            }
        }
    }
  
}
