<?php
class Userfeedback extends MJ_Controller{
    
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('user_feedback_model', 'user_feedback');
    }
    
     /**
     * 分页显示
     * @param number $pg
     */
    public function grid($pg = 1)
    {
    	$page_num = 20;
        $num = ($pg-1)*$page_num;
        $getData = $this->input->get();
        $config['first_url'] = base_url('userfeedback/grid').$this->pageGetParam($getData);
        $config['suffix'] = $this->pageGetParam($getData);
        $config['base_url'] = base_url('userfeedback/grid');
        $config['total_rows'] = $this->user_feedback->total($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_list'] = $this->pagination->create_links();
        $data['resultObj'] = $this->user_feedback->page_list($page_num, $num,$getData);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['feedBackType'] = $this->feedback();
        $this->load->view('userfeedback/grid', $data);
    }
    
     /**
     * 反馈类型
     * @return multitype:string
     */
    public function feedback()
    {
    	return array(
    		'1' => '美酒',
    	    '2' => '成人',
    	    '3' => '鑫余网络'
    	);
    }
}