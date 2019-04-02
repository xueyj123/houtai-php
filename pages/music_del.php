<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 获取id
$id = intval($id);





// 删除封面(文件)
$sql = "SELECT musicurl,coverurl FROM xyj_music WHERE id=$id LIMIT 1";
// 执行语句
$msql->execute($sql, 's');

// 返回结果
while ($rex = $msql->fetchquery('s')) {

    // 文件路径
    $coverUrl = $rex['coverurl'];
    $musicUrl = $rex['musicurl'];
    if (file_exists($coverUrl)) {
        @unlink($coverUrl);
    }
    if (file_exists($musicUrl)) {
        @unlink($musicUrl);
    }
};




// 查询语句(主表)
$sql = "DELETE FROM xyj_music WHERE id=$id";

// 执行语句
$msql->execute($sql);

// 返回结果
$res = $msql->affectedRows();


if ($res > 0) { //如果主表数据删除成功

    $result = '删除成功';
    jump('main.php?go=musiclist');
} else {
    $result = '删除失败';
}


// 载入模板
include 'pages/templates/music_del_do.html';
