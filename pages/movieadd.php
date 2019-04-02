<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 初始化
$class = $country = '';


// 类型（二级分类）
// 查询语句
$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$class_parent_movie";

// 执行语句
$msql->execute($sql);

// 抓取数据
while ($res = $msql->fetchquery()) {
    $class .= '<option value="' . $res['cname'] . '">' . $res['cname'] . '</option>';
}



// 地区
// 查询语句
$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$class_parent_country";

// 执行语句
$msql->execute($sql,'x');

// 抓取数据
while ($rex = $msql->fetchquery('x')) {
    $country .= '<option value="' . $rex['cname'] . '">' . $rex['cname'] . '</option>';
}




// 载入模板
include 'pages/templates/movieadd.html';
