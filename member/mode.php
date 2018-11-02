<?php


 $_SESSION['code']  = '123456';
 // 인증코드 생성
if($_POST['val'] == '0'){
    echo '인증 번호가 발송되었습니다.';
    exit();
}

// 인증번호 비교 
if($_POST['val'] == $_SESSION['code']){
    echo 'success';
    exit();
}else if($_POST['val'] != $_SESSION['code']){
    echo 'fail';
    exit();
} 


?>