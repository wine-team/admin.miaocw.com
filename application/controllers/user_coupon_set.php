<?php
class User_coupon_set extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('user_coupon_set_model', 'user_coupon_set');
        $this->load->model('mall_category_model', 'mall_category');
        $this->load->model('supplier_model', 'supplier');
    }

    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('user_coupon_set/grid').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('user_coupon_set/grid');
        $config['total_rows'] = $this->user_coupon_set->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->user_coupon_set->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['page_num'] = $page_num;
        $data['scope'] = array(1=>'自营劵', 2=>'店铺劵');
        $this->load->view('user_coupon_set/grid', $data);
    }

    public function add()
    {
        $this->load->view('user_coupon_set/add');
    }

    public function addPost()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('user_coupon_set/add', '', $error);
        }

        $this->db->trans_start();
        $resultId = $this->user_coupon_set->insert($this->input->post());
        $this->db->trans_complete();

        if ($resultId) {
            $this->success('user_coupon_set/grid', '', '保存成功！');
        } else {
            $this->error('user_coupon_set/add', '', '保存失败！');
        }
    }

    public function edit($coupon_set_id)
    {
        $result = $this->user_coupon_set->findById($coupon_set_id);
        if($result->num_rows() <= 0) {
            $this->redirect('user_coupon_set/grid');
        }
        $data['userCouponSet'] = $result->row(0);
        $this->load->view('user_coupon_set/edit', $data);
    }

    public function editPost()
    {
        $coupon_set_id = $this->input->post('coupon_set_id');
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('user_coupon_set/edit', $coupon_set_id, $error);
        }

        $this->db->trans_start();
        $resultId = $this->user_coupon_set->update($this->input->post());
        $this->db->trans_complete();

        if ($resultId) {
            $this->success('user_coupon_set/grid', '', '保存成功！');
        } else {
            $this->error('user_coupon_set/edit', $coupon_set_id, '保存失败！');
        }
    }

    public function delete($deliver_id)
    {
        $is_delete = $this->user_coupon_set->deleteById($deliver_id);
        if ($is_delete) {
            $this->success('user_coupon_set/grid', '', '删除成功！');
        } else {
            $this->error('user_coupon_set/grid', '', '删除失败！');
        }
    }

    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('coupon_name'))) {
            $error[] = '优惠劵名称不能为空';
        }
        if ($this->input->post('scope') == 1) { //自营劵
            if ($this->input->post('related_id') > 0) {
                $result = $this->mall_category->findById($this->input->post('related_id'));
                if ($result->num_rows() <= 0) {
                    $error[] = '自营劵分类ID（'.$this->input->post('related_id').'）不存在';
                }
            }
        } else { //店铺劵
            $result = $this->supplier->findById($this->input->post('related_id'));
            if ($result->num_rows() <= 0) {
                $error[] = '店铺劵：店铺ID（'.$this->input->post('related_id').'）不存在';
            }
        }
        if ($this->input->post('amount') <= 0) {
            $error[] = '优惠劵金额必须大于零';
        }
        if ($this->input->post('number') <= 0) {
            $error[] = '优惠劵数量必须大于零';
        }
        if ($this->validateParam($this->input->post('start_time'))) {
            $error[] = '开始使用时间不能为空';
        }
        if ($this->validateParam($this->input->post('end_time'))) {
            $error[] = '结束使用时间不能为空';
        }
        return $error;
    }
}