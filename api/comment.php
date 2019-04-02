<?php


// 引入公用文件
require_once('../include/common.in.php');

$classify = $classify;
$pid = $pid;
$openid = $openid;
$starnums = $starnums;
$content = $content;
$action = $action;
$dt = time();
// 入库
if ($action == 'add') {
    $sql = "INSERT INTO xyj_comment (openid,pid,stars,notes,classify,dt) VALUES ('" . $openid . "','" . $pid . "', $starnums ,'" . $content . "','" . $classify . "',$dt)";
} else {
    $sql = "UPDATE xyj_comment SET stars= $starnums ,notes='" . $content . "',dt=$dt WHERE openid='" . $openid . "' AND pid='" . $pid . "' AND classify='" . $classify . "' LIMIT 1";
}
$msql->execute($sql);
$re = $msql->affectedRows();
$msql->error();
if ($re > 0) {
    echo 'success';
} else {
    echo 'fail';
}
