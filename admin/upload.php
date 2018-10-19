<?php

include '../member/db.php';
// 강의테이블에 넣을자료 정보; 
$type = $_POST['type'];
$title = $_POST['title'];
$teacher = $_POST['teacher'];
$time = $_POST['time'];
$level = $_POST['level'];

echo $teacher;

// 파일 관련 정보
$f_name =$_FILES['file']['name']; // 원본파일명 
$f_Type =$_FILES['file']['type'];   // MIME Type
$f_Size =$_FILES['file']['size']; // 파일크기
$f_Temp =$_FILES['file']['tmp_name']; //임시디렉터리에 저장된 파일명
$f_Error=$fType =$_FILES['file']['error']; 
$upload ='../upload/file/';
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

if(!move_uploaded_file($f_Temp,$url)){
    die("실패");
}


$f_sql = "INSERT INTO tb_file
    (file_name,file_ori_name,file_type,file_path,reg_date,name)VALUES(
    '$f_new_name','$f_ori_name','$splitN[1]','$url','NOW()','$teacher')";

$f_result = mysql_query($f_sql);
echo $f_result;
if(!$f_result){
    die("죽었");
}else{
    echo "성공";}
$s_Key = mysql_insert_id();
echo $s_key;

$sql = "INSERT INTO tb_lecture(
    category_no,lecture_title,TIME,lecture_level,file_no,name
    )VALUES('$type','$title','$time','$level','$s_Key','$teacher')";
$result = mysql_query($sql);

if(!$result){
    die("강의등록실패");
}else{
    echo "강의등록성공";
} 
?>