<?php
session_start();
header("content-type:image/png");
//header("content-type:text/html chartset=utf-8");
 $image = imagecreatetruecolor(200, 60);
imagefill($image,0,0,imagecolorallocate($image,255,255,255));
for($i=0;$i<mt_rand(5, 30);$i++){
    imageline($image, mt_rand(0, 100), mt_rand(0, 30), mt_rand(0, 200), mt_rand(0, 60), imagecolorallocate($image,mt_rand(0, 255),mt_rand(0, 255),mt_rand(0, 255)));
}
for($j=0;$j<mt_rand(500,1000);$j++){
    imagesetpixel($image, mt_rand(0, 200),mt_rand(0, 60), imagecolorallocate($image,mt_rand(0, 255),mt_rand(0, 255),mt_rand(0, 255)));
}
$str="0987654321qazwsxedcrfvtgbyhnujmiklopQAZWERTYUIOPLKJHGFDSXCVBNM";
$str_new = substr(str_shuffle($str), 0, 6);
$_SESSION['yzmNumber'] = strtolower($str_new);
for($i=0;$i< strlen($str_new);$i++){
    $color = imagecolorallocate($image,mt_rand(0, 255),mt_rand(0, 255),mt_rand(0, 255));
    imagefttext($image,35,mt_rand(-40, 40), 20+$i*30, 40, $color, 'font/hei.ttf', substr($str_new,$i, 1)); 
}
imagepng($image);
