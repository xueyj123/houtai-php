<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// // 初始化变量
// $tempStr = '';

// // 查询语句
// $sql = "SELECT b.id,b.cid,ccid,bookname,author,publicer,price,dt,p.cname as pname,c.cname as cname FROM xyj_book as b LEFT JOIN xyj_class_parent as p ON (b.cid=p.id) LEFT JOIN xyj_class_child as c ON (b.ccid=c.id) ORDER BY b.id DESC";

// // 执行语句
// $msql->execute($sql);


// // 抓取数据
// while ($res = $msql->fetchquery()) {




//     // 给模板提供数据
//     $tempStr .= '<tr>
//                     <td>' . $res['id'] . '</td>
//                     <td>' . $res['pname'] . '>' . $res['cname'] . '</td>
//                     <td>' . $res['bookname'] . '</td>
//                     <td>' . $res['author'] . '</td>
//                     <td>' . $res['publicer'] . '</td>
//                     <td>' . $res['price'] . '</td>
//                     <td>' . date("Y-m-d", $res['dt']) . '</td>
//                     <td>
//                     <a href="main.php?go=book_view&id=' . $res['id'] . '">预览</a> | <a href="main.php?go=book_edit&id=' . $res['id'] . '">修改</a> | <a href="main.php?go=book_del&id=' . $res['id'] . '">删除</a></td>
//                     </tr>';
// }





// 载入模板
include 'pages/templates/swiperadd.html';
