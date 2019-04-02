<?php


// 引入公用文件
require_once('../include/common.in.php');

// 接收openid
$openid = $id;
// 产品信息
$datas = json_decode(stripslashes($datas), true);



// 定义入库状态
$result = 'success';

// 提取信息并入库
foreach ($datas as $key => $values) {
    // 产品分类
    $classify = $key;
    if (count($values)) {
        // 遍历内容
        foreach ($values as  $items) {
            // 产品id
            $pid = $items['pid'];
            // 产品数量
            $count = $items['count'];
            // 下单日期
            $dt = time();
            // 入库
            $sql = "INSERT INTO xyj_order (openid,counts,classify,pid,dt) VALUES ('" . $openid . "','" . $count . "','" .  $classify . "','" . $pid . "',$dt)";
            $msql->execute($sql);
            $res = $msql->affectedRows();
            if ($res < 1) {
                $result = 'fail';
            }
        };
    }
};


echo $result;
