<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mall_attribute_set extends MJ_Controller
{
	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_attribute_set_model','mall_attribute_set');
	    $this->load->model('mall_attribute_group_model','mall_attribute_group');
	    $this->load->model('mall_attribute_value_model','mall_attribute_value');
	}
    public function grid($pg = 1)
	{ 
	    $getData = $this->input->get();
	    $page_num = 20;
		$num = ($pg-1)*$page_num;
	    $config['first_url']   = base_url('mall_attribute_set/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('mall_attribute_set/grid');
	    $config['total_rows']  = $this->mall_attribute_set->total($getData);
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['page_list'] = $this->mall_attribute_set->page_list($page_num, $num, $getData);
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now'] = $pg;
		$data['page_num'] = $page_num;
	    $this->load->view('mall_attribute_set/grid', $data);
	}
	
	public function add()
	{
	    $this->load->view('mall_attribute_set/add');
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error)) {
	        $this->error('mall_attribute_set/add', '', $error);
	    }
        $res = $this->mall_attribute_set->insert($this->input->post());
	    if ($res) {
	        $this->success('mall_attribute_set/grid', '', '新增成功！');
	    } else {
	        $this->error('mall_attribute_set/add', '', '新增失败！');
	    }
	}
	
	public function edit($attr_set_id)
	{
	    $result = $this->mall_attribute_set->findById($attr_set_id);
		if ($result->num_rows() <= 0) {
			$this->error('mall_attribute_set/grid', '', '商品属性不存在');
		}
		$data['attributeSet'] = $result->row();
		$this->load->view('mall_attribute_set/edit', $data);
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error)) {
            $this->error('mall_attribute_set/edit', $this->input->post('attr_set_id'), $error);
        }
        $update = $this->mall_attribute_set->updateAttributeSet($this->input->post());
        if ($update) {
            $this->success('mall_attribute_set/grid', '', '修改成功！');
        } else {
            $this->error('mall_attribute_set/edit', $this->input->post('attr_set_id'), '修改失败！');
        }
	}
	
	public function validate()
	{   
	    $error = array();
        if ($this->validateParam($this->input->post('attr_set_name'))) {
            $error[] = '商品类型名称不能为空';
        }
	    return $error;
	}
	
}
/** End of file Mall_attribute_set.php */
/** Location: ./application/controllers/Mall_attribute_set.php */