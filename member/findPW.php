<?php
session_start();
$_SESSION['code']='123456';
$code =$_SESSION['code'];
include 'db.php';
$phone = $_POST['phone'];
$id=$_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$pw = $_POST['pw'];
switch($name && $id){
    case $pw :
    echo $pw;
    echo $id;
    echo $name;
    break;
    case $email:
    $sql = "select * from tb_user where name='$name' and id='$id' and phone='$phone'
     or email ='$email'"; 
    $result = mysql_query($sql);
    $count = mysql_num_rows($result);
    if($count != 0 ){
       echo $code;   
    }else{
       echo "일치하는 정보가 존재하지않습니다"; 
    }
    break;
};

/* 
if($pw && $id && $name){
    echo $pw;
    echo $id;
    echo $name;
    exit();
}
if($id && $name && $email){
    $sql = "select * 
    from tb_user 
    where name='$name' 
    and id='$id'
    and phone='$phone'
     or email ='$email'"; 
$result = mysql_query($sql);
$count = mysql_num_rows($result);
if($count != 0 ){
    echo $code;   
}else{
    echo "일치하는 정보가 존재하지않습니다"; 
}
} */
 
?>
