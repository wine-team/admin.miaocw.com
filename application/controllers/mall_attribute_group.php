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

    public function grid($group_id=0)
    {
        $attr_set_id = $this->input->get('attr_set_id');
        $result = $this->mall_attribute_group->findByAttrSetId($attr_set_id);
        $attrGroup = array();
        $attrValue = array();
        if ($result->num_rows() > 0) {
            $attrGroup = $result->result();
            if ($group_id > 0) {
                $groupIds = array($group_id);
            } else {
                foreach ($attrGroup as $item) {
                    $groupIds[] = $item->group_id;
                }
            }
            $attrValue = $this->mall_attribute_value->getWherein('group_id', $groupIds, array('attr_set_id'=>$attr_set_id))->result();
        }
        $data['attr_set_id'] = $attr_set_id;
        $data['group_id'] = $group_id;
        $data['attributeValue'] = $attrValue;
        $data['attributeGroup'] = $attrGroup;
        $this->load->view('mall_attribute_group/grid', $data);
    }
    
    public function add($attr_set_id)
    {
        $data['attr_set_id'] = $attr_set_id;
        $this->load->view('mall_attribute_group/add', $data);
    }
    
    public function addPost()
    {
        $postData = $this->input->post();
        $data['attr_set_id'] = $postData['attr_set_id'];
        $data['group_name'] = $postData['group_name'];
        $group = $this->mall_attribute_group->getWhere($data)->num_rows();
        if( $group > 0) {
            $this->error('mall_attribute_set/edit', $postData['attr_set_id'], '组名已存在，新增失败！');
        } else{
            $res = $this->mall_attribute_group->insertAttributeGroup($postData);
            if ($res) {
                $this->success('mall_attribute_group/grid', array('attr_set_id'=>$postData['attr_set_id']), '新增成功！');
            } else {
                $this->error('mall_attribute_group/add', $postData['attr_set_id'], '新增失败！');
            }
        }
    }
    
    public function delete($group_id)
    {
        $this->db->trans_start();
        $this->mall_attribute_value->delete(array('attr_set_id'=>$this->input->get('attr_set_id'), 'group_id'=>$group_id));
        $this->mall_attribute_group->delete(array('group_id'=>$group_id));
        $this->db->trans_complete();
        if ($this->db->trans_status() === true) {
            $this->success('mall_attribute_group/grid', array('attr_set_id'=>$this->input->get('attr_set_id')), '删除成功！');
        } else {
            $this->error('mall_attribute_group/grid', array('attr_set_id'=>$this->input->get('attr_set_id')), '删除失败！');
        }
    }
}