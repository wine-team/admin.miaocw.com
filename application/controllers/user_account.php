<?php 
class User_account extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('user_account_model', 'user_account');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('user_account/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('user_account/grid');
        $config['total_rows'] = $this->user_account->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['account_log'] = $this->user_account->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $this->load->view('accountlog/grid', $data);
    }
}