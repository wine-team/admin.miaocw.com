<?php

class Newscontent extends CS_Controller
{
    public function _init()
    {
        $this->load->helper(array('common'));
        $this->load->library('pagination');
        $this->load->model('news_content_model', 'news_content');
        $this->load->model('news_class_model', 'news_class');
    }

    public function grid($pg = 1)
    {
        $num = ($pg - 1) * 20;
        $config['base_url'] = base_url('newscontent/grid');
        $config['total_rows'] = $this->news_content->total();
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->news_content->page_list($num);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['newsclass'] = $this->news_class->find();
        $this->load->view('newscontent/grid', $data);
    }

    public function search($pg = 1)
    {
        if ( !$this->search_get_validate($this->input->get()) ) {
            $this->redirect('newscontent/grid');
        }
        $getData = $this->input->get();
        $num = ($pg - 1) * 20;
        $config['first_url'] = base_url('newscontent/search') . $this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('newscontent/search');
        $config['total_rows'] = $this->news_content->search_total($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['page_list'] = $this->news_content->search_page_list($num, $getData);
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['newsclass'] = $this->news_class->find();
        $this->load->view('newscontent/grid', $data);
    }

    public function add()
    {
        $data['newsclass'] = $this->news_class->find();
        $this->load->view('newscontent/add', $data);
    }

    public function addPost()
    {
        $error = $this->validate();
        if ( !empty($error) ) {
            $this->error('newscontent/add', '', $error);
        }
        $this->db->trans_start();
        $resultId = $this->news_content->insertNews($this->input->post());
        $this->db->trans_complete();
        if ( $resultId ) {
            $this->success('newscontent/grid', '', '保存成功！');
        } else {
            $this->error('newscontent/add', '', '保存失败！');
        }
    }

    public function edit($id)
    {
        $result = $this->news_content->findById($id);
        if ( $result->num_rows() <= 0 ) {
            $this->redirect('newscontent/grid');
        }
        $data['news'] = $result->row();
        $data['newsclass'] = $this->news_class->find();
        $this->load->view('newscontent/edit', $data);
    }

    public function editPost()
    {
        $newsId = $this->input->post('id');
        $error = $this->validate();
        if ( !empty($error) ) {
            $this->error('newscontent/edit', $newsId, $error);
        }

        $this->db->trans_start();
        $resultId = $this->news_content->updateNews($this->input->post());
        $this->db->trans_complete();

        if ( $resultId ) {
            $this->success('newscontent/grid', '', '保存成功！');
        } else {
            $this->error('newscontent/edit', $newsId, '保存失败！');
        }
    }

    public function delete($id)
    {
        $is_delete = $this->news_content->deleteById($id);

        if ( $is_delete ) {
            $this->success('newscontent/grid', '', '删除成功！');
        } else {
            $this->error('newscontent/grid', '', '删除失败！');
        }
    }

    public function validate()
    {
        $error = array();
        if ( $this->validateParam($this->input->post('title')) ) {
            $error[] = '公告标题不能为空';
        }
        if ( $this->validateParam($this->input->post('content')) ) {
            $error[] = '公告内容不能为空';
        }
        if ( $this->validateParam($this->input->post('class_id')) ) {
            $error[] = '所属分类不能为空';
        }
        if ( $this->validateParam($this->input->post('author')) ) {
            $error[] = '公告来源不能为空';
        }

        return $error;
    }

    /**
     * @descripte   图片管理
     * @Author xiumao
     * @date 2016/7/26 上午 10:21
     */
    public function images($id)
    {
        $result = $this->news_content->findById($id);
        if ( $result->num_rows() <= 0 ) {
            $this->error('newscontent/grid', '', '找不到产品相关信息！');
        }
        $news_content = $result->row();
        $data['news_content'] = $news_content;
        $image = trim($news_content->image, '|');
        if ( !empty($image) ) {
            $images = explode('|', $image);
        } else {
            $images = array();
        }
        $data['images'] = $images;
        $this->load->view('newscontent/images', $data);
    }

    /**
     * @descripte   保存图片
     * @Author xiumao
     * @date 2016/7/26 上午 10:24
     */
    public function saveImages()
    {
        $id = $this->input->post('id');
        $result = $this->news_content->findById($id);
        if ( $result->num_rows() <= 0 ) {
            $this->error('newscontent/images', $id, '找不到产品相关信息！');
        }
        $imageData = $this->dealWithImages('images', '', 'infor');
        if (isset($imageData['status']) && $imageData['status'] == false) {
            $this->error('newscontent/images', $id, '图片上传失败！');
        }
        $params['id'] = $id;
        $params['image'] = $this->input->post('image') . $imageData['file_name'] . '|';
        $this->db->trans_start();
        $this->news_content->updateImages($params);
        $this->db->trans_complete();
        if ( $this->db->trans_status() === TRUE ) {
            $this->success('newscontent/images', $id, '图片保存成功！');
        } else {
            $this->error('newscontent/images', $id, '图片保存失败！');
        }
    }

    /**
     * @descripte   删除图片
     * @Author xiumao
     * @date 2016/7/26 上午 10:25
     */
    public function deleteImage($id)
    {
        $result = $this->news_content->findById($id);
        if ( $result->num_rows() <= 0 ) {
            $this->error('newscontent/images', $id, '找不到产品相关信息！');
        }
        $news_content = $result->row(0);
        $image = trim($news_content->image, '|');
        $image_name = $this->input->get('image_name');
        $params['id'] = $id;
        $params['image'] = str_replace($image_name . '|', '', $news_content->image);
        if ( empty($params['image']) ) {
            $this->error('newscontent/images', $id, '必须存在一张');
        }
        $isupdate = $this->news_content->updateImages($params);
        $this->deleteOldfileName($image_name, 'infor');
        if ( $isupdate ) {
            $this->success('newscontent/images', $news_content->id, '图片删除成功');
        } else {
            $this->error('newscontent/images', $news_content->id, '图片删除失败');
        }
    }

}