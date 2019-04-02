<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 给模板提供数据
// 1.获取id
$id = intval($id);

// 2.删除一级分类语句
$sql = "DELETE FROM xyj_class_parent WHERE id=$id LIMIT 1";

// 3.执行删除
$msql->execute($sql);

// 4.执行结果
$res = $msql->affectedRows();

if ($res > 0) {
    $result = '删除成功';
    // 删除二级分类语句
    $sql2 = "DELETE FROM xyj_class_child WHERE cid=$id ";
    $msql->execute($sql2);
    $res2 = $msql->affectedRows();
    if ($res2>0) {
        $result2='删除二级分类成功';
    } else {
        $result2='删除二级分类失败';
    }
    
} else {
    $result = '删除失败';
}




// 载入模板
include 'pages/templates/classparentdel.html';
