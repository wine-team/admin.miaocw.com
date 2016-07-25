<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_category_product extends CS_Controller
{
    public function _init()
    {
        $this->load->helper(array('dictionary', 'common'));
        $this->load->library('pagination');
        $this->load->model('mall_category_product_model','mall_category_product');
        $this->load->model('mall_goods_base_model','mall_goods_base');
    }

    /**
     * ajax 翻页函数部分。
     * @param number $pg
     */
    public function ajaxGet($pg = 1)
    {
        $getData = $this->input->get();
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('mall_category_product/ajaxGet').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_category_product/ajaxGet');
        $goodsInfo = $this->mall_category_product->findByCategoryId($this->input->get('category_id'), true);
        if (!empty($goodsInfo) && $this->input->get('join') != '') {
            $getData['goods_ids'] = array_keys($goodsInfo);
        }
        $config['total_rows'] = $this->mall_goods_base->total($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['page_list'] = $this->mall_goods_base->page_list($page_num, $num, $getData);
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $data['page_num'] = $page_num;
        $data['goodsInfo'] = $goodsInfo;

        echo json_encode(array(
            'status'=>true,
            'html'  =>$this->load->view('mall_category_product/ajaxCategoryProduct/ajaxData', $data, true)
        ));exit;
    }
}
