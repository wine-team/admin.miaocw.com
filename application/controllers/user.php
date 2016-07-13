<?php 
class User extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('user_model', 'user');
    }
    
    public function grid($pg = 1)
    {
    	$page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('user/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('user/grid');
        $config['total_rows']  = $this->user->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->user->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $this->load->view('user/grid', $data);
    }

    public function toggle()
    {
        $uid = $this->input->post('uid');
        $status = $this->input->post('flag');
        switch ($status) {
            case '1': $flag = '2'; break;
            case '2': $flag = '1'; break;
            default : $flag = '2'; break;
        }
        $this->db->trans_start();
        $isUpdate = $this->user->updateUser(array('uid' => $uid, 'flag' => $flag));
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE && $isUpdate) {
            echo json_encode(array(
                'flag' => $flag,
            ));
        } else {
            echo json_encode(array(
                'flag' => 3,
            ));
        }
        exit;
    }

    public function add()
    {
        $data = array();
        $this->load->view('user/add', $data);
    }
    
    public function addPost()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->jsonMessage($error);
        }
        $this->db->trans_start();
        $uid = $this->user->insert($this->input->post());
        $this->db->trans_complete();
        if ($uid) {
            $this->session->set_flashdata('success', '添加成功！');
            $this->jsonMessage('', base_url('user/grid'));
        } else {
            $this->session->set_flashdata('error', '保存失败！');
            $this->jsonMessage('', base_url('user/add'));
        }
    }
    
    public function edit($id)
    {
        $result = $this->user->findById($id);
        if(!$result) {
            $this->error('user/grid', '', '数据不存在！');
        }
        $data['row'] = $result->row();
        $this->load->view('user/edit', $data);
    }
    
    public function editPost()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->jsonMessage($error);
        }
        $this->db->trans_start();
        $isUpdate = $this->user->update($this->input->post());
        $this->db->trans_complete();
        
        if ($isUpdate) {
            $this->session->set_flashdata('success', '保存成功！');
            $this->jsonMessage('', base_url('user/grid'));
        } else {
            $this->session->set_flashdata('error', '保存失败！');
            $this->jsonMessage('', base_url('user/edit'));
        }
    }

    /**
     * 验证手机号是否注册过。
     */
    public function validatePhone()
    {
        if ($this->input->post('uid')) {
            $result = $this->user->findById($this->input->post('uid'));
            if ($result->num_rows() <= 0){
                echo 'false';
            }
            $userInfo = $result->row();
            if ($userInfo->phone != $this->input->post('phone')) {
                $mobilePhone = $this->user->validatePhone($this->input->post('phone'));
                if ($mobilePhone->num_rows() > 0){
                    echo 'false';
                } else {
                    echo 'true';
                }
            } else {
                echo 'true';
            }
        } else {
            $result = $this->user->validatePhone($this->input->post('phone'));
            if ($result->num_rows() > 0) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
        exit;
    }

    /**
     * 验证用户是否注册过。
     */
    public function validateEmail()
    {
        if ($this->input->post('uid')) {
            $result = $this->user->findById($this->input->post('uid'));
            if ($result->num_rows() <= 0) {
                echo 'false';
            }
            $userInfo = $result->row();
            if ($userInfo->email != $this->input->post('email')) {
                $result = $this->user->validateEmail($this->input->post('email'));
                if ($result->num_rows() > 0) {
                    echo 'false';
                } else {
                    echo 'true';
                }
            } else {
                echo 'true';
            }
        } else {
            $result = $this->user->validateEmail($this->input->post('email'));
            if ($result->num_rows() > 0) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
        exit;
    }

    public function delete($uid)
    {
        $this->db->trans_start();
        $is_delete = $this->user->deleteById($uid);
        $this->db->trans_complete();
        
        if (!$is_delete) {
            $this->error('user/grid', '', '删除失败！');
        }
        $this->success('user/grid', '', '删除成功！');
    }
    
     /**
     * 重置密码
     * @param unknown $uid
     */
    public function restPassword($uid){
    	
    	$result = $this->user->updatePasswordByUid($uid);
    	if (!$result) {
    		$this->error('user/grid',array('username'=>$uid), '重置失败！');
    	}
    	$this->success('user/grid', '', '重置成功！');
    }
    
    public function validate()
    {
        $error = array();
        if (!$this->input->post('uid')) {
            $mobilePhone = $this->user->validatePhone($this->input->post('phone'));
            if ($mobilePhone->num_rows() > 0){
                $error[] = '手机号码已经存在。';
            }
            $mobileEmail = $this->user->validateEmail($this->input->post('email'));
            if ($mobileEmail->num_rows() > 0){
                $error[] = '邮箱已经存在。';
            }
            if ($this->validateParam($this->input->post('password'))) {
                $error[] = '请输入用户密码。';
            }
        } else {
            $result = $this->user->findById($this->input->post('uid'));
            if ($result->num_rows() <= 0){
                $error[] = '修改错误，请重新进入重试';
            }
            $userInfo = $result->row(0);
            if ($userInfo->phone != $this->input->post('phone')) {
                $result = $this->user->validatePhone($this->input->post('phone'));
                if ($result->num_rows() > 0){
                    $error[] = '手机号已存在。';
                }
            }
            if ($userInfo->email != $this->input->post('email')) {
                $mobileEmail= $this->user->validateEmail($this->input->post('email'));
                if ($mobileEmail->num_rows() > 0){
                    $error[] = '邮箱已经存在。';
                }
            }
        }
        if ($this->input->post('parent_id')) {
            $result = $this->user->findByParams(array('parent_id'=>$this->input->post('parent_id')));
            if ($result->num_rows() <= 0) {
                $error[] = '填写的父级序号不存在';
            }
        }
        return $error;
    }
    
    /**
     * ajax 翻页函数部分。
     * @param number $pg
     */
    public function ajaxGet($pg = 1)
    {
        $page_num = 10;
        $num = ($pg-1)*$page_num;
        $config['per_page'] = 10;
        $config['first_url'] = base_url('user/ajaxGet').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('user/ajaxGet');
        $config['total_rows'] = $this->user->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['page_list'] = $this->user->page_list($page_num, $num, $this->input->get());
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $data['page_num'] = $page_num;
        
        echo json_encode(array(
            'status'=>true,
            'html'  =>$this->load->view('user/ajaxUser/ajaxData', $data, true)
        ));exit;
    }
}