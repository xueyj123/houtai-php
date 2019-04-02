<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 获取id
$id = intval($id);

// 查询语句(主表)
$sql = "DELETE FROM xyj_book WHERE id=$id";

// 执行语句
$msql->execute($sql);

// 返回结果
$res = $msql->affectedRows();


if ($res > 0) { //如果主表数据删除成功

    // 删除封面(文件)
    $sql = "SELECT coverurl FROM xyj_cover WHERE bookid=$id";
    // 执行语句
    $msql->execute($sql, 's');

    // 返回结果
    while ($rex = $msql->fetchquery('s')) {
        
        // 文件路径
        $path = $rex['coverurl'];
        if (file_exists($path)) {
            unlink($path);
        }
    };



    // 删除封面(数据)
    $sql = "DELETE FROM xyj_cover WHERE bookid=$id";
    // 执行语句
    $msql->execute($sql, 'a');

    // 返回结果
    $re = $msql->affectedRows('a');
    if ($re > 0) {
        echo '图书删除成功<br>';
        // 跳转页面
        jump('main.php?go=booklist');
    }
} else {
    echo '图书删除失败<br>';
}










// 载入模板
// include 'pages/templates/bookadd.php';
