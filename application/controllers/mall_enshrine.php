<?php 
class Mall_enshrine extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_enshrine_model', 'mall_enshrine');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('mall_enshrine/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_enshrine/grid');
        $config['total_rows'] = $this->mall_enshrine->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['mall_enshrine'] = $this->mall_enshrine->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $this->load->view('mallenshrine/grid', $data);
    }
}