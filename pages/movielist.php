<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 初始化变量
$tempStr = '';

// 查询语句
$sql = "SELECT id,class_style,class_country,moviename,director,writer,price,dt FROM xyj_movie ORDER BY id DESC";

// 执行语句
$msql->execute($sql);

// 抓取数据
while ($res = $msql->fetchquery()) {


    // 给模板提供数据
    $tempStr .= '<tr>
                    <td>' . $res['id'] . '</td>
                    <td>' . $res['class_style'] .' / '. $res['class_country']. '</td>
                    <td>' . $res['moviename'] . '</td>
                    <td>' . $res['director'] . '</td>
                    <td>' . $res['writer'] . '</td>
                    <td>' . $res['price'] . '</td>
                    <td>' . date("Y-m-d", $res['dt']) . '</td>
                    <td>
                    <a href="main.php?go=movie_view&id=' . $res['id'] . '">预览</a> | <a href="main.php?go=movie_edit&id=' . $res['id'] . '">修改</a> | <a href="main.php?go=movie_del&id=' . $res['id'] . '">删除</a></td>
                    </tr>';
}

// 载入模板
include 'pages/templates/movielist.html';
