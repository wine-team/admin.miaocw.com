<?php 
class Newscategory extends CS_Controller
{
    public function _init()
    {
        $this->load->helper(array('common'));
        $this->load->library('pagination');
        $this->load->model('news_class_model', 'news_class');
    }
    
    public function grid($pg = 1)
    {
        $num = ($pg-1)*20;
        $config['base_url'] = base_url('newsclass/grid');
        $config['total_rows'] = $this->news_class->total();
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->news_class->page_list($num);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $this->load->view('newscategory/grid', $data);
    }
    
    public function add()
    {
        $this->load->view('newscategory/add');
    }
    
    public function addPost()
    {
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('newscategory/add', '', $error);
        }

        $resultId = $this->news_class->insertNewsclass($this->input->post());
        if ($resultId) {
            $this->success('newscategory/grid', '', '保存成功！');
        } else {
            $this->error('newscategory/add', '', '保存失败！');
        }
    }
    
    public function edit($id)
    {
        $result = $this->news_class->findById($id);
        if($result->num_rows() <= 0) {
            $this->redirect('newscategory/grid');
        }
        $data['newsclass'] = $result->row();
        $this->load->view('newscategory/edit', $data);
    }
    
    public function editPost()
    {
        $newsclass_id = $this->input->post('newsClassId');
        $error = $this->validate();
        if (!empty($error)) {
            $this->error('newscategory/edit', $newsclass_id, $error);
        }

        $this->db->trans_start();
        $resultId = $this->news_class->updateNewsclass($this->input->post());
        $this->db->trans_complete();
    
        if ($resultId) {
            $this->success('newscategory/grid', '', '保存成功！');
        } else {
            $this->error('newscategory/edit', $newsclass_id, '保存失败！');
        }
    }
    
    public function delete($id)
    {
        $is_delete = $this->news_class->deleteById($id);
        if ($is_delete) {
            $this->success('newscategory/grid', '', '删除成功！');
        } else {
            $this->error('newscategory/grid', '', '删除失败！');
        }
    }

    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('class_name'))) {
            $error[] = ' 分类不能为空';
        }
        if ($this->validateParam($this->input->post('sort'))) {
            $error[] = ' 排序不能为空';
        }
        return $error;
    }
}