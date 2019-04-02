<?php


// 引入公用文件
require_once('../include/common.in.php');


// 接收openid
$code = $code;

$tempArr = array();

if ($code) {

    $classify = $pid = '';

    $sql = "SELECT  id FROM xyj_book WHERE code=$code LIMIT 1";

    $msql->execute($sql);

    $res = $msql->fetchquery();
    if ($res['id']) {
        $classify = 'book';
        $pid = $res['id'];
    } else {
        $sql = "SELECT  id FROM xyj_music WHERE code=$code LIMIT 1";

        $msql->execute($sql);

        $res = $msql->fetchquery();
        if ($res['id']) {
            $classify = 'music';
            $pid = $res['id'];
        } else {
            $sql = "SELECT  id FROM xyj_movie WHERE code=$code LIMIT 1";

            $msql->execute($sql);

            $res = $msql->fetchquery();
            if ($res['id']) {
                $classify = 'movie';
                $pid = $res['id'];
            }
        }
    }
}


$tempArr['classify'] =$classify ;
$tempArr['pid'] =$pid ;
echo json_encode($tempArr);
