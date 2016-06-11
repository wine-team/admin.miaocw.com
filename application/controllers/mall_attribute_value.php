<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_attribute_value extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_attribute_value_model','mall_attribute_value');
	    $this->load->model('mall_attribute_set_model','mall_attribute_set');
	    $this->load->model('mall_attribute_group_model','mall_attribute_group');
	}
	
	public function add($group_id)
	{
	    $data['attr_set_id'] = $this->input->get('attr_set_id');
	    $data['attr_group'] = $this->mall_attribute_group->findById(array('group_id'=>$group_id))->row(); 
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
	    $data['group_id'] = $postData['group_id'];
	    $data['attr_set_id'] = $postData['attr_set_id'];
	    $data['attr_name'] = $postData['attr_name'];
	    $data['attr_type'] = $postData['attr_type'];
	    $data['attr_values'] = toEnComma($postData['attr_values']);
	    $data['values_required'] = $postData['values_required'];
	    $data['attr_index'] = $postData['attr_index'];
	    $data['attr_spec'] = $postData['attr_spec'];
	    $data['is_linked'] = $postData['is_linked'];
<<<<<<< HEAD
	    $data['sort_order'] = $postData['sort_order']; 
=======
	    $data['attr_spec'] = in_array($postData['attr_type'],array('select','multiselect')) ? '2' : '1';
	    $data['sort_order'] = $postData['sort_order'];
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c
	    $res = $this->mall_attribute_value->insert($data);
	    if ($res) {
	        $this->success('mall_attribute_group/grid/'.$postData['group_id'], array('attr_set_id'=>$postData['attr_set_id']), '新增成功！');
	    } else {
	        $this->error('mall_attribute_value/add/'.$postData['group_id'], array('attr_set_id'=>$postData['attr_set_id']), '新增失败！');
	    }
	}
	
	public function edit($attr_value_id)
	{
	    $data['attr_set_id'] = $this->input->get('attr_set_id');
	    $res = $this->mall_attribute_value->findById(array('attr_value_id'=>$attr_value_id));
	    if ($res->num_rows() > 0)
	    {
	        $data['attr_group'] = $this->mall_attribute_group->findById(array('group_id'=>$res->row()->group_id))->row();
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
	    $data['group_id'] = $postData['group_id'];
	    $data['attr_set_id'] = $postData['attr_set_id'];
	    $data['attr_name'] = $postData['attr_name'];
	    $data['attr_type'] = $postData['attr_type'];
	    $data['attr_values'] = toEnComma($postData['attr_values']);
	    $data['values_required'] = $postData['values_required'];
	    $data['attr_index'] = $postData['attr_index'];
	    $data['attr_spec'] = $postData['attr_spec'];
	    $data['is_linked'] = $postData['is_linked'];
<<<<<<< HEAD
	    $data['sort_order'] = $postData['sort_order']; 
=======
	    $data['attr_spec'] = in_array($postData['attr_type'],array('select','multiselect')) ? '2' : '1';
	    $data['sort_order'] = $postData['sort_order'];
>>>>>>> 3fd183d709a48b9bfe5787742ca738d5df2fc29c
        $res = $this->mall_attribute_value->update(array('attr_value_id'=>$postData['attr_value_id']), $data);  
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
	
	public function ajaxGetAttr($pg = 1)
	{
	    $getData = $this->input->get();
	    $perpage = 10;
	    $search['item'] = $getData['item'];
	    $config['first_url']   = base_url('mall_attribute_value/mall_attribute_value_list').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('mall_attribute_value/mall_attribute_value_list');
	    $config['total_rows']  = $this->mall_attribute_value->mall_attribute_value_list(null, null, $search)->num_rows();
	    $config['uri_segment'] = 3;
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_attribute_value->mall_attribute_value_list($pg-1, $perpage, $search)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg;
	    echo json_encode(array(
	        'status'=>true,
	        'html'  =>$this->load->view('mall_goods_attr/addGoodsAttr/ajaxAttrData', $data, true)
	    ));exit;
	}
	
}
/** End of file mall_attribute_value.php */
/** Location: ./application/controllers/mall_attribute_value.php */
