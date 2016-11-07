<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'CS_Controller.php';
class MJ_Controller extends CI_Controller
{
    public $uid;
    public $admin_name;
    public $admin_email;
    public $actionList = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->driver('cache');
        $adminUser = unserialize(base64_decode(get_cookie('adminUser')));
        if ($adminUser) {
            $this->uid = $adminUser->id;
            $this->admin_name = $adminUser->name;
            $this->realname = $adminUser->realname;
            $this->admin_email = $adminUser->email;
            if (empty($this->role)) {
                $this->load->model('admin_role_model', 'admin_role');
            }
            $role = $this->admin_role->findById($adminUser->role_id);
            if ($role->num_rows() > 0) {
                $this->actionList = $role->row(0)->action_list;
            }
        }

        $this->_init(); //用着重载
        
        // 开发模式下开启性能分析
        if (ENVIRONMENT === 'development') {
              $this->output->enable_profiler(TRUE);
        }
    }
    
    public function _init() {}
    
    /**
     * 验证get参数，如果get参数有一个值不为空，则返回true
     */
    protected function search_get_validate($params_get)
    {
        $is_empty = false;
        if (is_array($params_get) && !empty($params_get)) {
            foreach ($params_get as $val) {
                if (!empty($val)) {
                    $is_empty = true;
                    break;
                }
            }
        }
        return $is_empty;
    }
    
    /**
     * 验证参数，如果参数有一个为空，则返回true
     * @param  $postData
     * @return boolean
     */
    protected function validateParam($postData)
    {
        $validate = false;
        if (is_array($postData)) { //验证checkbox，有一个不为空，则通过
            $is_empty = '';
            foreach ($postData as $val) {
                $is_empty .= $val;
            }
            if (empty($is_empty)) {
                $validate = true;
            }
        } else {
            if (empty($postData)) {
                $validate = true;
            }
        }
        return $validate;
    }
    
    /**
     * 验证参数，如果参数有一个为空，则返回true
     * @param  $postData
     * @return boolean
     */
    protected function validateArrayEmpty($postData)
    {
        if (is_array($postData)) { //验证checkbox，有一个不为空，则通过
            foreach ($postData as $val) {
                if (empty($val)){
                    return true;
                }
            }
        } else {
            if (empty($postData)) {
                return true;
            }
        }
        return false;
    }

    /**
     * js提交表单数据提示。
     * @param unknown $error
     * @param string $url
     */
    public function jsonMessage($error, $url='')
    {
        if (!empty($error)) {
            if (is_array($error)) {
                $json = array('status'=>false, 'messages'=>implode('\\n', $error));
            } else {
                $json = array('status'=>false, 'messages'=>$error);
            }
        } else {
            $json = array('status'=>true, 'messages'=>$url);
        }
        echo json_encode($json);exit;
    }

    /**
     * 程序执行错误跳转
     * @param 跳转路径 $url
     * @param url参数 $param
     * @param 提示信息 $message
     */
    protected function error($url, $param, $message)
    {
        if (is_array($message)) {
            foreach ($message as $val) {
                $this->error .= '<p>' . $val . '</p>';
            }
            $this->session->set_flashdata('error', $this->error);
        } else {
            $this->session->set_flashdata('error', $message);
        }
        
        $this->formatUrl($url, $param);
    }
    
    /**
     * 程序执行成功跳转
     * @param 跳转路径 $url
     * @param url参数  $param
     * @param 提示信息 $message
     */
    protected function success($url, $param, $message)
    {
        $this->session->set_flashdata('success', $message);
        $this->formatUrl($url, $param);
    }
    
    private function formatUrl($url, $param)
    {
        $len = strlen($url)-1;
        if ($url{$len} != '/') {
            $url = $url.'/';
        }
        
        if (is_array($param)) {
            $fullUrl = http_build_query($param);
            $url .= '?'.$fullUrl;
        } else {
            $url .= $param;
        }
        
        $parseUrl = parse_url($url);
        if ($parseUrl && isset($parseUrl['scheme'])) {
            $this->redirect($url);
        } else {
            $this->redirect($url);
        }
    }
    
    /**
     * 程序执行跳转
     * @param string $url
     * @param bool $secure
     */
    protected function redirect($url)
    {
        redirectAction($url);
    }
    
    /**
     * 错误回跳到首页
     * @param unknown $msg
     */
    protected function alertError($msg)
    {
        echo '<script type="text/javascript">alert("'.$msg.'");location.href="'.base_url().'"</script>';exit;
    }
    
    /**
     * 错误回跳到首页
     * @param unknown $msg
     */
    protected function alertJumpPre($msg)
    {
        echo '<script type="text/javascript">alert("'.$msg.'");location.href="Javascript:window.history.go(-1)"</script>';exit;
    }
    
    /**
     * 分页get参数
     * @param unknown $getParam
     */
    public function pageGetParam($getParam)
    {
        $suffix = '';
        if ($getParam) {
            $param = http_build_query($getParam);
            $suffix = '?'.$param;
        }
        return $suffix;
    }
    
    /**
     * ci 验证码
     * @return Ambigous <boolean, multitype:number string >
     */
    public function getCaptcha($name, $font_size=20, $img_width=100, $img_height=30, $count=4)
    {
        $this->load->helper('captcha');
        $str = 'abcdefghgklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUXWXYZ23456789';
        $word = '';
        for ($i=0; $i < $count; $i++) {
            $word .= $str[mt_rand(0,strlen($str)-1)];
        }
        $vals = array(
            'word'       => $word,
            'img_path'   => FCPATH.'captcha/',
            'img_url'    => base_url().'captcha/',
            'font_path'  => BASEPATH.'fonts/texb.ttf',
            'font_size'  => $font_size.'px',
            'img_width'  => $img_width,
            'img_height' => $img_height,
            'expiration' => '300'
        );
        $captcha = create_captcha($vals);
        $this->session->set_userdata($name, $captcha['word']);
        return $captcha;
    }
}