<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

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
$destPosterUrl = uploadFile($poster, 'upload/movie/');

// echo $destMusicrUrl;
if (!$moviename || !$director || !$role || !$writer) {
    $result = '请确认是否规范填写';
} else {

    $sql = "INSERT INTO xyj_movie (cid,class_style,class_country,moviename,director,roles,writer,price,longs,movieurl,coverurl,descript,dt) VALUES ($class_parent_movie,'" . $class . "','" . $country . "','" . $moviename . "','" . $director . "','" . $roles . "','" . $writer . "',$price,$long,'" . $movieurl . "','" . $destPosterUrl . "','" . $descript . "',$dt)";
    $msql->execute($sql);
    // 返回结果
    $res = $msql->affectedRows();
    if ($res > 0) {
        $result = '电影入库成功<br>';
    } else {
        $result = '电影入库失败<br>';
    }
}





// 载入模板
include 'pages/templates/movie_add_do.html';
