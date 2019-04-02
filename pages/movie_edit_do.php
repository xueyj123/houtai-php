<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 初始化
$result = $result_music = $result_poster = $destPosterUrl = $tempDestArr = '';

// 接收表单数据

// 获取id
$id = intval($id);

// 初始化
$option_parent = '';

// 接收表单数据
// 类型分类id
$class = $class;
// 国家分类id
$country = $country;

// 电影名称
$moviename = trim($moviename);
// 导演
$director = trim($director);
// 编剧
$writer = trim($writer);
// 主演
$roles = trim($role);
// 价格
// $price = doubleval($price);
$price = $price;
// 片长
$long = intval($long);
// 花絮地址
$movieurl = trim($movieurl);
// 封面
$poster = $_FILES['poster'];
// 简介
$descript = trim($descript);
// 上架日期
$dt = strtotime($dt);
// 上传文件
// 上传封面
if ($poster['error'] < 1) {
    $destPosterUrl = uploadFile($poster, 'upload/movie/');
}

if (!$moviename || !$director || !$role || !$writer) {
    $result = '请确认是否规范填写';
} else {

    if ($destPosterUrl != '上传失败') { //意味着上传了新的封面
        $sql = "UPDATE xyj_movie SET class_style='" . $class . "',class_country='" . $country . "',moviename='" . $moviename . "',director='" . $director . "',roles='" . $role . "',writer='" . $writer . "',price=$price,descript='" . $descript . "',dt=$dt,longs=$long,coverurl='" . $destPosterUrl . "',movieurl='" . $movieurl . "' WHERE id=$id";
    } else {
        $sql = "UPDATE xyj_movie SET class_style='" . $class . "',class_country='" . $country . "',moviename='" . $moviename . "',director='" . $director . "',roles='" . $role . "',writer='" . $writer . "',price=$price,descript='" . $descript . "',dt=$dt,longs=$long,movieurl='" . $movieurl . "' WHERE id=$id";
    }
    $msql->execute($sql);
    // 返回结果
    $res = $msql->affectedRows();

    if ($res > 0) {
        $result = '电影入库成功';
        jump('main.php?go=movielist', 0);
    } else {
        $result = '电影入库失败';
        echo $result;
    }
}

// 载入模板
// include 'pages/templates/music_edit.html';
