<?php


// 引入公用文件
require_once('../include/common.in.php');


$pid=$pid;
$classify=$classify;
$id=$id;
$dt=time();
$result = 'fail';

$sql="INSERT INTO xyj_order (openid,pid,classify,counts,dt) VALUES ('".$id."','".$pid."','".$classify."',1,$dt)";

$msql->execute($sql);

$res=$msql->affectedRows();

if ($res>0) {
    $result = 'success';
} 

echo $result;