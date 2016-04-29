<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Browser extends CI_Controller
{
    function check_browser()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')) {
            echo '<meta charset="UTF-8" />';
            echo '请使用Google Chrome浏览器 或 IE8以上浏览器';
            exit();
        }
    }
}
