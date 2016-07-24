<?php 
class Ewm extends CS_Controller
{   
    public function _init()
    {
        $this->load->library('productewm'); // 引用二维码公共类
    }
    
     /**
     * 二维码编辑器
     */
    public function grid()
    {
        $url = $this->input->get('url');
		$matrixPointSize = $this->input->get('matrixPointSize');
		$state = $this->input->get('state');   //0显示   1不显示
		$errorCorrectionLevel = $this->input->get('errorCorrectionLevel');
		$value = $url ? $url : 'http://www.miaocw.com'; //二维码内容
		$errorCorrectionLevel = $errorCorrectionLevel ? $errorCorrectionLevel : 'H';//// 纠错级别：L、M、Q、H  
		$matrixPointSize = $matrixPointSize ? $matrixPointSize :4;//生成图片大小 默认4
		$QR = $this->config->upload_image_path('common/ewm','qrcode.png');//no logo
		$logo = $state ? FALSE : $this->config->upload_image_path('common/ewm','logo.png');
		$output =  $this->config->upload_image_path('common/ewm','helloweba.png');
		$getData = array('value'=>$value,'errorCorrectionLevel'=>$errorCorrectionLevel,'matrixPointSize'=>$matrixPointSize,'QR'=>$QR,'logo'=>$logo,'output'=>$output);
		$this->productewm->product($getData);
		$data['url'] = $value;
		$data['errorCorrectionLevel'] = $errorCorrectionLevel;
		$data['matrixPointSize'] = $matrixPointSize;
		$this->load->view('ewm/grid',$data);
    }
}   
