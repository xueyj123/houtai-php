<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 获取id
$id = intval($id);

// 根据该id获取数据
$sql = "SELECT b.id,b.cid,ccid,bookname,author,publicer,price,dt,fp,c.cname as cname,descript FROM xyj_book as b LEFT JOIN xyj_class_child as c ON (b.ccid=c.id) WHERE b.id=$id ORDER BY b.id DESC";

// 执行语句
$msql->execute($sql);

// 获取数据
$res = $msql->fetchquery();

// 二级分类
$classname = $res['cname'];
$class_cid = $res['ccid'];


// 初始化
$data = '';

// 根据id从数据库中读取该一级分类下的二级分类
$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$class_parent_book AND id!=$class_cid";

// 执行语句
$msql->execute($sql, 'h');

// 抓取数据
while ($rex = $msql->fetchquery('h')) {
    $data .= '<option value="' . $rex['id'] . '">' . $rex['cname'] . '</option>';
}




// 3.书名
$bookname = $res['bookname'];

//  4 .作者
$author = $res['author'];

// 5.出版社
$publicer = $res['publicer'];
// 6.价格
$price = $res['price'];


// 8.图书介绍
$descript = $res['descript'];

// 9.上架日期
$dt = date("Y-m-d", $res['dt']);
$fp = $res['fp'];





// 载入模板
include 'pages/templates/book_edit.html';
