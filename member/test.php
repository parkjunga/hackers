<?php
session_start();
include 'db.php';
$_SESSION['code'] = '123456';
$code = $_SESSION['code'];
$test = $_POST['code'];
$phone = $_POST['phone'][0].$_POST['phone'][1].$_POST['phone'][2];
$name = $_POST['name'];
$email = $_POST['email'];
//echo "세션 등록확인";
$sql = "select * 
        from tb_user 
        where name='$name'
        and (phone='$phone'
         or email ='$email')"; 


$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
if($code === $test){
    echo 'Y:';
    echo $row['id'];
}else {
    echo 'N:';
}

?>
