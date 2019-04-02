<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 获取id
$id = intval($id);





// 删除封面(文件)
$sql = "SELECT coverurl FROM xyj_movie WHERE id=$id LIMIT 1";
// 执行语句
$msql->execute($sql, 's');

// 返回结果
while ($rex = $msql->fetchquery('s')) {

    // 文件路径
    $coverUrl = $rex['coverurl'];
    if (file_exists($coverUrl)) {
        @unlink($coverUrl);
    }
};




// 查询语句(主表)
$sql = "DELETE FROM xyj_movie WHERE id=$id";

// 执行语句
$msql->execute($sql);

// 返回结果
$res = $msql->affectedRows();

if ($res > 0) { //如果主表数据删除成功
    jump('main.php?go=movielist', 0);
} else {
    $result = '删除失败';
}


// 载入模板
include 'pages/templates/movie_del_do.html';
