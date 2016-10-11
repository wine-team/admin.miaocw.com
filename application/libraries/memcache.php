<?php
class CI_Memcache 
{
    public $memcache_object = false;
    public $memcache_host  = '127.0.0.1';
    public $memcache_port  = '11211';

    public function __construct($params = array())
    {
        if (extension_loaded('memcache')) { //是否开启memcache
            $this->memcache_object = new Memcache();
            $this->memcache_object->addServer($this->memcache_host, $this->memcache_port);
        } elseif (extension_loaded('memcached')) {
            $this->memcache_object = new Memcached();
            $this->memcache_object->addServer($this->memcache_host, $this->memcache_port);
        }
    }
    
    /**
     * $data is_string && is_array
     * @param unknown $data
     */
    public function setData($key, $data, $expire=0)
    {
        if (!$this->memcache_object) {
            return false;
        }
        if (extension_loaded('memcached')) {
            $this->memcache_object->set($key, $data, $expire);
        } else {
            $this->memcache_object->set($key, $data, MEMCACHE_COMPRESSED, $expire);
        }
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
     * 清除所有缓存
     * @return boolean|void
     */
    public function flush()
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
    public function delete($key)
    {
        if (!$this->memcache_object) {
            return false;
        }
        return $this->memcache_object->delete($key);
    }
}