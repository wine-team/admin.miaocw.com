<?php 
class Mall_cart_goods extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_cart_goods_model', 'mall_cart_goods');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('mall_cart_goods/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_cart_goods/grid');
        $config['total_rows'] = $this->mall_cart_goods->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['cart_goods'] = $this->mall_cart_goods->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['uid'] = $this->input->get('uid');
        $this->load->view('mallcartgoods/grid', $data);
    }
}