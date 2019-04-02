<?php
 // 引入公用文件
require_once('../include/common.in.php');

$tempArr = array();

$sql = "SELECT o.pid,SUM(counts) as total,musicname,price,coverurl FROM xyj_order as o LEFT JOIN xyj_music as m ON (o.pid=m.id) WHERE classify='music' GROUP BY o.pid ORDER BY total DESC LIMIT 0,6 ";
$msql->execute($sql);
while ($re = $msql->fetchquery()) {



    // 处理星星数
    $pid = $re['pid'];

    $sql = "SELECT AVG(stars) as avgstars FROM xyj_comment WHERE classify='music' AND pid=$pid LIMIT 1";

    $msql->execute($sql, 'avg');

    $res_star = $msql->fetchquery('avg');
    // 处理价格
    $price = explode('.', $re['price']);
    $re['price_int'] = $price[0]; //整数
    $re['price_dec'] = $price[1]; //小数

    $re['stars'] = ceil($res_star['avgstars']) ? ceil($res_star['avgstars']) : 5;



    $tempArr[] = $re;
}

echo json_encode($tempArr);
