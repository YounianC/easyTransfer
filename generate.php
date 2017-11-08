<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('PRC');

$text =$_POST["msg"];
if($text==null || $text == ""){
    return;
}
$id = date("YmdHis")."_".sprintf("%05d", rand(0,99999));
$data["id"]= $id;
$data["msg"]= $text;

if (! is_dir ("data" )) {
    mkdir ("data", '0777' );
    chmod('data',0777);
}

if (! is_dir ("data/".$id )) {
    mkdir ("data/".$id, '0777' );
    chmod("data/".$id,0777);
}

$fileArray=array();
foreach ($_FILES["file"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["file"]["tmp_name"][$key];
        $name = $_FILES["file"]["name"][$key];
        move_uploaded_file($tmp_name, "data/$id/$name");
        array_push($fileArray,"data/$id/$name");
    }
}
$data["files"]= $fileArray;
$fp = fopen("data/".$id."/".$id.".txt", 'w+');
fwrite($fp, json_encode($data));
fclose($fp);

//重定向浏览器   
header("Location: detail.php?id=".$id);   
//确保重定向后，后续代码不会被执行   
exit;  