<?php


// 引入公用文件
require_once('../include/common.in.php');

// 接收openid
$openid=trim($id);


// 查询语句
$sql="SELECT uname,tel,address,header,post FROM xyj_user WHERE openid='".$openid."'LIMIT 1";

// 执行语句
$msql->execute($sql);

// 获取结果
$res=$msql->fetchquery();

// 返回json

echo json_encode($res);