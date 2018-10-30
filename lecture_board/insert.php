<?php
$type = $_POST['type'];
$type2 = $_POST['type2'];
$title = $_POST['title'];
$satisfy = $_POST['score'];
$ir1 = $_POST['ir1'];

$id = $_SESSION['id'];
$src = 'src';

// 게시글 sql 
$sql = "INSERT INTO tb_review(user_id,title,contents,category_no,reg_date,satisfy,lecture_no)VALUES('$id','$title','$ir1','$type',NOW(),'$satisfy','$type2')";
//echo $sql;
$rst = mysql_query($sql);
echo $rst;
echo '테스트';
$key = mysql_insert_id();
echo '<br/>';
echo $key;
echo '<br/>';
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
    $f_sql = "INSERT INTO tb_review_file(sys_name,file_type,file_path,board_no,ori_name,file_size)VALUES('$sysimg','$exts','$path','$key','$oriImg','$imgSize')";
    echo $f_sql;
    echo '<br/>';
    $f_key = mysql_insert_id();
    echo "그룹키값:" .$f_key;
    $f_group_sql = "INSERT INTO tb_review_file_group(file_no,board_no)VALUES('$f_key','$key')";
     
    $f_result = mysql_query($f_sql);  
    $f_group_result = mysql_query($f_group_sql);
     if(!$f_result){
         mysql_error();
     }
    };
     
    echo("<script>location.href='/lecture_board/index.php?mode=list';</script>");
};


?>