<?php
 // 引入公用文件
require_once('../include/common.in.php');

// 获取code
$code = $code;

// 获取openid
$res = file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid=wxeecdfcf7320ed7e0&secret=1b3e9a0bdd46e5f1fff832a88adf92c4&js_code=' . $code . '&grant_type=authorization_code');

echo $res;
