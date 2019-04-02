<?php

// 引入公用文件
require_once('../include/common.in.php');

// 接收id参数
$id = intval($id);

// 查询语句
$sql = "SELECT ccid,bookname,author,publicer,price,descript,cname FROM xyj_book as b LEFT JOIN xyj_class_child as cc ON (b.ccid=cc.id) WHERE b.id=$id LIMIT 1";

// 执行语句
$msql->execute($sql);

// 获取数据
$res = $msql->fetchquery();


// 处理价格
$price = explode('.', $res['price']);
$res['price_int'] = $price[0]; //整数
$res['price_dec'] = $price[1]; //小数

// 去掉html标签
$res['descript'] = strip_tags($res['descript']);
// 截取长度
$res['descript'] = mb_substr($res['descript'], 0, 200, 'utf8');

// 初始化
$temArr = array();


// 处理封面
$sql = "SELECT coverurl FROM xyj_cover WHERE bookid=$id";
$msql->execute($sql);
while ($rex = $msql->fetchquery()) {
    $temArr[] = $rex;
}

$res['cover'] = $temArr;

// 转换成json,并输出
echo json_encode($res);
