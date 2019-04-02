<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 给模板提供数据
$datas = '';

// 1.读取数据的语句
$sql = "SELECT id,cname FROM xyj_class_parent ORDER BY id ";

// 2.执行语句
$msql->execute($sql);

// 3.获取结果
while ($res = $msql->fetchquery()) {
    $datas .= '<tr>
    <td>' . $res['id'] . '</td>
    <td>' . $res['cname'] . '</td>
    <td><a href="main.php?go=classparentedit&id='.$res['id'].'">修改</a> | <a href="javascript:void(0)" onclick="ask('.$res['id'].')">删除</a></td>
</tr>';
}


// 载入模板
include 'pages/templates/classparent.html';

