<?php
class Cacheclear extends CS_Controller
{
    public function _init()
    {
        $this->load->library('pagination');
        $this->load->model('cache_clear_model','cache_clear');
    }
   
    public function grid($pg=1)
    {
        $pageNum = 20;
        $getData = $this->input->get();
        $num = ($pg-1)*$pageNum;
        $config['first_url']   = base_url('cacheclear/grid').$this->pageGetParam($this->input->get());
        $config['suffix']      = $this->pageGetParam($this->input->get());
        $config['base_url']    = base_url('cacheclear/grid');
        $config['total_rows']  = $this->cache_clear->total($getData);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pg_link']   = $this->pagination->create_links();
        $data['page_list'] = $this->cache_clear->searchList($pageNum,$num,$getData);
        $data['all_rows']  = $config['total_rows'];
        $data['pg_now']    = $pg;
        $this->load->view('cacheclear/grid',$data);
    }
    
    public function delete($id)
    {
        $is_delete = $this->cache_clear->deleteById($id);
        if ($is_delete) {
            $this->success('cacheclear/grid', '', '删除成功！');
        } else {
            $this->error('cacheclear/grid', '', '删除失败！');
        }
    }
    
    public function add()
    {
        $this->load->view('cacheclear/add');
    }
    
    public function addPost()
    {
        $error = $this->validate();
        if(!empty($error)){
            $this->error('cacheclear/add', '', $error);
        }
        $this->db->trans_start();
        $resultId = $this->cache_clear->insertCacheClear($this->input->post());
        $this->db->trans_complete();
        if ($resultId) {
            $this->success('cacheclear/grid', '', '保存成功！');
        } else {
            $this->error('cacheclear/add', '', '保存失败！');
        }
    }
    
    public function clear($id)
    {
        $result = $this->cache_clear->findById($id);
        if ($result->num_rows() > 0) {
            if ($this->memcache->getData($result->row()->cache_id)) {
                $is_secuss = $this->memcache->deleteMemcache($result->row()->cache_id);
            } else {
                $this->success('cacheclear/grid', '', '已经清理了。');
            }
        } else {
            $is_secuss = false;
        }
        if ($is_secuss) {
            $this->success('cacheclear/grid', '', '清理缓存成功！');
        } else {
            $this->error('cacheclear/grid', '', '清理缓存失败！');
        }
    }
    
    public function clearAll()
    {
        $is_secuss = $this->memcache->flushMemcache();
        if ($is_secuss) {
            $this->success('cacheclear/grid', '', '清理所有缓存成功！');
        } else {
            $this->error('cacheclear/grid', '', '清理所有缓存失败！');
        }
    }
    
    public function validate()
    {
        $error = array();
        if ($this->validateParam($this->input->post('cache_name'))) {
            $error[] = 'cache名称不能为空';
        }
        if ($this->validateParam($this->input->post('cache_id'))) {
            $error[] = 'cache_id不能为空';
        }
        return $error;
    }
   
}