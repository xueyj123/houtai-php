<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 获取id
$id = intval($id);

// 根据该id获取数据
$sql = "SELECT b.id,b.cid,ccid,musicname,singer,composer,writer,price,words,musicurl,coverurl,dt,c.cname as cname FROM xyj_music as b LEFT JOIN xyj_class_child as c ON (b.ccid=c.id) WHERE b.id=$id LIMIT 1";

// 执行语句
$msql->execute($sql);
// 获取数据
$res = $msql->fetchquery();
// 二级分类
$classname = $res['cname'];
$class_cid = $res['ccid'];

// 初始化
$data = '';

// 根据id从数据库中读取该一级分类下的类型分类
$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$class_parent_music AND cname!='" . $classname . "'";

// 执行语句
$msql->execute($sql, 'h');

// 抓取数据
while ($rex = $msql->fetchquery('h')) {
    $data .= '<option value="' . $rex['id'] . '">' . $rex['cname'] . '</option>';
}

$musicname = $res['musicname'];

$singer = $res['singer'];

$composer = $res['composer'];

$writer = $res['writer'];

$price = $res['price'];

$words = $res['words'];

// 9.上架日期
$dt = date("Y-m-d", $res['dt']);





// 载入模板
include 'pages/templates/music_edit.html';
