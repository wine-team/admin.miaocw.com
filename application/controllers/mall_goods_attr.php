<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_goods_attr extends MJ_Controller {
	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_goods_attr_model','mall_goods_attr');
	}

    public function grid($goods_id = 0)
	{
	    $data['goods_id'] = $goods_id;
	    $data['res'] = $this->mall_goods_attr->findById(array('goods_id'=>$goods_id))->result();
	    $this->load->view('mall_goods_attr/grid', $data);
	}
	
	public function add($goods_id)
	{
	    $data['goods_id'] = $goods_id;
	    $this->load->view('mall_goods_attr/add', $data);
	}
	
	public function addPost()
	{
	    $error = $this->validate();  
	    if (!empty($error))
	    {
	        $this->error('mall_goods_attr/add', $this->input->post('goods_id'), $error);
	    }
	    $postData = $this->input->post();
        $data['goods_id'] = $postData['goods_id'];
        $data['attr_id'] = $postData['attr_id'];
        $data['attr_value'] = $postData['attr_value'];
        $goods_attr = $this->mall_goods_attr->findById($data)->num_rows();
        if ($goods_attr)
        {
            $this->error('mall_goods_attr/add', $this->input->post('goods_id'), '此属性值已存在，新增失败！');
        } else {
            $data['attr_price'] = $postData['attr_price'];
            $res = $this->mall_goods_attr->insert($data);
            if ($res) {
                $this->success('mall_goods_attr/grid', $this->input->post('goods_id'), '新增成功！');
            } else {
                $this->error('mall_goods_attr/add', $this->input->post('goods_id'), '新增失败！');
            }
        }
	}
	
	public function edit($goods_attr_id)
	{
	    $res = $this->mall_goods_attr->findById(array('goods_attr_id'=>$goods_attr_id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('mall_goods_attr/edit',$data);
	    } else {
	        $this->redirect('mall_goods_attr/grid/'.$this->input->get('goods_id'));
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('mall_goods_attr/edit', $this->input->post('goods_attr_id'), $error);
	    }
	    $postData = $this->input->post();
        $data['goods_id'] = $postData['goods_id'];
        $data['attr_id'] = $postData['attr_id'];
        $data['attr_value'] = $postData['attr_value'];
        $goods_attr = $this->mall_goods_attr->findById($data);
        if ($goods_attr->num_rows() > 0)
        {
            if($goods_attr->row()->goods_attr_id == $this->input->post('goods_attr_id'))
            {
                $data['attr_price'] = $postData['attr_price'];
                $res = $this->mall_goods_attr->update(array('goods_attr_id'=>$postData['goods_attr_id']), $data);
            }else{
                $this->error('mall_goods_attr/edit', $this->input->post('goods_attr_id'), '此属性值已存在，修改失败！');
            }
            
        } else {
            $data['attr_price'] = $postData['attr_price'];
            $res = $this->mall_goods_attr->update(array('goods_attr_id'=>$postData['goods_attr_id']), $data);
        }
        if ($res) {
            $this->success('mall_goods_attr/grid', $this->input->post('goods_id'), '修改成功！');
        } else {
            $this->error('mall_goods_attr/edit', $this->input->post('goods_attr_id'), '修改失败！');
        }
	}
	
	public function delete($goods_attr_id)
	{ 
	    $is_delete = $this->mall_goods_attr->delete(array('goods_attr_id'=>$goods_attr_id));
	    if ($is_delete) {
	        $this->success('mall_goods_attr/grid', $this->input->get('goods_id'), '删除成功！');
	    } else {
	        $this->error('mall_goods_attr/grid', $this->input->get('goods_id'), '删除失败！');
	    }
	}
	
	public function validateUser()
	{
	    if ($this->input->post('mall_goods_attr_id'))
	    {
	        $mall_goods_attr = $this->mall_goods_attr->findById(array('uid'=>$this->input->post('uid')));
	        if ($mall_goods_attr->num_rows() > 0)
	        {
	            if ($mall_goods_attr->row()->mall_goods_attr_id == $this->input->post('mall_goods_attr_id'))
	            {
	                echo 'true';
	            } else {
	                echo 'false';
	            }
	        } else {
	            echo 'true';
	        }
	    } else {
	        $user_num = $this->mall_goods_attr->findById(array('uid'=>$this->input->post('uid')))->num_rows();
	        if ($user_num > 0)
	        {
	            echo 'false';
	        } else {
	            echo 'true';
	        }
	    }
	    exit;
	}
	
	public function validate()
	{   
	    $error = array();
        if ($this->validateParam($this->input->post('attr_value'))) {
            $error[] = '属性值不能为空';
        }
	    return $error;
	}
}

/** End of file Mall_goods_attr.php */
/** Location: ./application/controllers/Mall_goods_attr.php */
