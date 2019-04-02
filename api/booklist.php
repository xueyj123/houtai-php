<?php


// 引入公用文件
require_once('../include/common.in.php');

// 接收tap参数
$tap = $tap;
$searchKeywords = trim($searchKeywords);
$comlumn = trim($comlumn);
// 初始化
$ccid = '';
$tempArr = array();
$arrBookName = array();
$arrNew = array();
$arrTempClassify = array();

// 根据不同的tap，查询不同的数据
// 把tap转换成二级分类id
switch ($tap) {
    case 'science':
        $ccid = 62;
        break;
    case 'child':
        $ccid = 61;
        break;
    case 'younth':
        $ccid = 59;
        break;
    case 'people':
        $ccid = 60;
        break;
    case 'health':
        $ccid = 58;
        break;
    case 'new':
        $ccid = 65;
        break;
    case 'hot':
        $ccid = 63;
        break;
    case 'shipping':
        $ccid = 64;
        break;
}
$id = $id ? $id : $ccid;

// 根据ccid（二级分类id）查询该分类下的数据
// 查询语句

if ($searchKeywords && $comlumn) {

    $sql = "SELECT b.id,bookname,author,publicer,price,dt,descript,coverurl FROM xyj_book as b LEFT JOIN xyj_cover as c ON (b.id=c.bookid) WHERE $comlumn LIKE '%" . $searchKeywords . "%' ORDER BY b.id DESC LIMIT 0,20 ";
} elseif ($tap == 'shipping') {
    $sql = "SELECT b.id,bookname,author,publicer,price,dt,descript,coverurl FROM xyj_book as b LEFT JOIN xyj_cover as c ON (b.id=c.bookid) WHERE fp=1 ORDER BY b.id DESC LIMIT 0,20 ";
}else if ($id=='all') {
    $sql = "SELECT b.id,bookname,author,publicer,price,dt,descript,coverurl FROM xyj_book as b LEFT JOIN xyj_cover as c ON (b.id=c.bookid) ORDER BY b.id DESC LIMIT 0,20 ";
}elseif ($tap == 'bookmoretop') {
    $sql = "SELECT m.id,SUM(counts) as total,bookname,author,publicer,price,o.dt,descript,coverurl FROM xyj_order as o LEFT JOIN xyj_book as m ON (o.pid=m.id)  LEFT JOIN xyj_cover as c ON (c.bookid=m.id) WHERE classify='book' GROUP BY o.pid ORDER BY total DESC LIMIT 0,20 ";
}
 else {
    $sql = "SELECT b.id,bookname,author,publicer,price,dt,descript,coverurl FROM xyj_book as b LEFT JOIN xyj_cover as c ON (b.id=c.bookid) WHERE ccid=$id ORDER BY b.id DESC LIMIT 0,20 ";
}
// 执行语句
$msql->execute($sql);
$msql->error();
// 获取数据
while ($res = $msql->fetchquery()) {
    // 处理简介
    // 去掉html标签
    $res['descript'] = strip_tags($res['descript']);
    // 截取长度
    $res['descript'] = mb_substr($res['descript'], 0, 40, 'utf8');

    // 处理价格
    $price = explode('.', $res['price']);
    $res['price_int'] = $price[0]; //整数
    $res['price_dec'] = $price[1]; //小数

    // 处理星星数
    $res['stars'] = 5;

    // 评论数
    $res['comment_count'] = 0;

    // 处理日期
    $res['date'] = date('Y-m-d', $res['dt']);

    $tempArr[] = $res;
}

// 数组去重
if (count($tempArr) > 0) {

    foreach ($tempArr as $key => $value) {
        // 获取名称
        $bookname = $value['bookname'];

        // 把图书名存入数据
        if (!in_array($bookname, $arrBookName)) {
            $arrBookName[] = $bookname;
            $arrNew[] = $value;
        }
    }
}

$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$class_parent_book";

$msql->execute($sql);

while ($res = $msql->fetchquery()) {

    if ($res['id'] == $id) {
        $res['cls'] = 'active';
    } else {
        $res['cls'] = '';
    }
    $arrTempClassify[] = $res;
}


$arr['style'] = $arrTempClassify;
$arr['datas'] = $arrNew;


// 把数据转换成json格式，并返回给小程序
echo json_encode($arr);
