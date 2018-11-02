<?php

session_start();
$_SESSION['code']='123456';
$code =$_SESSION['code'];
include 'db.php';
$id=$_POST['id'];
$name = $_POST['name'];
$pw = $_POST['pw'];
$email = $_POST['email1'].'@'.$_POST['email2'];
$phone = $_POST['phone'][0].$_POST['phone'][1].$_POST['phone'][2];
// 암호

// 비밀번호 체크
if(!ereg("[[:alnum:]+]{8,15}",$pw)) {
    echo "<script>
                alert('비밀번호는 8~15자의 영문자나 숫자의 조합이어야 합니다!!');
       history.back(-1);
     </script>";
    //exit();
  }


switch($name && $id){
    case $pw :
    $pwHash = hash("sha256",$pw);
    $sql = "update tb_user set pw = '$pwHash' where id='$id' and name ='$name'";
    $result = mysql_query($sql);
    echo 'Y';
    break;

    case $email || $phone:
    $sql = "select * from tb_user where name='$name' and id='$id' and (phone='$phone' or email ='$email')"; 
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
