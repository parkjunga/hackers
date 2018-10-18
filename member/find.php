<?php
session_start();
$_SESSION['code']='123456';
$code =$_SESSION['code'];
include 'db.php';
$phone = $_POST['phone'];
$name = $_POST['name'];
$id = $_POST['id'];
$email = $_POST['email'];
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