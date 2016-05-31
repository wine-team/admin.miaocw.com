<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_attribute_set extends MJ_Controller {
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
	    $perpage = 20;
	    $search['item'] = $getData['item'];
	    $config['first_url']   = base_url('mall_attribute_set/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('mall_attribute_set/grid');
	    $config['total_rows']  = $this->mall_attribute_set->mall_attribute_set_list(null, null, $search)->num_rows();
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_attribute_set->mall_attribute_set_list($pg-1, $perpage, $search)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg; 
	    $this->load->view('mall_attribute_set/grid', $data);
	}
	
	public function add()
	{
	    $this->load->view('mall_attribute_set/add');
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('mall_attribute_set/add', '', $error);
	    }
	    $postData = $this->input->post();
        $data['attr_set_name'] = $postData['attr_set_name'];
        $data['enabled'] = $postData['enabled'];
        $res = $this->mall_attribute_set->insert($data);
	    if ($res) {
	        $this->success('mall_attribute_set/grid', '', '新增成功！');
	    } else {
	        $this->error('mall_attribute_set/add', '', '新增失败！');
	    }
	}
	
	public function edit($attr_set_id)
	{
	    $res = $this->mall_attribute_set->findById(array('attr_set_id'=>$attr_set_id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $group = $this->mall_attribute_group->findById(array('attr_set_id'=>$attr_set_id))->result();
	        $groupid = array();
	        $arribute = array();
	        foreach($group as $g)
	        {
	            $groupid[] = $g->group_id;
	        }
	        if(!empty($groupid))
	        {
	            $arribute = $this->mall_attribute_value->getWherein('group_id', $groupid, array('attr_set_id'=>$attr_set_id))->result();
	        }
	        $data['attr_set_id'] = $attr_set_id;
	        $data['arribute'] = $arribute;
	        $data['group'] = $group; 
	        $this->load->view('mall_attribute_set/edit',$data);
	    } else {
	        $this->redirect('mall_attribute_set/grid');
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('mall_attribute_set/edit', $this->input->post('attr_set_id'), $error);
        }
        $postData = $this->input->post();
        $data['attr_set_name'] = $postData['attr_set_name'];
        $data['enabled'] = $postData['enabled']; 
        $res = $this->mall_attribute_set->update(array('attr_set_id'=>$postData['attr_set_id']), $data);
        if ($res) {
            $this->success('mall_attribute_set/grid', '', '修改成功！');
        } else {
            $this->error('mall_attribute_set/edit', $this->input->post('attr_set_id'), '修改失败！');
        }
	}
	
	public function delete($attr_set_id)
	{ 
	    $is_delete = $this->mall_attribute_set->delete(array('attr_set_id'=>$attr_set_id));
	    if ($is_delete) {
	        $this->success('mall_attribute_set/grid', '', '删除成功！');
	    } else {
	        $this->error('mall_attribute_set/grid', '', '删除失败！');
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
	
	public function addGroup($attr_set_id)
	{
	    $data['attr_set_id'] = $attr_set_id;
	    $this->load->view('mall_attribute_set/addGroup', $data);
	}
	
	public function addPostGroup()
	{
	    $postData = $this->input->post();
	    $data['attr_set_id'] = $postData['attr_set_id'];
	    $data['group_name'] = $postData['group_name'];
	    $group = $this->mall_attribute_group->findById($data)->num_rows();
	    if($group > 0)
	    {
	        $this->error('mall_attribute_set/edit', $postData['attr_set_id'], '组名已存在，新增失败！');
	    }else{
	        $data['sort'] = $postData['sort'];
	        $res = $this->mall_attribute_group->insert($data);
	        if ($res) {
	            $this->success('mall_attribute_set/edit', $postData['attr_set_id'], '新增成功！');
	        } else {
	            $this->error('mall_attribute_set/edit', $postData['attr_set_id'], '新增失败！');
	        } 
	    }
	}
	
	public function deleteGroup($group_id)
	{    
	    $is_delete = $this->mall_attribute_group->delete(array('group_id'=>$group_id));
	    if ($is_delete) {
	        $this->success('mall_attribute_set/edit', $this->input->get('attr_set_id'), '删除成功！');
	    } else {
	        $this->error('mall_attribute_set/edit', $this->input->get('attr_set_id'), '删除失败！');
	    }
	}
	
	
	
}

/** End of file Mall_attribute_set.php */
/** Location: ./application/controllers/Mall_attribute_set.php */
