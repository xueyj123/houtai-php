<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 初始化
$option_parent = '';

// 接收表单数据
// 二级分类id
$cclass = intval($cclass);
// 歌曲名称
$musicname = trim($musicname);
// 歌手
$singer = trim($singer);
// 作曲
$composer = trim($composer);
// 填词
$writer = trim($writer);

// 价格
$price = $price;
// 封面
$poster = $_FILES['poster'];
// 音乐
$music = $_FILES['music'];
// 歌词
$descript = trim($descript);
// 上架日期
$dt = strtotime($dt);

// 上传文件
// 上传封面
$destPosterUrl = uploadFile($poster);
// 上传音乐
$destMusicrUrl = uploadFile($music, 'upload/music/');
// echo $destMusicrUrl;
if (!$musicname || !$singer || !$composer || !$writer) {
    $result = '请确认是否规范填写';
} else {



    $sql = "INSERT INTO xyj_music (cid,ccid,musicname,singer,composer,writer,price,musicurl,coverurl,words,dt) VALUES ($class_parent_music,$cclass,'" . $musicname . "','" . $singer . "','" . $composer . "','" . $writer . "',$price,'" . $destMusicrUrl . "','" . $destPosterUrl . "','" . $descript . "',$dt)";
    $msql->execute($sql);
    // 返回结果
    $res = $msql->affectedRows();
    if ($res > 0) {
        $result = '音乐入库成功<br>';
    } else {
        $result = '音乐入库失败<br>';
    }
}




// 载入模板
include 'pages/templates/music_add_do.html';
