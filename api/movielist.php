<?php
 // 引入公用文件
require_once('../include/common.in.php');

$style_cname = trim($style_cname);
$country_cname = trim($country_cname);

$arrTemp = $arrTempClassify = $arrTempCountry = array();
$where = '';
if ($style_cname != 'all_style' && $country_cname != 'all_country') {
    $where = "AND class_style='" . $style_cname . "' AND class_country='" . $country_cname . "'";
} elseif ($style_cname == 'all_style' && $country_cname != 'all_country') {
    $where = " AND class_country='" . $country_cname . "'";
} elseif ($style_cname != 'all_style' && $country_cname == 'all_country') {
    $where = "AND class_style='" . $style_cname . "'";
} else { }

$sql = "SELECT id,class_style,class_country,moviename,director,roles,writer,price,coverurl,movieurl,longs,descript FROM xyj_movie WHERE 1 $where ORDER BY id DESC LIMIT 0,20";

$msql->execute($sql);
$msql->error();
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


    $arrTemp[] = $res;
}

$sql = "SELECT cid,cname FROM xyj_class_child WHERE cid=$class_parent_movie OR cid=$class_parent_country";

$msql->execute($sql);

while ($res = $msql->fetchquery()) {
    if ($res['cid'] == $class_parent_movie) {

        if ($res['cname'] == $style_cname) {
            $res['cls'] = 'active-class';
        } else {
            $res['cls'] = '';
        }
        $arrTempClassify[] = $res;
    } else {
        if ($res['cname'] == $country_cname) {
            $res['cls'] = 'active-country';
        } else {
            $res['cls'] = '';
        }
        $arrTempCountry[] = $res;
    }
}

$arr['style'] = $arrTempClassify;
$arr['country'] = $arrTempCountry;
$arr['datas'] = $arrTemp;

echo json_encode($arr);
