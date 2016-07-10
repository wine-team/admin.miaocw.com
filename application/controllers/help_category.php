<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Help_category extends MJ_Controller {

	private $menuArray;
	public function _init()
	{
	    $this->load->library('pagination');
	    $this->load->model('help_center_model','help_center');
	    $this->load->model('help_category_model','help_category');
	    $this->menuArray = array(
	    	   '1' => '帮助中心',
	    	   '2' => '资讯中心'
	    );
	}

	public function grid($pg = 1)
	{
	    $page_num = 20;
	    $num = ($pg-1)*$page_num;
	    $getData = $this->input->get();
	    $config['first_url']   = base_url('help_category/grid').$this->pageGetParam($this->input->get());
	    $config['suffix']      = $this->pageGetParam($getData);
	    $config['base_url']    = base_url('help_category/grid');
	    $config['total_rows']  = $this->help_category->total($getData);
	    $config['uri_segment'] = 3;
	    $this->pagination->initialize($config);
	    $data['pg_link']   = $this->pagination->create_links();
	    $data['pg_list']   = $this->help_category->pg_list($num, $page_num, $getData);
	    $data['all_rows']  = $config['total_rows'];
	    $data['pg_now']    = $pg;
	    $data['menuArray'] = $this->menuArray;
	    $this->load->view('help_category/grid', $data);
	}
	
	public function add()
	{
		$data['menuArray'] = $this->menuArray;
	    $this->load->view('help_category/add',$data);
	}
	
	public function addPost()
	{
	    $error = $this->validate(); 
	    if (!empty($error)){
	        $this->error('help_category/add','', $error);
	    }
	    $result = $this->help_category->insert($this->input->post());
	    if ($result) {
	        $this->success('help_category/grid', '', '新增成功！');
	    } else {
	        $this->error('help_category/add','', '新增失败！');
	    }
	}
	
	public function edit($id)
	{
	    $reult = $this->help_category->findResultById($id);
	    if($reult->num_rows()<=0){
	    	$this->error('help_category/grid','', '无结果');
	    }
	    $data['category'] = $reult->row(0);
	    $data['menuArray'] = $this->menuArray;
	    $this->load->view('help_category/edit',$data);
	}
	
	public function editPost()
	{
	    $error = $this->validate();
        if (!empty($error)){
            $this->error('help_category/edit', $this->input->post('category_id'), $error);
        }
        $postData = $this->input->post();
        $res = $this->help_category->update($postData);
        if ($res) {
            $this->success('help_category/grid', '', '修改成功！');
        } else {
            $this->error('help_category/edit', $this->input->post('category_id'), '修改失败！');
        }
	}
	
	public function delete($id)
	{
	    $is_delete = $this->help_category->deleteById($id);
	    if ($is_delete) {
	        $this->success('help_category/grid', '', '删除成功！');
	    } else {
	        $this->error('help_category/grid', '', '删除失败！');
	    }
	}
	
	public function validate()
	{
	    $error = array();
        if ($this->validateParam($this->input->post('help_category_name')))
        {
            $error[] = '分类名不能为空';
        }
        if ($this->validateParam(strip_tags($this->input->post('sort'))))
        {
            $error[] = '排序不能为空';
        }
	    return $error;
	}
	
	 /**
	 * 添加大分类下的小内幕
	 * @param unknown $category_id
	 */
	public function help_center($pg=1){
		
		$page_num = 20;
		$num = ($pg-1)*$page_num;
		$getData = $this->input->get();
		$config['first_url']   = base_url('help_category/help_center').$this->pageGetParam($this->input->get());
		$config['suffix']      = $this->pageGetParam($getData);
		$config['base_url']    = base_url('help_category/help_center');
		$config['total_rows']  = $this->help_center->total($getData);
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['pg_link']   = $this->pagination->create_links();
		$data['pg_list']   = $this->help_center->pg_list($num, $page_num, $getData);
		$data['all_rows']  = $config['total_rows'];
		$data['pg_now']    = $pg;
		$data['category_id'] = $getData['category_id'];
		$this->load->view('help_category/help_center', $data);
	}
	
	public function add_help_center(){
		
		$data['category_id'] = $this->input->get('category_id');
		$this->load->view('help_category/add_help_center',$data);
	}
	
	public function addHelpPost(){
		
		$error = $this->validateHelp();
		if (!empty($error)){
			$this->error('help_category/add_help_center', array('category_id'=>$this->input->post('category_id')), $error);
		}
		$postData = $this->input->post();
		$res = $this->help_center->insert($postData);
		if ($res) {
			$this->success('help_category/help_center', array('category_id'=>$this->input->post('category_id')), '添加成功！');
		} else {
			$this->error('help_category/add_help_center', array('category_id'=>$this->input->post('category_id')), '添加失败！');
		}
	}
	
	public function edit_help_center($id){
		
		$help = $this->help_center->findById($id);
		if( $help->num_rows()<=0 ){
			$this->error('help_category/help_center', array('category_id'=>$this->input->get('category_id')), '没有发现值');
		}
		$data['help'] = $help->row(0);
		$this->load->view('help_category/edit_help_center',$data);
	}
	
	public function editHelpPost(){
	
		$error = $this->validateHelp();
		if (!empty($error)){
			$this->error('help_category/add_help_center', $this->input->post('id'), $error);
		}
		$postData = $this->input->post();
		$res = $this->help_center->edit($postData);
		if ($res) {
			$this->success('help_category/help_center', array('category_id'=>$this->input->post('category_id')), '修改成功！');
		} else {
			$this->error('help_category/edit_help_center',$this->input->post('id'), '修改失败！');
		}
	}
	
	public function delete_help_center($id){
		
		$category_id = $this->input->get('category_id');
		$status = $this->help_center->deleteById($id);
		if($status){
			$this->success('help_category/help_center',array('category_id'=>$category_id), '删除成功！');
		} else {
			$this->error('help_category/help_center',array('category_id'=>$category_id), '删除失败！');
		}
	}
	
	 /**
	 * 上下架
	 * @param unknown $id
	 * @param unknown $flag
	 */
	public function up_down($id,$flag){
		
		$status = ($flag==1) ?　2 : 1;
		$category_id = $this->input->get('category_id');
		$result = $this->help_center->upFlagById($id,$status);
		if($result){
			$this->success('help_category/help_center',array('category_id'=>$category_id), '操作成功！');
		} else {
			$this->error('help_category/help_center',array('category_id'=>$category_id), '操作失败！');
		}
	}
	
	public function validateHelp(){
		
		$error = array();
		if ($this->validateParam($this->input->post('sub_title')))
		{
			$error[] = '标题不能为空';
		}
		if ($this->validateParam($this->input->post('author')))
		{
			$error[] = '作者不能为空';
		}
		if ($this->validateParam($this->input->post('sort')))
		{
			$error[] = '排序不能为空';
		}
		if ($this->validateParam($this->input->post('help_info')))
		{
			$error[] = '说明不能为空';
		}
		return $error;
	}
}