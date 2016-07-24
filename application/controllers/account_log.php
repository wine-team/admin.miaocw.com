<?php 
class Account_log extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('account_log_model', 'account_log');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('account_log/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('account_log/grid');
        $config['total_rows'] = $this->account_log->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['account_log'] = $this->account_log->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['accountTypeArray'] = array('1'=>'账户','2'=>'积分');
        $data['flowArray'] = array('1'=>'收入','2'=>'支出','3'=>'退款');
        $data['tradeTypeArray'] = array('1'=>'购物','2'=>'充值','3'=>'提现','4'=>'转账','5'=>'还款','6'=>'退款');
        $this->load->view('accountlog/grid', $data);
    }
}