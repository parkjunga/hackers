<?php 
 include "../include/db.php";
  
 $name = $_POST['name'];
 $id = $_POST['id'];
 $pw = $_POST['password'];
 $pwR = $_POST['passwordRe'];
 $email = $_POST['email1'].'@'.$_POST['email2'];
 $phone = $_POST['phone1'].$_POST['phone2'].$_POST['phone3'];
 $tel = $_POST['tel1'].$_POST['tel2'].$_POST['tel3'];
 $post = $_POST['postNum'];
 $addr = $_POST['postAddr'];
 $dAddr=$_POST['detailAddr'];
 $Rsms = $_POST['sms'];
 $Remail = $_POST{'email'};
 echo $name;
 echo $id;
 echo $email;
 echo $post;
 echo $addr;
 echo $Rsms;
 echo $Remail;
 echo $phone; 
// 암호화 
$pwHash = hash("sha256",$pw);
//echo "암호화 전 : ".$pw."<br/>";
//echo "암호화 후 : ".$pwHash."<br/>";
//echo "암호화 후 (대문자) : ".strtoupper($pwHash)."<br/>";


 if($pw != $pwR){
   echo "비밀번호를 확인해주세요";
   exit();
 }
/*  if($id == NULL || $pw == NULL || $name == NULL || $email == NULL ){
     echo "빈칸 확인필요";
     exit();
 } */
 $query ="INSERT INTO tb_user (name, id,pw,email,phone,addr,detail_addr,post,receive_mail,receive_sms)
 VALUES ('{$_POST[name]}','{$_POST[id]}','$pwHash','$email','$phone','$addr','$dAddr','{$post}','$Remail','$Rsms')";
 
 $result = mysql_query($query);
    if (!$result) {
        echo "테이블 값 입력 실패: ". mysql_error();
      }
      //echo "테이블 값 입력 성공"; 
      echo "<script> 
        document.location.href='/member/index.php?mode=complete'; 
          </script>"; 
    


?>