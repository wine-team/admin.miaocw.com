<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supply_sales_join extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('supply_sales_join_model','supply_sales_join');
	}

    public function grid($pg = 1)
	{
	    $getData = $this->input->get();
	    $perpage = 20;
	    $config['first_url']   = base_url('supply_sales_join/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('supply_sales_join/grid');
	    $config['total_rows']  = $this->supply_sales_join->total($getData)->num_rows();
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->supply_sales_join->supply_sales_join_list($pg-1, $perpage, $getData)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg; 
	    $this->load->view('supply_sales_join/grid', $data);
	}
	
	public function edit($id)
	{
	    $res = $this->supply_sales_join->findById(array('id'=>$id));
	    if ($res->num_rows() <= 0){
	    	$this->error('supply_sales_join/grid', '', '无法找到该ID结果值');
	    } 
	    $data['res'] = $res->row();
	    $this->load->view('supply_sales_join/edit',$data);
	}
	
	public function editPost()
	{
        $postData = $this->input->post();
	    $data['flag'] = $postData['flag'];
        $res = $this->supply_sales_join->update(array('id'=>$postData['id']), $data);  
        if ($res) {
            $this->success('supply_sales_join/grid', '', '修改成功！');
        } else {
            $this->error('supply_sales_join/edit', $this->input->post('id'), '修改失败！');
        }
	}
	
	public function delete($id)
	{ 
        $is_delete = $this->supply_sales_join->delete(array('id'=>$id));
        if ($is_delete) {
            $this->success('supply_sales_join/grid', '', '删除成功！');
        } else {
            $this->error('supply_sales_join/grid', '', '删除失败！');
        }
	    
	}
	
	
}
/** End of file Supply_sales_join.php */
/** Location: ./application/controllers/Supply_sales_join.php */
