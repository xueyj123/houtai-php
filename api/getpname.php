<?php


// 引入公用文件
require_once('../include/common.in.php');

$pid = $pid;
$classify = $classify;


switch ($classify) {
    case 'book':
        $sql = "SELECT bookname as pname FROM xyj_book WHERE id='" . $pid . "' LIMIT 1";
        break;
    case 'music':
        $sql = "SELECT musicname as pname FROM xyj_music WHERE id='" . $pid . "' LIMIT 1";
        break;
    case 'movie':
        $sql = "SELECT moviename as pname FROM xyj_movie WHERE id='" . $pid . "' LIMIT 1";
        break;
}
$msql->execute($sql);
$msql->error();
$res = $msql->fetchquery();

echo json_encode($res);
