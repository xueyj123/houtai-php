<?php
 // 引入公用文件
require_once('../include/common.in.php');

$ccid = intval($ccid);


$arrTemp = array();


if ($ccid) {
    $sql = "SELECT id,musicname,singer,composer,writer,price,coverurl FROM xyj_music WHERE ccid=$ccid ORDER BY id DESC LIMIT 0,20";
} else {
    $sql = "SELECT id,musicname,singer,composer,writer,price,coverurl FROM xyj_music ORDER BY id DESC LIMIT 0,20";
}
$msql->execute($sql);

while ($res = $msql->fetchquery()) {
    // 处理简介
    // 去掉html标签
    $res['descript'] = strip_tags($res['descript']);
    // 截取长度
    $res['descript'] = mb_substr($res['descript'], 0, 40, 'utf8');

    // 处理价格
    $price = explode('.', $res['price']);
    $res['price_int'] = $price[0]; //整数
    $res['price_dec'] = $price[1]; //小数

    // 处理星星数
    $res['stars'] = 5;

    // 评论数
    $res['comment_count'] = 0;

    // 处理日期
    $res['date'] = date('Y-m-d', $res['dt']);

    $arrTemp[] = $res;
}


echo json_encode($arrTemp);
