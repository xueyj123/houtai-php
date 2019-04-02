<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 初始化
$option_parent = '';



// 1.获取一级分类
// 查询语句
$sql = "SELECT id,cname FROM xyj_class_parent WHERE id=$class_parent_book";

// 执行语句
$msql->execute($sql);

// 抓取数据
while ($res = $msql->fetchquery()) {
    $option_parent .= '<option value="' . $res['id'] . '">' . $res['cname'] . '</option>';
}




// 载入模板
include 'pages/templates/bookadd.html';
