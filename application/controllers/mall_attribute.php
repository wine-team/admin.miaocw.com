<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_attribute extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_attribute_model','mall_attribute');
	    $this->load->model('mall_goods_type_model','mall_goods_type');
	}
	
	public function grid($type_id = 0)
	{
	    $res = $this->mall_attribute->findById(array('type_id'=>$type_id));
	    $data['type_id'] = $type_id;
	    $data['res'] = $res;
	    $this->load->view('mall_attribute/grid', $data);
	}

	public function add($type_id)
	{
	    $data['type'] = $this->mall_goods_type->findById(array('type_id'=>$type_id))->row();
	    $this->load->view('mall_attribute/add', $data);
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('mall_attribute/add', $this->input->post('type_id'), $error);
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
	        $this->success('mall_attribute/grid', $this->input->post('type_id'), '新增成功！');
	    } else {
	        $this->error('mall_attribute/add', $this->input->post('type_id'), '新增失败！');
	    }
	}
	
	public function edit($attr_id)
	{
	    $data['type'] = $this->mall_goods_type->findById(array())->result();
	    $res = $this->mall_attribute->findById(array('attr_id'=>$attr_id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('mall_attribute/edit',$data);
	    } else {
	        $this->redirect('mall_goods_type/grid');
	    }
        $data['res'] = $res->row();
        $this->load->view('mall_attribute/edit',$data);
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
            $this->success('mall_attribute/grid', $this->input->post('type_id'), '修改成功！');
        } else {
            $this->error('mall_attribute/edit', $this->input->post('attr_id'), '修改失败！');
        }
	}
	
	public function delete($attr_id)
	{
        $is_delete = $this->mall_attribute->delete(array('attr'=>$attr_id));
        if ($is_delete) {
            $this->success('mall_attribute/grid', $this->input->get('type_id'), '删除成功！');
        } else {
            $this->error('mall_attribute/grid', $this->input->get('type_id'), '删除失败！');
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
