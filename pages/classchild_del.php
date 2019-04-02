<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 接收id
$id = intval($id);

// 删除语句
$sql = "DELETE FROM xyj_class_child WHERE id=$id";

// 执行语句
$msql->execute($sql);

// 返回执行结果
$res = $msql->affectedRows();
if ($res > 0) {
    $result = '删除成功！';
} else {
    $result = '删除失败！';
}


// 载入模板
include 'pages/templates/classchild_del.html';

