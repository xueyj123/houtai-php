<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 给模板提供数据
// 1.获取id
$id = intval($id);

// 根据id，查询数据库
$sql = "SELECT cname FROM xyj_class_parent WHERE id=$id LIMIT 1";

// 3.执行语句
$msql->execute($sql);

// 4.获取结果
$res = $msql->fetchquery();

// 5.给模板提供数据
$value=$res['cname'];

// 载入模板
include 'pages/templates/classparentedit.html';
