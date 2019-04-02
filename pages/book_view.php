<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 获取id
$id=intval($id);

// 根据该id获取数据
$sql="SELECT b.id,b.cid,ccid,bookname,author,publicer,price,dt,c.cname as cname,descript FROM xyj_book as b LEFT JOIN xyj_class_child as c ON (b.ccid=c.id) WHERE b.id=$id ORDER BY b.id DESC";

// 执行语句
$msql->execute($sql);

// 获取数据
$res=$msql->fetchquery();

// 二级分类
$classname=$res['cname'];


// 3.书名
$bookname = $res['bookname'];

//  4 .作者
$author = $res['author'];

// 5.出版社
$publicer = $res['publicer'];
// 6.价格
$price =$res['price'];


// 8.图书介绍
$descript = $res['descript'];

// 9.上架日期
$dt = date("Y-m-d",$res['dt']);

// 载入模板
include 'pages/templates/book_view.html';
