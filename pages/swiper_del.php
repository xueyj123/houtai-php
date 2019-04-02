<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 获取id
$id = intval($id);


// 删除文件
// 删除封面(文件)
$sql = "SELECT photourl FROM xyj_swiper WHERE id=$id LIMIT 1";
// 执行语句
$msql->execute($sql, 's');

// 返回结果
$rex = $msql->fetchquery('s');

// 文件路径
$photoUrl = $rex['photourl'];
if (file_exists($photoUrl)) {
   
    @unlink($photoUrl);
    echo '文件删除成功';
}





// 删除语句
$sql = "DELETE FROM xyj_swiper WHERE id=$id";

// 执行语句
$msql->execute($sql);

// 返回结果
$res = $msql->affectedRows();


if ($res > 0) { //如果主表数据删除成功

    $result = '删除成功';
    jump('main.php?go=swiper', 0);
} else {
    $result = '删除失败';
}
