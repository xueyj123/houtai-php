<?php


// 引入公用文件
require_once('../include/common.in.php');

// 引入公用函数
require_once('../include/common.fn.php');

// 接收小程序的表单数据
// OPENID
$openid = $openid;

// 姓名
$uname = trim($uname);

// 电话
$tel = trim($tel);

// 地址
$address = trim($address);

// 邮编
$post = trim($post);

// 图片
$pohot = $_FILES['file'];

// 上传头像
$remoteUrl = uploadFile($pohot, '../upload/photo/');
$remoteUrl = substr($remoteUrl, 3);

// 日期
$dt = time();


// 查询数据库中是否已经存在该用户，如果有，则修改，否则新建
$sql = "SELECT id FROM xyj_user WHERE openid='" . $openid . "' LIMIT 1";
$msql->execute($sql);
$re = $msql->fetchquery();

if (!$re['id']) {
    // 入库
    $sql = "INSERT INTO xyj_user (openid,uname,tel,address,post,header,dt) VALUES ('" . $openid . "','" . $uname . "','" . $tel . "','" . $address . "','" . $post . "','" . $remoteUrl . "',$dt)";
} else {

    if ($pohot) { //重置头像
        $sql = "UPDATE xyj_user SET uname='" . $uname . "',tel='" . $tel . "',address='" . $address . "',post='" . $post . "',header='" . $remoteUrl . "',dt=$dt WHERE openid='" . $openid . "'";
    } else {  //没有重置头像
        // 修改
        $sql = "UPDATE xyj_user SET uname='" . $uname . "',tel='" . $tel . "',address='" . $address . "',post='" . $post . "',dt=$dt WHERE openid='" . $openid . "'";
    }
}

$msql->execute($sql);
$res = $msql->affectedRows();

if ($res > 0) {
    $result = 'success';
} else {
    $result = 'fail';
}

echo $result;
