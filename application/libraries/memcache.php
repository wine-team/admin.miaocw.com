<?php
class CI_Memcache 
{
    public $CI;
    public $memcache_object = false;
    public $memcache_host  = '127.0.0.1';
    public $memcache_port  = '11211';
    

    public function __construct($params = array())
    {
        if (extension_loaded('memcache')) { //是否开启memcache
            $this->memcache_object = new Memcache();
            $this->memcache_object->addServer($this->memcache_host, $this->memcache_port);
        } elseif (extension_loaded('memcached')) {
            $this->memcache_object = new Memcache();
            $this->memcache_object->addServer($this->memcache_host, $this->memcache_port);
        }
    }
    
    /**
     * $data is_string && is_array
     * @param unknown $data
     */
    public function setData($key, $data)
    {
        if (!$this->memcache_object) {
            return false;
        }
        $this->memcache_object->set($key, $data);
    }
    
    /**
     * 获取memcach数据。
     * @param unknown $key
     */
    public function getData($key)
    {
        if (!$this->memcache_object) {
            return false;
        }
        return $this->memcache_object->get($key);
    }
    
    /**
     * 获取用户登录信息。
     * 
     */
    public function getCustomerSession($session)
    {
        $frontUser = $this->getData('frontUser');
        if ($frontUser && !$session->userdata('ACT_UID')) {
            $session->set_userdata($frontUser);
        } elseif (!$frontUser && $session->userdata('ACT_UID')) {
            $session->sess_destroy();
        }
    }
    
    public function deleteCustomerMemcache()
    {
        if (!$this->memcache_object) {
            return false;
        }
        return $this->memcache_object->delete('frontUser');
    }

    /**
     * 清除所有缓存
     * @return boolean|void
     */
    public function flushMemcache()
    {
        if (!$this->memcache_object) {
            return false;
        }
        return $this->memcache_object->flush();
    }
    
    /**
     * 删除指定缓存
     * @param unknown $key
     * @return boolean
     */
    public function deleteMemcache($key)
    {
        if (!$this->memcache_object) {
            return false;
        }
        return $this->memcache_object->delete($key);
    }
}