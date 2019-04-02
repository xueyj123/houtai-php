<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}


// 接收数据


// 3.书名
$name = trim($name);
$url = trim($url);


// 7.封面
$poster = $_FILES['poster'];




// 初始化遍历
$result_upload = $result_book = $result_poster = '';

// 数据验证

// 图片上传
$destFile = uploadFile($poster, 'upload/swiper/');


// 入库
$sql = "INSERT INTO xyj_swiper (title,photourl,gourl) VALUES ('" . $name . "','" . $destFile . "','" . $url . "')";
$msql->execute($sql);

$res = $msql->affectedRows();

if ($res > 0 && strpos($destFile, 'load')) {
    jump('main.php?go=swiper');
} else {
    echo '数据入库失败';
    echo '<br/>';
    echo $destFile;
}













// 载入模板
include 'pages/templates/swiper_add_do.html';
