<?php
include '../include/db.php';
 $id = $_POST{'id'};
 $pw = $_POST['password'];
 $pwR = $_POST['passwordRe'];
 $email = $_POST['email1'].'@'.$_POST['email2'];
 $phone = $_POST['phone1'].$_POST['phone2'].$_POST['phone3'];
 $tel = $_POST['tel1'].$_POST['tel2'].$_POST['tel3'];
 $postNum = $_POST['postNum'];
 $addr = $_POST['postAddr'];
 $dAddr=$_POST['detailAddr'];
 $Rsms = $_POST['sms'];
 $Remail = $_POST{'email'};
 echo $id;
 echo "<br/>";
 echo $tel;
 echo "<br/>"; 
 echo $postNum;
 echo "<br/>";
 echo $addr;
 echo "<br/>";
 echo $Rsms;
 echo "<br/>";
 echo $Remail;
 echo "<br/>";
 echo $phone;  
// 암호화 
$pwHash = hash("sha256",$pw);
if($tel != ''){
    $sql = "update tb_user 
    set tel ='$tel'
      ,email = '$email'
       ,addr='$addr',detail_Addr='$dAddr' 
       where id = '$id' ";
}else{
    $sql = "update tb_user 
               set email = '$email'
       ,addr='$addr',detail_Addr='$dAddr' 
       where id = '$id' ";
}

$result = mysql_query($sql) or die("틀렸다");
 if(mysql_affected_rows($conn)){
     echo "정상적으로입력되지않았음";
 }else{
     echo "정상적으로 입력됨";
     echo "<script> 
     document.location.href='/member/index.php'; 
       </script>"; 
 } 

?>