<?php

// 引入公用文件
require_once('../include/common.in.php');

$tempArr = array();

if ($style == 'all') {
    $sql = "SELECT  b.id,bookname as pname,price,coverurl FROM xyj_book as b LEFT JOIN xyj_cover as c ON (c.bookid=b.id) WHERE bookname LIKE '%" . $search . "%' GROUP BY b.id";
    $msql->execute($sql);
    $msql->error();
    while ($res = $msql->fetchquery()) {
        // 处理价格
        $price = explode('.', $res['price']);
        $res['price_int'] = $price[0]; //整数
        $res['price_dec'] = $price[1]; //小数
        $res['classify'] = 'book';
        $tempArr[] = $res;
    }
    $sql = "SELECT  id,musicname as pname,price,coverurl FROM xyj_music  WHERE musicname LIKE '%" . $search . "%' ";
    $msql->execute($sql);
    while ($res = $msql->fetchquery()) {
        // 处理价格
        $price = explode('.', $res['price']);
        $res['price_int'] = $price[0]; //整数
        $res['price_dec'] = $price[1]; //小数
        $res['classify'] = 'music';
        $tempArr[] = $res;
    }
    $sql = "SELECT  id,moviename as pname,price,coverurl FROM xyj_movie  WHERE moviename LIKE '%" . $search . "%' ";
    $msql->execute($sql);
    while ($res = $msql->fetchquery()) {
        // 处理价格
        $price = explode('.', $res['price']);
        $res['price_int'] = $price[0]; //整数
        $res['price_dec'] = $price[1]; //小数
        $res['classify'] = 'movie';
        $tempArr[] = $res;
    }
} else if ($style == 'book') {
    $sql = "SELECT  b.id,bookname as pname,price,coverurl FROM xyj_book as b LEFT JOIN xyj_cover as c ON (c.bookid=b.id) WHERE bookname LIKE '%" . $search . "%' GROUP BY b.id";
    $msql->execute($sql);
    while ($res = $msql->fetchquery()) {
        // 处理价格
        $price = explode('.', $res['price']);
        $res['price_int'] = $price[0]; //整数
        $res['price_dec'] = $price[1]; //小数
        $res['classify'] = 'book';
        $tempArr[] = $res;
    }
} else if ($style == 'music') {
    $sql = "SELECT  id,musicname as pname,price,coverurl FROM xyj_music  WHERE musicname LIKE '%" . $search . "%' ";
    $msql->execute($sql);
    while ($res = $msql->fetchquery()) {
        // 处理价格
        $price = explode('.', $res['price']);
        $res['price_int'] = $price[0]; //整数
        $res['price_dec'] = $price[1]; //小数
        $res['classify'] = 'music';
        $tempArr[] = $res;
    }
} else if ($style == 'movie') {
    $sql = "SELECT  id,moviename as pname,price,coverurl FROM xyj_movie  WHERE moviename LIKE '%" . $search . "%' ";
    $msql->execute($sql);
    while ($res = $msql->fetchquery()) {
        // 处理价格
        $price = explode('.', $res['price']);
        $res['price_int'] = $price[0]; //整数
        $res['price_dec'] = $price[1]; //小数
        $res['classify'] = 'movie';
        $tempArr[] = $res;
    }
}

echo json_encode($tempArr);
