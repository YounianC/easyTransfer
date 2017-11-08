<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('PRC');

$id = $_GET["id"];
if ($id == null || $id == "") {
    return;
}

$str = file_get_contents("data/" . $id . "/" . $id . ".txt");
$json = json_decode($str);

$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url = urlencode($url);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="keywords" content="文本文件速递">
    <meta name="description" content="文本文件速递">
    <title>文本文件速递-详情</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico">

    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

    <style>
        .container {
            padding: 30px;
        }

        .msg{
            background-color:#e0dedc;
            border-radius: 3px;
            padding: 15px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="/easyTransfer">速递首页</a>
    </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-4" style="text-align: center;">
            <img style="width: 100%;" src="getQR.php?url=<?php echo $url ?>">
        </div>
        <div class="col-md-8 msg">
            <?php echo $json->msg ?>
        </div>
    </div>

    <label>附件：</label>
    <div class="row">
        <div class="col-md-12" style="text-align: left;">
            <?php
            foreach ($json->files as $file) {
                $name = substr($file,strripos($file,'/') + 1);
                echo '<p><a href="'.$file.'">'.$name.'</a></p>';
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>