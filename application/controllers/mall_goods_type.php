<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_goods_type extends MJ_Controller {
	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_goods_type_model','mall_goods_type');
	}

    public function grid($pg = 1)
	{ 
	    $getData = $this->input->get();
	    $perpage = 20;
	    $search['item'] = $getData['item'];
	    $config['first_url']   = base_url('mall_goods_type/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('mall_goods_type/grid');
	    $config['total_rows']  = $this->mall_goods_type->mall_goods_type_list(null, null, $search)->num_rows();
	    $config['uri_segment'] = 3; 
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['res_list'] = $this->mall_goods_type->mall_goods_type_list($pg-1, $perpage, $search)->result();
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg; 
	    $this->load->view('mall_goods_type/grid', $data);
	}
	
	public function add()
	{
	    $this->load->view('mall_goods_type/add');
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('mall_goods_type/add', '', $error);
	    }
	    $postData = $this->input->post();
        $data['type_name'] = $postData['type_name'];
        $data['enabled'] = $postData['enabled'];
        $res = $this->mall_goods_type->insert($data);
	    if ($res) {
	        $this->success('mall_goods_type/grid', '', '新增成功！');
	    } else {
	        $this->error('mall_goods_type/add', '', '新增失败！');
	    }
	}
	
	public function edit($type_id)
	{
	    $res = $this->mall_goods_type->findById(array('type_id'=>$type_id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('mall_goods_type/edit',$data);
	    } else {
	        $this->redirect('mall_goods_type/grid');
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('mall_goods_type/edit', $this->input->post('type_id'), $error);
        }
        $postData = $this->input->post();
        $data['type_name'] = $postData['type_name'];
        $data['enabled'] = $postData['enabled']; 
        $res = $this->mall_goods_type->update(array('type_id'=>$postData['type_id']), $data);
        if ($res) {
            $this->success('mall_goods_type/grid', '', '修改成功！');
        } else {
            $this->error('mall_goods_type/edit', $this->input->post('type_id'), '修改失败！');
        }
	}
	
	public function delete($type_id)
	{ 
	    $is_delete = $this->mall_goods_type->delete(array('type_id'=>$type_id));
	    if ($is_delete) {
	        $this->success('mall_goods_type/grid', '', '删除成功！');
	    } else {
	        $this->error('mall_goods_type/grid', '', '删除失败！');
	    }
	}
	
	public function validate()
	{   
	    $error = array();
        if ($this->validateParam($this->input->post('type_name'))) {
            $error[] = '商品类型名称不能为空';
        }
	    return $error;
	}
}

/** End of file Mall_goods_type.php */
/** Location: ./application/controllers/Mall_goods_type.php */
