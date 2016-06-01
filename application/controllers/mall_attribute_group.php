<?php
class Mall_attribute_group extends MJ_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('mall_attribute_value_model','mall_attribute_value');
        $this->load->model('mall_attribute_set_model','mall_attribute_set');
        $this->load->model('mall_attribute_group_model','mall_attribute_group');
    }

    public function grid()
    {
        $attr_set_id = $this->input->get('attr_set_id');
        $result = $this->mall_attribute_group->findByAttrSetId($attr_set_id);
        $data['attributeGroup'] = array();
        if ($result->num_rows() > 0) {
            $data['attributeGroup'] = $result->row();
        }
        $this->load->view('mall_attribute_group/grid', $data);
    }
}