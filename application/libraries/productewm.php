<?php
class Productewm {
   
     /**
    * 二维码编辑器
    * @param unknown $getData
    */
   public function product($getData)
   {   
       require_once 'phpqrcode/phpqrcode.php';
   	   $value  = $getData['value'];
       $QR     = $getData['QR'];
       $errorCorrectionLevel = $getData['errorCorrectionLevel'];
       $matrixPointSize = $getData['matrixPointSize'];
       $logo  = $getData['logo'];
       $output = $getData['output'];
       QRcode::png($value, $QR, $errorCorrectionLevel, $matrixPointSize, 2);    //生成二维码图片
       if ($logo !== FALSE) {
           
           $QR = imagecreatefromstring(file_get_contents($QR));
           $logo = imagecreatefromstring(file_get_contents($logo));
           $QR_width = imagesx($QR);//二维码图片宽度
           $QR_height = imagesy($QR);//二维码图片高度
           $logo_width = imagesx($logo);//logo图片宽度
           $logo_height = imagesy($logo);//logo图片高度
           $logo_qr_width = $QR_width / 6;
           $scale = $logo_width/$logo_qr_width;
           $logo_qr_height = $logo_height/$scale;
           $from_width = ($QR_width - $logo_qr_width) / 2; //重新组合图片并调整大小
           imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);
           imagepng($QR,$output);//输出图片
       }
   }
}