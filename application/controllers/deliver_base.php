<?php
class Deliver_base extends MJ_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('deliver_base_model', 'deliver_base');
    }

    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('deliver_base/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('deliver_base/grid');
        $config['total_rows'] = $this->deliver_base->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->deliver_base->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $this->load->view('deliver_base/grid', $data);
    }

    public function add()
    {
        $this->load->view('deliver_base/add');
    }

    public function addPost()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('deliver_base/add', '', $error);
        }

        $this->db->trans_start();
        $resultId = $this->deliver_base->insertDeliverBase($this->input->post());
        $this->db->trans_complete();

        if ($resultId) {
            $this->success('deliver_base/grid', '', '保存成功！');
        } else {
            $this->error('deliver_base/add', '', '保存失败！');
        }
    }

    public function edit($deliver_id)
    {
        $result = $this->deliver_base->findById($deliver_id);
        if($result->num_rows() <= 0) {
            $this->redirect('deliver_base/grid');
        }
        $data['deliverBase'] = $result->row();
        $this->load->view('deliver_base/edit', $data);
    }

    public function editPost()
    {
        $deliver_id = $this->input->post('deliver_id');
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('deliver_base/edit', $deliver_id, $error);
            return ;
        }

        $this->db->trans_start();
        $resultId = $this->deliver_base->updateDeliverBase($this->input->post());
        $this->db->trans_complete();

        if ($resultId) {
            $this->success('deliver_base/grid', '', '保存成功！');
        } else {
            $this->error('deliver_base/edit', $deliver_id, '保存失败！');
        }
    }

    public function delete($deliver_id)
    {
        $is_delete = $this->deliver_base->deleteById($deliver_id);
        if ($is_delete) {
            $this->success('deliver_base/grid', '', '删除成功！');
        } else {
            $this->error('deliver_base/grid', '', '删除失败！');
        }
    }

    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('deliver_name'))) {
            $error[] = '快递名称不能为空。';
        }
        if ($this->validateParam($this->input->post('deliver_flag'))) {
            $error[] = '快递标识不能为空。';
        }
        return $error;
    }
}