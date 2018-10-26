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
$s= preg_match_all("/<img[^>]*src=[']?([^>']+)[']?[^>]*>/", $ir1, $imgs1);
    //$a = var_dump($imgs1[1]);
    //preg_match( '@'.$tag.'="([^"]+)"@' , $a, $match );
    for($i=0; $i<$s; $i++){
    $img = $imgs1[1][$i];
    //echo $img;
    echo '<br/>';
    // 전체 이미지 쌍따옴표 제거
   // $test = str_replace( "\"","", $img);
     
    $result = strstr($img,'title');
    $s1 = explode("=",$result);
    // 쌍따옴표제거, 이미지 
    $c = str_replace( "\"","", $s1);
    echo '<br/>';

    // 시스템에 저장될 이미지 
    $sysimg = $c[1];
    echo $sysimg;    
    // 원본이미지 
    echo '<br/>';
    $ori = explode("_",$sysimg);
    $oriImg =  $ori[1];
    $ext = explode('.',$ori[1]);
    $exts = $ext[1];
    echo '<br/>';
    echo "키값: ". $key;
     // 파일 sql 
    $f_sql = "INSERT INTO tb_review_file(file_name,file_type,file_path,board_no,ori_name,file_size)VALUES('$sysimg','$exts','$img',$key,'$oriImg',1234)";
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