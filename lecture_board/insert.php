<?php
$type = $_POST['type'];
$type2 = $_POST['type2'];
$title = $_POST['title'];
$satisfy = $_POST['score'];
$ir1 = $_POST['ir1'];

$id = $_SESSION['id'];
$src = 'src';

// 게시글 sql 
$sql = "INSERT INTO tb_review(id,title,contents,category_no,reg_date,satisfy,lecture_no)VALUES('$id','$title','$ir1','$type',NOW(),'$satisfy','$type2')";
echo $sql;
$rst = mysql_query($sql);
$key = mysql_insert_id();
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
    $imgSize = floor($imgSize);
    





     // 파일 sql 
    $f_sql = "INSERT INTO tb_review_file(file_name,file_type,file_path,board_no,ori_name,file_size)VALUES('$sysimg','$exts','$path',$key,'$oriImg',$imgSize)";
    $f_key = mysql_insert_id();
    echo "그룹키값:" .$f_key;
    $f_group_sql = "INSERT INTO tb_review_file_group(file_no)VALUES('$f_key')";
     
    $f_result = mysql_query($f_sql);  
    $f_group_result = mysql_query($f_group_sql);
     if(!$f_result){
         mysql_error();
     }
    };
     
 
};


/*
먼저 
1. 이미지 파일 여부를 확인 
2. 파일이있다면 파일의 갯수확인 
3. 파일을 먼저 insert 후 
4. 파일의 번호를 찾아 게시글에 넣어준다.
*/


?>