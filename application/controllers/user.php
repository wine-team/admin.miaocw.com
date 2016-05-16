<?php 
class User extends CS_Controller
{
    private $postData = array();
    private $parentId = 0;
    public function _init()
    {
        $this->load->helper(array('common'));
        $this->load->library('pagination');
        $this->load->model('user_model', 'user');
    }
    
    public function grid($pg = 1)
    {
    	$page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url']   = base_url('user/grid').$this->pageGetParam($this->input->get());
        $config['suffix']      = $this->pageGetParam($this->input->get());
        $config['base_url']    = base_url('user/grid');
        $config['total_rows']  = $this->user->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['page_list'] = $this->user->page_list($page_num, $num, $this->input->get());
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $this->load->view('user/grid', $data);
    }
    
    public function add()
    {
        $data = array();
        $this->load->view('user/add', $data);
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
        $isUpdate = $this->user->updateUserInfo(array('uid' => $uid, 'flag' => $flag));
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
    
    public function addPost()
    {
        $this->db->trans_start();
        $uid = $this->user->insert($this->postData);
        $this->db->trans_complete();
        if ($uid) {
            $this->session->set_flashdata('success', '添加成功！');
            $this->jsen('user/grid?', true);
        } else {
            $this->session->set_flashdata('error', '保存失败！');
            $this->jsen('user/add?sid='.$this->input->post('sid'), true);
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
        $this->db->trans_start();
        $uid = $this->user->update($this->postData);
        $this->db->trans_complete();
        
        if ($uid) {
            $this->session->set_flashdata('success', '保存成功！');
            $this->jsen('user/grid?', true);
        } else {
            $this->session->set_flashdata('error', '保存失败！');
            $this->jsen('user/edit?sid='.$this->input->post('sid'), true);
        }
    }
    
    public function ajaxVaildate()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->jsen($error);
        }
        
        if ($this->input->post('uid')) { //用户ID
            $this->editPost();
        } else {
            $this->addPost();
        }
    }

    public function jsen($error, $status = FALSE)
    {
        echo json_encode(array(
            'message' => $error,
            'status'  => $status
        ));exit;
    }
    
