<?php 
 include "../include/db.php";
  
 $name = $_POST['name'];
 $id = $_POST['id'];
 $pw = $_POST['password'];
 $pwR = $_POST['passwordRe'];
 $email = $_POST['email1'].'@'.$_POST['email2'];
 $phone = $_POST['phone1'].$_POST['phone2'].$_POST['phone3'];
 $tel = $_POST['tel1']."-".$_POST['tel2']."-".$_POST['tel3'];
 $post = $_POST['postNum'];
 $addr = $_POST['postAddr'];
 $dAddr=$_POST['detailAddr'];
 $Rsms = $_POST['sms'];
 $Remail = $_POST{'email'};
/*  echo $name;
 echo $id;
 echo $email;
 echo $post;
 echo $addr;
 echo $Rsms;
 echo $Remail;
 echo $phone; 
 echo $tel; */
// 암호화 
$pwHash = hash("sha256",$pw);
//echo "암호화 전 : ".$pw."<br/>";
//echo "암호화 후 : ".$pwHash."<br/>";
//echo "암호화 후 (대문자) : ".strtoupper($pwHash)."<br/>";

//id 유효성 체크 
if(!ereg("[[:alnum:]+]{4,15}",$id)) {
  echo "<script>
              alert('ID는 4~15자의 영문자나 숫자의 조합이어야 합니다!!');
     history.back(-1);
   </script>";
  exit();
}

// 비밀번호 체크
if(!ereg("[[:alnum:]+]{8,15}",$pw)) {
  echo "<script>
              alert('비밀번호는 8~15자의 영문자나 숫자의 조합이어야 합니다!!');
     history.back(-1);
   </script>";
  exit();
}

// 이름 체크 
if(!ereg("([^[:space:]]+)", $name) || ereg("([[:space:]]+)",$name)) {
  echo "<script>
              alert('이름에 공백이 존재합니다!!\n\n이름을 공백없이 입력하세요!!');
     history.back(-1);
   </script>";
  exit();
}

/* for($i = 0; $i < strlen($name); $i++) {
  if(ord($name[$i]) <= 0x80) {
  echo "<script>
              alert('이름은 반드시 한글이어야 합니다!!');
     history.back(-1);
   </script>";
     exit();
  }
} */

 if($pw != $pwR){
   echo "비밀번호를 확인해주세요";
   exit();
 }

 // 이메일 체크 
 if(!ereg("(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$)", $email)) {
  echo "<script>
              alert('이메일주소가 잘못돼었습니다\n\n정확하게 입력해 주세요!!');
     history.back(-1);
   </script>";
  exit();
}



/*  if($id == NULL || $pw == NULL || $name == NULL || $email == NULL ){
     echo "빈칸 확인필요";
     exit();
 } */
 $query ="INSERT INTO tb_user (name, id,pw,email,phone,addr,detail_addr,post,receive_mail,receive_sms,tel)
 VALUES ('{$_POST[name]}','{$_POST[id]}','$pwHash','$email','$phone','$addr','$dAddr','{$post}','$Remail','$Rsms','$tel')";
 
 $result = mysql_query($query);
    if (!$result) {
        echo "테이블 값 입력 실패: ". mysql_error();
      }
      //echo "테이블 값 입력 성공"; 
     /*  echo "<script> 
        document.location.href='/member/index.php?mode=complete'; 
          </script>";  */
    


?>