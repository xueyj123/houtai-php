<?php
class Mysqlclass{

    //初始化类成员
    var $dbhost;
    var $dbuser;
    var $dbpwd;
    var $dbdatabase;
    var $res;
    var $conn;
    var $result;

    //创建构造函数
    function __construct($dbhost,$dbuser,$dbpwd,$dbdatabase){
        $this->host = $dbhost;
        $this->user = $dbuser;
        $this->pwd = $dbpwd;
        $this->database = $dbdatabase;

        //执行数据库连接
        $this->init();
    }

    //初始化数据库连接
    function init(){
        $this->conn = mysqli_connect($this->host,$this->user,$this->pwd,$this->database);
        mysqli_query($this->conn,"set NAMES utf8");
    }

    // 检查数据库是否连接成功
    function isConnect(){
        if ($this->conn) {
            return '数据库连接成功';
        }else{
            return '数据库连接失败';
        }
    }


    //执行语句
    function execute($sql='',$tag="i"){
        $this->result[$tag] = mysqli_query($this->conn,$sql);
    }

    //获取并返回插入的ID
    function insertid(){
        return mysqli_insert_id($this->conn);
    }

    //获取并返回受影响的行数
    function affectedRows(){
        return mysqli_affected_rows($this->conn);
    }

    //抓取SELECT的数据
    function fetchquery($tag="i"){
        return mysqli_fetch_array($this->result[$tag],MYSQL_ASSOC);
    }

    //返回json格式数据
    function fetchjson(){

        $affectNums = $this->affectedRows();
        
        if ($affectNums > 0){
            while ($res = mysqli_fetch_array($this->result)){
                $result[] = $res;
            }

            return json_encode($result);
            
        } else {
            return 'Fetch Error!';
        }

    }

    //获取总记录数
    function getTotal($sql=''){
        if ($sql){
            $this->execute($sql);
            $resx = $this->fetchquery();
            return $resx['total'];
        } else {
            return 'error';
        }
    }

    //查看数据库执行错误信息
    function error(){
        echo mysqli_error($this->conn);
    }

    //分页
    function pagination($url,$page=1,$keywords='',$pageRecords,$totalRecords){

        //总页码数
        $pageNums = ceil($totalRecords/$pageRecords);

        //当前页码
        $curpage = $page;

        //首页
        $firstpage = '<a href="'.$url.'&page=1'.$keywords.'">首页</a>';

        //上一页
        if ($curpage == 1){
            $prepage = 1;
        } else {
            $prepage = $curpage-1;
        }
        $prepageHtml = '<a href="'.$url.'&page='.$prepage.$keywords.'">上一页</a>';
        
        //下一页
        if($curpage == $pageNums){
            $nextpage = $pageNums;
        } else {
            $nextpage = $curpage+1;
        }
        $nextpageHtml = '<a href="'.$url.'&page='.$nextpage.$keywords.'">下一页</a>';

        //末页
        $lastpage = '<a href="'.$url.'&page='.$pageNums.$keywords.'">末页</a>';

        //输出页码
        
        //显示页码个数
        $showPageNums = 5;

        //如果总页数小于等于显示页码个数
        if ($pageNums <= $showPageNums){

            for($i=1;$i<$pageNums+1;$i++){

                if ($i == $page){
                    $currentstyle = 'style="color:red;"';
                } else {
                    $currentstyle = '';
                }

                $p .= '<a href="'.$url.'&page='.$i.$keywords.'" '.$currentstyle.'> '.$i.' </a>';
            }

        } else {

            $startPage_ = $curpage >=3 ? $curpage-2 : 1;

            if ($pageNums < $curpage+2){
                $end = $pageNums+1;
            } else {
                $end = $curpage+3;
            }

            $endPage_ = $curpage <=3 ? $showPageNums+1 : $end; 

            for($i=$startPage_;$i<$endPage_;$i++){

                if ($i == $page){
                    $currentstyle = 'style="color:red;"';
                } else {
                    $currentstyle = '';
                }

                $p .= '<a href="'.$url.'&page='.$i.$keywords.'" '.$currentstyle.'> '.$i.' </a>';
            }

        }

        return $firstpage.$prepageHtml.$p.$nextpageHtml.$lastpage;
    }