    /**
     * 验证用户是否注册过。
     */
    public function validateName()
    {
        if ($this->input->post('uid')) {
            $result = $this->user->findById($this->input->post('uid'));
            if ($result->num_rows() <= 0) {
                echo 'false';
            }
            $userInfo = $result->row();
            if ($userInfo->user_name != $this->input->post('user_name')) {
                $result = $this->user->findByUserName(array('user_name'=>$this->input->post('user_name')));
                if ($result->num_rows() > 0) {
                    echo 'false';
                } else {
                    echo 'true';
                }
            } else {
                echo 'true';
            }
        } else {
            $result = $this->user->validateName($this->input->post('user_name'));
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
    public function validateMobilePhone()
    {
        if ($this->input->post('uid')) {
            $result = $this->user->findById($this->input->post('uid'));
            if ($result->num_rows() <= 0){
                echo 'false';
            }
            $userInfo = $result->row();
            if ($userInfo->mobile_phone != $this->input->post('mobile_phone')) {
                $mobilePhone = $this->user->validateMobilePhone($this->input->post('mobile_phone'));
                if ($mobilePhone->num_rows() > 0){
                    echo 'false';
                } else {
                    echo 'true';
                }
            } else {
                echo 'true';
            }
        } else {
            $result = $this->user->validateMobilePhone($this->input->post('phone'));
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
        $detailId  = $this->user_detail->delete($uid);
        $accountId = $this->user_account->delete($uid);
        $this->db->trans_complete();
        
        if (!$is_delete || !$detailId || !$accountId) {
            $this->error('user/grid', '', '删除失败！');
        }
        
        $this->success('user/grid', '', '删除成功！');
    }
    
    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('user_name'))) {
            $error[] = '请输入用户名称。';
        }
        if (!$this->input->post('uid')) {
            $result = $this->user->findByUserName(array('user_name'=>$this->input->post('user_name'),'alias_name'=>$this->input->post('alias_name')));
            if ($result->num_rows() > 0){
                $error[] = '用户名称或用户呢称已存在。';
            }
            $mobilePhone = $this->user->validateMobilePhone($this->input->post('phone'));
            if ($mobilePhone->num_rows() > 0){
                $error[] = '手机号码已经存在。';
            }
            if ($this->validateParam($this->input->post('pw'))) {
                $error[] = '请输入用户密码。';
            }
            if ($this->input->post('pw') != $this->input->post('password')) {
                $error[] = '二次密码输入不一致，请从新输入。';
            }
        } else {
            $result = $this->user->findById($this->input->post('uid'));
            if ($result->num_rows() <= 0){
                $error[] = '修改错误，请重新进入重试';
            }
            $userInfo = $result->row();
            if ($userInfo->user_name != $this->input->post('user_name')) {
                $result = $this->user->findByUserName(array('user_name'=>$this->input->post('user_name')));
                if ($result->num_rows() > 0){
                    $error[] = '用户名称已存在。';
                }
            }
            if ($userInfo->phone != $this->input->post('phone')) {
                $mobilePhone = $this->user->validateMobilePhone($this->input->post('phone'));
                if ($mobilePhone->num_rows() > 0){
                    $error[] = '手机号码已经存在。';
                }
            }
        }
        if ($this->validateParam($this->input->post('userType'))) {
            $error[] = '请选择用户类型。';
        }
        
        $userType = $this->input->post('userType');
        $opt = 0;
        foreach ($userType as $value){
            $opt += $value;
        }
        $this->postData = $this->input->post();
        $this->postData['user_type'] = $opt;
        
        if ($opt&UTID_PROVIDER) {
            if ($this->validateParam($this->input->post('cellphone'))) {
                $error[] = '供应商帐号，备用手机号码不能为空';
            }
        }
        $parent_id = $this->input->post('parent_id') ? $this->input->post('parent_id') :'1';
        if (!empty($parent_id)) {
            $result = $this->user->findByIds(array('parent_id'=>$this->input->post('parent_id')));
            if ($result){
                $this->parentId = $parent_id;
            }else {
                $error[] = '填写的父级序号不存在';
            }
        }
        return $error;
    }
    
    public function addMachine($uid)
    {
        $macs = $this->goodsMacs->findByMacs($uid);
        $goodsId =array();
        if ($this->parentId > 16 && !$macs){
            $goodProfit = $this->goods_map_profit->findByUid($this->parentId);
            if ($goodProfit){
                foreach ($goodProfit->result() as $value){
                    $goodsId[] = $value->goods_id;
                }
                $this->goodsMacs->insertInto($macs->row_array(), $goodsId);
            }
        }
    }
    
    public function accountlog($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('user/accountLog').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('user/accountlog');
        $config['total_rows'] = $this->account_log->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config); 
        $data['pg_list'] = $this->pagination->create_links();
        $data['page_list'] = $this->account_log->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['type'] = $this->levelType();
        $data['account_type'] = $this->accountType();
        $data['product_type'] = array('scenic'=>'景区', 'hotel'=>'酒店', 'line'=>'线路', 'tourism'=>'商品');
        $this->load->view('user/accountlog', $data);
    }
    
    /**
     * ajax 翻页函数部分。
     * @param number $pg
     */
    public function ajaxGetUser($pg = 1)
    {
        if ($this->input->get('uidid')) { //如果存在uidid，则赋值给uid
            $_GET['uid'] = $this->input->get('uidid');
        }
        $page_num = 10;
        $num = ($pg-1)*$page_num;
        $config['per_page'] = 10;
        $config['first_url'] = base_url('user/ajaxGetUser').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('user/ajaxGetUser');
        $config['total_rows'] = $this->user->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_list']   = $this->pagination->create_links();
        $data['page_list'] = $this->user->page_list($page_num, $num, $this->input->get());
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $data['user_type'] = $this->user_type->find();
        
        echo json_encode(array(
            'status'=>true,
            'html'  =>$this->load->view('user/addSupplierUid/ajaxUserData', $data, true)
        ));exit;
    }
    
    
}