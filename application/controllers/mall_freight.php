<?php
class Mall_freight extends CS_Controller
{
    public function _init()
    {
        $this->load->helper('common');
        $this->load->library('pagination');
        $this->load->model('region_model', 'region');
        $this->load->model('mall_freight_tpl_model', 'mall_freight_tpl');
        $this->load->model('mall_freight_price_model', 'mall_freight_price');
    }

    /**
     * 运费模板列表
     * @param number $pg
     */
    public function grid($pg = 1)
    {
        $getData = $this->input->get();
        $page_num = 20;
        $num = ($pg - 1) * 20;
        $config['first_url'] = base_url('mall_freight/grid') . $this->pageGetParam($getData);
        $config['suffix'] = $this->pageGetParam($getData);
        $config['base_url'] = base_url('mall_freight/grid');
        $config['total_rows'] = $this->mall_freight_tpl->total($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_list'] = $this->pagination->create_links();
        $data['list'] = $this->mall_freight_tpl->page_list($page_num, $num, $getData);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $this->load->view('mallfreight/grid', $data);
    }

    /*
     *运费模板列表
     */
    public function add()
    {
        $this->load->view('mallfreight/add');
    }

    public function ajaxGetTemplet()
    {
        $data['regionAll'] = getRegionAll();
        echo json_encode(array(
            'status' => true,
            'html' => $this->load->view('mallfreight/templet/ajaxTempletDate', $data, true)
        )); exit;
    }

    public function addPost()
    {
        $template_param['name'] = $this->input->post('name', true);
        $template_param['logistics'] = (int)$this->input->post('logistics');
        $template_param['methods'] = (int)$this->input->post('methods');
        $template_param['uid'] = (int)$this->input->post('uid');
        
        $default_params['area'] = '';
        $default_params['first_unit'] = $this->input->post('unit_first');
        $default_params['first_price'] = $this->input->post('price_first');
        $default_params['add_unit'] = $this->input->post('unit_add');
        $default_params['add_price'] = $this->input->post('price_add');
        $default_params['is_default'] = 2;
        
        $list_params = $this->input->post('list') ? $this->input->post('list') : array();
        if (is_array($list_params)) {
            $list_params[] = $default_params;
        }
        $this->db->trans_start();
        $resultId = $this->mall_freight_tpl->add($template_param, $list_params);
        $this->db->trans_complete();
        if ($resultId) {
            $this->success('mall_freight/grid', '', '保存成功！');
        } else {
            $this->error('mall_freight/grid', '', '保存失败！');
        }
    }

    public function delete($id)
    {
        $id = (int)$id;
        if (!$id) {
            $this->error('mall_freight/grid', '', '参数有误！');
        }
        $result = $this->mall_freight_tpl->delete($id);
        if ($result) {
            $this->success('mall_freight/grid', '', '删除成功！');
        } else {
            $this->error('mall_freight/grid', '', '删除失败！');
        }
    }

    public function edit($id = 0)
    {
        if ($id == 0) {
            $this->error('mall_freight/grid', '', '参数有误');
        }
        $result = $this->mall_freight_tpl->getTemplate($id);
        $default_freight = $this->mall_freight_price->getFreight($id, 1);

        $data['result'] = $result->row();

        $data['default_freight'] = $default_freight->row();
        $this->load->view('mallfreight/edit', $data);
    }

    public function ajax($id)
    {
        $freight = $this->mall_freight_price->getFreight($id, 1);
        echo json_encode($freight->result());
        exit;
    }

    public function editPost()
    {
        $template_param['name'] = $this->input->post('name', true);
        $template_param['logistics'] = (int)$this->input->post('logistics');
        $template_param['methods'] = (int)$this->input->post('methods');
        $template_param['uid'] = (int)$this->input->post('uid');

        $default_params['area'] = '';
        $default_params['first_unit'] = $this->input->post('unit_first');
        $default_params['first_price'] = $this->input->post('price_first');
        $default_params['add_unit'] = $this->input->post('unit_add');
        $default_params['add_price'] = $this->input->post('price_add');
        $default_params['is_default'] = 2;

        $list_params = $this->input->post('list') ? $this->input->post('list') : array();
        $template_id = (int)$this->input->post('template');

        if (is_array($list_params)) {
            $list_params[] = $default_params;
        }
        
        if (!$template_id) {
            $this->error('mall_freight/grid', '', '参数有误！');
        }

        $this->db->trans_start();
        $resultId = $this->mall_freight_tpl->update($template_id, $template_param, $list_params);
        $this->db->trans_complete();
        if ($resultId) {
            $this->success('mall_freight/grid', '', '修改成功！');
        } else {
            $this->error('mall_freight/grid', '', '修改失败！');
        }
    }

    /*
     * 获取运费模板信息
     * author laona
     * */
    public function ajaxGetTransport()
    {
        $uid = $this->input->post('uid');
        $result = $this->mall_freight_tpl->getTransport($uid);
        echo json_encode($result->result());exit;
    }
}