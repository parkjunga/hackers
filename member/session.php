<?php
 include 'db.php';
session_start();
//$_SESSION['prev_refere'] $_SERVER['HTTP_REFERER'];
$id = $_POST['id'];
$pw = $_POST['pw'];
$pwHash =  hash("sha256",$pw);
$pwStr = substr($pwHash,0,25);
echo $pwStr;
echo '리퍼러';
//echo($_SERVER["HTTP_REFERER"]);
//echo $_SESSION['prev_refere'] ;
//echo("<script>location.href='{$_SESSION['prev_refere']}';</script>"); 
$sql = "select * from tb_user where id='$id' and pw='$pwStr'";
$result = mysql_query($sql);
//echo $result ;
$count = mysql_num_rows($result);
echo $count;
 if($count == 1){
     $_SESSION['id'] = $id;
     $sId = $_SESSION['id'];
     if(isset($sId)){
         echo '해당아이디로 로그인하겠습니다.';
         //header("location:".$_SESSION['prev_refere']);
          //header("Location:{$_SESSION['prev_refere']}");
          echo("<script>location.href='{$_SESSION['prev_refere']}';</script>"); 
          exit();
     }
} else if($count == 0){
   echo "<script> alert('로그인정보를 확인해주세요')</script>";
  // header("location:".$_SERVER['HTTP_REFERE']);
  echo("<script>location.href='/member/login.php';</script>");
   exit();
}


?>