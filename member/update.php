<?php
include '../include/db.php';
 $id = $_POST{'id'};
 $pw = $_POST['password'];
 $pwR = $_POST['passwordRe'];
 $email = $_POST['email1'].'@'.$_POST['email2'];
 $phone = $_POST['phone1'].$_POST['phone2'].$_POST['phone3'];
 $t1 = $_POST['tel1'];
 $t2 = $_POST['tel2'];
 $t3 = $_POST['tel3'];
 $tel = $_POST['tel1']."-".$_POST['tel2']."-".$_POST['tel3'];
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
 echo "<br/>";
// 암호화 
$pwHash = hash("sha256",$pw);

// 비밀번호 체크
if(!ereg("[[:alnum:]+]{8,15}",$pw)) {
    echo "<script>
                alert('비밀번호는 8~15자의 영문자나 숫자의 조합이어야 합니다!!');
       history.back(-1);
     </script>";
    //exit();
  }
  
  // 이름 체크 
  if(!ereg("([^[:space:]]+)", $name) || ereg("([[:space:]]+)",$name)) {
    echo "<script>
                alert('이름에 공백이 존재합니다!!\n\n이름을 공백없이 입력하세요!!');
       history.back(-1);
     </script>";
    //exit();
  }
  
  if($pw != $pwR){
     echo "비밀번호를 확인해주세요";
    // exit();
   }
  

  

/* if($t1 == '' || $t2 == '' || $t3 == ''){
    $sql = "update tb_user 
                set email = '$email'
                    ,addr='$addr'
                ,detail_Addr='$dAddr',
            receive_mail = '$Remail',
             receive_sms = '$Rsms' 
                where id = '$id' ";
}else{
    */ 
$sql = "update tb_user 
              set email = '$email'    
                 ,addr='$addr'
                 ,tel ='$tel'
                ,detail_Addr='$dAddr',
                receive_mail = '$Remail',
                 receive_sms = '$Rsms' 
              where id = '$id' ";
echo $sql;


$result = mysql_query($sql) or die("틀렸다");
echo $result;
 if($result){
     echo "정상적으로입됨";
     echo "<script> 
     document.location.href='/member/index.php'; 
       </script>"; 
 }else{
     echo "정상적으로 입력되지않음";

 } 

?>