    //分页 优化超链接href与参数分离
    function pagination2($url,$page=1,$keywords,$pageRecords,$totalRecords){

        //总页码数
        $pageNums = ceil($totalRecords/$pageRecords);

        //当前页码
        $curpage = $page;

        //首页
        $firstpage = '<a href="'.$url.'" data-page="1" data-param="1&page=1'.$keywords.'">首页</a>';

        //上一页
        if ($curpage == 1){
            $prepage = 1;
        } else {
            $prepage = $curpage-1;
        }
        $prepageHtml = '<a href="'.$url.'" data-page="'.$prepage.'" data-param="1&page='.$prepage.$keywords.'">上一页</a>';
        
        //下一页
        if($curpage == $pageNums){
            $nextpage = $pageNums;
        } else {
            $nextpage = $curpage+1;
        }
        $nextpageHtml = '<a href="'.$url.'" data-page="'.$nextpage.'" data-param="1&page='.$nextpage.$keywords.'">下一页</a>';

        //末页
        $lastpage = '<a href="'.$url.'" data-page="'.$pageNums.'" data-param="1&page='.$pageNums.$keywords.'">末页</a>';

        //输出页码
        
        //显示页码个数
        $showPageNums = 5;

        //如果总页数小于等于显示页码个数
        if ($pageNums <= $showPageNums){

            for($i=1;$i<$pageNums+1;$i++){
                if ($i == $page){
                    $currentstyle = 'style="color:red;"';
                } else {
                    $currentstyle = '';
                }

                $p .= '<a href="'.$url.'" '.$currentstyle.' data-page="'.$i.'" data-param="1&page='.$i.$keywords.'"> '.$i.' </a>';
            }

        } else {

            $startPage_ = $curpage >=3 ? $curpage-2 : 1;

            if ($pageNums < $curpage+2){
                $end = $pageNums+1;
            } else {
                $end = $curpage+3;
            }

            $endPage_ = $curpage <=3 ? $showPageNums+1 : $end; 

            for($i=$startPage_;$i<$endPage_;$i++){
                if ($i == $page){
                    $currentstyle = 'style="color:red;"';
                } else {
                    $currentstyle = '';
                }

                $p .= '<a href="'.$url.'" data-page="'.$i.'" data-param="1&page='.$i.$keywords.'" '.$currentstyle.'> '.$i.' </a>';
            }

        }

        return $firstpage.$prepageHtml.$p.$nextpageHtml.$lastpage;
    }

     //异步分页，仅数字页码
    function pagination_asyn($url,$page=1,$keywords='',$pageRecords,$totalRecords){

        //总页码数
        $pageNums = ceil($totalRecords/$pageRecords);

        //当前页码
        $curpage = $page;

         //上一页
        if ($curpage == 1){
            $prepage = 1;
        } else {
            $prepage = $curpage-1;
        }
        $prepageHtml = '<a href="javascript:void(0)" data-id="'.$prepage.'" data-keywords="'.$keywords.'"> << </a>';
        
        //下一页
        if($curpage == $pageNums){
            $nextpage = $pageNums;
        } else {
            $nextpage = $curpage+1;
        }
        $nextpageHtml = '<a href="javascript:void(0)" data-id="'.$nextpage.'"  data-keywords="'.$keywords.'"> >> </a>';

        //如果总页数小于等于显示页码个数
        for($i=1;$i<$pageNums+1;$i++){
            if ($i == $page){
                $currentstyle = 'style="color:red; text-decoration:none; padding:0 5px;" class="cur-page"';
            } else {
                $currentstyle = 'style="text-decoration:none; padding:0 5px;"';
            }

            $p .= '<a href="javascript:void(0)" '.$currentstyle.' data-id="'.$i.'"  data-keywords="'.$keywords.'"> '.$i.' </a>';
        }


        return $prepageHtml.$p.$nextpageHtml;
    }

}

//实例化一个对象
$msql = $mmsql = new Mysqlclass($dbhost,$dbuser,$dbpwd,$dbname);

?>