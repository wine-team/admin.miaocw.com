<?php
class CS_Controller extends MJ_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->uid) {
            $this->redirect('account/login');
        }
    }
    
    /**
     * 资金类型(type)
     * @return multitype:string
     */
    public function levelType()
    {
        return array(
            PAY             => '支付',
            CASH            => '提现',
            RECHARGE        => '银行充值',
            CANCEL          => '退票',
            VIR_RECH        => '虚拟充值',
            REBUT           => '提现驳回',
            DFPROFIT        => '到付反利',
            ZFPROFIT        => '在线利润',
            DEDUCTION       => '月结抵扣',
            REBUT_DEDUCTION => '抵扣驳回',
            MONTHLY         => '月结转余额',
            TOURISMFREIGHT  => '商品运费',
        );
    }
    
    /**
     * 账户类型
     * @return multitype:string
     */
    public function accountType()
    {
        return array(
            ACCOUNT_TYPE_CARRY      => '可提现',
            ACCOUNT_TYPE_SETTLEMENT => '冻结',
            ACCOUNT_TYPE_BONUS      => '游币',
            ACCOUNT_TYPE_RANK       => '积份',
            ACCOUNT_TYPE_MONTH      => '月结',
        );
    }

    /**
     * 图片上传方法
     * @param $name 图片<input type="file" name="line_image"/>
     * @param string $oldfilename replace重写上传图片，删除老图片
     * @param string $dirName 图片保存在uploads下的目录。
     * @return boolean|array
     */
    protected function dealWithImages($name, $oldfilename = '', $dirName = '')
    {
        $date = date('Ymd');
        $config['upload_path'] = $this->config->upload_image_path($dirName.'/'.$date);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], DIR_WRITE_MODE, true);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = uniqid(); //唯一的函数
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($name)) {
            return array('status'=>false, 'messages'=>$this->upload->display_errors());
        }

        if (!empty($oldfilename)) {
            $this->deleteOldfileName($oldfilename, $dirName);
        }
        $uploadData = $this->upload->data();

        if (!empty($uploadData)) {
            $uploadData['file_name'] = $date.'/'.$uploadData['file_name'];
        }
        return $uploadData;
    }

    /**
     * 删除大图和小图
     * @param unknown $oldfullname
     * @param unknown $dirName
     */
    protected function deleteOldfileName($oldfullname, $dirName)
    {
        $imageLarge = $this->config->upload_image_path($dirName, $oldfullname);
        $imageThumb = $this->config->upload_image_thumb_path($dirName, $oldfullname);
        if (is_file($imageLarge)) {
            @unlink($this->config->upload_image_path($dirName, $oldfullname));
            if (is_file($imageThumb)) {
                @unlink($this->config->upload_image_thumb_path($dirName, $oldfullname));
            }
        }
    }

    /**
     * 图片等比例压缩
     * @param array $imageData {full_path:图片完整路径；file_path：图片所在完整目录}
     * @param string $dirName 图片保存在uploads下的目录。
     * @return boolean|array
     */
    protected function dealWithImagesResize($imageData, $width='60', $height='60')
    {
        $config['image_library']  = 'GD2'; //设置图像库GD, GD2, ImageMagick, NetPBM
        $config['source_image']   = $imageData['full_path']; //设置原始图像的名字/路径。 这个路径必须是相对或绝对的服务器路径，不能是URL
        $config['new_image']      = $imageData['file_path'].'thumb/'; //设置图像的目标名/路径。这个路径必须是相对或绝对的服务器路径，不能是URL
        if (!is_dir($config['new_image'])) {
            mkdir($config['new_image'], DIR_WRITE_MODE, true);
        }
        $config['create_thumb']   = TRUE; //让图像处理函数产生一个预览图像
        $config['maintain_ratio'] = TRUE; //指定是否在缩放或使用硬值的时候使图像保持原始的纵横比例。
        $config['thumb_marker']   = '_'.$width.'x'.$height; //例如，mypic.jpg 将会变成 mypic_thumb.jpg
        $config['quality']        = 95; //设置图像的品质。1 - 100
        $config['width']          = $width;
        $config['height']         = $height;

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $ifResize = $this->image_lib->resize();
        if (!$ifResize) {
            return array('status'=>false, 'messages'=>$this->image_lib->display_errors());
        }
        $this->image_lib->clear();
        return $ifResize;
    }

    /**
     * 水印处理一个图像
     * @param array $imageData {full_path:图片完整路径；file_path：图片所在完整目录}
     * @param string $textContent 打水印的文字内容。
     */
    protected function dealWithImagesWatermark($imageData, $textContent, $type='text', $fontSize=12, $fontColor='ffffff')
    {
        $config['image_library']      = 'gd2'; //设置图像库GD, GD2, ImageMagick, NetPBM
        $config['wm_type']            = 'text'; //Text: 水印信息将以文字方式生成;Overlay: 水印信息将以图像方式生成
        $config['source_image']       = $imageData['full_path'];//图片的路径;
        $config['quality']            = 90; //设置图像的品质。1 - 100
        $config['wm_padding']         = -10;
        $config['wm_vrt_alignment']   = 'bottom'; //top, middle, bottom
        $config['wm_hor_alignment']   = 'center'; //left, center, right
        $config['wm_hor_offset']      = 'right'; //left, center, right
        $config['wm_vrt_offset']      = 'bottom'; //left, center, right

        if (!is_writable($imageData['full_path'])) {
            @chmod($imageData['full_path'], DIR_WRITE_MODE);
        }

        if ($type == 'text') {
            $config['wm_text']            = $textContent;
            $config['wm_font_path']       = BASEPATH.'fonts/nsimsun.ttf';
            $config['wm_font_size']       = $fontSize;
            $config['wm_font_color']      = $fontColor;
            //$config['wm_shadow_color']    = $fontColor; //阴影的颜色, 以十六进制给出。
            $config['wm_shadow_distance'] = 3; //阴影与文字之间的距离(以像素为单位)。
        }

        if ($type == 'overlay') {
            $config['wm_overlay_path'] = $textContent; //你想要用作水印的图片在你服务器上的路径。
            $config['wm_opacity']      = 50; //图像不透明度(opacity)。通常设置为50。
            $config['wm_x_transp']     = 4; //一个数字	如果你的水印图片是一个PNG或GIF图片, 你可以指定一种颜色用来使图片变得"透明"。
            $config['wm_y_transp']     = 4; //你想要用作水印的图片在你服务器上的路径。
        }

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $ifWatermark = $this->image_lib->watermark();
        //var_dump($this->image_lib->display_errors());exit;
        if (!$ifWatermark) {
            return array('status'=>false, 'messages'=>$this->image_lib->display_errors());
        }
        $this->image_lib->clear();
        return $ifWatermark;
    }
    
    
    /**
     * 图片上传方法(多张图片) 会生成压缩图
     * @param $name 图片<input type="file" name="line_image"/>
     * @param string $oldfilename replace重写上传图片，删除老图片
     * @param string $dirName 图片保存在uploads下的目录。
     * @return boolean|array
     */
    protected function dealWithMoreImages($name, $oldfilename = array(), $dirName = '')
    {
    	$date = date('Ymd');
    	$config['upload_path'] = $this->config->upload_image_path($dirName.'/'.$date);
    	if (!is_dir($config['upload_path'])) {
    		mkdir($config['upload_path'], DIR_WRITE_MODE, true);
    	}
    	$config['allowed_types'] = 'gif|jpg|png';
    	$config['file_name'] = date('YmdHis').mt_rand(10, 100);
    	$this->load->library('upload', $config);
    	//获取图片上传数量
    	$count = count($_FILES["$name"]["name"]);
    	$uploadDatas = array();
    	$uploadDatas_new = array();
    	$uploadDatas_old = array();
    	for ($i=0;$i<$count;$i++) {
    		if(!empty($_FILES[$name]['name'][$i])){
    			$tmp_hotel_img = '_tmp_' . $name . '_' . $i;
    			$_FILES[$tmp_hotel_img] = array(
    					'name' => $_FILES[$name]['name'][$i],
    					'size' => $_FILES[$name]['size'][$i],
    					'type' => $_FILES[$name]['type'][$i],
    					'tmp_name' => $_FILES[$name]['tmp_name'][$i],
    					'error' => $_FILES[$name]['error'][$i]
    			);
    			if (!$this->upload->do_upload($tmp_hotel_img)) {
    				$this->session->set_flashdata('error', $this->upload->display_errors());
    				return false;
    			}
    			if (!empty($oldfilename)) {
    				$this->deleteOldfileName($oldfilename[$i], $dirName);
    			}
    			$uploadData = $this->upload->data();
    			/*批量上传图片 生成压缩图*/
    			$this->dealWithImagesResize($uploadData, $width='400', $height='400');
    			$this->dealWithImagesResize($uploadData, $width='60', $height='60');
    			if (!empty($uploadData)) {
    				$uploadData['file_name'] = $date.'/'.$uploadData['file_name'];
    				$uploadDatas_new[] = $uploadData['file_name'];
    			}
    		} else {
    			if (!empty($oldfilename[$i])){
    				$uploadDatas_old[] = $oldfilename[$i];
    			}
    		}
    	}
    	$uploadDatas = array_merge($uploadDatas_new,$uploadDatas_old);
    	return $uploadDatas;
    }
    
    
}