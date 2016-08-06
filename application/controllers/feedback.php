<?php
class Feedback extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('user_feedback_model', 'user_feedback');
    }

    public function grid($pg = 1)
    {
    	$page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('feedback/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('feedback/grid');
        $config['total_rows'] = $this->user_feedback->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['resultObj'] = $this->user_feedback->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $data['feedBackType'] = array( '1' => '美酒',  '2' => '成人', '3' => '鑫余网络');
        $this->load->view('feedback/grid', $data);
    }
}