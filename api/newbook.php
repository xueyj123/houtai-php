<?php
 // 引入公用文件
require_once('../include/common.in.php');

$tempArr = array();

$sql = "SELECT b.id,bookname,price,coverurl,fp FROM xyj_book as b LEFT JOIN xyj_cover as c ON (b.id=c.bookid)  GROUP BY b.id ORDER BY b.fp DESC,b.id DESC LIMIT 0,3";

$msql->execute($sql);

while ($res = $msql->fetchquery()) {

    // 处理价格
    $price = explode('.', $res['price']);
    $res['price_int'] = $price[0]; //整数
    $res['price_dec'] = $price[1]; //小数

    // 处理标题长度
    $title = $res['bookname'];
    $titlelen = strlen($title);

    if ($titlelen > 43) {
        $res['bookname'] = mb_substr($title, 0, 17, 'utf8').'...';
    }

    $tempArr[] = $res;
}
echo json_encode($tempArr);
