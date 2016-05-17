<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mall_delivery_address extends MJ_Controller {

	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('mall_delivery_address_model','mall_delivery_address');
	    $this->load->model('region_model', 'region');
	}

	public function grid($uid = 0)
	{
	    $res = $this->mall_delivery_address->findById(array('uid'=>$uid));
	    $data['uid'] = $uid;
        $data['res'] = $res->result();
        $this->load->view('mall_delivery_address/grid', $data);
	}
	
	public function add($uid)
	{
	    $data['uid'] = $uid;
	    $this->load->view('mall_delivery_address/add', $data);
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error))
	    {
	        $this->error('mall_delivery_address/add', $this->input->post('id'), $error);
	    }
	    $postData = $this->input->post();
		$data['uid'] = $postData['uid'];
	    $data['province_id'] = $postData['province_id'];
        $data['province_name'] = $this->region->findById($postData['province_id'])->row()->region_name;
        $data['city_id'] = $postData['city_id'];
        $data['city_name'] = $this->region->findById($postData['city_id'])->row()->region_name;
        $data['district_id'] = $postData['district_id'];
        $data['district_name'] = $this->region->findById($postData['district_id'])->row()->region_name;
        $data['detailed'] = $postData['detailed'];
        $data['code'] = $postData['code'];
        $data['receiver_name'] = $postData['receiver_name'];
        $data['tel'] = $postData['tel'];
        $data['code'] = $postData['code'];
        $data['is_default'] = $postData['is_default'];
        
        
		$this->db->trans_start();
        if($postData['is_default'] == 2)  //如果改为默认，需将此用户其他默认地址改为非默认
        {
            $this->mall_delivery_address->update(array('uid'=>$postData['uid']), array('is_default'=>1));
        }
        $res = $this->mall_delivery_address->insert($data);
        $this->db->trans_complete(); 
	    
	    if ($res) {
	        $this->success('mall_delivery_address/grid', $postData['uid'], '新增成功！');
	    } else {
	        $this->error('mall_delivery_address/add', $postData['uid'], '新增失败！');
	    }
	}
	
	public function edit($id)
	{
	    $res = $this->mall_delivery_address->findById(array('address_id'=>$id));
	    if ($res->num_rows() > 0)
	    {
	        $data['res'] = $res->row();
	        $this->load->view('mall_delivery_address/edit',$data);
	    } else {
	        $this->redirect('mall_delivery_address/grid');
	    }
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error))
        {
            $this->error('mall_delivery_address/edit', $this->input->post('address_id'), $error);
        }
        $postData = $this->input->post(); 
        $data['province_id'] = $postData['province_id'];
        $data['province_name'] = $this->region->findById($postData['province_id'])->row()->region_name;
        $data['city_id'] = $postData['city_id'];
        $data['city_name'] = $this->region->findById($postData['city_id'])->row()->region_name;
        $data['district_id'] = $postData['district_id'];
        $data['district_name'] = $this->region->findById($postData['district_id'])->row()->region_name;
        $data['detailed'] = $postData['detailed'];
        $data['code'] = $postData['code'];
        $data['receiver_name'] = $postData['receiver_name'];
        $data['tel'] = $postData['tel'];
        $data['code'] = $postData['code'];
        $data['is_default'] = $postData['is_default']; 
        $this->db->trans_start();
        if($postData['is_default'] == 2)  //如果改为默认，需将此用户其他默认地址改为非默认
        {
            $this->mall_delivery_address->update(array('uid'=>$postData['uid']), array('is_default'=>1));
        }
        $res = $this->mall_delivery_address->update(array('address_id'=>$postData['address_id']), $data);
        $this->db->trans_complete(); 
        if ($this->db->trans_status() === TRUE) {
            $this->success('mall_delivery_address/grid', $this->input->post('uid'), '修改成功！');
        } else {
            $this->error('mall_delivery_address/edit', $this->input->post('address_id'), '修改失败！');
        }
	}
	
	public function delete($address_id)
	{ 
	    $is_delete = $this->mall_delivery_address->delete(array('address_id'=>$address_id));
	    if ($is_delete) {
	        $this->success('mall_delivery_address/grid', $this->input->get('uid'), '删除成功！');
	    } else {
	        $this->error('mall_delivery_address/grid', $this->input->get('uid'), '删除失败！');
	    }
	}
	
	public function validate()
	{   
	    $this->load->helper('validation');
	    $error = array();
	    if ($this->validateParam($this->input->post('province_id')) || $this->validateParam($this->input->post('city_id')) || $this->validateParam($this->input->post('district_id')))
	    {
	        $error[] = '地区不能为空';
	    }
        if ($this->validateParam($this->input->post('detailed')))
        {
            $error[] = '详细地址不能为空';
        }
        if ($this->validateParam($this->input->post('code')))
        {
            $error[] = '邮编不能为空';
        }
        if ($this->validateParam($this->input->post('receiver_name')))
        {
            $error[] = '收货人不能为空';
        }
        if (!valid_mobile($this->input->post('tel')))
        {
            $error[] = '联系电话不能为空';
        }
        if ($this->validateParam($this->input->post('is_default')))
        {
            $error[] = '是否设置为默认不能为空';
        }
	    return $error;
	}
	
}

/** End of file mall_delivery_address.php */
/** Location: ./application/controllers/mall_delivery_address.php */
