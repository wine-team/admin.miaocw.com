<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_attribute_value extends CS_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->helper('dictionary');
	    $this->load->model('mall_attribute_value_model','mall_attribute_value');
	    $this->load->model('mall_attribute_set_model','mall_attribute_set');
	    $this->load->model('mall_attribute_group_model','mall_attribute_group');
	}
	
	public function add($group_id)
	{
	    $data['attr_set_id'] = $this->input->get('attr_set_id');
	    $data['attr_group'] = $this->mall_attribute_group->findById($group_id)->row(); 
	    $data['attr_set'] = $this->mall_attribute_set->findById($data['attr_set_id'])->row();
	    $this->load->view('mall_attribute_value/add', $data);
	}
	
	public function addPost()
	{
	    $postData = $this->input->post();
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('mall_attribute_value/add/'.$postData['group_id'], array('attr_set_id'=>$postData['attr_set_id']), $error);
	    }
	    $res = $this->mall_attribute_value->insertAttrVal($postData);
	    if ($res) {
	        $this->success('mall_attribute_group/grid/'.$postData['group_id'], array('attr_set_id'=>$postData['attr_set_id']), '新增成功！');
	    } else {
	        $this->error('mall_attribute_value/add/'.$postData['group_id'], array('attr_set_id'=>$postData['attr_set_id']), '新增失败！');
	    }
	}
	
	public function edit($attr_value_id)
	{
	    $data['attr_set_id'] = $this->input->get('attr_set_id');
	    $res = $this->mall_attribute_value->findById($attr_value_id);
	    if ($res->num_rows() > 0)
	    {
	        $data['attr_group'] = $this->mall_attribute_group->findById($res->row()->group_id)->row();
	        $data['attr_set'] = $this->mall_attribute_set->findById($data['attr_set_id'])->row();
	        $data['res'] = $res->row();
	        $this->load->view('mall_attribute_value/edit',$data);
	    } else {
            $this->error('mall_attribute_set/grid', $this->input->get('attr_set_id'), '没找到对应属性');
	    }
	}
	
	public function editPost()
	{
	    $postData = $this->input->post();
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('mall_attribute_value/edit/'.$postData['attr_value_id'], array('attr_set_id'=>$postData['attr_set_id']), $error);
        }
        $res = $this->mall_attribute_value->updateAttrVal($postData);  
        if ($res) {
            $this->success('mall_attribute_group/grid/'.$postData['group_id'], array('attr_set_id'=>$postData['attr_set_id']), '修改成功！');
        } else {
            $this->error('mall_attribute_value/edit/'.$postData['attr_value_id'], array('attr_set_id'=>$postData['attr_set_id']), '修改失败！');
        } 
	}
	
	public function delete($attr_value_id)
	{
        $is_delete = $this->mall_attribute_value->delete(array('attr_value_id'=>$attr_value_id));
        if ($is_delete) {
            $this->success('mall_attribute_group/grid', array('attr_set_id'=>$this->input->get('attr_set_id')), '删除成功！');
        } else {
            $this->error('mall_attribute_group/grid', array('attr_set_id'=>$this->input->get('attr_set_id')), '删除失败！');
        }
	    
	}
	
	public function validate()
	{
	    $error = array();
        if ($this->validateParam($this->input->post('attr_name')))
        {
            $error[] = '属性名称不能为空';
        }
        if ($this->validateParam($this->input->post('attr_type')))
        {
            $error[] = '属性类型不能为空';
        }
	    return $error;
	}
	
	
}
/** End of file mall_attribute_value.php */
/** Location: ./application/controllers/mall_attribute_value.php */
