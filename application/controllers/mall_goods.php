<?php 
class Mall_goods extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_goods_model', 'mall_goods');
        //$this->load->model('mall_attribute_set_model','mall_attribute_set');
        $this->load->model('region_model', 'region');
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('mall_goods/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('mall_goods/grid');
        $config['total_rows'] = $this->mall_goods->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['mall_goods'] = $this->mall_goods->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['is_on_sale'] = array('1' => '上架', '2' => '下架');
        $data['is_check'] = array('1' => '待审核', '2' => '审核通过', '3' => '审核拒绝');
        $data['pg_now'] = $pg;
        $this->load->view('mallgoods/grid', $data);
    }
    
     /**
     *添加的第一步
     */
    public function addstep1()
    {
    	$data['extension'] = array('simple'=>'简单产品','virtual'=>'虚拟产品','giftcard'=>'礼品卡');
    	$this->load->view('mallgoods/addstep1',$data);
    }
    
    
    /**
     * 设置产品上下架
     * @param unknown $goods_id
     * @param unknown $status
     * @param unknown $pageNow
     */
    public function setIsOnSaleStatus($goods_id, $status, $pageNow)
    {
    	switch ($status) {
    		case '1': $isOnSale = '2'; break;
    		case '2': $isOnSale = '1'; break;
    		default : $isOnSale = '1'; break;
    	}
    	$param['is_on_sale'] = $isOnSale;
    	$this->db->trans_start();
    	$result = $this->mall_goods->updateByGoodsId($goods_id,$param);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === TRUE) {
    		$this->success('mall_goods/grid/'.$pageNow, $this->input->get(), '操作成功！');
    	} else {
    		$this->error('mall_goods/grid/'.$pageNow, $this->input->get(), '操作失败！');
    	}
    }
    
    /**
     * 设置产品审核状态
     * @param unknown $goods_attr_id
     * @param unknown $status
     * @param unknown $pageNow
     */
    public function setIsCheckStatus($goods_id, $status, $pageNow)
    {
    	switch ($status) {
    		case '1': $isCheck = '2'; break;
    		case '2': $isCheck = '3'; break;
    		default : $isCheck = '1'; break;
    	}
    	$param['is_check'] = $isCheck;
    	$this->db->trans_start();
    	$result = $this->mall_goods->updateByGoodsId($goods_id, $param);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === TRUE) {
    		$this->success('mall_goods/grid/'.$pageNow, $this->input->get(), '操作成功！');
    	} else {
    		$this->error('mall_goods/grid/'.$pageNow, $this->input->get(), '操作失败！');
    	}
    }
    
}