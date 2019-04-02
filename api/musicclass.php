<?php
 // 引入公用文件
require_once('../include/common.in.php');

$arrTemp = array();

$sql = "SELECT id,cname FROM xyj_class_child WHERE cid=$class_parent_music ";

$msql->execute($sql);

while ($res = $msql->fetchquery()) {


    $arrTemp[] = $res;
}


echo json_encode($arrTemp);
