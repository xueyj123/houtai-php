<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 给模板提供数据
$datas = '';

// 1.读取数据的语句
$sql = "SELECT cc.id as ccid,cc.cname as cname,cp.cname as pname,cp.id as cpid FROM xyj_class_child as cc LEFT JOIN xyj_class_parent as cp ON (cc.cid=cp.id) ORDER BY cc.id ";

// 2.执行语句
$msql->execute($sql);

// 3.获取结果
while ($res = $msql->fetchquery()) {
    $datas .= '<tr>
    <td>' . $res['ccid'] . '</td>
    <td>' . $res['pname'] .$res['cpid']. '</td>
    <td>' . $res['cname'] . '</td>
    <td><a href="main.php?go=classchild_edit&id='.$res['ccid'].'">修改</a> | <a href="javascript:void(0)" onclick="ask('.$res['ccid'].')">删除</a></td>
</tr>';
}


// 载入模板
include 'pages/templates/classchild.html';

