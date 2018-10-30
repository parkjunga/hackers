<?php
$no = $_POST['review_no'];
$type = $_POST['type'];
$type2 = $_POST['type2'];
$title = $_POST['title'];
$satisfy = $_POST['score'];
$ir1 = $_POST['ir1'];
$id = $_SESSION['id'];
$src = 'src';
echo $no;
echo '<br/>';
// 게시글 sql 
$sql = "UPDATE tb_review
           set title = '$title'
             ,contents = '$ir1'
             ,category_no = '$type'
             ,reg_date = NOW()
            ,satisfy = '$satisfy'
            ,lecture_no = '$type2'
        where board_no = '$no'";
echo $sql;
$rst = mysql_query($sql);
echo $rst;

if(strpos($ir1,$src) != false){
    echo '포함됨';
    
//$pattern = '`<img src="/upload/tmp/(?<tmp>[^"]+)" title="(?<fname>[^"]+)`'; 
$s= preg_match_all("/<img src=[']?([^>']+)[']?[^>]* title=[']?([^>']+)[']?[^>]*>/", $ir1, $imgs1);
    $a = var_dump($imgs1[1]);
    echo '<br/>';
    //echo $a;

    //preg_match( '@'.$tag.'="([^"]+)"@' , $a, $match );
    for($i=0; $i<$s; $i++){
    $img = $imgs1[1][$i];
    echo '<br/>';
    //echo $img;

    // 경로
    $path = str_replace( "\"","", $img);
    echo '<br/>';
    echo $path;
    echo '<br/>';
    $sys = explode("/",$path);
    // 시스템에 저장될때 들어오는 이미지;
    $sysimg =  $sys[3];
    echo $sysimg;
    $s1 = explode("=",$result);
    // 원본이미지 
    echo '<br/>';
    $ori = explode("__",$path);
    $oriImg =  $ori[1];
    echo '<br />';
    echo $oriImg;
    $ext = explode('.',$oriImg);
    $exts = $ext[1];
    echo '<br/>';
    echo $exts;
    echo '<br/>';
    echo "키값: ". $key;
    echo $_SERVER['DOCUMENT_ROOT'];
    echo '<br/>';
    $file_url = $_SERVER['DOCUMENT_ROOT'].$path;
    echo $file_url;    
   echo '<br/>';
    $imgSize = filesize($file_url)/1024;
    echo $imgSize;
    echo '<br/>';
    echo round($imgSize, 1);
    $imgSize = ceil($imgSize);
    echo '<br/>';
    echo $imgSize;
    
    
    




     // 파일 sql 
    $f_sql = "UPDATE tb_review_file
                set sys_name = '$sysimg'
                   ,file_type = '$exts'
                   ,file_path = '$path'
                   ,board_no = '$key'
                   ,ori_name = '$oriImg'
                   ,file_size = $imgSize' ";
    echo $f_sql;
    echo '<br/>';
    $f_group_sql = "UPDATE tb_review_file_group
                       set file_no = '$f_key'
                         ,board_no = '$key'";
     
    $f_result = mysql_query($f_sql);  
    $f_group_result = mysql_query($f_group_sql);
     if(!$f_result){
         mysql_error();
     }
    };
     
    echo("<script>location.href='/lecture_board/index.php?mode=list';</script>");
};



?>