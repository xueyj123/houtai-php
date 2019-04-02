<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}


// 一级分类名称入库
// 1.入库语句
$sql = "INSERT INTO xyj_class_parent (cname) VALUES ('" . $title . "')";

// 2.执行语句
$msql->execute($sql);

// 3.查看结果
$res = $msql->affectedRows();

// 4.给模板提供数据
if ($res > 0) {
    $result = '创建成功！';
} else {
    $result = '创建失败！';
}






// 载入模板
include 'pages/templates/classparentadddo.html';
