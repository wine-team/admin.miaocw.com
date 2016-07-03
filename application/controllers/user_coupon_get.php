<?php
class User_coupon_get extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('user_coupon_get_model', 'user_coupon_get');
        $this->load->model('mall_category_model', 'mall_category');
        $this->load->model('supplier_model', 'supplier');
    }

    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg - 1) * $page_num;
        $config['first_url'] = base_url('user_coupon_get/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('user_coupon_get/grid');
        $config['total_rows'] = $this->user_coupon_get->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->user_coupon_get->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $data['scope'] = array(1 => '自营劵', 2 => '店铺劵');
        $data['staus'] = array(1 => '未使用', 2 => '已使用');
        $this->load->view('user_coupon_get/grid', $data);
    }

}