<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}


// 接收数据
// 1.一级分类id
$class_pid = intval($pclass);

// 2.二级分类id
$class_cid = intval($cclass);

// 3.书名
$bookname = trim($bookname);

//  4 .作者
$author = trim($author);

// 5.出版社\
$publicer = trim($publicer);
// 6.价格
$price = trim($price);

// 7.封面
$poster = $_FILES['poster'];

// 8.图书介绍
$descript = trim(stripcslashes($descript));

// 9.上架日期
$dt = strtotime($dt);


// 10.是否包邮
$fp = $freeposter;


// 初始化遍历
$result_upload = $result_book = $result_poster = '';

// 数据验证

if (!$class_pid || !is_numeric($class_pid) || !$class_cid || !is_numeric($class_cid)) {
    die('分类有误！');
}

if (strlen($bookname) < 2 || !$author || !$publicer || !$price) {
    die('填写不规范');
}


// 处理封面上传
// 临时文件
if (count($poster) > 0) {
    // 上传上来的文件名
    $arrFn = $poster['name'];

    // 临时文件
    $arrTemp = $poster['tmp_name'];

    // 定义临时数组
    $tempDestArr = array();

    // 遍历临时文件
    foreach ($arrTemp as $key => $value) {
        // 临时文件名
        $tempFile = $value;

        // 新文件名
        $newFileName = time() . mt_rand(1, 100);

        // 旧的文件名
        $oldName = $arrFn[$key];
        // 扩展名
        $pathInfo = pathinfo($oldName);
        $extension = $pathInfo['extension'];

        // 服务器文件路径
        $destFile = 'upload/' . $newFileName . '.' . $extension;



        // 执行上传
        if (move_uploaded_file($tempFile, $destFile)) {
            $tempDestArr[] = $destFile;
            $result_upload = '封面上传成功<br>';
        } else {
            $result_upload = '封面上传失败<br>';
        };
    }
}

// 入库操作
// 1.图书入库
$sql = "INSERT INTO xyj_book (cid,ccid,bookname,author,publicer,price,descript,dt,fp) VALUES ($class_pid,$class_cid,'" . $bookname . "','" . $author . "','" . $publicer . "','" . $price . "','" . $descript . "',$dt,$fp)";

$msql->execute($sql);

// 返回结果
$res = $msql->affectedRows();
if ($res > 0) {
    $result_book = '图书入库成功<br>';
} else {
    $result_book = '图书入库失败<br>';
}

// 获取最近一次入库的数据id
$id = $msql->insertid();

// 2.封面入库
foreach ($tempDestArr as  $value) {
    $sql = "INSERT INTO xyj_cover (bookid,coverurl) VALUES ($id,'" . $value . "')";
    $msql->execute($sql);
}
// 返回结果
$res = $msql->affectedRows();
if ($res > 0) {
    $result_poster = '封面入库成功';
} else {
    $result_poster = '封面入库失败';
}


// 载入模板
include 'pages/templates/book_add_do.html';
