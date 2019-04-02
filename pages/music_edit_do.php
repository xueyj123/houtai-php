<?php

// 访问限制
if (!defined('WWWROOT')) {
    die('Request var not allow!');
}

$result = $result_music = $result_poster = $destPosterUrl = $tempDestArr = '';
// 获取id
$id = intval($id);

// 接收表单数据
// 二级分类id
$cclass = intval($cclass);
// 歌曲名称
$musicname = trim($musicname);
// 歌手
$singer = trim($singer);
// 作曲
$composer = trim($composer);
// 填词
$writer = trim($writer);

// 价格
$price = $price;
// 封面
$poster = $_FILES['poster'];
// 音乐
$music = $_FILES['music'];
// 歌词
$descript = trim($descript);
// 上架日期
$dt = strtotime($dt);

// 上传文件
// 上传封面
if ($poster['error'] < 1) {
    $destPosterUrl = uploadFile($poster);
}
if ($music['error'] < 1) {
    $tempDestArr = uploadFile($music, 'upload/music/');
}




if (!$musicname || !$singer || !$composer || !$writer) {
    $result = '请确认是否规范填写';
} else {

    // 2.封面入库
    if ($destPosterUrl != '上传失败') { //意味着上传了新的封面

        $sql = "UPDATE xyj_music SET cid=$class_parent_music,ccid=$cclass,musicname='" . $musicname . "',singer='" . $singer . "',composer='" . $composer . "',writer='" . $writer . "',price=$price,words='" . $descript . "',dt=$dt,musicurl='" . $destPosterUrl . "'WHERE id=$id";

    } else if ($tempDestArr != '上传失败') { //意味着上传了新的音乐

        $sql = "UPDATE xyj_music SET cid=$class_parent_music,ccid=$cclass,musicname='" . $musicname . "',singer='" . $singer . "',composer='" . $composer . "',writer='" . $writer . "',price=$price,words='" . $descript . "',dt=$dt,coverurl='" . $tempDestArr . "' WHERE id=$id";

    } else {
        $sql = "UPDATE xyj_music SET cid=$class_parent_music,ccid=$cclass,musicname='" . $musicname . "',singer='" . $singer . "',composer='" . $composer . "',writer='" . $writer . "',price=$price,words='" . $descript . "',dt=$dt WHERE id=$id";
        $msql->execute($sql);
        // 返回结果
        $res = $msql->affectedRows();

        if ($res > 0) {
            $result = '音乐入库成功';
            jump('main.php?go=musiclist', 0);
        } else {
            echo '音乐入库失败';
        }
    }
}





// 载入模板
// include 'pages/templates/music_edit.html';
