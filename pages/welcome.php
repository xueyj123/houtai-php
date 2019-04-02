<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

// 给模板提供数据
$content='Welcome';



// 载入模板
include 'pages/templates/welcome.html';

 