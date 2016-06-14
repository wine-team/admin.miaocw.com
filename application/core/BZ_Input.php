<?php
class BZ_Input extends CI_Input 
{
    /**
    * Set cookie
    *
    * Accepts six parameter, or you can submit an associative
    * array in the first parameter containing all the values.
    *
    * @access    public
    * @param    mixed
    * @param    string    the value of the cookie
    * @param    string    the number of seconds until expiration
    * @param    string    the cookie domain.  Usually:  .yourdomain.com
    * @param    string    the cookie path
    * @param    string    the cookie prefix
    * @param    bool    true makes the cookie secure
    * @return    void
    */
    function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = FALSE)
    {
        if (is_array($name)) {
            // always leave 'name' in last place, as the loop will break otherwise, due to $$item
            foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'secure', 'name') as $item) {
                if (isset($name[$item])) {
                    $$item = $name[$item];
                }
            }
        }
        if ($prefix == '' AND config_item('cookie_prefix') != '') {
            $prefix = config_item('cookie_prefix');
        }
        
        $_COOKIE[$prefix.$name] = $value; //设置cookie及时生效的方法
        
        if ($domain == '' AND config_item('cookie_domain') != '') {
            $domain = config_item('cookie_domain');
        }
        if ($path == '/' AND config_item('cookie_path') != '/') {
            $path = config_item('cookie_path');
        }
        if ($secure == FALSE AND config_item('cookie_secure') != FALSE) {
            $secure = config_item('cookie_secure');
        }
        if (!is_numeric($expire)) {
            $expire = time() - 86500;
        } else {
            $expire = ($expire > 0) ? time() + $expire : 0;
        }
        
        setcookie($prefix.$name, $value, $expire, $path, $domain, $secure);
    }

}