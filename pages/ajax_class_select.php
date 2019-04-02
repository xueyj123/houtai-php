<?php

// 接收ajax参数
$id = intval($id);


// 初始化
$option_child = '';

// 根据id从数据库中读取该一级分类下的二级分类
$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$id";

// 执行语句
$msql->execute($sql);

// 抓取数据
while ($res = $msql->fetchquery()) {
    $option_child .= '<option value="' . $res['id'] . '">' . $res['cname'] . '</option>';
}



echo  $option_child;
