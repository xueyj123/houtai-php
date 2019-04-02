<?php

// 页面编码
// header("Content-type:text/html;charset='utf8'");
header("Content-type:text/html;charset=utf8");


// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}


// 接收表单数据
$cid = intval($cid);
$title = trim($title);

// 验证合法性

// 1.入库语句
$sql = "INSERT INTO xyj_class_child (cid,cname) VALUES ($cid,'" . $title . "')";

// 2.执行语句
$msql->execute($sql);

// 3.查看结果
$res = $msql->affectedRows();



// 4.给模板提供数据
if ($res > 0) {
    $result='创建成功！';
} else {
    $result='创建失败！';
}






// 载入模板
include 'pages/templates/classchild_add_do.html';
