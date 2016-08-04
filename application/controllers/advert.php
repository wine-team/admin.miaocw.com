<?php 
class Advert extends CS_Controller
{
    private $advertArray;
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('advert_model', 'advert');
        $this->advertArray = array(
            '1' => '首页幻灯片广告',
            '2' => '登陆幻灯片广告',
        	'3' => '女性首页广告',
        );
    }
    
    public function grid($pg = 1)
    {
        $page_num = 20;
        $num = ($pg-1)*$page_num;
        $config['first_url'] = base_url('advert/search').$this->pageGetParam($this->input->get());
        $config['suffix'] = $this->pageGetParam($this->input->get());
        $config['base_url'] = base_url('advert/grid');
        $config['total_rows'] = $this->advert->total($this->input->get());
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        $data['line_list'] = $this->advert->page_list($page_num, $num, $this->input->get());
        $data['all_rows'] = $config['total_rows'];
        $data['pg_now'] = $pg;
        $data['advertArray'] = $this->advertArray;
        $this->load->view('advert/grid', $data);
    }
    
    public function toggle()
    {
        $advertId = $this->input->post('advert_id');
        $status = $this->input->post('flag');
        switch ($status) {
            case '1': $flag = '2'; break;
            case '2': $flag = '1'; break;
            default : $flag = '2'; break;
        }
        $this->db->trans_start();
        $isUpdate = $this->advert->updateAdvert(array('advert_id' => $advertId, 'flag' => $flag));
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === TRUE && $isUpdate) {
            echo json_encode(array(
                'flag' => $flag,
            ));
        } else {
            echo json_encode(array(
                'flag' => 3,
            ));
        }
        exit;
    }
    
    public function add()
    {
        $data['advertArray'] = $this->advertArray;
        $this->load->view('advert/add', $data);
    }
    
    public function addPost()
    {
        
        $error = $this->validate();
        if (empty($_FILES['picture']['name'])) {
            $error[] = '图片添加不能为空';
        }
        
        if (!empty($error)) {
            $this->error('advert/add', '', $error);
        }
        
        $imageData = $this->dealWithImages('picture', '', 'advert');
        if ($imageData == false) {
            $this->error('advert/add', '', '图片上传失败！');
        }
        $this->db->trans_start();
        $resultId = $this->advert->insertIntoAdvert($this->input->post(), $imageData);
        $this->db->trans_complete();
        
        if ($resultId) {
            $this->success('advert/grid', '', '保存成功！');
        } else {
            $this->error('advert/add', '', '保存失败！');
        }
    }
    
    public function edit($id)
    {
        $result = $this->advert->findById($id);
        if($result->num_rows() <= 0) {
            $this->redirect('advert/grid');
        }
        $data['advert'] = $result->row();
        $data['advertArray'] = $this->advertArray;
        $this->load->view('advert/edit', $data);
    }
    
    public function editPost()
    {
        $advert_id = $this->input->post('advert_id');
        $error = $this->validate();
    
        if (!empty($error)) {
            $this->error('advert/edit', $advert_id, $error);
        }
        $imageData = '';
        if (!empty($_FILES['picture']['name'])) {
            $imageData = $this->dealWithImages('picture', $this->input->post('oldfilename'), 'advert');
            if ($imageData == false) {
                $this->error('advert/edit', $advert_id, '图片上传失败！');
            }
        }
    
        $this->db->trans_start();
        $resultId = $this->advert->updateInfoAdvert($this->input->post(), $imageData);
        $this->db->trans_complete();
    
        if ($resultId) {
            $this->success('advert/grid', '', '保存成功！');
        } else {
            $this->error('advert/edit', $advert_id, '保存失败！');
        }
    }
    
    public function delete($id)
    {
        $is_delete = $this->advert->deleteById($id);
        
        $oldfilename = $this->input->get('picture');
        
        $this->deleteOldfileName($this->input->get('picture'), 'advert');
        
        if ($is_delete) {
            $this->success('advert/grid', '', '删除成功！');
        } else {
            $this->error('advert/grid', '', '删除失败！');
        }
    }

    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('source_state'))) {
            $error[] = '所属广告位不能为空';
        }
        if ($this->validateParam($this->input->post('title'))) {
            $error[] = '标题不能为空';
        }
        if ($this->validateParam($this->input->post('url'))) {
            $error[] = ' 链接地址不能为空';
        }
        return $error;
    }
}