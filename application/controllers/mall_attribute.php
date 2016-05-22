<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_attribute extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_attribute_model','mall_attribute');
	}

    public function grid($pg = 1)
	{
	    $getData = $this->input->get();
	    $perpage = 20;
	    $search['item'] = $getData['item'];
	    $config['first_url']   = base_url('mall_attribute/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('mall_attribute/grid');
	    $config['total_rows']  = $this->mall_attribute->mall_attribute_list(null, null, $search)->num_rows();
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_attribute->mall_attribute_list($pg-1, $perpage, $search)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg; 
	    $this->load->view('mall_attribute/grid', $data);
	}
	
	public function add()
	{
	    $this->load->view('mall_attribute/add');
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('mall_attribute/add', '', $error);
	    }
	    $postData = $this->input->post(); 
	    $data['attr_name'] = $postData['attr_name'];
	    $data['type_id'] = $postData['type_id'];
	    $data['attr_type'] = $postData['attr_type'];
	    $data['attr_values'] = toEnComma($postData['attr_values']);
	    $data['attr_index'] = $postData['attr_index'];
	    $data['is_linked'] = $postData['is_linked'];
	    $data['sort_order'] = $postData['sort_order'];
	    $res = $this->mall_attribute->insert($data);
	    if ($res) {
	        $this->success('mall_attribute/grid', '', '新增成功！');
	    } else {
	        $this->error('mall_attribute/add', '', '新增失败！');
	    }
	}
	
	public function edit($attr_id)
	{
	    $res = $this->mall_attribute->findById(array('attr_id'=>$attr_id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('mall_attribute/edit',$data);
	    } else {
	        $this->redirect('mall_attribute/grid');
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('mall_attribute/edit', $this->input->post('attr_id'), $error);
        }
        $postData = $this->input->post();
        $data['attr_name'] = $postData['attr_name'];
	    $data['type_id'] = $postData['type_id'];
	    $data['attr_type'] = $postData['attr_type'];
	    $data['attr_values'] = toEnComma($postData['attr_values']);
	    $data['attr_index'] = $postData['attr_index'];
	    $data['is_linked'] = $postData['is_linked'];
	    $data['sort_order'] = $postData['sort_order'];
        $res = $this->mall_attribute->update(array('attr_id'=>$postData['attr_id']), $data);  
        if ($res) {
            $this->success('mall_attribute/grid', '', '修改成功！');
        } else {
            $this->error('mall_attribute/edit', $this->input->post('attr_id'), '修改失败！');
        }
	}
	
	public function delete($attr_id)
	{
        $is_delete = $this->mall_attribute->delete(array('attr'=>$attr_id));
        if ($is_delete) {
            $this->success('mall_attribute/grid', '', '删除成功！');
        } else {
            $this->error('mall_attribute/grid', '', '删除失败！');
        }
	    
	}
	
	public function validate()
	{
	    $error = array();
        if ($this->validateParam($this->input->post('attr_name')))
        {
            $error[] = '属性名称不能为空';
        }
        if ($this->validateParam($this->input->post('attr_values')))
        {
            $error[] = '属性可选值不能为空';
        }
	    return $error;
	}
	
}
/** End of file Mall_attribute.php */
/** Location: ./application/controllers/Mall_attribute.php */
