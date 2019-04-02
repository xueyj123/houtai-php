<?php
 // 引入公用文件
require_once('../include/common.in.php');


$tempArr = array();


$sql = "SELECT id,title,photourl,gourl FROM xyj_swiper ";
// 执行语句
$msql->execute($sql);

// 获取数据
while ($res = $msql->fetchquery()) {

    $tempArr[] = $res;
}



// 把数据转换成json格式，并返回给小程序
echo json_encode($tempArr);
 