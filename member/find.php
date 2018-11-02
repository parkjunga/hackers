<?php
session_start();
$_SESSION['code']='123456';
$code =$_SESSION['code'];
include '../include/db.php';
$name = $_POST['name'];
$id = $_POST['id'];
$email = $_POST['email1'].'@'.$_POST['email2'];
$phone = $_POST['phone'][0].$_POST['phone'][1].$_POST['phone'][2];

if($name == ''){
    echo '입력후 시도해주세요';
    exit;
}
if($email == ''){
    echo '입력후 시도해주세요';
    exit;
}
if($phone == ''){
    echo '입력후 시도해주세요';
    exit;
}


$sql = "select * 
        from tb_user 
        where name='$name'
        and (phone='$phone'
         or email ='$email')"; 


$result = mysql_query($sql);
$count = mysql_num_rows($result);

if($count > 0 ){
    echo $code;   
}else{
    echo "일치하는 정보가 존재하지않습니다"; 
} 

?>