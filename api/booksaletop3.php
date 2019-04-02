<?php


// 引入公用文件
require_once('../include/common.in.php');

$tempArr = array();

// 畅销书top3查询语句
$sql = "SELECT o.pid,SUM(counts) as total,bookname,price FROM xyj_order as o LEFT JOIN xyj_book as b ON (o.pid=b.id) WHERE classify='book' GROUP BY o.pid ORDER BY total DESC LIMIT 0,3";

$msql->execute($sql);
while ($re = $msql->fetchquery()) {

    // 获取图书封面
    $pid = $re['pid'];

    $sql = "SELECT coverurl FROM xyj_cover WHERE bookid=$pid LIMIT 1";
    $msql->execute($sql, 'c');
    $res_cover = $msql->fetchquery('c');

    $re['cover'] = $res_cover['coverurl'];
    // 处理价格
    $price = explode('.', $re['price']);
    $re['price_int'] = $price[0]; //整数
    $re['price_dec'] = $price[1]; //小数

    // 处理标题长度
    $title = $re['bookname'];
    $titlelen = strlen($title);

    if ($titlelen > 43) {
        $re['bookname'] = mb_substr($title, 0, 17, 'utf8').'...';
    }



    $tempArr[] = $re;
}

echo json_encode($tempArr);
