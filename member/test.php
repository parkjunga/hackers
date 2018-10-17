<?php
session_start();
$_SESSION['code'] = '123456';
$code = $_SESSION['code'];
$test = $_POST['code'];
//echo "세션 등록확인";
echo $test;
if($code === $test){
    echo 'Y';
}else {
    echo 'N';
}

?>
