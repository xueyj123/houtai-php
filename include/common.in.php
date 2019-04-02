<?php

// 开启session
session_start();


// 限制报错
// error_reporting(E_ALL || ~E_NOTICE);

// 定义根目录(常量)
define('WWWROOT', substr(__DIR__, 0, -8));

// 优化数据接收方式
function _RunMagicQuotes(&$svar)
{
    if (!get_magic_quotes_gpc()) {
        if (is_array($svar)) {
            foreach ($svar as $_k => $_v) $svar[$_k] = _RunMagicQuotes($_v);
        } else {
            if (strlen($svar) > 0 && preg_match('#^(cfg_|GLOBALS|_GET|_POST|_COOKIE)#', $svar)) {
                exit('Request var not allow!');
            }
            $svar = addslashes($svar);
        }
    }
    return $svar;
}

//检查和注册外部提交的变量
function CheckRequest(&$val)
{

    if (is_array($val)) {

        foreach ($val as $_k => $_v) {
            if ($_k == 'nvarname') continue;
            CheckRequest($_k);
            CheckRequest($val[$_k]);
        }
    } else {
        if (strlen($val) > 0 && preg_match('/^(cfg_|GLOBALS|_GET|_POST|_COOKIE)/', $val)) {
            exit('Request var not allow!');
        }
    }
}

//var_dump($_REQUEST);exit;
CheckRequest($_REQUEST); //$_POST,$_GET
CheckRequest($_COOKIE);

foreach (array('_GET', '_POST', '_COOKIE') as $_request) {
    foreach ($$_request as $_k => $_v) {
        if ($_k == 'nvarname') ${$_k} = $_v;
        else ${$_k} = _RunMagicQuotes($_v);
    }
}


// 数据库配置数据
$dbhost = 'localhost';
$dbuser = 'nanxi1111';
$dbpwd = 'web_shangyuan_test20445@!';
$dbname = 'nanxi1111';

// $dbhost = 'localhost';
// $dbuser = 'root';
// $dbpwd = 'root';
// $dbname = 'yuzhoutushu';

// 引入数据库的操作类
require_once('mysqli.class.php');


// 一级分类
$class_parent_book = 7;
$class_parent_music = 13;
$class_parent_movie = 12;
$class_parent_country = 14;
