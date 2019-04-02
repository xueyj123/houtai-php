<?php

// 引入公用文件
require_once('../include/common.in.php');

// 接收id参数
$id = intval($id);

// 查询语句
$sql = "SELECT m.id,ccid,musicname,singer,composer,writer,price,musicurl,coverurl,words,cname FROM xyj_music as m LEFT JOIN xyj_class_child as cc ON (m.ccid=cc.id) WHERE m.id=$id LIMIT 1";

// 执行语句
$msql->execute($sql);

// 获取数据
$res = $msql->fetchquery();

$msql->error();
// 处理价格
$price = explode('.', $res['price']);
$res['price_int'] = $price[0]; //整数
$res['price_dec'] = $price[1]; //小数





// 转换成json,并输出
echo json_encode($res);
