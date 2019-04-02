<?php

header("Content-type:text/html;charset=utf8");

// 引入公用配置文件
require_once('include/common.in.php');

// 引入公用函数文件
require_once('include/common.fn.php');

// 检查权限
checkAuthor();


// 加载不同业务模块（图书的增、删、改、查）的代码
// 子页面不可以访问，只能通过入口文件（main.php）来执行

// 默认页面
$go = $go ? $go : 'welcome';

// 接收哪个子页面请求
$allowPages[] = 'welcome';

$allowPages[] = 'booklist';
$allowPages[] = 'bookadd';
$allowPages[] = 'book_add_do';
$allowPages[] = 'book_view';
$allowPages[] = 'book_edit';
$allowPages[] = 'book_edit_do';
$allowPages[] = 'book_del';
$allowPages[] = 'ajax_class_select';

$allowPages[] = 'musiclist';
$allowPages[] = 'musicadd';
$allowPages[] = 'music_add_do';
$allowPages[] = 'music_view';
$allowPages[] = 'music_edit';
$allowPages[] = 'music_edit_do';
$allowPages[] = 'music_del';
$allowPages[] = 'music_del_do';

$allowPages[] = 'movielist';
$allowPages[] = 'movieadd';
$allowPages[] = 'movie_add_do';
$allowPages[] = 'movie_view';
$allowPages[] = 'movie_edit';
$allowPages[] = 'movie_edit_do';
$allowPages[] = 'movie_del';
$allowPages[] = 'movie_del_do';

$allowPages[] = 'classparent';
$allowPages[] = 'classparentadd';
$allowPages[] = 'classparentadddo';
$allowPages[] = 'classparentedit';
$allowPages[] = 'classparenteditdo';
$allowPages[] = 'classparentdel';

$allowPages[] = 'classchild';
$allowPages[] = 'classchild_add';
$allowPages[] = 'classchild_add_do';
$allowPages[] = 'classchild_edit';
$allowPages[] = 'classchild_edit_do';
$allowPages[] = 'classchild_del';

$allowPages[] = 'exit';
$allowPages[] = 'swiper';
$allowPages[] = 'swiperadd';
$allowPages[] = 'swiper_add_do';
$allowPages[] = 'swiper_del';


if (!in_array($go, $allowPages)) {
    die('Request Fail!');
}

// 根据$go加载不同的子页面
require_once('pages/' . $go . '.php');
