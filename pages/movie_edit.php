<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 获取id
$id = intval($id);

// 根据该id获取数据
$sql = "SELECT id,cid,class_style,class_country,moviename,director,writer,roles,longs,movieurl,price,descript,dt FROM xyj_movie  WHERE id=$id LIMIT 1";

// 执行语句
$msql->execute($sql);
$msql->error();

// 获取数据
$res = $msql->fetchquery();
// 二级分类
$class_style = $res['class_style'];//字符串
$class_country = $res['class_country'];//字符串


// 初始化
$data = '';
$data2 = '';

// 根据id从数据库中读取该一级分类下的类型分类
$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$class_parent_movie AND cname!='" .$class_style. "'";

// 执行语句
$msql->execute($sql, 'h');

// 抓取数据
while ($rex = $msql->fetchquery('h')) {
    $data .= '<option value="' . $rex['cname'] . '">' . $rex['cname'] . '</option>';
}
// 根据id从数据库中读取该一级分类下的国家分类
$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$class_parent_country AND cname!='" . $class_country . "'";

// 执行语句
$msql->execute($sql, 'x');

// 抓取数据
while ($re = $msql->fetchquery('x')) {
    $data2 .= '<option value="' . $re['cname'] . '">' . $re['cname'] . '</option>';
}




$musicname = $res['moviename'];
$longs = $res['longs'];
$movieurl = $res['movieurl'];

$director = $res['director'];

$roles = $res['roles'];

$writer = $res['writer'];

$price = $res['price'];

$descript = $res['descript'];

// 9.上架日期
$dt = date("Y-m-d", $res['dt']);
// $fp = $res['fp'];




// 载入模板
include 'pages/templates/movie_edit.html';
