<?php


// 引入公用文件
require_once('../include/common.in.php');


// 获取id
$pid = $id;
$classify = $classify;
$tempArr = array();

$sql = "SELECT stars,notes,c.dt,uname,header FROM xyj_comment as c LEFT JOIN xyj_user as u ON (u.openid=c.openid) WHERE pid=$id AND classify='" . $classify . "'";

$msql->execute($sql);
$msql->error();
while ($res = $msql->fetchquery()) {
    $tempArr[]=$res;
}

echo json_encode($tempArr);
