<?php
class Useraccount extends MJ_Controller{
    
    public function _init(){
        $this->load->helper(array('common'));
        $this->load->library('pagination');
        $this->load->model('user_account_model', 'user_account');
        $this->load->model('account_log_model', 'account_log');
        $this->load->model('user_model', 'user');
    }
    
    public function index($pg = 1){
        $num = ($pg-1)*20;
        $config['base_url'] = base_url('useraccount/index');
        $config['total_rows'] = $this->user_account->findByRechargeTotal();
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['resultObj'] = $this->user_account->findByRecharge($num);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $this->load->view('useraccount/index', $data);
    }
    
    public function search($pg = 1)
    {
        if (!$this->search_get_validate($this->input->get())) {
            $this->redirect('useraccount/index');
        }
        $data['userName']  = $this->input->get('userName');
        $getData = $data;
         
        $num = ($pg-1)*20;
        $config['first_url'] = base_url('useraccount/search').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url']    = base_url('useraccount/search');
        $config['total_rows']  = $this->user_account->findByRechargeTotal($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['resultObj'] = $this->user_account->findByRecharge($num, $getData);
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $this->load->view('useraccount/index', $data);
    }
    
    public function historyrecharge($pg = 1){
        if (!$this->search_get_validate($this->input->get())) {
            $this->redirect('useraccount/index');
        }
        $data['uid']  = $this->input->get('uid');
        $data['type_not_in'] = array(2048);
        $getData = $data;
        
        $num = ($pg-1)*20;
        $config['first_url'] = base_url('useraccount/historyrecharge').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url']    = base_url('useraccount/historyrecharge');
        $config['total_rows']  = $this->account_log->accountLogUidTotal($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['resultObj'] = $this->account_log->accountLogUidList($num, $getData);
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $this->load->view('useraccount/historyrecharge', $data);
    }
    
    public function recharge(){
        //检验操作权限
        if (!$this->admin_priv('vir_rech_add')){
            $this->error('useraccount/index', '', '你没有此项操作的权限!');
        }
        $uid = $this->input->get('uid');
        $userExist = $this->user->findById($uid);
        if (!$uid && $userExist) {
            $this->error('useraccount/index', '',  '用户名不存在');
        }
        $data['userInfo'] = $userExist->row();
        $this->load->view('useraccount/recharge', $data);
    }
    
    public function addRecharge()
    {
        //检验操作权限
        if (!$this->admin_priv('vir_rech_add')){
            $this->error('useraccount/index', '',  '你没有此项操作的权限!');
        }
        $uid = $this->input->post('uid');
        $userExist = $this->user_account->findByUid($uid);
        if (!$uid && $userExist) {
            $this->error('useraccount/index', '', '用户名不存在');
        }
        $amount_org = $this->calculateAmountCarry($userExist);
        
        $logData = array(
                    'uid'=>$uid,
                    'amount'=>$this->input->post('amount_carry'),
                    'amount_carry'=>$amount_org,
                    'type'=>16,
                    'account_type'=>1,
                    'remittance_person' => $this->session->userdata('id')
        );
        $this->db->trans_start();
        $account_update = $this->user_account->updateUserAccount($uid, $amount_org);
        $account_log = $this->account_log->insertAccountLog($logData);
        $this->db->trans_complete();
    
        if ($account_update && $account_log) {
            $this->success('useraccount/index', '', '保存成功！');
        } else {
            $this->error('useraccount/index', '', '充值失败!');
        }
    }
    
    private function calculateAmountCarry($userExist)
    {
        $amount_carry = $userExist->row()->amount_carry;
        $addValue = $this->input->post('amount_carry');
        if (is_numeric($amount_carry)) {
            $amount_carry += $addValue;
        }
        return $amount_carry;
    }
    
    public function rechargelog($pg = 1){
        $getData['type'] = array(16);
        $num = ($pg-1)*20;
        $config['base_url'] = base_url('useraccount/rechargelog');
        $config['total_rows'] = $this->account_log->accountLogUidTotal($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['resultObj'] = $this->account_log->accountLogUidList($num, $getData);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $this->load->view('useraccount/rechargelog', $data);
    }
    
    public function rechargelogsearch($pg = 1){
        
    	if (!$this->search_get_validate($this->input->get())) {
            $this->redirect('useraccount/rechargelog');
        }
        $data['username']  = $this->input->get('username');
        $data['startDate']  = $this->input->get('startDate');
        $data['endDate']  = $this->input->get('endDate');
        $data['type'] = array(16);
        $getData = $data;
        $num = ($pg-1)*20;
        $config['first_url'] = base_url('useraccount/rechargelogsearch').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url']    = base_url('useraccount/rechargelogsearch');
        $config['total_rows']  = $this->account_log->accountLogUidTotal($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['resultObj'] = $this->account_log->accountLogUidList($num, $getData);
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $this->load->view('useraccount/rechargelog', $data);
    }
}