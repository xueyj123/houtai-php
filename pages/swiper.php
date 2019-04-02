<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 初始化变量
$tempStr = '';

// 查询语句
$sql = "SELECT id,title,photourl,gourl FROM xyj_swiper ORDER BY id DESC";

// 执行语句
$msql->execute($sql);


// 抓取数据
while ($res = $msql->fetchquery()) {


    // 给模板提供数据
    $tempStr .= '<tr>
                    <td>' . $res['id'] . '</td>
                    <td>' . $res['title'] . '</td>
                    <td>' . $res['photourl'] . '</td>
                    <td>' . $res['gourl'] . '</td>
                    <td>
                    <a href="main.php?go=swiper_edit&id=' . $res['id'] . '">修改</a> | <a href="main.php?go=swiper_del&id=' . $res['id'] . '">删除</a></td>
                    </tr>';
}





// 载入模板
include 'pages/templates/swiper.html';
