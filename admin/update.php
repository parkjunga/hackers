<?php

include '../member/db.php';
// 강의테이블에 넣을자료 정보; 
$type = $_POST['type'];
$title = $_POST['title'];
$teacher = $_POST['teacher'];
$time = $_POST['time'];
$level = $_POST['level'];
$oriFNo = $_POST['oriFNo'];
$ori = $_POST['oriFile'];
$file = $_FILES['file'];
$no = $_POST['no'];
$id = $_POST['id'];
echo $no;
echo '<br/>';
echo $oriFNo;
echo '<br/>';
echo $type;
echo '<br/>';
echo $teacher;
echo '<br/>';
echo $title;
echo '<br/>';
echo $id;
echo '<br/>';

// 파일 관련 정보
$f_name =$_FILES['file']['name']; // 원본파일명 
$f_Type =$_FILES['file']['type'];   // MIME Type
$f_Size =$_FILES['file']['size']; // 파일크기
$f_Temp =$_FILES['file']['tmp_name']; //임시디렉터리에 저장된 파일명
$f_Error=$fType =$_FILES['file']['error']; 
$upload ='../upload/file/';

echo $f_name;
echo '<br/>';
echo $f_Type;
echo '<br/>';
echo $f_Size;
echo '<br/>';
echo $f_Temp;
echo '<br/>';
//echo $f_Type;
$splitN=explode(".",$f_name);
$splitN[0]; // 파일명
$splitN[1]; // 확장자
echo $splitN[1];
// 파일 업로드 확장자 제한 걸기
if($splitN[1] == 'txt' || $splitN[1] == 'c' ||$splitN[1] == 'php' || $splitN[1] == 'html' ){
    echo '확인fff';
}
// 뉴파일명 지정 
$f_time = time();
$f_new_name = $f_time.".".$splitN[1];
$f_ori_name =addslashes($f_name);

// 파일 경로 지정 
$url = $upload . $f_new_name;


if($f_name == ''){
    echo '값이변하지않아서';
    $f_sql = "UPDATE tb_file SET name='$teacher'
     where file_no = '$oriFNo'";
    
    $f_result = mysql_query($f_sql);
   
    $sql = "UPDATE tb_lecture 
               SET category_no = '$type'
                ,lecture_title = '$title' 
                        ,NAME = '$teacher'
                        ,TIME = '$time'
               ,lecture_level = '$level'
                     ,file_no = '$oriFNo' 
              WHERE lecture_no = '$no'";
   
   $result = mysql_query($sql);
     
    if(!$result){
        die("강의등록실패");
    }else{
        echo "강의등록성공";
        echo("<script>location.href='/admin/index.php?mode=list';</script>");
    }   




} else{
    echo '있어 파일';
    $f_sql = "UPDATE tb_file 
                SET file_name = '$f_new_name'
                ,file_ori_name = '$f_ori_name' 
                ,file_type = '$splitN[1]' 
                ,file_path = '$url' 
                ,reg_date = NOW()
                ,id='$id'
     where file_no = '$oriFNo'";
    
    $f_result = mysql_query($f_sql);

    if(!$f_result){
        die("죽었");
    }else{
        echo "파일수정까지성공";

    } 

    $sql = "UPDATE tb_lecture 
               SET category_no = '$type'
                  ,lecture_title = '$title' 
                  ,teacher = '$teacher'
                  ,TIME = '$time'
                  ,lecture_level = '$level'
                  ,file_no = '$oriFNo' 
                  WHERE lecture_no = '$no'";
    echo $sql;
    $result = mysql_query($sql);
     
    if(!$result){
        die("강의등록실패");
    }else{
        echo "강의등록성공";
        echo("<script>location.href='/admin/index.php?mode=list';</script>");
    } 
    if(!move_uploaded_file($f_Temp,$url)){
        die("실패");
    }
} 


 

?>