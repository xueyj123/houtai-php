<?php


// 引入公用文件
require_once('../include/common.in.php');


// 接收openid
$openid = $openid;


$tempArr = array();
if ($openid) {

    $sql = "SELECT pid,classify,dt FROM xyj_order WHERE openid='" . $openid . "'";
    $msql->execute($sql);
    while ($re = $msql->fetchquery()) {

        // 分类
        $class = $re['classify'];

        // 产品id
        $pid = $re['pid'];

        // 根据不同的分类，去不同的表中查该pid对应的数据（名称，封面，价格）
        if ($class == 'book') {
            $sql = "SELECT bookname,price,coverurl FROM xyj_book as b LEFT JOIN xyj_cover as c ON (b.id=c.bookid) WHERE b.id=$pid";

            $msql->execute($sql, 'book');


            $res_book = $msql->fetchquery('book');

            // 产品名称
            $res_book['pname'] = $res_book['bookname'];

            // 分类
            $res_book['classify'] = $class;

            // 产品id
            $res_book['pid'] = $pid;

            // 上架日期
            $res_book['dt'] = date('Y-m-d', $re['dt']);

            // 评论
            $sql = "SELECT stars,notes,dt FROM xyj_comment WHERE classify='book' AND pid=$pid AND openid='" . $openid . "' ORDER BY id DESC LIMIT 1";
            $msql->execute($sql, 'comment1');
            $res_comment = $msql->fetchquery('comment1');
            $res_comment['dt'] = date('Y-m-d', $res_comment['dt']);

            $res_book['comment'] = $res_comment;

            $tempArr[] = $res_book;
        } else  if ($class == 'music') {
            $sql = "SELECT musicname,price,coverurl FROM xyj_music WHERE id=$pid";

            $msql->execute($sql, 'music');
            $res_music = $msql->fetchquery('music');

            // 产品名称
            $res_music['pname'] = $res_music['musicname'];

            // 分类
            $res_music['classify'] = $class;

            // 产品id
            $res_music['pid'] = $pid;

            // 上架日期
            $res_music['dt'] = date('Y-m-d', $re['dt']);
            // 评论
            $sql = "SELECT stars,notes,dt FROM xyj_comment WHERE classify='music' AND pid=$pid AND openid='" . $openid . "' ORDER BY id DESC LIMIT 1";
            $msql->execute($sql, 'comment2');
            $res_comment = $msql->fetchquery('comment2');
            $res_comment['dt'] = date('Y-m-d', $res_comment['dt']);

            $res_music['comment'] = $res_comment;
            $tempArr[] = $res_music;
        } else {
            $sql = "SELECT moviename,price,coverurl FROM xyj_movie WHERE id=$pid";

            $msql->execute($sql, 'movie');
            $res_movie = $msql->fetchquery('movie');

            // 产品名称
            $res_movie['pname'] = $res_movie['moviename'];

            // 分类
            $res_movie['classify'] = $class;

            // 产品id
            $res_movie['pid'] = $pid;

            // 上架日期
            $res_movie['dt'] = date('Y-m-d', $re['dt']);
            // 评论
            $sql = "SELECT stars,notes,dt FROM xyj_comment WHERE classify='movie' AND pid=$pid AND openid='" . $openid . "' ORDER BY id DESC LIMIT 1";
            $msql->execute($sql, 'comment3');
            $msql->error();
            $res_comment = $msql->fetchquery('comment3');
            $res_comment['dt'] = date('Y-m-d', $res_comment['dt']);

            $res_movie['comment'] = $res_comment;
            $tempArr[] = $res_movie;
        }
    }
}

echo json_encode($tempArr);
