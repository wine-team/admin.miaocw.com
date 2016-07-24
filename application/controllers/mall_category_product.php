<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_category_product extends CS_Controller
{
    public function _init()
    {
        $this->load->helper(array('dictionary', 'common'));
        $this->load->library('pagination');
        $this->load->model('mall_category_product_model','mall_category_product');
    }

    /**
     * ajax 翻页函数部分。
     * @param number $pg
     */
    public function ajaxGet($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('mall_category_product/ajaxGet').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_category_product/ajaxGet');
        $config['total_rows'] = $this->mall_category_product->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['page_list'] = $this->mall_category_product->page_list($page_num, $num, $this->input->get());
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $data['page_num'] = $page_num;

        echo json_encode(array(
            'status'=>true,
            'html'  =>$this->load->view('mall_category_product/ajaxCategoryProduct/ajaxData', $data, true)
        ));exit;
    }
}
