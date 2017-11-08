<?php
include 'phpqrcode.php';

$url = $_GET["url"];
if($url==null || $url == ""){
    return;
}


// $text所要生成的链接或文字
// $outfile保存二维码的路径，（默认为false，直接在浏览器显示二维码）
// $level纠错级别
// $size点的大小
// $margin为边缘厚度
// $saveandprint表示是否保存二维码并显示
$outfile = false;
$level = 4;
$size = 10;
$margin = 1;
QRcode::png($url, $outfile, $level, $size, $margin, $saveandprint=false);
?>