<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 接收参数
$id = intval($id);
$cid = intval($cid);
$cname = trim($title);

// 修改语句
$sql = "UPDATE xyj_class_child SET cid=$cid,cname='" . $cname . "' WHERE id=$id";

// 执行语句
$msql->execute($sql);

// 返回执行结果
$res = $msql->affectedRows();

if ($res > 0) {
    $result = '修改成功！';
} else {
    $result = '修改失败！';
}


// 载入模板
include 'pages/templates/classchild_edit_do.html';
