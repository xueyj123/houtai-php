<?php
 // 引入公用文件
require_once('../include/common.in.php');

$tempArr = array();

// 图书5星
$sql = "SELECT c.pid,bookname,price,coverurl FROM xyj_comment as c LEFT JOIN xyj_book as b ON (c.pid=b.id) LEFT JOIN xyj_cover as x ON (c.pid=x.bookid) WHERE stars=5 AND classify='book' ORDER BY c.id DESC LIMIT 1";
$msql->execute($sql);
$res = $msql->fetchquery();

// 处理价格
$price = explode('.', $res['price']);
$res['price_int'] = $price[0]; //整数
$res['price_dec'] = $price[1]; //小数
// 符合条件的id
$book_pid = $res['pid'];
if ($book_pid) {
    // 根据pid统计评论数
    $sql = "SELECT count(*) as total FROM xyj_comment WHERE pid=$book_pid";

    $msql->execute($sql);
    $res_book_count = $msql->fetchquery();

    $res['counts'] = $res_book_count['total'];


    $tempArr['book'] = $res;
}



// 音乐5星
$sql = "SELECT c.pid,musicname,price,coverurl FROM xyj_comment as c LEFT JOIN xyj_music as b ON (c.pid=b.id) WHERE stars=5 AND classify='music' ORDER BY c.id DESC LIMIT 1";
$msql->execute($sql);
$res = $msql->fetchquery();
// 处理价格
$price = explode('.', $res['price']);
$res['price_int'] = $price[0]; //整数
$res['price_dec'] = $price[1]; //小数

// 符合条件的id
$music_pid = $res['pid'];

if ($music_pid) {
    // 根据pid统计评论数
    $sql = "SELECT count(*) as total FROM xyj_comment WHERE pid=$music_pid";

    $msql->execute($sql);
    $msql->error();

    $res_music_count = $msql->fetchquery();

    $res['counts'] = $res_music_count['total'];


    $tempArr['music'] = $res;
}


// 电影5星
$sql = "SELECT c.pid,moviename,price,coverurl FROM xyj_comment as c LEFT JOIN xyj_movie as b ON (c.pid=b.id) WHERE stars=5 AND classify='movie' ORDER BY c.id DESC LIMIT 1";
$msql->execute($sql);
$res = $msql->fetchquery();


// 符合条件的id
$movie_pid = $res['pid'];
// 处理价格
$price = explode('.', $res['price']);
$res['price_int'] = $price[0]; //整数
$res['price_dec'] = $price[1]; //小数
if ($movie_pid) {
    // 根据pid统计评论数
    $sql = "SELECT count(*) as total FROM xyj_comment WHERE pid=$movie_pid";

    $msql->execute($sql);
    $res_movie_count = $msql->fetchquery();


    $res['counts'] = $res_movie_count['total'];


    $tempArr['movie'] = $res;
}



echo json_encode($tempArr);
